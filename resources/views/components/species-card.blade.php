@php use App\Models\ConservationStatus; @endphp
<div>
    <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-green-dark dark:bg-white/[0.03]">
        <div class="mb-5 overflow-hidden rounded-lg">
            <img
                src="{{ $image }}"
                alt="{{ $name }}"
                class="w-full h-56 object-cover rounded-lg"
            />
        </div>

        <div>
            <h4 class="mb-1 text-theme-xl font-medium text-gray-800 dark:text-white">
                {{ $name }}
            </h4>
            <p class="text-sm text-gray-600 dark:text-white mb-1">
                <strong> Nome común: {{ $commonName }}</strong>
                <br>
                <strong>Avistamentos:</strong> {{ $sightings }}
                <br>
                <strong>Estado de conservación:</strong>
                <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                    @if($status == ConservationStatus::CONSERVATION_STATUS_VERY_DANGER)
                        bg-status-very-danger text-white dark:bg-error-500/15 dark:text-error-400
                    @elseif($status == ConservationStatus::CONSERVATION_STATUS_DANGER)
                        bg-status-danger text-white dark:bg-orange-500/15 dark:text-orange-400
                    @elseif($status == ConservationStatus::CONSERVATION_STATUS_SLIGHT)
                        bg-status-watched text-white dark:bg-warning-500/15 dark:text-warning-400
                    @elseif($status == ConservationStatus::CONSERVATION_STATUS_WATCHED)
                        bg-status-slight text-white dark:bg-warning-500/15 dark:text-warning-400
                    @elseif($status == ConservationStatus::CONSERVATION_STATUS_NORMAL)
                        bg-status-normal text-white dark:bg-success-500/15 dark:text-success-400
                    @endif
                ">
                    {{ $status }}
                </span>
            </p>
            <div class="flex justify-center">
                <a href="{{route('speciesFront', $specieID)}}"
                   class="mt-4 inline-flex items-center gap-2 rounded-lg bg-green-bright px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-black-green">
                    Información ampliada / Rexistrar avistamento
                </a>
            </div>
        </div>
    </div>
</div>
