/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Daily Report Chart - Bar Chart
  // --------------------------------------------------------------------
  document.addEventListener('DOMContentLoaded', function () {
    var dailyMeetingChartOptions = {
      series: [{
        name: 'Today Meeting Usage',
        data: peopleCounts,
        color: '#696cff'
      }],
      chart: {
        id: 'realtime',
        height: 365,
        type: 'line',
        animation: {
          enabled: true,
          easing: 'linear',
          dynamicAnimation: {
            speed: 1000
          }
        },
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        }
      },

      dataLabels: {
        enabled: false
      },

      stroke: {
        curve: 'smooth'
      },
      
      markers: {
        size: 0
      },

      xaxis: {
      categories: timeLabels,
       labels: {
         style: {
           fontSize: '13px',
           colors: axisColor,
           format: 'HH:mm'
         },
        },
        // range: XAXISRANGE,
      },

      yaxis: {
        min: 0,
        max: 25,
        tickAmount: 5
      },

      legend: {
        show: false
      },
    //   series: [{
    //   name: 'Count',
    //   data: vehicleCounts,
    //   color: '#696cff'
    // }],
    //   chart: {
    //   type: 'area',
    //   stacked: false,
    //   height: 400,
    //   zoom: {
    //     type: 'x',
    //     enabled: true,
    //     autoScaleYaxis: true
    //   },
    //   toolbar: {
    //     autoSelected: 'zoom'
    //   }
    // },
    // dataLabels: {
    //   enabled: false
    // },
    // markers: {
    //   size: 0,
    // },
    // fill: {
    //   type: 'gradient',
    //   gradient: {
    //     shade: 'dark',
    //     shadeIntensity: 1,
    //     gradientToColors: [config.colors.primary],
    //     opacityFrom: 0.5,
    //     opacityTo: 0,
    //     stops: [30, 70, 100]
    //   },
    //   colors: ['#696cff'],
    // },
    // yaxis: {
    //   title: {
    //     text: 'Count'
    //   },
    //   min: 0,
    // },
    // xaxis: {
    //   categories: timeLabels,
    //   labels: {
    //     style: {
    //       fontSize: '13px',
    //       colors: axisColor
    //     },
    //     format: 'HH:mm',
    //   },
    // },
    // tooltip: {
    //   shared: false,
    //   y: {
    //     formatter: function (val) {
    //       return (val / 1000000).toFixed(0)
    //     }
    //   }
    // }
    };
    
    var todayMeetingUsage = new ApexCharts(document.getElementById('dailyChart'), dailyMeetingChartOptions);
    todayMeetingUsage.render();
  });


  // Weekly Report Chart
  // --------------------------------------------------------------------
  document.addEventListener("DOMContentLoaded", function() {

    var totalWeeklyChartOptions = {
      series: [
        {
          name: 'Average Vehicle Count',
          data: weeklyMeetingUsage,
        }
      ],
      chart: {
        height: 335,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        },
        title: {
          text: 'Day',
        },
      },
      yaxis: {
        min: 0,
        max: 20,
        tickAmount: 4,
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          },
        },
        title: {
          text: 'Count',
        },
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
    var weeklyChart = new ApexCharts(document.getElementById('weeklyChart'), totalWeeklyChartOptions);
    weeklyChart.render();
  });


  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  document.addEventListener("DOMContentLoaded", function() {
  var chartData = document.getElementById('growthChart').getAttribute('data-chart-data');
  // const growthChartEl = document.querySelector('#growthChart'),
    var growthChartOptions = {
      series: [chartData],
      labels: ['Used'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    }
  var growthChart = new ApexCharts(document.getElementById('growthChart'), growthChartOptions);
      growthChart.render();
});

  // Fungsi untuk mendapatkan dan menampilkan hari dan tanggal saat ini
  function updateDateTime() {
    var currentDate = new Date();
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var day = days[currentDate.getDay()];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec'];
    var month = months[currentDate.getMonth()];
    var year = currentDate.getFullYear();
    var date = currentDate.getDate();

    var dateTimeElement = document.getElementById('currentDateTime');
    dateTimeElement.innerHTML = day + ', ' + month + ' '+ date + ' ' + year;
  }

  // Memanggil fungsi untuk pertama kali
  updateDateTime();

})();
