<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class BookDescription extends Component
{
    public $bookTitle;
    public $bookAuthor;
    public $description = '';
    public $isLoading = false;
    public $debugResponse = '';

    public function mount($bookTitle, $bookAuthor = null)
    {
        $this->bookTitle = $bookTitle;
        $this->bookAuthor = $bookAuthor;
    }

    public function generateDescription()
    {
        $this->isLoading = true;

        try {
            $apiKey = env('TOGETHER_API_KEY');

            if (!$apiKey) {
                $this->description = "Error: API key is missing. Please check your .env file.";
                $this->isLoading = false;
                return;
            }

            $authorInfo = $this->bookAuthor ? " by {$this->bookAuthor}" : "";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])->post('https://api.together.xyz/v1/chat/completions', [
                'model' => 'meta-llama/Meta-Llama-3.1-8B-Instruct-Turbo-classifier',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a literary assistant that provides concise, engaging one-paragraph book descriptions.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Generate a single paragraph book description for '{$this->bookTitle}'{$authorInfo}.
                                     Keep it under 100 words and make it engaging."
                    ],
                ],
                'max_tokens' => 150,
                'temperature' => 0.4,
            ]);

            $responseData = $response->json();

            // Store the raw response for debugging if needed
            $this->debugResponse = json_encode($responseData, JSON_PRETTY_PRINT);

            if (isset($responseData['choices'][0]['message']['content'])) {
                $this->description = trim($responseData['choices'][0]['message']['content']);
            } else if (isset($responseData['error'])) {
                $this->description = "API Error: " . $responseData['error']['message'];
            } else {
                $this->description = "Error: Invalid response structure.";
            }
        } catch (\Exception $e) {
            $this->description = "Error: " . $e->getMessage();
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.book-description');
    }
}
