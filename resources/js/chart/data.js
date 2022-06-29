const DATA_COUNT = 23;
const labels = [];
for (let i = 0; i <= DATA_COUNT; ++i) {
    labels.push(i.toString());
}

export const data = (datapoints, colors, label) => {
    return {
        labels: labels,
        datasets: [
            {
                label: label,
                data: datapoints,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: colors,
                fill: false,
                cubicInterpolationMode: 'monotone',
                tension: 0.4
            }
        ]
    }
};