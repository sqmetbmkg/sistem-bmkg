import L from 'leaflet/dist/leaflet';
import { suhuChart, kelembapanChart, tekananChart } from './chart/init';

var map = L.map('mapid').setView([-1.533406, 117.159704], 5);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibXVocmlma3lucyIsImEiOiJjbDJoYWo2c3AwYzJ0M2NwbDlmd3lpanFwIn0.HfUW6nFFXhNsFgWr6LTJhg'
}).addTo(map);

var idStasiun;
fetch(BASE_URL + '/stasiun', {
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json"
    },
    method: 'get'
}).then((res) => res.json())
    .then((data) => {
        data.forEach(element => {
            L.marker([element.latitude, element.longitude]).addTo(map)
                .bindPopup(element.nama_stasiun)
                .on('click', () => {
                    idStasiun = element.id;
                    Livewire.emit('toggleModal', element.nama_stasiun);
                });
        });
    })
    .catch(err => { console.log(err) });

var chartSuhu;
var chartKelembapan;
var chartTekanan;
const datepicker = document.getElementById('waktu');
const button = document.getElementById('lihat');
button.addEventListener('click', () => {
    Livewire.emit('initEmpty');
    if (chartSuhu) {
        chartSuhu.destroy();
    }
    if (chartKelembapan) {
        chartKelembapan.destroy();
    }
    if (chartTekanan) {
        chartTekanan.destroy();
    }
    fetch(BASE_URL + '/data-stasiun/' + idStasiun + '/' + datepicker.value, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        method: 'get'
    }).then((res) => res.json())
        .then((data) => {
            if (data[0].datapoints.length > 0) {
                chartSuhu = suhuChart(data);
            }
            if (data[1].datapoints.length > 0) {
                chartKelembapan = kelembapanChart(data);
            }
            if (data[2].datapoints.length > 0) {
                chartTekanan = tekananChart(data);
            }
            if ((data[0].datapoints.length <= 0) && (data[1].datapoints.length <= 0) && (data[2].datapoints.length <= 0)) {
                Livewire.emit('toggleEmpty');
            }
        })
        .catch(err => { console.log(err) });
});