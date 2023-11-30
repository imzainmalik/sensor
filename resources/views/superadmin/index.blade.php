@extends('layouts.app')
@section('content')
    <div class="col-md-7 col-xl-8">
        <div class="row">
            <div class="col-md-6 ss">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Resources</h3>
                    </div>
                    <div class="panel_body">
                        <div class="ajaxloader"></div>
                        <div class="chartTitle">
                            @php
                                $filter = 'Water';
                                if(isset($request['filter'])){
                                    if($request['filter'] == 'Energy') {
                                        $filter = 'Energy';
                                    }elseif($request['filter'] == 'Gas'){
                                        $filter = 'Gas';
                                    }else{
                                        $filter = 'Water';
                                    }
                                }
                            @endphp
                            <h3><span><i class="fal fa-water-rise"></i></span>  {{  $filter }} Consumption</h3>
                            <input type="text" name="datetimes" />
                            <input type="hidden" id="startDate" name="start_date" value=""/>
                            <input type="hidden" id="endDate" name="end_date" value=""/>
                            <input type="hidden" id="filter" name="filter" value="{{ $filter }}"/>
                        </div>
                        <div id="chart">
                            <div class="chartstabs">
                                <div class="toolbar ">
                                    <button id="daily" value="daily">Daily</button>
                                    <button id="weekly" value="weekly" class="active">Weekly</button>
                                    <button id="monthly" value="monthly" >Monthly</button>
                                    <button id="yearly" value="yearly">Yearly</button>
                                </div>
                                <div class="selectSt">
                                </div>
                            </div>
                            <div id="chart-timeline"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Property Watch</h3>
                    </div>
                    <div class="panel_body">
                        <div class="det_1 d-flex justify-content-between">
                            <p>Property</p>
                            <p>Fire or Safety</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-6">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Financials</h3>
                    </div>
                    <div class="panel_body">
                        <div class="chartTitle">
                            <h3><span><i class="fal fa-water-rise"></i></span> Water Consumption</h3>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-3">
                <div class="dv_alerts">
                    <div class="panel_head bluethemeCol">
                        <h3>Canvas</h3>
                    </div>
                    <div class="alerts redalert">
                        <div class="d-flex">
                            <div class="alert_icon">
                                <img src="assets/images/fireicon.webp" alt="">
                            </div>
                            <div class="alert_det">
                                <h5>Smoke Detected!</h5>
                                <p>Check your house and make sure to stay safe.</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a class="alertactBtn" href="javascript:;" title="">Take Action</a>
                        </div>
                    </div>
                    <div class="alerts yellowalert">
                        <div class="d-flex">
                            <div class="alert_icon">
                                <img src="assets/images/fireicon.webp" alt="">
                            </div>
                            <div class="alert_det">
                                <h5>Leak Detected!</h5>
                                <p>Check your house and make sure to stay safe.</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a class="alertactBtn" href="javascript:;" title="">Take Action</a>
                        </div>
                    </div>
                    <div class="alerts greenalert">
                        <div class="d-flex">
                            <div class="alert_icon">
                                <img src="assets/images/tipsicon.webp" alt="">
                            </div>
                            <div class="alert_det">
                                <h5>Tips & Tricks</h5>
                                <p>Switch to an instantaneous hot water system.</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center largeBtn">
                        <a class="themeBtn" href="javascript:;" title="">Tips & Tricks</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dv_alerts">
                    <div class="panel_head bluethemeCol">
                        <h3>Work Orders</h3>
                    </div>
                    <div class="box_notification">
                        <div class="icons">
                            <img src="assets/images/houseicon.webp" alt="">
                        </div>
                        <div class="details_mm">
                            <div class="headtitle">
                                <h6 class="">High Priority </h6>
                                <h3>Device Not Working</h3>
                                <span>Today</span>
                            </div>
                            <p>Commodo diam fames egestas odio dignissim adipiscing pellentesque eu.</p>
                        </div>
                    </div>
                    <div class="box_notification">
                        <div class="icons">
                            <img src="assets/images/pipeicon.webp" alt="">
                        </div>
                        <div class="details_mm">
                            <div class="headtitle">
                                <h6 class="yellowcol">Medium Priority </h6>
                                <h3>Leak Detected</h3>
                                <span>8hrs ago</span>
                            </div>
                            <p>Commodo diam fames egestas odio dignissim adipiscing pellentesque eu.</p>
                        </div>
                    </div>
                    <div class="box_notification">
                        <div class="icons">
                            <img src="assets/images/pipeicon.webp" alt="">
                        </div>
                        <div class="details_mm">
                            <div class="headtitle">
                                <h6 class="greencol">Low Priority </h6>
                                <h3>Leak Detected</h3>
                                <span>8hrs ago</span>
                            </div>
                            <p>Commodo diam fames egestas odio dignissim adipiscing pellentesque eu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Device List</h3>
                    </div>
                    <div class="panel_body">
                            <table class="table table-bordered data-table"  style="color:white;  height:400px; " >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Device Code</th>
                                        <th width="50px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    @push('custum_js')
    <script>
        $(window).on('load',function() {
             $('.toolbar .active').trigger('click');
        });
    </script>
    @endpush
@endsection
