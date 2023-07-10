<div>
    <x-title class="my-4 text-2xl">Notificações não lidas</x-title>
    <a type="button" wire:click='readAll' style="cursor: pointer"
        class="mb-4 text-lg text-blue-600 dark:text-blue-400 hover:line">Marcar todas como lida</a>
    <a type="button" wire:click='deleteAll' style="cursor: pointer"
        class="mx-4 mb-4 text-red-600 text-md dark:text-red-400 hover:line">Excluir todas notificações</a>
    {!! $unread->links() !!}
    <div class="grid grid-cols-3 gap-2">
        @foreach($unread as $notification)
        <div id="toast-notification"
            class="w-full max-w-xs p-4 text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-300"
            role="alert">
            <div class="flex items-center mb-3">
                <span class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Novo Chamado</span>
                <a type="button" href="{{route('helpdesk.tickets.edit', ['id' => $notification->data['ticket_id']])}}"
                    class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                    <span class="sr-only">Marcar como lida</span>
                    @if($notification->read_at)
                    <x-icon name='external-link' class="w-5 h-5 text-gray-400"></x-icon>
                    @else
                    <x-icon name="mail" class="w-5 h-5"></x-icon>
                    @endif

                </a>
                <a type="button"
                    class="mx-2 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">
                    <x-icon name='trash' class="w-5 h-5 text-gray-400"></x-icon>
                </a>
            </div>
            <div class="flex items-center">
                <div class="ml-3 text-sm font-normal">
                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{$notification->data['user_name'] ?? ''}}
                    </div>
                    <div class="text-sm font-normal">#{{$notification->data['ticket_id'] ?? ''}} -
                        {{$notification->data['ticket_title'] ?? ''}}</div>
                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500">{{date("d/m/Y H:i:s",
                        strtotime($notification->created_at))}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>