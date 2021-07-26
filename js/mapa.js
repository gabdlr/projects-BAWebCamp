(function() {
    'use strict';
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('mapa').setView([-34.606023, -58.363731], 16);
        //lo que esta despues del [], es el nivel de zoom
        //lo que esta dentro del [] son las coordenadas
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-34.606023, -58.363731]).addTo(map)
            .bindPopup('BAWebCamp 2021.<br> Boletos ya disponibles!.')
            .openPopup()
            .bindTooltip('Hilton Buenos Aires <br>Macacha Guemes 351')
            .openTooltip();
    }); //DOM CONTENT LOADED
})();