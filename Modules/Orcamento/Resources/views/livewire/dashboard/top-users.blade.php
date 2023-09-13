<div>

    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Orçamentos por atendente</h2>
    <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
        @foreach($users as $user)
        <li>
            <span class="font-semibold text-gray-900 dark:text-white">{{$user->name}}</span> com <span
                class="font-semibold text-gray-900 dark:text-white">{{$user->relBudgets->count()}}</span> orçamentos
        </li>
        @endforeach

    </ol>

</div>