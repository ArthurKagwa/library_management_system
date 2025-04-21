<?php

    namespace App\Livewire;

    use App\Models\Checkout;
    use App\Models\Penalty;
    use Livewire\Component;

    class CheckinForm extends Component
    {
        public $checkinId;
        public $checkin = null;

        // Fields
        public $returnCondition;
        public $fineAmount = 0;
        public $finePerDay = 0;
        public $finePerCondition = 0;
        public $daysExceeded = 0;
        public $damageLevels = 0;
        public $overdueFine =0;
        public $damageFine =0;

        //set damage levels function
        public function setDamageLevels()
        {
            if ($this->checkin) {
                $conditions = ['new', 'good', 'fair', 'poor', 'damaged'];
                $checkoutIndex = array_search($this->checkin->checkout_condition, $conditions);
                $returnIndex = array_search($this->returnCondition, $conditions);

                if ($checkoutIndex !== false && $returnIndex !== false) {
                    $this->damageLevels = max(0, $returnIndex - $checkoutIndex);
                } else {
                    $this->damageLevels = 0; // Default to 0 if conditions are invalid
                }
            }
        }

        public function setDaysExceeded()
        {
            if ($this->checkin && $this->checkin->due_date) {
                $dueDate = \Carbon\Carbon::parse($this->checkin->due_date);
                $currentDate = now();

                // Only calculate daysExceeded if the current date is past the due date
                if ($currentDate->greaterThan($dueDate)) {
                    $this->daysExceeded = $currentDate->diffInDays($dueDate);
                } else {
                    $this->daysExceeded = 0; // No days exceeded if not overdue
                }
            } else {
                $this->daysExceeded = 0; // Default to 0 if no due date is available
            }
        }


        public function calculateFineAmount()
        {
            // Ensure the checkin exists
            if ($this->checkin) {
                // Calculate fines using global properties
                $this->overdueFine = $this->daysExceeded * $this->finePerDay;
                $this->damageFine = $this->damageLevels * $this->finePerCondition;

                // Total fine amount
                $this->fineAmount = $this->overdueFine + $this->damageFine;
            } else {
                $this->fineAmount = 0; // Default to 0 if no checkin exists
            }
        }

        // Mount
        public function mount($checkinId = null)
        {
            $this->checkinId = $checkinId;
            $this->finePerDay = Penalty::where('type', 'fine_per_day_exceeded')->first()->base_amount;
            $this->finePerCondition = Penalty::where('type', 'fine_per_damage_level')->first()->base_amount;

            // Reload the checkin data if an ID is provided
            if ($this->checkinId) {
                $this->checkin = Checkout::find($this->checkinId);
                //set the fine variables
                $this->setDaysExceeded();
                $this->setDamageLevels();

                // Set the return condition if the checkin exists
                $this->returnCondition = $this->checkin ? $this->checkin->return_condition : null;
            } else {
                // Reset fields if no checkin ID is provided
                $this->checkin = null;
                $this->returnCondition = null;
                $this->fineAmount = 0;
            }
        }

        protected $listeners = [
            'checkoutSelected' => 'setCheckin',
        ];

        public function setCheckin($checkoutId)
        {
            $this->checkinId = $checkoutId;
            $this->checkin = Checkout::find($checkoutId);

            if ($this->checkin && $this->checkin->return_date !== null) {
                $this->mount(); // Reset the component if return_date is not null
            }
        }
        public function updated($property)
        {
            if ($property === 'checkinId') {
                $this->checkin = Checkout::find($this->checkinId);
                $this->mount($this->checkinId);
            }
        }


        // Update fine amount based on the return condition
        public function updatedReturnCondition()
        {
            if ($this->checkin) {
                $this->setDamageLevels();
                $this->setDaysExceeded();
                $this->calculateFineAmount();
            }
        }



        // Submit
public function submit()
        {
            $this->validate([
                'returnCondition' => [
                    'required',
                    'in:new,good,fair,poor,damaged',
                    function ($attribute, $value, $fail) {
                        $conditions = ['new', 'good', 'fair', 'poor', 'damaged'];
                        $previousCondition = $this->checkin->checkout_condition;

                        if (array_search($value, $conditions) < array_search($previousCondition, $conditions)) {
                            $fail(__('The return condition must be worse or equal to the checkout condition.'));
                        }
                    },
                ],
            ]);

            if ($this->checkin) {
                $this->checkin->update([
                    'return_condition' => $this->returnCondition,
                    'return_date' => now(),
                    'fine_amount' => $this->fineAmount,
                ]);

                // Reload the checkin data to reflect changes
                $this->checkin = $this->checkin->fresh();

                //mount
                $this->mount();

                session()->flash('success', 'Check-in successful!');
            } else {
                session()->flash('error', 'Check-in not found.');
            }
        }
        public function render()
        {
            return view('livewire.checkin-form');
        }
    }
