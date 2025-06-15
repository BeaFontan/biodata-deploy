@extends('layouts.app-auth')

@section('title', 'Cambiar contrasinal')

@section('content')
    <div class="flex flex-col flex-1 w-full lg:w-1/2">
        <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
            @if(session('error'))
                <div class="mb-4 rounded-lg bg-error-50 text-red-alert dark:bg-error-500/15 dark:text-red-alert">
                    {{ session('error') }}
                </div>
            @elseif($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="mb-4 rounded-lg bg-error-50 text-red-alert dark:bg-error-500/15 dark:text-red-alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="mb-5 sm:mb-8">
                <h1 class="mb-2 font-semibold text-green-bright text-title-sm dark:text-white/90 sm:text-title-md">Mudar contrasinal</h1>
                <p class="text-lg text-gray-500 dark:text-green-bright">Introduce a teu vello contrasinal e o que queres usar en adiante</p>
            </div>

            <form method="POST" id="form-change-pass" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                <div class="space-y-5">

                    {{-- Contraseña actual --}}
                    <div>
                        <label class="mb-1.5 block text-gray-700 dark:text-white/90">Contrasinal actual<span class="text-error-500">*</span></label>
                        <div x-data="{ showPassword: false }" class="relative">
                            <input name="current_password" :type="showPassword ? 'text' : 'password'" placeholder="Contrasinal actual" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:border-green-bright dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"/>
                            <span @click="showPassword = !showPassword" class="absolute z-30 text-gray-500 -translate-y-1/2 cursor-pointer right-4 top-1/2 dark:text-gray-400">
                                <svg x-show="!showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 13.86C7.23 13.86 4.87 12.14 3.92 9.7C4.87 7.27 7.23 5.54 10 5.54C12.77 5.54 15.13 7.27 16.08 9.7C15.13 12.14 12.77 13.86 10 13.86ZM10 4.04C6.48 4.04 3.49 6.31 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C13.52 15.36 16.51 13.1 17.58 9.95C17.64 9.79 17.64 9.62 17.58 9.46C16.51 6.31 13.52 4.04 10 4.04ZM9.99 7.84C8.96 7.84 8.13 8.68 8.13 9.7C8.13 10.73 8.96 11.56 9.99 11.56H10.01C11.03 11.56 11.86 10.73 11.86 9.7C11.86 8.68 11.03 7.84 10.01 7.84H9.99Z" fill="#98A2B3"/></svg>
                                <svg x-show="showPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.64 3.58C4.35 3.28 3.87 3.28 3.58 3.58C3.28 3.87 3.28 4.34 3.58 4.64L4.85 5.91C3.75 6.84 2.89 8.06 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C11.26 15.36 12.44 15.07 13.5 14.56L15.36 16.42C15.66 16.72 16.13 16.72 16.42 16.42C16.72 16.13 16.72 15.66 16.42 15.36L4.64 3.58ZM12.36 13.42L10.45 11.51C10.31 11.54 10.16 11.56 10.01 11.56H9.99C8.96 11.56 8.13 10.73 8.13 9.7C8.13 9.55 8.15 9.39 8.19 9.25L5.92 6.98C5.04 7.69 4.34 8.63 3.92 9.7C4.87 12.14 7.23 13.86 10 13.86C10.83 13.86 11.63 13.71 12.36 13.42Z" fill="#98A2B3"/></svg>
                            </span>
                        </div>
                        @error('current_password') <p class="text-sm text-error-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nueva contraseña --}}
                    <div>
                        <label class="mb-1.5 block text-gray-700 dark:text-white/90">
                            Novo contrasinal<span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ showNewPassword: false }" class="relative">
                            <input name="new_password" id="new_password" :type="showNewPassword ? 'text' : 'password'" placeholder="Novo contrasinal"
                                   class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:border-green-bright dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30" />
                            <span @click="showNewPassword = !showNewPassword" class="absolute z-30 text-gray-500 -translate-y-1/2 cursor-pointer right-4 top-1/2 dark:text-gray-400">
                                <svg x-show="!showNewPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10 13.86C7.23 13.86 4.87 12.14 3.92 9.7C4.87 7.27 7.23 5.54 10 5.54C12.77 5.54 15.13 7.27 16.08 9.7C15.13 12.14 12.77 13.86 10 13.86ZM10 4.04C6.48 4.04 3.49 6.31 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C13.52 15.36 16.51 13.1 17.58 9.95C17.64 9.79 17.64 9.62 17.58 9.46C16.51 6.31 13.52 4.04 10 4.04ZM9.99 7.84C8.96 7.84 8.13 8.68 8.13 9.7C8.13 10.73 8.96 11.56 9.99 11.56H10.01C11.03 11.56 11.86 10.73 11.86 9.7C11.86 8.68 11.03 7.84 10.01 7.84H9.99Z" fill="#98A2B3" />
                                </svg>
                                <svg x-show="showNewPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4.64 3.58C4.35 3.28 3.87 3.28 3.58 3.58C3.28 3.87 3.28 4.34 3.58 4.64L4.85 5.91C3.75 6.84 2.89 8.06 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C11.26 15.36 12.44 15.07 13.5 14.56L15.36 16.42C15.66 16.72 16.13 16.72 16.42 16.42C16.72 16.13 16.72 15.66 16.42 15.36L4.64 3.58ZM12.36 13.42L10.45 11.51C10.31 11.54 10.16 11.56 10.01 11.56H9.99C8.96 11.56 8.13 10.73 8.13 9.7C8.13 9.55 8.15 9.39 8.19 9.25L5.92 6.98C5.04 7.69 4.34 8.63 3.92 9.7C4.87 12.14 7.23 13.86 10 13.86C10.83 13.86 11.63 13.71 12.36 13.42Z" fill="#98A2B3" />
                                </svg>
                            </span>
                        </div>
                        @error('new_password') <p class="text-sm text-error-500 mt-1">{{ $message }}</p> @enderror
                    </div>


                    {{-- Confirmación --}}
                    <div>
                        <label class="mb-1.5 block text-gray-700 dark:text-white/90">
                            Confirma o novo contrasinal<span class="text-error-500">*</span>
                        </label>
                        <div x-data="{ showConfirmPassword: false }" class="relative">
                            <input name="new_password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" placeholder="Confirmar novo contrasinal"
                                   class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:outline-none focus:border-green-bright dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30" />
                            <span @click="showConfirmPassword = !showConfirmPassword" class="absolute z-30 text-gray-500 -translate-y-1/2 cursor-pointer right-4 top-1/2 dark:text-gray-400">
                                <svg x-show="!showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10 13.86C7.23 13.86 4.87 12.14 3.92 9.7C4.87 7.27 7.23 5.54 10 5.54C12.77 5.54 15.13 7.27 16.08 9.7C15.13 12.14 12.77 13.86 10 13.86ZM10 4.04C6.48 4.04 3.49 6.31 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C13.52 15.36 16.51 13.1 17.58 9.95C17.64 9.79 17.64 9.62 17.58 9.46C16.51 6.31 13.52 4.04 10 4.04ZM9.99 7.84C8.96 7.84 8.13 8.68 8.13 9.7C8.13 10.73 8.96 11.56 9.99 11.56H10.01C11.03 11.56 11.86 10.73 11.86 9.7C11.86 8.68 11.03 7.84 10.01 7.84H9.99Z" fill="#98A2B3" />
                                </svg>
                                <svg x-show="showConfirmPassword" class="fill-current" width="20" height="20" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4.64 3.58C4.35 3.28 3.87 3.28 3.58 3.58C3.28 3.87 3.28 4.34 3.58 4.64L4.85 5.91C3.75 6.84 2.89 8.06 2.42 9.46C2.36 9.62 2.36 9.79 2.42 9.95C3.49 13.1 6.48 15.36 10 15.36C11.26 15.36 12.44 15.07 13.5 14.56L15.36 16.42C15.66 16.72 16.13 16.72 16.42 16.42C16.72 16.13 16.72 15.66 16.42 15.36L4.64 3.58ZM12.36 13.42L10.45 11.51C10.31 11.54 10.16 11.56 10.01 11.56H9.99C8.96 11.56 8.13 10.73 8.13 9.7C8.13 9.55 8.15 9.39 8.19 9.25L5.92 6.98C5.04 7.69 4.34 8.63 3.92 9.7C4.87 12.14 7.23 13.86 10 13.86C10.83 13.86 11.63 13.71 12.36 13.42Z" fill="#98A2B3" />
                                </svg>
                            </span>
                        </div>
                    </div>


                    {{-- Botón --}}
                    <div>
                        <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-white transition rounded-lg bg-green-bright shadow-theme-xs hover:bg-green-dark dark:hover:bg-graphite">Mudar contrasinal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
