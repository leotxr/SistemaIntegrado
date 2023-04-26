<div id="file_input">
    <form wire:submit.prevent='save'>
        <div>
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>

        <label for="arquivos" class="block text-sm font-medium leading-6 text-gray-900">Adicionar
            arquivos</label>
        <div class="flex">
            <div>
                <input type="file" wire:model="photo"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="arquivo_help" accept="image/*;capture=camera">
            </div>

            <div class="mx-2">
                <select wire:model='type' required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Tipo do arquivo</option>
                    @foreach($file_type as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="m-2">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Salvar</button>
        </div>
    </form>
</div>