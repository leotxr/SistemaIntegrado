<div wire:poll>
    <div class="justify-items-center grid sm:grid-cols-3 grid-cols-1 gap-4 content-evenly py-8">
        <div class="text-center text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" class="bi bi-emoji-angry"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zm6.991-8.38a.5.5 0 1 1 .448.894l-1.009.504c.176.27.285.64.285 1.049 0 .828-.448 1.5-1 1.5s-1-.672-1-1.5c0-.247.04-.48.11-.686a.502.502 0 0 1 .166-.761l2-1zm-6.552 0a.5.5 0 0 0-.448.894l1.009.504A1.94 1.94 0 0 0 5 6.5C5 7.328 5.448 8 6 8s1-.672 1-1.5c0-.247-.04-.48-.11-.686a.502.502 0 0 0-.166-.761l-2-1z" />
            </svg>
            <span class="font-bold text-2xl">{{$queue->count()}}</span>
        </div>
        <div class="text-center text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" class="bi bi-emoji-neutral"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M4 10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm3-4C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5z" />
            </svg>
            <span class="font-bold text-2xl">10</span>
        </div>
        <div class="text-center text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" class="bi bi-emoji-laughing"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zM7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z" />
            </svg>
            <span class="font-bold text-2xl">10</span>
        </div>
        Ultima Atualização: {{now()}}
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th>Médico</th>
                    <th>Aguardando</th>
                    <th>Atrasados até 10'</th>
                    <th>Atrasados após 10'</th>
                    <th>Atendidos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filas as $fila)
                <tr>
                    <th>{{$fila['name']}}</th>
                    <td class="font-bold text-xl">{{$queue->where('FILAID', $fila['id'])->where('STATUSID', 0)->count()}}</td>
                    <td class="font-bold text-xl">0</td>
                    <td class="font-bold text-xl">0</td>
                    <td class="font-bold text-xl">{{$queue->where('FILAID', $fila['id'])->where('STATUSID', 2)->count()}}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Total</th>
                    <td class="font-bold text-xl"></td>
                    <td class="font-bold text-xl">0</td>
                    <td class="font-bold text-xl">0</td>
                    <td class="font-bold text-xl"></td>
                </tr>
            </tbody>
        </table>
    </div>



</div>