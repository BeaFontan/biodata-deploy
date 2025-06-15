import './bootstrap';
import flatpickr from "flatpickr";
import leaflet from "leaflet/dist/leaflet";
import './auth/login.js';
import './auth/change-pass.js';

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");

    // Function to focus the search input
    function focusSearchInput() {
        searchInput.focus();
    }

    if (searchButton) {
        searchButton.addEventListener("click", focusSearchInput);
    }
    document.addEventListener("keydown", function (event) {
        if ((event.metaKey || event.ctrlKey) && event.key === "k") {
            event.preventDefault(); // Prevent the default browser behavior
            focusSearchInput();
        }
    });
    document.addEventListener("keydown", function (event) {
        if (event.key === "/" && document.activeElement !== searchInput) {
            event.preventDefault(); // Prevent the "/" character from being typed
            focusSearchInput();
        }
    });
    if (document.getElementById("hs-basic-leaflet")) {
        const location = [42.878563, -8.547438];
        const map = leaflet.map('hs-basic-leaflet', {
            center: location,
            zoom: 14,
            // Prevent dragging over the limit
            maxBounds: [
                [40, -10],
                [60, 10]
            ],
            maxBoundsViscosity: 1.0
        });
        leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            minZoom: 2,
            attribution: '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        leaflet.marker(location).addTo(map);
    }
    flatpickr(".datepicker", {
        locale: {
            weekdays: {
                shorthand: ["Dom", "Lun", "Mar", "Mer", "Xov", "Ven", "Sáb"],
                longhand: [
                    "Domingo",
                    "Luns",
                    "Martes",
                    "Mércoles",
                    "Xoves",
                    "Venres",
                    "Sábado",
                ],
            },
            months: {
                shorthand: [
                    "Xan",
                    "Feb",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Xuñ",
                    "Xul",
                    "Ago",
                    "Sep",
                    "Out",
                    "Nov",
                    "Dec",
                ],
                longhand: [
                    "Xaneiro",
                    "Febreiro",
                    "Marzo",
                    "Abril",
                    "Maio",
                    "Xuño",
                    "Xullo",
                    "Agosto",
                    "Septembro",
                    "Outubro",
                    "Novembro",
                    "Decembro",
                ],
            },
            ordinal: function () {
                return "º";
            },
            firstDayOfWeek: 1,
            rangeSeparator: " a ",
            time_24hr: true,
        },
        mode: "single",
        static: true,
        monthSelectorType: "static",
        dateFormat: "j M Y",
        defaultDate: new Date().toLocaleDateString(),
        prevArrow:
            '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        nextArrow:
            '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        onReady: (selectedDates, dateStr, instance) => {
            // eslint-disable-next-line no-param-reassign
            instance.element.value = dateStr.replace("to", "-");
            const customClass = instance.element.getAttribute("data-class");
            instance.calendarContainer.classList.add(customClass);
        },
        onChange: (selectedDates, dateStr, instance) => {
            // eslint-disable-next-line no-param-reassign
            instance.element.value = dateStr.replace("to", "-");
        },
    });
});
