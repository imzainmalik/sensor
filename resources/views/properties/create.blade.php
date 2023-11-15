@extends('layouts.app')
@section('content')
    <div class="col-md-7 col-xl-8">
        <div class="row">
            <div class=" col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">

            <form action="{{route('property.store')}}" method="POST">
                @csrf
                <input type="hidden" class="form-control"  name="id" value="{{ $property ? $property->id : '' }}" placeholder="id">
                <div class="form-row">
                  <div class=" col-md-6">
                    <label for="inputText">Name</label>
                    <input type="text" class="form-control" id="inputText" name="title" value="{{ $property ? $property->title : '' }}" placeholder="Name">
                  </div>
                  <div class=" col-md-6">
                    <label for="inputPassword4">Phone</label>
                    <input type="number" class="form-control" id="inputPassword4" name="phone" value="{{ $property ? $property->phone : '' }}" placeholder="Phone">
                  </div>
                </div>
                <br>
                <div class="">
                  <label for="inputAddress">User</label>
                  <select  class="form-control" name="user_id" id="cars">

                    @foreach ($users as $user) 
                        <option value="{{ $user->id }}" {{ $property ? $property->user_id == $user->id ? 'selected' : '' : '' }}>{{ $user->name }}</option>
                    @endforeach
                  </select>
                  {{-- <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St"> --}}
                </div>
                <br>
                <div class="">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" name="address"  value="{{ $property ? $property->address : '' }}" placeholder="1234 Main St">
                </div>
                <br>
                <div class="">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
              
              </form>
            {{-- <div class="col-md-6">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Resources</h3>
                    </div>
                    <div class="panel_body">
                        <div class="chartTitle">
                            <h3><span><i class="fal fa-water-rise"></i></span> Water Consumption</h3>
                            <div class="selectTT">
                                <div class="selectPos">
                                    <i class="fal fa-city"></i>
                                </div>
                   
                                <select name="" id="">
                                    @forelse ($properties as $property)
                                    <option selected disabled value="">Select Properties</option>
                                    <option value="{{ $property->id }}">{{ $property->title }}</option>
                                    @empty 
                                    <option selected disabled value="">Select Properties</option>
                                    @endforelse
                                   
                                </select>
                            </div>
                        </div>
                        <div id="chart">
                            <div class="chartstabs">
                                <div class="toolbar">
                                    <button id="daily">Daily</button>
                                    <button id="weekly">Weekly</button>
                                    <button id="monthly" class="active">Monthly</button>
                                    <button id="yearly">Yearly</button>
                                </div>
                                <div class="selectSt">
                                    <input id="datepicker" placeholder="Select Date" />
                                    <div class="arrowD">
                                        <i class="fal fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="chart-timeline"></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
                <div class="panelBox widgets minheightSet">
                    <div class="panel_head greenthemeCol">
                        <h3>Financials</h3>
                    </div>
                    <div class="panel_body">
                        <div class="chartTitle">
                            <h3><span><i class="fal fa-water-rise"></i></span> Water Consumption</h3>
                            <div class="selectTT">
                                <div class="selectPos">
                                    <i class="fal fa-city"></i>
                                </div>
                                <select name="" id="">
                                    
                                  @forelse ($properties as $property) 
                                  <option selected disabled value="">Select Properties</option>
                                      <option value="{{ $property->id }}">{{ $property->title }}</option>
                                  @empty 
                                  <option selected disabled value="">Select Properties</option>
                                  
                                  @endforelse
                                  
                                </select>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
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
            </div> --}}
        </div>
    </div>
@endsection
