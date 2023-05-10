<div class="border border-dashed">
    <input type="text" class="input bg-base" hidden name="pacienteid" value="{{$pacienteid}}"/>
    <h2 class="text-2xl font-extrabold dark:text-white"><input type="text" class="input bg-base" hidden name="nome" value="{{$paciente}}"/>#{{$pacienteid}} - {{$paciente}}</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3">
        <p class="my-4 text-md text-gray-500">Nascimento: <input type="text" class="input bg-base" name="nascimento" hidden value="{{$data_nascimento}}"/>{{ date('d/m/Y', strtotime($data_nascimento)) }}</p>
        <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400">Inicio Triagem: <input type="text" name="start" class="input bg-base input-sm" hidden value="{{$inicio_triagem}}"/>{{$inicio_triagem}}</p>
        <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400">{{$data_exame}}</p>
    </div>
    <p class="my-4 text-md font-bold dark:text-white">Procedimento: <input type="text" name="procedimento" class="input bg-base input-sm" value="{{$procedimento}}" hidden/>{{$procedimento}}</p>
</div>
