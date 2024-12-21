import 'bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const searchToggle = document.getElementById('searchToggle');
    const searchForm = document.getElementById('searchForm');

    if (searchToggle && searchForm) {
        console.log("Search toggle initialized");
        searchToggle.addEventListener('click', function (e) {
            e.preventDefault();
            searchForm.classList.toggle('d-none');
            console.log("Search form toggled");
        });
    } else {
        console.error("Search toggle or form not found in the DOM.");
    }
});

