<x-button label="Open" x-on:click="$openModal('simpleModal')" primary />

<x-modal name="simpleModal">
    <x-card title="Consent Terms">
        <div class="p-5 h-[80vh]">
            @if($user)
                <h1 class="text-[42px] font-bold leading-[1.3] mb-10">Let's talk.</h1>

                <x-select
                    wire:model="reason"
                    label="What shall we talk about?"
                    :options="\App\Models\Subject::all()->pluck('name')"
                />

                <button wire:click="chat"> continue</button>

            @else
                <h2 class="text-3xl mb-3 text-center font-bold">Almost there.</h2>
                <p class="text-center mb-5">We just need to log you in.</p>


                <div class="flex justify-center">
                    <a href="{{ route('register') }}" class="bg-brand-700 hover:bg-brand-800 text-white px-5 py-3 font-bold rounded-md text-lg">Sign up</a>
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('login') }}" class="text-center mt-3 inline-block">Sign in</a>
                </div>
            @endif
        </div>

        <x-slot name="footer" class="flex justify-end gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />

            <x-button primary label="I Agree" wire:click="agree" />
        </x-slot>
    </x-card>
</x-modal>


