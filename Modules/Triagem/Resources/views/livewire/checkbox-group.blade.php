<div class="block text-md text-gray-500 sm:text-center dark:text-gray-400">
    <div class="items-center">
        <input id="aceite-termo" type="checkbox" value="" checked
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
        <label for="aceite-termo" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">{{$label}} <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">{{$link}}</a>.</label>
    </div>
</div>
<script>
    $("#aceite-termo").click(function(){
        $("#imgclone").toggleClass('hidden');
    })            
    </script>