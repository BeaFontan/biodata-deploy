@php use App\Models\Species; @endphp
@extends('layouts.app-panel')

@section('content')
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-error-50 text-red-alert dark:bg-error-500/15 dark:text-red-alert">
            {{ session('error') }}
        </div>
    @elseif(session('message'))
        <div class="mb-4 rounded-lg bg-error-50 text-green-bright dark:bg-error-500/15 dark:text-green-bright">
            {{ session('message') }}
        </div>
    @elseif($errors->any())
        @foreach ($errors->all() as $error)
            <div class="mb-4 rounded-lg bg-error-50 text-red-alert dark:bg-error-500/15 dark:text-red-alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-black-green p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Crear/Editar Especie`}">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <h2
                    class="text-xl font-semibold text-gray-800 dark:text-white/90"
                    x-text="pageName"
                ></h2>
                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a
                                class="inline-flex items-center gap-1.5 text-green-bright"
                                href="/listado-especies"
                            >
                                Avistamentos
                                <svg
                                    class="stroke-current"
                                    width="17"
                                    height="16"
                                    viewBox="0 0 17 16"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                                        stroke=""
                                        stroke-width="1.2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li
                            class="text-sm text-gray-800 dark:text-white/90"
                            x-text="pageName"
                        ></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <form method="POST" id="form-create-species" action="{{route('species.create')}}" enctype="multipart/form-data">
            @csrf

            <div
                class="bg-brand-50 text-brand-500 dark:bg-brand-500/[0.12] dark:text-green-bright rounded-lg p-4 mb-6 flex items-center ">
                <svg class="fill-current mr-3" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 10.8V14M12 17.2H12.01M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Para obter a clasificación automáticamente, escribe o Nome Científico e pulsa obter clasificación automáticamente.</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                        Tipo de especie
                    </label>

                    <select
                        name="type"
                        required
                        class="w-full rounded-lg border border-green-bright bg-white px-4 py-2 text-gray-800 focus:border-brand-500 focus:ring-brand-500 dark:bg-gray-soft/10 dark:text-green-bright dark:border-green-bright">
                        <option value="{{ Species::TYPE_ANIMAL }}"
                            {{ old('type', $species?->type) === Species::TYPE_ANIMAL ? 'selected' : '' }}>
                            Animal
                        </option>

                        <option value="{{ Species::TYPE_PLANT }}"
                            {{ old('type', $species?->type) === Species::TYPE_PLANT ? 'selected' : '' }}>
                            Planta
                        </option>

                    </select>
                </div>

                <div class="flex items-end">
                    <button
                        type="button"
                        id="btnClasificacion"
                        class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium text-white bg-green-bright shadow-theme-xs dark:bg-green-bright hover:bg-green-dark dark:hover:bg-graphite"
                    >
                        OBTER CLASIFICACIÓN AUTOMÁTICAMENTE
                    </button>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="pb-4 text-base text-gray-800 border-b border-gray-200 dark:border-green-bright dark:text-green-bright mb-4">
                    Información Taxonómica
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Nome científico
                        </label>
                        <input
                            type="text"
                            name="scientific_name"
                            placeholder="Nome científico"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('scientific_name', $species?->scientific_name) }}"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Nome común
                        </label>
                        <input
                            type="text"
                            name="common_name"
                            placeholder="Nome común"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('common_name', $species?->common_name) }}"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Reino
                        </label>
                        <input
                            type="text"
                            name="kingdom"
                            placeholder="Reino"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('kingdom', $species?->kingdom) }}"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Filo
                        </label>
                        <input
                            type="text"
                            name="phylum"
                            placeholder="Filo"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('phylum', $species?->phylum) }}"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Clase
                        </label>
                        <input
                            type="text"
                            name="class"
                            placeholder="Clase"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('class', $species?->class) }}"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Orden
                        </label>
                        <input
                            type="text"
                            name="order"
                            placeholder="Orden"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('order', $species?->order) }}"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Familia
                        </label>
                        <input
                            type="text"
                            name="family"
                            placeholder="Familia"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('family', $species?->family) }}"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Xénero
                        </label>
                        <input
                            type="text"
                            name="genus"
                            placeholder="Xénero"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('genus', $species?->genus) }}"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Especie
                        </label>
                        <input
                            type="text"
                            name="species_name"
                            placeholder="Especie"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('species_name', $species?->species_name) }}"
                        >
                    </div>
                    <div>
                        <label class="mb-2 block font-medium text-gray-700 dark:text-white/80">
                            Subespecie
                        </label>
                        <input
                            type="text"
                            name="subspecies"
                            placeholder="Subespecie"
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30"
                            value="{{ old('subspecies', $species?->subspecies) }}"
                        >
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="pb-4 text-base text-gray-800 border-b border-gray-200 dark:border-green-bright dark:text-green-bright mb-4">
                    Imaxes
                </h4>

                <!-- Input + vista previa -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="preview-container">
                    @foreach ($images as $image)
                        <div class="relative group h-48 rounded-lg overflow-hidden">
                            <img src="{{ $image->getUrl() }}" alt="Imaxe" class="w-full h-full object-cover">

                            <div class="absolute inset-0 dark:bg-gray-soft/20 bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                                <button type="button"
                                        class="text-error-500 bg-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all"
                                        onclick="removeExistingImage('{{ $image->id }}', this)">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M4.5 5H19.5M10 10V15M14 10V15M6 5H18L16.5 19C16.5 19.5304 16.2893 20.0391 15.9142 20.4142C15.5391 20.7893 15.0304 21 14.5 21H9.5C8.96957 21 8.46086 20.7893 8.08579 20.4142C7.71071 20.0391 7.5 19.5304 7.5 19L6 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>

                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                        </div>
                    @endforeach

                    <!-- Input para añadir nuevas imágenes -->
                    <label
                        class="relative group h-48 rounded-lg border-2 border-dashed border-white-300 dark:border-white/80 bg-gray-50 dark:bg-gray-soft/20 flex items-center justify-center cursor-pointer hover:border-brand-400 dark:hover:border-brand-500 transition-colors">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-white/80"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="mt-2 block text-sm font-medium text-gray-700 dark:text-white/80">Engadir nova foto</span>
                        </div>
                        <input type="file" id="images" name="" class="hidden" multiple accept="image/*">
                        <input type="file" name="images[]" id="input-images-back" class="hidden" multiple>
                    </label>
                </div>
            </div>


            <div class="flex justify-end">
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-20 py-4 text-base font-medium text-white bg-green-bright shadow-theme-xs hover:bg-brand-600 hover:bg-green-dark dark:bg-green-bright  dark:hover:bg-graphite">
                    Gardar
                </button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/species.css'])
@endpush

@push('scripts')
    @vite(['resources/js/species/create-species.js'])
@endpush
