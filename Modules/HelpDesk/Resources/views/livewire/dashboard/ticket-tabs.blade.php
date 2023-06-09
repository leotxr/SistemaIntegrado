<div class="grid grid-cols-1 gap-4 mx-2 font-bold sm:grid-cols-6 ">
    @php
    $colors = ['#00C510', '#447FFF', '#8978D9', '#B2B2B2', '#FFBD33', '#FF5733'];
    @endphp
    @for($i = 0; $i < 6; $i++)
    <div class="cursor-pointer active:scale-95">
        <div class="rounded-lg shadow-md stat max-h-auto glass" style="background-color: {{$colors[$i]}};">
            <div class="font-bold">Teste</div>
            <div class="text-gray-800 stat-value">
                20
            </div>
        </div>
    </div>
    @endfor
</div>