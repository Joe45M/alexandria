<div x-data="chat" data-chat="{{ $currentChat?->id }}">

    <div class="container text-black mx-auto pt-32">
        @if($pendingRequest)
            <div class="bg-blue-500 py-5 text-white mb-10 rounded-lg px-5"> We're connecting you to a listener. Please wait</div>
        @endif
        <div class="flex gap-3 relative">
            <div class="w-[300px] bg-white p-3 rounded-lg">
                Your conversations

                <div>
                    @if($chats)
                        @foreach($chats->sortByDesc('updated_at') as $chat)
                            <button wire:click="setChat({{ $chat->id }})" class="block hover:bg-blue-50 rounded-lg w-full text-left mb-5 p-3 {{ $chat->unreadCount ? 'bg-blue-50' : '' }}">

                                <span class="flex gap-3">
                                    @if(\Illuminate\Support\Facades\Auth::user()->type === 'listener')
                                        <img src="{{ $chat->member->avi }}" alt="">

                                        {{ $chat->member->name }}
                                    @else
                                        <img src="{{ $chat->listener->avi }}" alt="Image" class="w-10 rounded-full">

                                        <div>
                                            {{ $chat->listener->name }}
                                            <div class="text-gray-500 italic">
                                                {{ $chat?->latest?->message }}
                                            </div>
                                        </div>
                                    @endif
                                </span>



                            </button>
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="bg-white p-3 flex-grow rounded-lg relative">
                <div class="sticky border-b border-b-gray-200 top-0 left-0 bg-white p-5 w-full">
                    <p class="text-2xl title">
                        @if(\Illuminate\Support\Facades\Auth::user()->type === 'listener')
                            {{ $chat->member->name }}
                        @else
                            {{ $chat->listener->name }}
                        @endif
                    </p>
                </div>
                <div class="h-[40vh] chat-body flex flex-col-reverse overflow-scroll">
                    @if($currentChat)
                        @foreach($currentChat->messages->sortByDesc('created_at') as $ms)
                            <div class="flex {{ $ms->user_id === auth()->id() ? 'justify-end' : '' }}">
                                <div class="block mb-5 p-3 bg-blue-100/50 min-w-[20%] w-auto max-w-[60%] inline-block">
                                    {{ $ms->message }}
                                </div>
                            </div>
                        @endforeach
                    @else

                        <div class="flex justify-center items-center h-full text-gray-300">
                            <div class="text-center">
                                No conversation selected.

                                <div class="text-xl">
                                    @if(auth()->user()->chatRequests()->count())
                                        We're matching you with a listener. Please wait
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex gap-3">
                    <input class="bg-gray-100 flex-grow border-none rounded-md"
                           wire:model='message'
                           wire:keydown.enter="submitMessage"
                           type="text"
                           wire:keyup="typing"
                           placeholder="Write your message...">

                    <button wire:click='submitMessage' class="bg-green-500/70 px-3 rounded-full text-white">
                        <i class="fa-solid fa-paper-plane-top"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
