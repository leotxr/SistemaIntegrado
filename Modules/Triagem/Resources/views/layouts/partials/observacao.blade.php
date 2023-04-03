<div class="p-2 mb-3 mt-2 border">
    <div class="pb-2">
        <h1 class="font-bold text-md sm:text-lg">Observação</h1>
    </div>
    <div>
        <label for="message" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Observações da triagem</label>
        <textarea id="observacao" name="observacao" rows="4" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1' value="{{$termo->observacao ?? ''}}" name="observacao"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >{{$termo->observation ?? ''}}</textarea>
    </div>
</div>
