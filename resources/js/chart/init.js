import { Chart, registerables } from 'chart.js';
import { configKelembapan, configSuhu, configTekanan } from './config';
import { data } from './data';

Chart.register(...registerables);


const ID_CHART_SUHU = 'suhu-chart';
const ID_CHART_KELEMBAPAN = 'kelembapan-chart';
const ID_CHART_TEKANAN = 'tekanan-chart';

export const suhuChart = (el) => {
    const dataSuhu = data(el[0].datapoints, el[0].colors, 'Suhu');
    return new Chart(document.getElementById(ID_CHART_SUHU), configSuhu(dataSuhu, el[0].status))
};

export const kelembapanChart = (el) => {
    const dataKelembapan = data(el[1].datapoints, el[1].colors, 'Kelembapan');
    return new Chart(document.getElementById(ID_CHART_KELEMBAPAN), configKelembapan(dataKelembapan, el[1].status))
};

export const tekananChart = (el) => {
    const dataTekanan = data(el[2].datapoints, el[2].colors, 'Tekanan');
    return new Chart(document.getElementById(ID_CHART_TEKANAN), configTekanan(dataTekanan, el[2].status));
};