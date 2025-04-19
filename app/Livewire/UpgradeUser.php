<?php

namespace App\Livewire;

use App\Http\Controllers\ManagerController;
use App\Models\User;
use App\Notifications\UserPromotedNotification;
use Livewire\Component;

class UpgradeUser extends Component
{
    public $selectedUser;
    public $userId;
    protected $listeners = ['userSelected' => 'setUserId']; // Add listenerprotected $listeners = ['userSelected' => 'setUserId']; // Add listener


    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->selectedUser = User::find($userId);
    }

    public function upgradeSelectedUser()
    {
        // Verify current user is a manager
        if (!auth()->user()->hasRole('manager')) {
            abort(403, 'Unauthorized action.');
        }



        ManagerController::upgradeToLibrarian($this->selectedUser);

        $this->selectedUser->notify(new UserPromotedNotification());
        session()->flash('success', "User {$this->selectedUser->name} has been upgraded to librarian.");

        //reset the selected user

        $this->selectedUser = null;



    }



    public function render()
    {
        return view('livewire.upgrade-user');
    }
}
