<div class="justify-center max-w-3xl mx-12">
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="p-4 m-4 space-y-12 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="pb-12 border-b border-gray-900/10">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Cadastro do usuário</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">As informações inseridas serão referentes ao novo
                    usuário cadastrado.</p>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Usuario</label>
                        <div class="mt-2">
                            <x-text-input type="text" name="username" id="username" autocomplete="username"
                                placeholder="usuario"></x-text-input>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Foto de perfil</label>
                        <div class="flex items-center mt-2 gap-x-3" x-data="{open: false}">
                            <svg class="w-12 h-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <button type="button" x-on:click="open = ! open"
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Escolher</button>

                            <div x-show="open" x-transition>
                                <input type="file" name="photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-12 border-b border-gray-900/10">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Informações pessoais</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use o endereço de e-mail correspondente ao utilizado na
                    empresa pelo setor.</p>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                            required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label for="lastname" :value="__('Sobrenome')" />
                        <x-text-input id="lastname" class="block w-full mt-1" type="text" name="lastname"
                            :value="old('lastname')" required autofocus />
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>

                    <div class="sm:col-span-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                            :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label for="user_group_id" :value="__('Setor')" class="text-lg font-bold" />
                        <x-select name='user_group_id' id="user_group_id" class="w-full">
                            <x-slot name='option'>
                                <option selected> Selecione </option>
                                @foreach($groups as $group)
                                <x-select.option value="{{$group->id}}">
                                    {{$group->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('group')" />
                    </div>
                    <div class="sm:col-span-3">
                        <label for="role" class="block text-sm font-medium text-gray-700">Permissão/Cargo</label>
                        <select id="role" name="role" autocomplete="cargo"
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option selected> Selecione </option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="sm:col-span-3">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="sm:col-span-3">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                            name="password_confirmation" required />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>
                <div class="flex items-center justify-end mt-10">

                    <x-secondary-button class="ml-4">{{__('Cancelar')}}</x-secondary-button>
                    <x-primary-button class="ml-4">
                        {{ __('Cadastrar') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</div>