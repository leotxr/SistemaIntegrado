<div class="p-10 bg-white dark:bg-gray-800">
    <h1 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Cadastrar nova Categoria</h1>
    <form action="{{ route('categorias.store') }}">
        @csrf
        <div class="mb-6">
            <label for="categoria_nome" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nome</label>
            <input type="text" id="categoria_nome" name="categoria_nome"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-xl p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="Nome da Categoria" required>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cadastrar</button>
    </form>

</div>