



var options = {
    series: [{
        name: 'Electricity Usage (kWh)',
        data: [300, 315, 310, 320, 325, 330, 335, 340, 345, 350, 355, 360] // Updated data for electricity usage per month for 12 months
    }, {
        name: 'Total Cost (₱)',
        data: [150, 157.5, 155, 160, 162.5, 165, 167.5, 170, 172.5, 175, 177.5, 180] // Updated data for total cost per month for 12 months
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
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Updated months of the year
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

var chart = new ApexCharts(document.querySelector("#additional-container-year"), options);
chart.render();
