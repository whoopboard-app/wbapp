document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".button-toggle-menu");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            const html = document.documentElement; // <html> element
            const currentSize = html.getAttribute("data-menu-size");

            if (currentSize === "condensed") {
                html.setAttribute("data-menu-size", "default");
            } else {
                html.setAttribute("data-menu-size", "condensed");
            }
        });
    }

    var mixedOptions = {
        chart: {
            height: 350,
            type: 'line',
            stacked: false
        },
        series: [
            {
                name: 'Revenue',
                type: 'column',  // bar
                data: [33, 64, 45, 67, 48, 60, 41, 43, 77, 51, 62, 66]
            },
            {
                name: 'Visits',
                type: 'line',
                data: [5, 10, 7, 15, 20, 12, 5, 8, 7, 25, 12, 30]
            },
            {
                name: 'Orders',
                type: 'line',
                data: [12, 14, 10, 22, 28, 24, 15, 27, 35, 40, 38, 48]
            }
        ],
        stroke: {
            width: [0, 2, 2],
            curve: 'smooth',
            dashArray: [0, 0, 2]
        },
        plotOptions: {
            bar: {
                columnWidth: '30%',
                borderRadius: 4  
            }
        },
        colors: ['#4697ce', '#7dcc93', '#f0934e'], // customize colors
        fill: {
            opacity: [1, 1, 1] // bar solid, lines semi-transparent
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        legend: {
            position: 'bottom'
        }
    };

    var mixedChart = new ApexCharts(document.querySelector("#dash-performance-chart"), mixedOptions);
    mixedChart.render();

    // Donut Chart
    var donutOptions = {
        chart: {
            type: 'donut',
            height: 350
        },
        series: [44.25, 52.68, 45.98],
        labels: ['Direct', 'Affiliate', 'Sponsored'],
        colors: ['#4697ce', '#e06d94', '#7dcc93'],
        legend: {
            show: false // remove legend
        },
        dataLabels: {
            enabled: false // hide percentages on slices
        },
        fill: {
            type: 'gradient',
            gradient: {
                type: 'radial',
                shade: 'light',
                gradientToColors: ['#ffffff', '#ffffff', '#ffffff'],
                stops: [0, 70, 100]
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%'
                }
            }
        }
    };

    var donutChart = new ApexCharts(document.querySelector("#conversions"), donutOptions);
    donutChart.render();
});
