<div>
    <div class="bg-cover bg-center pt-32 text-white relative min-h-[80vh] h-[80vh]" style="background-image: url({{ asset('img/home-bg.jpg') }})">
        <div class="container relative mx-auto z-0">
            <h1 class="text-[42px] font-bold leading-[1.3] mb-10">Need to talk? <br> We're here to listen to you.</h1>

            <button x-on:click="$openModal('simpleModal')" class="bg-brand-700 hover:bg-brand-800 text-white px-5 py-3 font-bold rounded-md text-lg">Talk to us now</button>
        </div>
    </div>
    <x-modal name="simpleModal" class="x-50 items-center">
        <x-card title="Get started" class="text-black  w-[500px]">
            <div class="p-5">
                @if($user)
                    <h1 class="text-[42px] font-bold leading-[1.3] mb-10">Let's talk.</h1>

                    <x-select
                        wire:model="reason"
                        label="What shall we talk about?"
                        :options="\App\Models\Subject::all()->pluck('name')"
                    />


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

                <x-button primary label="Begin Chat" wire:click="chat" />
            </x-slot>
        </x-card>
    </x-modal>

</div>
