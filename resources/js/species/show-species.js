document.addEventListener('DOMContentLoaded', () => {
    //Funcionalidad carrousel imagenes
    const images = document.querySelectorAll('[data-image-index]');
    let currentIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.classList.toggle('hidden', i !== index);
        });
    }

    document.getElementById('prevImage')?.addEventListener('click', (e) => {
        e.preventDefault();
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    });

    document.getElementById('nextImage')?.addEventListener('click', (e) => {
        e.preventDefault();
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    });

    showImage(currentIndex);

    //Registro de avistamientos en mapa
    const map = L.map('mapa').setView([42.5, -8.9], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const bounds = [];
    const formatDate = (isoDate) => {
        const [year, month, day] = isoDate.split('T')[0].split('-');
        return `${day}/${month}/${year}`;
    };

    sightings.forEach(({ latitude, longitude, observed_at, individuals }) => {
        const marker = L.marker([latitude, longitude]).addTo(map);

        marker.bindPopup(`
            <strong>Data:</strong> ${formatDate(observed_at)}<br>
            <strong>Exemplares:</strong> ${individuals}
        `);

        bounds.push([latitude, longitude]);
    });

    map.fitBounds(bounds);


    //Formulario de registro de avistamiento
    $("#form-register-sighting").validate({
        rules: {
            latitude: {
                required: true,
                number: true
            },
            longitude: {
                required: true,
                number: true
            },
            individuals: {
                required: true,
                digits: true,
                min: 1
            },
            observed_at: {
                required: true,
                date: true
            }
        },
        messages: {
            latitude: {
                required: "Por favor, introduce a latitude.",
                number: "A latitude debe ser un número.",
            },
            longitude: {
                required: "Por favor, introduce a lonxitude.",
                number: "A lonxitude debe ser un número.",
            },
            individuals: {
                required: "Indica o número de exemplares.",
                digits: "Debe ser un número enteiro.",
                min: "Debe haber polo menos un exemplar."
            },
            observed_at: {
                required: "Indica a data de observación.",
                date: "Introduce unha data válida.",
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        }
    });
});
