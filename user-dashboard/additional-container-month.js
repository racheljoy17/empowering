var options = {
    series: [{
        name: 'Electricity Usage (kWh)',
        data: [300, 315, 310, 320, 325, 330, 335, 340, 345, 350, 355, 360, 365, 370, 375, 380, 385, 390, 395, 400, 405, 410, 415, 420, 425, 430, 435, 440, 445, 450] // Updated data for electricity usage per day for 30 days
    }, {
        name: 'Total Cost (₱)',
        data: [150, 157.5, 155, 160, 162.5, 165, 167.5, 170, 172.5, 175, 177.5, 180, 182.5, 185, 187.5, 190, 192.5, 195, 197.5, 200, 202.5, 205, 207.5, 210, 212.5, 215, 217.5, 220, 222.5, 225] // Updated data for total cost per day for 30 days
    }],
    chart: {
        type: 'bar',
        height: 800
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7', 'Day 8', 'Day 9', 'Day 10', 'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20', 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30'], // Updated days of the month
    },
    yaxis: [{
        title: {
            text: 'Electricity Usage (kWh)'
        }
    }, {
        opposite: true,
        title: {
            text: 'Total Cost (₱)'
        }
    }],
    fill: {
        opacity: 1
    },
    tooltip: {
        y: [{
            formatter: function (val) {
                return val + " kWh"; // Format electricity usage tooltip
            }
        }, {
            formatter: function (val) {
                return "₱ " + val; // Format total cost tooltip with pesos
            }
        }]
    }
};

var chart = new ApexCharts(document.querySelector("#additional-container-month"), options);
chart.render();
