$(function () {

    //Volcado de imagenes
    const input = document.getElementById('images');
    const previewContainer = document.getElementById('preview-container');
    const hiddenInput = document.getElementById('input-images-back');
    let validFiles = [];

    input.addEventListener('change', function (event) {
        validFiles = Array.from(event.target.files);
        renderPreviews();
        updateHiddenInput();
    });

    function renderPreviews() {
        const previews = previewContainer.querySelectorAll('.preview-temp');
        previews.forEach(el => el.remove());

        validFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative group h-48 rounded-lg overflow-hidden preview-temp';
                wrapper.innerHTML = `
                    <img src="${e.target.result}" alt="Vista previa" class="w-full h-full object-cover">
                    <div class="absolute inset-0 dark:bg-gray-soft/20 bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                        <button type="button" class="text-error-500 bg-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all" onclick="removeFile(${index})">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M4.5 5H19.5M10 10V15M14 10V15M6 5H18L16.5 19C16.5 19.5304 16.2893 20.0391 15.9142 20.4142C15.5391 20.7893 15.0304 21 14.5 21H9.5C8.96957 21 8.46086 20.7893 8.08579 20.4142C7.71071 20.0391 7.5 19.5304 7.5 19L6 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                `;

                const inputLabel = input.closest('label');
                previewContainer.insertBefore(wrapper, inputLabel);
            };

            reader.readAsDataURL(file);
        });
    }

    window.removeFile = function (index) {
        validFiles.splice(index, 1);
        renderPreviews();
        updateHiddenInput();
    };



    function updateHiddenInput() {
        const dataTransfer = new DataTransfer();
        validFiles.forEach(file => dataTransfer.items.add(file));
        hiddenInput.files = dataTransfer.files;
    }

    // Clasificación automática desde GBIF
    $('#btnClasificacion').on('click', function () {
        const scientificName = $('input[name="scientific_name"]').val().trim();

        if (!scientificName) {
            alert('Introduce o nome científico primeiro');
            return;
        }

        $.ajax({
            url: `https://api.gbif.org/v1/species/match?name=${encodeURIComponent(scientificName)}`,
            method: 'GET',
            success: function (match) {
                if (!match.usageKey) {
                    alert('Especie non atopada en GBIF');
                    return;
                }

                const speciesKey = match.usageKey;

                // Llamada para obtener la clasificación taxonómica
                $.ajax({
                    url: `https://api.gbif.org/v1/species/${speciesKey}`,
                    method: 'GET',
                    success: function (data) {
                        $('input[name="kingdom"]').val(data.kingdom || '');
                        $('input[name="phylum"]').val(data.phylum || '');
                        $('input[name="class"]').val(data.class || '');
                        $('input[name="order"]').val(data.order || '');
                        $('input[name="family"]').val(data.family || '');
                        $('input[name="genus"]').val(data.genus || '');
                        $('input[name="species_name"]').val(data.species || '');

                        const parts = data.canonicalName?.split(' ') || [];
                        if (parts.length === 3) {
                            $('input[name="subspecies"]').val(parts[2]);
                        } else {
                            $('input[name="subspecies"]').val('');
                        }
                    },
                    error: function () {
                        alert('Erro ao obter a clasificación desde GBIF.');
                    }
                });
            },
            error: function () {
                alert('Erro ao buscar a especie en GBIF.');
            }
        });
    });


    $("#form-create-species").validate({
        ignore: [],
        rules: {
            type: { required: true },
            scientific_name: { required: true, maxlength: 200 },
            common_name: { maxlength: 100 },
            kingdom: { maxlength: 80 },
            phylum: { maxlength: 100 },
            class: { maxlength: 100 },
            order: { maxlength: 100 },
            family: { maxlength: 100 },
            genus: { maxlength: 100 },
            species_name: { maxlength: 150 },
            subspecies: { maxlength: 150 },
            "images[]": { required: true }
        },
        messages: {
            type: { required: "Debes seleccionar un tipo" },
            scientific_name: {
                required: "Debes introducir o nome científico",
                maxlength: "O nome científico non pode ter máis de 200 caracteres"
            },
            common_name: { maxlength: "O nome común non pode ter máis de 100 caracteres"},
            kingdom: { maxlength: "O reino non pode ter máis de 80 caracteres"},
            phylum: { maxlength: "O filo non pode ter máis de 100 caracteres"},
            class: { maxlength: "A clase non pode ter máis de 100 caracteres"},
            order: { maxlength: "A orde non pode ter máis de 100 caracteres"},
            family: {  maxlength: "A familia non pode ter máis de 100 caracteres"},
            genus: { maxlength: "O xénero non pode ter máis de 100 caracteres"},
            species_name: { maxlength: "A especie non pode ter máis de 150 caracteres"},
            subspecies: { maxlength: "A subespecie non pode ter máis de 150 caracteres"},
            "images[]": { required: "Debes subir polo menos unha foto"}
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorPlacement: function (error, element) {
            if (element.attr("name") === "images[]") {
                error.insertAfter("#preview-container");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        }
    });
});
