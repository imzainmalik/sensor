<script src="{{ asset('assets/js/all.min.js')  }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>   
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
	
@stack('custum_js')
<script>
    // var options = {
    //       series: [{
    //       name: 'Overused',
    //       data: [31, 40, 28, 51, 42, 109, 100]
    //     }, {
    //       name: 'Good used',
    //       data: [11, 32, 45, 32, 34, 52, 41]
    //     }],
    //       chart: {
    //       height: 350,
    //       type: 'area'
    //     },
    //     dataLabels: {
    //       enabled: false
    //     },
    //     stroke: {
    //       curve: 'smooth'
    //     },
    //     xaxis: {
    //       type: 'datetime',
    //       categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
    //     },
    //     fill: {
    //     colors: ['#c90303' ,'#527ff4' ]
    //     },
    //     tooltip: {
    //       x: {
    //         format: 'dd/MM/yy HH:mm'
    //       },
    //     },
        
    //     };

    //     var chart = new ApexCharts(document.querySelector("#chart"), options);
    //     chart.render();


        var options1 = {
          series: [{
          name: 'Overused',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'Good used',
          data: [11, 32, 45, 32, 34, 52, 41]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
            labels: {
                    format: 'dd/MM',
                }
        },
        fill: {
            colors: ['#c90303' ,'#527ff4' ]
        },
        chart: {
            foreColor: '#373d3f'
         }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();







        // var options = {
        //   series: [{
        //     name: 'Good used',
        //     data: [100,150,200,250,300,350]
        //   }, {
        //     name: 'Overused',
        //     data: [400,450]
        //   }],
        //   chart: {
        //   id: 'area-datetime',
        //   type: 'area',
        //   height: 350,
        //   zoom: {
        //     autoScaleYaxis: true
        //   }
        // },
        // annotations: {
        //   yaxis: [{
        //     y: 400,
        //     borderColor: '#c90303',
        //     borderWidth: 3,
        //     dashArray: 0, 
        //     label: {
        //       show: true,
        //       text: 'Overused',
        //       style: {
        //         color: "#fff",
        //         background: '#c90303'
        //       }
        //     }
        //   }],
          
        // },
        // dataLabels: {
        //   enabled: false
        // },
        // markers: {
        //   size: 0,
        //   style: 'hollow',
        // },
        // xaxis: {
        //   categories: [2015,2016,2017,2018,2019,2020,2021, 2022,2023]
        // },
        // tooltip: {
        //   x: {
        //     format: 'dd MMM yyyy'
        //   }
        // },
        // fill: {
        //   type: 'gradient',
        //   gradient: {
        //     shadeIntensity: 1,
        //     opacityFrom: 0.7,
        //     opacityTo: 0.9,
        //     stops: [0, 100]
        //   }
        // },
        // };

        // var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
        // chart.render();


        var options = {
            series: [{
                  name: 'Overused',
                  data: [150,240,400, 350,250,120]
              }, {
                  name: 'Good used',
                  data: [100, 150, 350, 250, 300, 200]
                  
              }],
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 300,
                zoom: {
                    autoScaleYaxis: false
                }
            },
            annotations: {
                yaxis: [{
                    y: 400,
                    borderColor: '#c90303',
                    borderWidth: 3,
                    dashArray: 0,
                    label: {
                        show: true,
                        text: 'Overused',
                        style: {
                            color: "#fff",
                            background: '#c90303',
                            
                        }
                    }
                }],
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'category',
                categories: [['Jan 2023'], ['Feb 2023'], ['Mar 2023'], ['Apr 2023'], ['May 2023'], ['Jun 2023']]
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.1,
                    stops: [0, 100]
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
        chart.render();

        function updateChart(selectedTab) {
            if (selectedTab === "daily") {
                chart.updateOptions({
                  series: [{
                      name: 'Good used',
                      data: [100, 150, 350, 250, 300, 200]
                  }, {
                      name: 'Overused',
                      data: [150,240,400, 350,250,120]
                  }],
                    xaxis: {
                        categories: [['Mon', '01 Jan 2023'], ['Tue', '02 Jan 2023'], ['Wed', '03 Jan 2023'], ['Thu', '04 Jan 2023'], ['Fri', '05 Jan 2023'], ['Sat', '06 Jan 2023']]
                    }
                });
            } else if (selectedTab === "weekly") {
                chart.updateOptions({
                  series: [{
                      name: 'Good used',
                      data: [150,240,400, 350,250,120]
                  }, {
                      name: 'Overused',
                      data: [100, 150, 350, 250, 300, 200]
                      
                  }],
                    xaxis: {
                        categories: [['Week 1'], ['Week 2'], ['Week 3'], ['Week 4'], ['Week 5'], ['Week 6']]
                    }
                });
            } else if (selectedTab === "monthly") {
                chart.updateOptions({
                    series: [{
                        name: 'Good used',
                        data: [150,240,400, 350,250,120]
                    }, {
                        name: 'Overused',
                        data: [100, 150, 320, 250, 300, 200]
                        
                    }],
                    xaxis: {
                        categories: [['Jan 2023'], ['Feb 2023'], ['Mar 2023'], ['Apr 2023'], ['May 2023'], ['Jun 2023']]
                    }
                });
            } else if (selectedTab === "yearly") {
                chart.updateOptions({
                    xaxis: {
                        categories: [['2018'], ['2019'],['2020'],['2021'],['2022'],['2023']]
                    }
                });
            }
        }

        $(".toolbar button").click(function () {
            var selectedTab = $(this).attr("id");
            updateChart(selectedTab);
            $(".toolbar button").removeClass("active");
            $(this).addClass("active");
        });

</script>