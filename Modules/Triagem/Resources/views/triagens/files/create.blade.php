@extends('triagem::layouts.master')
@section('content')
    <form method="POST" action="{{ route('store.term-file', ['id' => $triagem->id]) }} " enctype="multipart/form-data">
        @csrf
        <div class="bg-white dark:bg-black shadow-sm m-4">
            <div class="space-y-12 max-w-2xl p-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Arquivos da triagem #{{ $triagem->id }}</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Formulário para inserção de arquivos referentes à triagem
                        realizada.</p>

                    <div class="pt-2">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Paciente:
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ $triagem->patient_name }}</p>
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Procedimento:
                        </h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">{{ $triagem->proced }}</p>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="col-span-full">
                           <livewire:triagem::text-area />
                        </div>

                        <div id="file_input" class="col-span-full">
                            <label for="arquivos" class="block text-sm font-medium leading-6 text-gray-900">Adicionar
                                arquivos</label>
                            <div class="flex">
                                <div>
                                    <input name="arquivos" value=""
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="arquivo_help" id="arquivos" type="file" multiple>
                                </div>
                                <div class="mx-2">
                                    <select id="file_type" name="tipo" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Tipo do arquivo</option>
                                        @foreach($file_types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--
                                <div>
                                    <button type="button"
                                        class="text-blue-700 border border-blue-700 mx-2 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>

                                        <span class="sr-only">Adicionar</span>
                                    </button>
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                    <div class="m-2">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
