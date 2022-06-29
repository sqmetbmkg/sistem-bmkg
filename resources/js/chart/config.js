import { data } from './data';

export const configSuhu = (data, status) => {
    return {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Data Suhu'
                },
                tooltip: {
                    callbacks: {
                        footer: (tooltipItems) => {
                            let idx = tooltipItems[0].dataIndex;
                            return "Status: " + status[idx];
                        },
                    }
                }
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jam (UTC)'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Suhu (Celcius)'
                    },
                    suggestedMin: 0,
                    suggestedMax: 50,
                }
            }
        }
    }
};

export const configKelembapan = (data, status) => {
    return {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Data Kelembaban'
                },
                tooltip: {
                    callbacks: {
                        footer: (tooltipItems) => {
                            let idx = tooltipItems[0].dataIndex;
                            return "Status: " + status[idx];
                        },
                    }
                }
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jam (UTC)'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Kelembaban (%)'
                    },
                    suggestedMin: 0,
                    suggestedMax: 100,
                }
            }
        }
    }
};

export const configTekanan = (data, status) => {
    return {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Data Tekanan'
                },
                tooltip: {
                    callbacks: {
                        footer: (tooltipItems) => {
                            let idx = tooltipItems[0].dataIndex;
                            return "Status: " + status[idx];
                        },
                    }
                }
            },
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jam (UTC)'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Tekanan (mb)'
                    },
                    suggestedMin: 500,
                    suggestedMax: 1100,
                }
            }
        }
    }
};