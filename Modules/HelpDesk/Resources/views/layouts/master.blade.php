<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>HelpDesk</title>
    
    @include('helpdesk::layouts.partials.head')

    @include('helpdesk::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@include('helpdesk::layouts.partials.alerts')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @can(['editar chamado', 'excluir chamado'])
        @include('helpdesk::layouts.partials.navigation')
    @endcan
    <header class="pt-14 sm:ml-14">
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="px-6 sm:ml-14">
        @yield('content')
    </main>
</div>

</body>

</html>

<script>
    window.addEventListener('notify', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }


    window.onload = function () {

        Echo.channel('dashboard')
            .listen('TicketCreated', (e) => {
                console.log(e);
                notification = new Notification(
                    "Sigma HelpDesk - Novo Chamado Recebido",
                    {
                        body: e.ticket.title ,
                        tag: "Acesse o Painel",
                        requireInteraction: true,
                    }
                )

            });


    };

</script>
