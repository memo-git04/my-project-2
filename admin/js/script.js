
// -------CHARTS----------//

// BAR CHART
var barChartOptions = {
    series: [{
      data: [10 ,8 ,6 ,4 ,2]
    }],
    chart: {
        type: 'bar',
        height: 350,
        toolbar: {
            show: false
        },
    },
    colors: [
        "#246dec",
        "#cc3c43",
        "#367952",
        "#f5b74f",
        "#4f35a1",
    ],
    plotOptions: {
      bar: {
            distributed: true,
            borderRadius: 4,
            horizontal: false,
            columnWidth: "40%",
      }
    },
    dataLabels: {
      enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
      categories: ["Sofa", "Bed", "Desk", "Table", "Lamp"],
    },
    yaxis: {
        title: {
            text: "Count"
        }
    },
};
var barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartOptions);
barChart.render();


// AREA CHART
var areaChartOptions = {
      series: [{
      name: 'Purchases Orders',
      data: [30, 40, 28,6,75,109, 100]
    }, {
      name: 'Sales Orders',
      data: [11,32,55,45,36,52,14]
    }],
      chart: {
      height: 350,
      type: 'area',
      toolbar:
      {
        show: false,
      },
    },
    colors: ["#4f35a1", "#246dec"],
    dataLabels: {
        enabled: false,
    },
    stroke: {
      curve: 'smooth'
    },
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    markers: {
      size: 0
    },
    yaxis: [
      {
        title: {
          text: 'Purchase Orders',
        },
      },
      {
        opposite: true,
        title: {
          text: 'Sales Oreders',
        },
      },
    ],
    tooltip: {
      shared: true,
      intersect: false,
    }
    }   
    var areaChart = new ApexCharts(document.querySelector("#area-chart"), areaChartOptions);
    areaChart.render();