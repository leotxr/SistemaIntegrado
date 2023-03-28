<div class="p-10 bg-white dark:bg-gray-800">
    <h1 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Cadastrar novo Status</h1>
    <form action="{{ route('statuses.store') }}">
        @csrf
        <div class="mb-6">
            <label for="status_nome" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nome</label>
            <input type="text" id="status_nome" name="status_nome"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-xl p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="Nome do Status" required>
        </div>
        <div class="mb-6">
            <label for="status_cor" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Cor</label>
            <select id="status_cor" name="status_cor"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-xl p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecione uma cor</option>
                <option
                    class="bg-blue-100 text-blue-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                    value="blue">Azul</option>
                <option
                    class="bg-gray-100 text-gray-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300"
                    value="gray">Cinza</option>
                <option
                    class="bg-green-100 text-green-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                    value="green">Verde</option>
                <option
                    class="bg-red-100 text-red-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                    value="red">Vermelho</option>
                <option
                    class="bg-yellow-100 text-yellow-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                    value="yellow">Amarelo</option>
                <option
                    class="bg-indigo-100 text-indigo-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300"
                    value="indigo">Indigo</option>
                <option
                    class="bg-purple-100 text-purple-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300"
                    value="purple">Roxo</option>
                <option
                    class="bg-pink-100 text-pink-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300"
                    value="pink">Rosa</option>
            </select>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cadastrar</button>
    </form>

</div>