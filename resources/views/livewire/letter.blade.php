<div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f5f5f5;">
    <!-- Outer container to center the form vertically and horizontally -->
    <div style="background-color: #0000; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px;">

        {{-- SUCCESS MESSAGE ALERT --}}
        {{-- Shown only if $successMessage is set by Livewire (backend -> frontend). --}}
        @if ($successMessage)
            <div
                x-data="{ show: true }"                     {{-- Alpine.js: reactive state for showing/hiding --}}
                x-init="setTimeout(() => show = false, 3000)" {{-- Auto-hide after 3 seconds --}}
                x-show="show"                               {{-- Toggle visibility --}}
                style="color: #2f855a; background-color: #c6f6d5; padding: 10px; border-radius: 4px; margin-bottom: 1rem; font-size: 0.9rem; transition: all 0.5s ease;">
                {{ $successMessage }} {{-- Message comes from Livewire backend --}}
            </div>
        @endif

        <!-- Form heading -->
        <h2 style="text-align: center; font-size: 1.5rem; margin-bottom: 1.5rem; color: #2d3748;">
            Subscribe to Newsletter
        </h2>

        <!-- SUBSCRIPTION FORM -->
        <!-- wire:submit.prevent="subscribe" connects frontend form to Livewire backend method 'subscribe' -->
        <form wire:submit.prevent="subscribe">

            {{-- NAME FIELD --}}
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #4a5568;">Name:</label>
                <input type="text"
                       wire:model.live="name" {{-- Two-way binding: input <-> $name property in Livewire --}}
                       style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e0; border-radius: 4px; color: #000;">
                @error('name') {{-- Validation error message from Livewire --}}
                    <div style="color: #e53e3e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            {{-- EMAIL FIELD --}}
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; color: #4a5568;">Email:</label>
                <input type="email"
                       wire:model.live="email" {{-- Two-way binding: input <-> $email property in Livewire --}}
                       style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e0; border-radius: 4px; color: #000;">
                @error('email') {{-- Validation error message from Livewire --}}
                    <div style="color: #e53e3e; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit"
                    style="width: 100%; background-color: #3182ce; color: white; padding: 0.75rem; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer;">
                Subscribe
            </button>
        </form>
    </div>
</div>

{{-- FRONTEND SCRIPT --}}
{{-- Listens for the Livewire backend event 'clearMessage' (dispatched from PHP class). --}}
{{-- After 3s, it tells Livewire to run clearMessage() method, which resets $successMessage. --}}
<script>
    Livewire.on('clearMessage', () => {
        setTimeout(() => {
            Livewire.dispatch('clearMessage'); // Communicates back to Livewire backend method
        }, 3000);
    });
</script>
