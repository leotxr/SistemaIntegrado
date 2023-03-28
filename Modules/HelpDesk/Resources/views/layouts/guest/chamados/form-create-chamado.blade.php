<div class="p-10 bg-white dark:bg-gray-800">
    <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Cadastrar novo Chamado</h1>
    <form method="post" action="{{url('helpdesk/chamados')}}">
        @csrf
        <div class="mb-6">
            <label for="categoria" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Categoria</label>
            <select id="categoria" name="categoria"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="assunto" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Assunto</label>
            <input type="text" id="assunto" name="assunto"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                placeholder="Assunto" required>
        </div>
        <div class="mb-6">
            <label for="desctricao" class="block mb-2 text-sm font-bold text-gray-900 dark:text-white">Descrição</label>
            <textarea id="descricao" rows="4" name="descricao"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Descreva o problema..."></textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white" for="arquivo">Anexar
                Arquivo</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="arquivo" type="file">
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2">
            <a type="button" href="{{url('helpdesk')}}"
                class="text-gray-900 text-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancelar</a>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Abrir
                Chamado</button>
        </div>
    </form>

</div>