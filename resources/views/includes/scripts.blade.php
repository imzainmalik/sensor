<script src="{{ asset('assets/js/all.min.js')  }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>   
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	
@stack('custum_js')
<script>
    $(window).on('load',function()    {    
        $("#preloaders").fadeOut(1200); 
    });

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
        $(".toolbar button").removeClass("active");
        $(this).addClass("active");
    });

    $( document ).ready(function() {

        function AjaxRequest(url,data)
        {
            var res;
            $.ajax({
                url: url,
                data: data,
                async: false,
                error: function() {
                    console.log('error');
                },
                dataType: 'json',
                success: function(data) {
                    res= data;

                },
                type: 'POST'
            });
            return res;
        }
        
        $("input[name='datetimes']").daterangepicker(
            {},
            function (start, end, label) {
            let startDate = start.format("YYYY-MM-DD").toString();
            let endDate = end.format("YYYY-MM-DD").toString();
            
            $("#startDate").val(startDate);
            $("#endDate").val(endDate);
            $('.toolbar .active').trigger('click');
            }
        );

        $('.toolbar button').click(function (){
            $('.ajaxloader').fadeIn();
            var days =  $(this).val();
            var start_date =  $("input[name='start_date']").val()  === '' ? null : $("input[name='start_date']").val();
            var end_date =  $("input[name='end_date']").val() === '' ? null : $("input[name='end_date']").val() ;
            var filter =  $("input[name='filter']").val() === '' ? null : $("input[name='filter']").val() ;
            let property_id = '{{ isset($app_property) ? $app_property->id : null }}';
            let appartment_id = '{{ isset($appartment) ? $appartment->id : null }}';
            var data = {
                "_token": '{{ csrf_token() }}',
                "days": days,
                "start_date": start_date,
                "end_date": end_date,
                "property_id": property_id,
                "appartment_id": appartment_id,
                "filter": filter,
            };
            var url = '{{route('water.ajax')}}';
            var res = AjaxRequest(url,data);
        
            if(res.status==1)
            {       
                var options = {
                    series: [
                        {
                        name: 'Temperature',
                        data: res.averages,
                            
                        }
                    ],
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
                        categories: res.days
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
                $("#chart-timeline").html('');
                $('.ajaxloader').fadeOut(500);
                var chart = new ApexCharts(document.querySelector("#chart-timeline"), options);
                chart.render();
            }else {
                alert('Some thing went wrong');
            }
        });
    });

</script>
