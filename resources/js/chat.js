import {Howl, Howler} from 'howler';

document.addEventListener('livewire:init', () => {
    Livewire.on('request-notification', (event) => {

        var requestNotification = new Howl({
            src: ['/media/chat-request.wav'],
        });

        requestNotification.play();

    });

    Livewire.on('new-message', (event) => {
       console.log('test');
        var objDiv = document.querySelector(".chat-body");
        objDiv.scrollIntoView(false);
    });

    Livewire.on('chat-selected', (event) => {

        console.log('new chat')
        var objDiv = document.querySelector(".chat-body");
        objDiv.scrollIntoView(false);

    });
});

if (window.user) {
    Echo.channel(`accepted.${window.user.id}`)
        .listen('PendingChatEvent', e => {

            console.log('Chat has been accepted by listener.');

            $wireui.notify({
                icon: 'success',
                title: 'Your listener is ready!',
                description: 'We\'ll open your chat now.',
                onTimeout: () => window.location.href = '/chat?pdchat=' + e.chat,
            })
        });
}

document.addEventListener('alpine:init', () => {
    Alpine.data('chat', () => ({
        typing: false,
        chat: null,
        init: () => {
            Livewire.on('chat-selected', (event) => {

                window.chat = document.querySelector('[data-chat]').getAttribute('data-chat');

                // Echo.channel(`typing.${window.chat}`)
                //     .listen('TypingEvent', (e) => {
                //         console.log(e);
                //     })

            });
        }
    }))
})
