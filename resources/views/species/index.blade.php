@extends('layouts.app-panel')
@section('content')
    <div x-data="{ selectedGroup: 'Todos' }"
        class="rounded-2xl border border-gray-200 bg-white dark:border-none dark:bg-black-green">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Listado especies` }">
            <h2 class="ms-6 mt-6 text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>
        </div>
        <!-- Breadcrumb End -->
        <!-- Task header Start -->
        <div class="flex flex-col items-center px-4 py-5 xl:px-6 xl:py-6">
            <div class="flex flex-col w-full gap-5 sm:justify-between xl:flex-row xl:items-center">
                <div class="flex flex-wrap items-center gap-x-1 gap-y-2 rounded-lg bg-gray-100 p-0.5 dark:bg-green-dark">
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md h group hover:text-gray-900 dark:hover:text-white"
                        :class="selectedGroup === 'Todos' ? 'text-gray-900 dark:text-white bg-white dark:bg-graphite' :
                            'text-gray-500 dark:text-gray-400'"
                        @click="selectedGroup = 'Todos' ">
                        Todos os avistamentos
                        <span
                            class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium leading-normal group-hover:bg-brand-50 group-hover:text-brand-500 dark:group-hover:bg-brand-500/15 dark:group-hover:text-brand-400"
                            :class="selectedGroup === 'Todos' ?
                                'text-brand-500 dark:text-brand-400 bg-brand-50 dark:bg-brand-500/15' :
                                'bg-white dark:bg-white/[0.03]'">
                            {{ $totalSpecies }}
                        </span>
                    </button>

                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md group hover:text-gray-900 dark:hover:text-white"
                        :class="selectedGroup === 'Animais' ? 'text-gray-900 dark:text-white bg-white dark:bg-graphite' :
                            'text-gray-500 dark:text-gray-400'"
                        @click="selectedGroup = 'Animais' ">
                        Animais
                        <span
                            class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium leading-normal group-hover:bg-brand-50 group-hover:text-brand-500 dark:group-hover:bg-brand-500/15 dark:group-hover:text-brand-400"
                            :class="selectedGroup === 'Animais' ?
                                'text-brand-500 dark:text-brand-400 bg-brand-50 dark:bg-brand-500/15' :
                                'bg-white dark:bg-white/[0.03]'">
                            {{$totalAnimals}}
                        </span>
                    </button>

                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-md group hover:text-gray-900 dark:hover:text-white"
                        :class="selectedGroup === 'Plantas' ? 'text-gray-900 dark:text-white bg-white dark:bg-graphite' :
                            'text-gray-500 dark:text-gray-400'"
                        @click="selectedGroup = 'Plantas' ">
                        Plantas
                        <span
                            class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium leading-normal group-hover:bg-brand-50 group-hover:text-brand-500 dark:group-hover:bg-brand-500/15 dark:group-hover:text-brand-400"
                            :class="selectedGroup === 'Plantas' ?
                                'text-brand-500 dark:text-brand-400 bg-brand-50 dark:bg-brand-500/15' :
                                'bg-white dark:bg-white/[0.03]'">
                            {{$totalPlants}}
                        </span>
                    </button>
                </div>

                <div class="flex flex-wrap items-center gap-3 xl:justify-end">
                    <div x-data="{ isFilterAndOrder: false }" class="relative">
                        <button @click="isFilterAndOrder = !isFilterAndOrder"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-white/50 dark:text-white dark:hover:bg-white/[0.03]">
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.0826 4.0835C11.0769 4.0835 10.2617 4.89871 10.2617 5.90433C10.2617 6.90995 11.0769 7.72516 12.0826 7.72516C13.0882 7.72516 13.9034 6.90995 13.9034 5.90433C13.9034 4.89871 13.0882 4.0835 12.0826 4.0835ZM2.29004 6.65409H8.84671C9.18662 8.12703 10.5063 9.22516 12.0826 9.22516C13.6588 9.22516 14.9785 8.12703 15.3184 6.65409H17.7067C18.1209 6.65409 18.4567 6.31831 18.4567 5.90409C18.4567 5.48988 18.1209 5.15409 17.7067 5.15409H15.3183C14.9782 3.68139 13.6586 2.5835 12.0826 2.5835C10.5065 2.5835 9.18691 3.68139 8.84682 5.15409H2.29004C1.87583 5.15409 1.54004 5.48988 1.54004 5.90409C1.54004 6.31831 1.87583 6.65409 2.29004 6.65409ZM4.6816 13.3462H2.29085C1.87664 13.3462 1.54085 13.682 1.54085 14.0962C1.54085 14.5104 1.87664 14.8462 2.29085 14.8462H4.68172C5.02181 16.3189 6.34142 17.4168 7.91745 17.4168C9.49348 17.4168 10.8131 16.3189 11.1532 14.8462H17.7075C18.1217 14.8462 18.4575 14.5104 18.4575 14.0962C18.4575 13.682 18.1217 13.3462 17.7075 13.3462H11.1533C10.8134 11.8733 9.49366 10.7752 7.91745 10.7752C6.34124 10.7752 5.02151 11.8733 4.6816 13.3462ZM9.73828 14.096C9.73828 13.0904 8.92307 12.2752 7.91745 12.2752C6.91183 12.2752 6.09662 13.0904 6.09662 14.096C6.09662 15.1016 6.91183 15.9168 7.91745 15.9168C8.92307 15.9168 9.73828 15.1016 9.73828 14.096Z"
                                    fill="" />
                            </svg>

                            Filtrar e ordear
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="isFilterAndOrder" @click.away="isFilterAndOrder = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-30 mt-2 w-72 rounded-xl border border-gray-200 bg-white p-4 shadow-theme-lg dark:border-gray-800 dark:bg-green-dark">

                            <div class="mb-4">
                                <h4 class="mb-2 text-sm font-medium text-gray-800 dark:pink">Filtrar por estado
                                </h4>
                                <div class="flex flex-col gap-2">
                                    <div x-data="{ checkboxToggle: false }">
                                        <label for="checkMoiPerigoso"
                                            class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                                            <div class="relative">
                                                <input type="checkbox" id="checkMoiPerigoso" class="sr-only"
                                                    @change="checkboxToggle = !checkboxToggle" />
                                                <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                                    'bg-transparent border-gray-300 dark:border-white"
                                                    class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                    <span :class="checkboxToggle ? '' : 'opacity-0'">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white"
                                                                stroke-width="1.94437" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center gap-2 dark:text-white">
                                                Moi perigoso
                                            </span>
                                        </label>
                                    </div>

                                    <div x-data="{ checkboxToggle: false }">
                                        <label for="checkPerigoso"
                                            class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-white">
                                            <div class="relative">
                                                <input type="checkbox" id="checkPerigoso" class="sr-only"
                                                    @change="checkboxToggle = !checkboxToggle" />
                                                <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                                    'bg-transparent border-gray-300 dark:border-white'"
                                                    class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                    <span :class="checkboxToggle ? '' : 'opacity-0'">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white"
                                                                stroke-width="1.94437" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center gap-2">
                                                Perigoso
                                            </span>
                                        </label>
                                    </div>

                                    <div x-data="{ checkboxToggle: false }">
                                        <label for="checkNormal"
                                            class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-white">
                                            <div class="relative">
                                                <input type="checkbox" id="checkNormal" class="sr-only"
                                                    @change="checkboxToggle = !checkboxToggle" />
                                                <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                                    'bg-transparent border-gray-300 dark:border-white'"
                                                    class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                    <span :class="checkboxToggle ? '' : 'opacity-0'">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white"
                                                                stroke-width="1.94437" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center gap-2">
                                                Normal
                                            </span>
                                        </label>
                                    </div>

                                    <div x-data="{ checkboxToggle: false }">
                                        <label for="checkBaixoRisco"
                                            class="flex cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-white">
                                            <div class="relative">
                                                <input type="checkbox" id="checkBaixoRisco" class="sr-only"
                                                    @change="checkboxToggle = !checkboxToggle" />
                                                <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' :
                                                    'bg-transparent border-gray-300 dark:border-white'"
                                                    class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]">
                                                    <span :class="checkboxToggle ? '' : 'opacity-0'">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white"
                                                                stroke-width="1.94437" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="inline-flex items-center gap-2 dark:text-white">
                                                Baixo risco
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button
                                    class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium dark:text-white text-black shadow-theme-xs hover:bg-brand-600 dark:hover:text-white/50"
                                    @click="isFilterAndOrder = false">
                                    Aplicar filtros
                                </button>
                            </div>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('createEditSpeciesFront') }}">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium border hover:bg-gray-50 border-gray-200 text-graphite dark:text-white shadow-theme-xs hover:bg-brand-600 dark:hover:text-green-bright">
                            Engadir nova especie

                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">

                                <path d="M6.1,10.1h1.1v1.1h-1.1v-1.1Z" />
                                <path d="M12.9,10.1h1.1v1.1h-1.1v-1.1Z" />
                                <path
                                    d="M18.3,11.2c-.1-.1-.3-.3-.5-.4-.3-.7-.7-1.4-.9-1.9l-1.3-6.2c-.2-.7-.7-1.2-1.4-1.4-.8-.2-1.7.3-2,1.1h0l-.9,2.1c-.4,0-.8,0-1.2,0s-.8,0-1.2,0l-.9-2.1c-.3-.8-1.2-1.2-2-1.1-.7.1-1.3.7-1.4,1.4l-1.3,6.2c-.2.5-.6,1.2-.9,1.9-.2.1-.3.3-.5.4-.7.7-1,1.6-1,2.6v4.7l.8-.3s2.4-1,5.8-1.4c.2,0,.4.1.6.2.4.8,1.2,1.3,2.2,1.3s1.7-.5,2.2-1.3c.2,0,.4,0,.6-.2,3.4.4,5.8,1.3,5.8,1.4l.8.3v-4.7c0-1-.4-1.9-1-2.6ZM13.2,2.8h0c.1-.3.5-.5.8-.4.3,0,.5.3.6.6l.7,3.5c-.7-.7-1.7-1.4-2.9-1.7l.8-1.9ZM5.6,2.9c0-.3.3-.5.6-.6.3,0,.7.1.8.4l.8,1.9c-1.3.4-2.2,1-2.9,1.7l.7-3.5ZM1.9,16.9v-2.6h1c1.1-.2,2.1,0,3.1.4,0,0,0,0,0,0,0,.4.1.8.3,1.2-2,.3-3.5.7-4.4,1ZM8.3,15.9c-.7,0-1.3-.6-1.3-1.3s.5-1.2,1.1-1.2c0,.6.3,1.1.8,1.4l.6.3c-.2.5-.6.8-1.2.8h0ZM9.7,12.8h.7c.3,0,.6.3.6.6s-.1.4-.3.5l-.6.4-.6-.4c-.2-.1-.3-.3-.3-.5,0-.3.3-.6.6-.6ZM9.3,11.7v-1c0-.6.3-1.1.8-1.4.5.3.8.8.8,1.4v1c-.1,0-.3,0-.4,0h-.7c-.2,0-.3,0-.4,0h0ZM10.1,17.1c-.4,0-.7-.1-.9-.4.4-.1.7-.4.9-.7.2.3.6.5.9.7-.2.2-.6.4-.9.4ZM11.9,15.9c-.5,0-1-.3-1.2-.8l.6-.3c.5-.3.8-.8.8-1.4.6,0,1.1.6,1.1,1.2,0,.7-.6,1.3-1.3,1.3h0ZM11.9,12.3v-1.6c0-1-.5-1.9-1.4-2.4l-.5-.2-.5.2c-.9.5-1.4,1.4-1.4,2.4v1.6c-.9,0-1.6.5-2,1.3-1.1-.4-2.3-.6-3.4-.5h-.8c.3-1,1.2-1.9,2.4-1.9v-1.1c-.2,0-.4,0-.6,0,.2-.4.3-.7.5-.9.9-1.8,2.3-3.8,5.8-3.8s5,2,5.8,3.8c.1.2.3.6.5.9-.2,0-.4,0-.5,0v1.1c1.2,0,2.1.9,2.4,1.9h-.8c-1.2-.2-2.4,0-3.4.4-.4-.7-1.1-1.2-2-1.3h0ZM18.3,16.9c-.9-.3-2.4-.7-4.4-1,.2-.4.3-.8.3-1.2s0,0,0,0c1-.4,2-.6,3.1-.5h1v2.7Z" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="p-4 space-y-8 border-t mt-7 dark:border-green-dark sm:mt-0 xl:p-6">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($species as $specie)
                    @php
                        $imageUrl = $specie->getFirstMediaUrl('species_images', 'image');

                        $status = $specie->status ?? 'Sen estado';

                        if ($specie->sightings->isEmpty()) {
                            $sightings = "Sen avistamentos";
                        } else {
                            $sightings = $specie->conservationStatus->name . ' avistamentos';
                        }
                    @endphp
                    <x-species-card
                        :id="$specie->id"
                        :name="$specie->scientific_name"
                        :common-name="$specie->common_name"
                        :sightings="$sightings"
                        :status="$status"
                        :image="$imageUrl"
                        :specieID="$specie->id"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection
