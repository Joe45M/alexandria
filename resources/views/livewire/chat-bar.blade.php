<div class="{{ $requests->count() > 8 ? 'bg-red-500' : 'bg-green-500' }} py-3">
    <div class="container mx-auto flex gap-5 items-center text-white">
        <x-button x-on:click="$openModal('blur-sm')" outline white xl>
            {{ $requests->count() }} chat requests
        </x-button>

        @if($requests->count() > 8)

            <div>
                We are busy! <br>
                please take a chat.
            </div>

        @endif
    </div>



    <x-modal name="blur-sm" blur="sm">
        <x-card title="Pending chats" class="w-[600px]">
            @foreach($requests as $request)
                <div class="group relative flex justify-between gap-3 mb-5">

                    <x-button wire:click="accept({{ $request->id }})" class="hidden group-hover:block absolute right-0 top-0" blue>Accept chat</x-button>

                    <img src="{{ $request->user->avi }}" alt="user image" class="w-10">

                    <div class="text-center">
                        {{ $request?->user->name }}
                        <div>
                            <x-badge>
                                {{ $request?->subject?->first()?->name }}
                            </x-badge>
                        </div>
                    </div>

                    <div>
                        {{ $request->created_at->diffForHumans() }}
                        <div>Waiting since</div>
                    </div>
                </div>
            @endforeach
        </x-card>
    </x-modal>
</div>
