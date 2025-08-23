<?php

namespace App\Livewire;

use Livewire\Component;

class Letter extends Component
{
    public $name = '';
    public $email = '';
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => [
            'required',
            'email',
            'regex:/^[\w\.-]+@(gmail|yahoo)\.com$/i',
        ],
    ];

    protected $messages = [
        'email.regex' => 'Only Gmail or Yahoo emails are allowed.',
    ];

    // real-time validation for individual fields
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function subscribe()
    {
        $this->validate();

        $this->reset(['name', 'email']);
        $this->successMessage = 'You have successfully subscribed!';

        // trigger frontend to auto-clear message
        $this->dispatch('clearMessage');
    }

    public function clearMessage()
    {
        $this->successMessage = '';
    }

    public function render()
    {
        return view('livewire.letter');
    }
}

