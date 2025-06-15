@extends('layouts.app-panel')

@section('content')
<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-black-green p-6">
    <!-- Breadcrumb Start -->
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

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div class="ms-5">
            {{-- Botón "Ver avistamentos rexistrados" --}}
            <button @click="window.location.href = '/especie'"
                    class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium border hover:bg-gray-50 border-gray-200 text-graphite dark:text-white shadow-theme-xs hover:bg-brand-600 dark:hover:text-green-bright">
                Ver avistamentos rexistrados
                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.3,12.8c0,0-2.1-5.6-2.1-5.6-.3-.7-.9-1.3-1.6-1.6,0,0-.3-.7-.3-.8-.3-.7-1-1.2-1.8-1.2s-1.7.6-1.9,1.5c0,0,0,.1,0,.2v2.5h-3v-2.5c0,0,0-.1,0-.2-.2-.9-1-1.5-1.9-1.5s-1.6.6-1.8,1.2l-.3.7c-.7.3-1.3.9-1.6,1.6C.7,13.2.8,12.7.8,12.8c-.1.4-.2.9-.2,1.3,0,2.2,1.8,4,4,4s3.6-1.4,3.9-3.3h3.1c.3,1.9,2,3.3,3.9,3.3s4-1.8,4-4c0-.4,0-.9-.2-1.3ZM16.1,7.6s0,0,0,0l1.1,2.9c-1.5-.7-3.4-.4-4.6.8v-3.1c0-1,.8-1.8,1.8-1.8s1.4.5,1.7,1.2ZM11.5,12.1h-3v-3.3h3v3.3ZM8.6,13.2h3v.4h-3v-.4ZM13.5,4.8c.3,0,.7.2.8.6-.6,0-1.2.3-1.7.6v-.6c.1-.3.5-.6.8-.6ZM6.6,4.8c.4,0,.7.2.8.6v.6c-.5-.4-1.1-.6-1.7-.6.2-.4.5-.6.8-.6ZM3.9,7.6c.3-.7.9-1.2,1.7-1.2s1.8.8,1.8,1.8v3.1c-1.2-1.3-3.1-1.6-4.6-.8,1.6-4.3.9-2.3,1.1-2.9ZM4.6,17c-1.6,0-2.9-1.3-2.9-2.9s1.3-2.9,2.9-2.9,2.9,1.3,2.9,2.9-1.3,2.9-2.9,2.9ZM15.5,17c-1.6,0-2.9-1.3-2.9-2.9s1.3-2.9,2.9-2.9,2.9,1.3,2.9,2.9-1.3,2.9-2.9,2.9Z" />
                </svg>
            </button>
        </div>

        <div class="flex items-center gap-2 me-5">
            {{-- Botón Editar --}}
            <a href="{{ route('createEditSpeciesFront', ['id' => $species->id]) }}" title="Editar especie"
               class="flex items-center justify-center w-6 h-6 text-green-bright hover:text-green-dark">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                     class="w-6 h-6">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                </svg>
            </a>

            {{-- Botón Eliminar --}}
            <form action="{{ route('species.destroy', $species) }}" method="POST"
                  onsubmit="return confirm('¿Estás segura de que deseas eliminar esta especie?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" title="Eliminar especie"
                        class="flex items-center justify-center w-6 h-6 text-red-alert hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                         class="w-6 h-6">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7h16" />
                        <path d="M10 11v6" />
                        <path d="M14 11v6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3h6v3" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Breadcrumb End -->

    <div class="rounded-2xl border border-gray-200 bg-white dark:border-green-bright/50 dark:bg-white/[0.03] p-4 xl:p-6">
        <h2 class="text-xl font-semibold ms-3 text-gray-800 dark:text-white/90">Rexistrar avistamento</h2>

        <form method="POST" action="{{ isset($species) ? route('species.edit', $species) : route('species.create') }}}" id="form-register-sighting" class="mb-6 p-4 rounded-xl border border-gray-200 bg-white dark:bg-white/[0.03] dark:border-green-bright/50" >
            @csrf
            @php
                $today = now()->format('Y-m-d');
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="relative">
                    <input type="text" name="latitude" placeholder="Latitude:"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30">
                </div>
                <div class="relative">
                    <input type="text" name="longitude" placeholder="Lonxitude:"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30">
                </div>
                <div class="relative">
                    <input type="text" name="individuals" placeholder="Nº especímenes:"
                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30">
                </div>
                <div class="relative">
                    <input type="date" name="observed_at" max="{{ $today }}"
                        class=" w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-800 focus:border-green-bright focus:outline-hidden dark:border-0 dark:focus:border-green-bright dark:focus:ring-1 dark:focus:ring-green-bright dark:text-white dark:bg-gray-soft/10 dark:placeholder:text-white/30">
                </div>
                <div>
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white bg-green-bright  shadow-theme-xs hover:bg-brand-600 hover:bg-green-dark dark:dark:hover:bg-graphite">
                        Gardar
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-green-bright/50 dark:bg-white/[0.03] min-h-[400px] flex flex-col justify-center">

                <div class="h-[400px] relative overflow-hidden rounded-lg">
                    @foreach($images as $index => $image)
                        <img
                            src="{{ $image->getUrl() }}"
                            alt="{{ $image->name }}"
                            class="w-full h-full object-cover rounded-lg absolute top-0 left-0 transition-all duration-300 {{ $index === 0 ? '' : 'hidden' }}"
                            data-image-index="{{ $index }}">
                    @endforeach

                    <!-- Botones superpuestos sobre la imagen -->
                    <div class="absolute inset-0 flex items-center justify-between px-2">
                        <button
                            class="inline-flex items-center justify-center rounded-lg bg-white/80 backdrop-blur-sm p-2 text-gray-700 hover:bg-white dark:bg-black/50 dark:text-gray-200 dark:hover:bg-black/70 transition-all"
                            title="Imaxe anterior" id="prevImage">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.9991 19.9201L8.47909 12.4001L15.9991 4.88012" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button
                            class="inline-flex items-center justify-center rounded-lg bg-white/80 backdrop-blur-sm p-2 text-gray-700 hover:bg-white dark:bg-black/50 dark:text-gray-200 dark:hover:bg-black/70 transition-all"
                            title="Imaxe seguinte" id="nextImage">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.00094 19.9201L15.5209 12.4001L8.00094 4.88012" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-green-bright/50 dark:bg-white/[0.03]">
                <div class="text-center mb-3">
                    <h4 class="text-green-bright text-xl">Clasificación Taxonómica</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Nome científico</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->scientific_name}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Nome común</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90"><strong>{{$species->common_name}}</strong></td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Reino</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->kingdom}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Filo</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->phylum}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Clase</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->class}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Orden</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->order}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Familia</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->family}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Xénero</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->genus}}</td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Especie</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->species_name}}</td>
                            </tr>
                            <tr>
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 dark:text-green-bright">Subespecie</th>
                                <td class="px-3 py-2 text-gray-800 dark:text-white/90">{{$species->subspecies}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 mt-6">

            @if ($totalRecordedSpecies < 5)
                <div>
                    <p class="text-gray-700 dark:text-gray-300 dark:border-green-bright/50">Pendente datos</p>
                </div>
            @else
                <div>
                    <p class="text-gray-700 dark:text-gray-300 dark:border-green-bright/50">
                        Estado de conservación:
                        <span class="inline-flex ms-1 text-white rounded-full px-3 py-1 text-xs font-medium"  style="background-color: {{$species->conservationStatus->color}}">{{ $species->conservationStatus->label }}</span>
                    </p>
                </div>
            @endif

            <div>
                <p class="text-gray-700 dark:text-gray-300">
                    Total exemplares rexistrados: <strong>{{$totalRecordedSpecies}}</strong>
                </p>
            </div>
        </div>

        <!-- Mapa -->
        <div id="mapa" class="hs-leaflet z-10 mt-6 rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] h-64 flex items-center justify-center">

        </div>
    </div>
</div>
@endsection

@push('styles')
    @vite(['resources/css/species.css'])
@endpush

@push('scripts')
    @vite(['resources/js/species/show-species.js'])
@endpush

@push('scripts')
    <script>
        const sightings = @json($sightings);
    </script>
@endpush
