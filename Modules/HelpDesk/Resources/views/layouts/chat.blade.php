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
    @livewire('layouts.navigation', ['name' => 'HelpDesk'])
    @can(['editar chamado', 'excluir chamado'])
        @include('helpdesk::layouts.partials.sidebar')
    @endcan
    <header class="pt-14 sm:ml-14">
        <div class="py-4 mx-auto max-w-full sm:px-6 ">
            @yield('header')
        </div>
    </header>
    <main class="sm:ml-14">
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
                alert("Novo chamado recebido");
                console.log('chamado recebido');
                notification = new Notification(
                    "HelpDesk - Sigma Ultrimagem",
                    {
                        body: "Novo Chamado Recebido!",
                        tag: "Acesse o Painel",
                    }
                )

            });


    };

</script>
