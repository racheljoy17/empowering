var options = {
    series: [{
        name: 'Electricity Usage (kWh)',
        data: [10, 15, 20, 25, 30, 35, 40, 35, 30, 25, 20, 15, 10, 15, 20, 25, 30, 35, 40, 35, 30, 25, 20, 15] // Updated data for electricity usage throughout the day
    }, {
        name: 'Total Cost (₱)',
        data: [5, 7.5, 10, 12.5, 15, 17.5, 20, 17.5, 15, 12.5, 10, 7.5, 5, 7.5, 10, 12.5, 15, 17.5, 20, 17.5, 15, 12.5, 10, 7.5] // Updated data for total cost throughout the day
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
        categories: ['12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'], // Updated hours of the day
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

var chart = new ApexCharts(document.querySelector("#additional-container-today"), options);
chart.render();
