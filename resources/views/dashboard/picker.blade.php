@extends('layouts.main')
@section('style')
    
@endsection
@section('head')
    
@endsection

@section('content')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Form Pickers</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Form Pickers</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Material Date picker</h4>
                                <h6 class="card-subtitle">Use <code>.bootstrapMaterialDatePicker</code> to create it.</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="m-t-20">Default Material Date Picker</label>
                                        <input type="text" class="form-control" placeholder="2017-06-04" id="mdate">
                                        <label class="m-t-40">Default Material Date Timepicker</label>
                                        <input type="text" id="date-format" class="form-control" placeholder="Saturday 24 June 2017 - 21:44">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="m-t-20">Time Picker</label>
                                        <input class="form-control" id="timepicker" placeholder="Check time">
                                        <label class="m-t-40">Min Date set</label>
                                        <input type="text" class="form-control" placeholder="set min date" id="min-date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Clock Picker</h4>
                                <h6 class="card-subtitle">Use <code>.clockpicker</code> to create it.</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="m-t-20">Default Clock Picker</label>
                                        <div class="input-group clockpicker">
                                            <input type="text" class="form-control" value="09:30">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                        </div>
                                        <label class="m-t-40">Auto close Clock Picker</label>
                                        <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                            <input type="text" class="form-control" value="13:14">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="m-t-20">Now time</label>
                                        <div class="input-group">
                                            <input class="form-control" id="single-input" value="" placeholder="Now">
                                            <div class="input-group-append">
                                                <button type="button" id="check-minutes" class="btn waves-effect waves-light btn-success">Check the minutes</button>
                                            </div>
                                        </div>
                                        <label class="m-t-40">Left Placement</label>
                                        <div class="input-group clockpicker " data-placement="left" data-align="top" data-autoclose="true">
                                            <input type="text" class="form-control" value="13:14">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 m-b-30">
                                        <div class="example">
                                            <h5 class="box-title">Simple mode</h5>
                                            <p class="text-muted m-b-20">just add class <code>.colorpicker</code></p>
                                            <input type="text" class="colorpicker form-control" value="#7ab2fa" /> </div>
                                    </div>
                                    <div class="col-md-4 m-b-30">
                                        <div class="example">
                                            <h5 class="box-title">Complex mode</h5>
                                            <p class="text-muted m-b-20">just add class <code>.complex-colorpicker</code></p>
                                            <input type="text" class="complex-colorpicker form-control" value="#fa7a7a" /> </div>
                                    </div>
                                    <div class="col-md-4 m-b-30">
                                        <div class="example">
                                            <h5 class="box-title">Gradiant mode</h5>
                                            <p class="text-muted m-b-20">just add class <code>.gradient-colorpicker-colorpicker</code></p>
                                            <input type="text" class="gradient-colorpicker form-control" value="#bee0ab" /> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Date Range picker</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Date Range Pick</h5>
                                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2015 - 01/31/2015" /> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Date Range With Time</h5>
                                            <input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM" /> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Limit Selectable Dates</h5>
                                            <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015" /> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Default Datedpicker</h5>
                                            <p class="text-muted m-b-20">just add class <code>.mydatepicker</code> to create it.</p>
                                            <div class="input-group">
                                                <input type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Autoclose Datedpicker</h5>
                                            <p class="text-muted m-b-20">just add class <code>.complex-colorpicker</code> to create it.</p>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="example">
                                            <h5 class="box-title m-t-30">Date Range picker</h5>
                                            <p class="text-muted m-b-20">just add id <code>#date-range</code> to create it.</p>
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="start" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-info b-0 text-white">TO</span>
                                                </div>
                                                <input type="text" class="form-control" name="end" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <h5 class="box-title m-t-30">Datepicker Inline</h5>
                                            <p class="text-muted m-b-20">You also can set the datepicker to be inline and flat.</p>
                                            <center>
                                                <div id="datepicker-inline"></div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
@endsection
@section('script')

<script src="{{asset('public/assets/node_modules/moment/moment.js')}}"></script>
    <script src="{{asset('public/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="{{asset('public/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('public/assets/node_modules/jquery-asColor/dist/jquery-asColor.js')}}"></script>
    <script src="{{asset('public/assets/node_modules/jquery-asGradient/dist/jquery-asGradient.js')}}"></script>
    <script src="{{asset('public/assets/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('public/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{asset('public/assets/node_modules/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('public/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false, switchOnClick: true });
    $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false, switchOnClick: true });
    $('#date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });

    $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
    
@endsection