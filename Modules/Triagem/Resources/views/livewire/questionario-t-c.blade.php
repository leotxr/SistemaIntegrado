<div>

        <div class="relative overflow-x-auto border border-dashed sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Questionario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sim
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Não
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Observação
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perguntas as $pergunta)
                    <tr>
                        <th scope="row" name="pergunta"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-pre-line dark:text-white">
                            <input type="pergunta" name="pergunta[{{$pergunta->id}}]" class="w-full input" readonly value="{{ $pergunta->description }}"/>
                            
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio[{{$pergunta->id}}]" class="mx-2 radio" value="1"/>
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="radio" name="radio[{{$pergunta->id}}]" class="mx-2 radio" value="0" checked />
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="observacao[]"
                                class="w-full mt-2 input input-bordered" value="" />
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
</div>
