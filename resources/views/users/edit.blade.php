<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            
            <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="avatar">
                        <div class="w-24 rounded-full active:scale-250">
                            <img src="{{ URL::asset($user->profile_img) }}" />
                        </div>
                    </div>
        
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                
                <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.fields.update-name-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.fields.update-password-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.fields.update-permissions-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.fields.show-user-permissions')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>