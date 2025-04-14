<?php

namespace Tests\Feature\Livewire;

use App\Livewire\UserSearch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserSearchTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(UserSearch::class)
            ->assertStatus(200);
    }
}
