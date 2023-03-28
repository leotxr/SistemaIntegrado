<div class="p-10 bg-white dark:bg-gray-800">
    <h1 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Cadastrar Sub-Categoria</h1>
    <form action="{{ route('sub_categorias.store') }}">
        @csrf
        <div class="mb-6">

            <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorias</label>
            <select id="categoria" name="categoria"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-xl p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 mb-2 dark:focus:border-blue-500">
                <option selected>Selecione uma Categoria</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>

            <label for="sub_categoria_nome" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Nome</label>
            <input type="text" id="sub_categoria_nome" name="sub_categoria_nome"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-xl p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="Nome da Sub-Categoria" required>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cadastrar</button>
    </form>

</div>