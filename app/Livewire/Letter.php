<?php

namespace App\Livewire;

use Livewire\Component;

class Letter extends Component
{
    // PUBLIC PROPERTIES
    // These are "reactive" properties accessible from the frontend (Blade view).
    // Livewire automatically keeps them in sync with the UI.
    public $name = '';              // Holds the user's name input
    public $email = '';             // Holds the user's email input
    public $successMessage = '';    // Holds success message after subscribing

    // VALIDATION RULES
    // Define backend validation rules for inputs.
    // Livewire will automatically check inputs against these.
    protected $rules = [
        'name' => 'required|min:3',   // Name must be at least 3 characters long
        'email' => [
            'required',               // Email is required
            'email',                  // Must be a valid email format
            'regex:/^[\w\.-]+@(gmail|yahoo)\.com$/i', // Only Gmail or Yahoo allowed
        ],
    ];

    // CUSTOM ERROR MESSAGES
    // Override default validation messages.
    protected $messages = [
        'email.regex' => 'Only Gmail or Yahoo emails are allowed.', // Friendly message for regex rule
    ];

    // REAL-TIME VALIDATION
    // Called automatically when a property is updated (e.g., typing in input field).
    // Communicates between frontend (input fields) and backend (validation).
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // SUBSCRIBE ACTION
    // Called when the user clicks "Subscribe".
    // Validates the input, resets the fields, and sets a success message.
    // Communicates with:
    //  - Backend (validation logic)
    //  - Frontend (resets input fields and shows success message)
    public function subscribe()
    {
        $this->validate();  // Validate all inputs

        $this->reset(['name', 'email']); // Clear form fields after success
        $this->successMessage = 'You have successfully subscribed!'; // Show success message

        // Dispatch a frontend browser event to auto-clear the success message after a while
        $this->dispatch('clearMessage');
    }

    // CLEAR SUCCESS MESSAGE
    // This will be triggered by the frontend event dispatched above.
    // Communicates with frontend to hide the success alert.
    public function clearMessage()
    {
        $this->successMessage = '';
    }

    // RENDER METHOD
    // Tells Livewire which Blade view to render.
    // Communicates with the frontend (resources/views/livewire/letter.blade.php)
    public function render()
    {
        return view('livewire.letter');
    }
}
