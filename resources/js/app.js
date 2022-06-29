require('./bootstrap');
// require('./maps');
let Pikaday = require('pikaday/pikaday');

import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
import Swal from 'sweetalert2/dist/sweetalert2';

window.Alpine = Alpine;
window.Pikaday = Pikaday;
window.flatpickr = flatpickr;
window.Swal = Swal;

Alpine.start();