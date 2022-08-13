<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.ui-lib.com/gull-html/dashboard.v1.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Jan 2019 05:34:10 GMT -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CarSeekers - {{ Request::segment(1) == '' ? 'Home': ucfirst(Request::segment(1)) }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('templates/images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('templates/backend/styles/css/themes/lite-purple.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/styles/vendor/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/backend/styles/vendor/datatables.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
<div class="app-admin-wrap">
    <div class="main-header">
        <div class="logo text-center">
{{--            <img src="{{ asset('templates/images/logo.png') }}" alt="">--}}
            <h4><span class="text-danger">Car</span>Seekers</h4>
        </div>

        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div style="margin: auto"></div>

        <div class="header-part-right">
            <!-- Full screen toggle -->
            <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
            <!-- Notificaiton -->
            <div class="dropdown">
                <div class="badge-top-container" id="dropdownNotification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">3</span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>
                <!-- Notification dropdown -->
                <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>New message</span>
                                <span class="badge badge-pill badge-primary ml-1 mr-1">new</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">10 sec ago</span>
                            </p>
                            <p class="text-small text-muted m-0">James: Hey! are you busy?</p>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Receipt-3 text-success mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>New order received</span>
                                <span class="badge badge-pill badge-success ml-1 mr-1">new</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">2 hours ago</span>
                            </p>
                            <p class="text-small text-muted m-0">1 Headphone, 3 iPhone x</p>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Empty-Box text-danger mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>Product out of stock</span>
                                <span class="badge badge-pill badge-danger ml-1 mr-1">3</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">10 hours ago</span>
                            </p>
                            <p class="text-small text-muted m-0">Headphone E67, R98, XL90, Q77</p>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon">
                            <i class="i-Data-Power text-success mr-1"></i>
                        </div>
                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>Server Up!</span>
                                <span class="badge badge-pill badge-success ml-1 mr-1">3</span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">14 hours ago</span>
                            </p>
                            <p class="text-small text-muted m-0">Server rebooted successfully</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Notificaiton End -->

            <!-- User avatar dropdown -->
            <div class="dropdown">
                <div class="user col align-self-end">
                    <img src="{{ asset('templates/images/avatars/'.Auth::user()->avatar) }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-header">
                            <i class="i-Lock-User mr-1"></i> {{ Auth::user()->name }}
                        </div>
                        <a class="dropdown-item" href="{{ route('account-settings') }}">Account settings</a>
                        <a class="dropdown-item" href="{{ route('password.update') }}">Reset Password</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-lg"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="side-content-wrap">
        <div class="sidebar-left open" data-perfect-scrollbar data-suppress-scroll-x="true">
            <ul class="navigation-left">
                <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
                    <a class="nav-item-hold" href="{{ route('dashboard') }}">
                        <i class="nav-icon i-Bar-Chart"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <div class="triangle"></div>
                </li>


                <li class="nav-item {{ Request::is('bookings') ? 'active':'' }}">
                    <a class="nav-item-hold" href="{{ route('bookings.index') }}">
                        <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                        <span class="nav-text">Bookings</span>
                    </a>
                    <div class="triangle"></div>
                </li>

                <li class="nav-item {{ Request::is('vehicle') ? 'active':'' }}">
                    <a class="nav-item-hold" href="{{ route('vehicle.index') }}">
                        <span class="nav-icon material-icons">
                            directions_car
                        </span>
                        <span class="nav-text">Vehicles</span>
                    </a>
                    <div class="triangle"></div>
                </li>

                <li class="nav-item {{ Request::is('drivers') ? 'active':'' }}">
                    <a class="nav-item-hold" href="{{ route('drivers.index') }}">
                        <span class="nav-icon material-icons">account_box</span>
                        <span class="nav-text">Drivers</span>
                    </a>
                    <div class="triangle"></div>
                </li>

                @if(Auth::user()->role == 'Admin')

                    <li class="nav-item {{ Request::is('packages') ? 'active':'' }}">
                        <a class="nav-item-hold" href="{{ route('packages.index') }}">
                            <i class="nav-icon i-Data-Upload"></i>
                            <span class="nav-text">Packages</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item {{ Request::is('durations') ? 'active':'' }}">
                        <a class="nav-item-hold" href="{{ route('durations.index') }}">
                            <i class="nav-icon i-Data-Upload"></i>
                            <span class="nav-text">Durations</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item {{ Request::is('discounts') ? 'active':'' }}" hidden>
                        <a class="nav-item-hold" href="{{ route('discounts.index') }}">
                            <i class="nav-icon i-Financial"></i>
                            <span class="nav-text">Discounts</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item {{ Request::is('company-policies') ? 'active':'' }}">
                        <a class="nav-item-hold" href="{{ route('company-policies.index') }}">
                            <i class="nav-icon i-Computer-Secure"></i>
                            <span class="nav-text">Company Policies</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                    <li class="nav-item {{ Request::is('users') ? 'active':'' }}">
                        <a class="nav-item-hold" href="{{ route('users.index') }}">
                            <i class="nav-icon i-Male"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <div class="triangle"></div>
                    </li>

                @endif
            </ul>
        </div>
    </div>
    <!--=============== Left side End ================-->

    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">
        {{--
        <div class="breadcrumb">
            <h1>Version 1</h1>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li>Version 1</li>
            </ul>
        </div>

        <div class="separator-breadcrumb border-top"></div>
        --}}

        @if(Auth::user()->status == 'Disapproved' || Auth::user()->status == 'Suspended')
            <h1 class="text-center alert alert-danger col-md-6 offset-md-3">Your account has been {{ Auth::user()->status }}!</h1>
            <br>
            <h5 class="text-center">Please contact "Administrator" for support</h5>
        @elseif(Auth::user()->status == 'Pending')
            <h1 class="text-center alert alert-danger col-md-6 offset-md-3">Your account approval is in {{ Auth::user()->status }}!</h1>
            <br>
            <h5 class="text-center">Please check back latter or contact "Administrator" for support</h5>
        @elseif(Auth::user()->status == 'Approved')

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('danger'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger text-center">
                        {{ $error }} <br>
                    </div>
                @endforeach
            @endif

        @yield('content')
        @endif

    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<script src="{{ asset('templates/backend/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/vendor/echarts.min.js') }}"></script>

<script src="{{ asset('templates/backend/js/es5/echart.options.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/es5/dashboard.v1.script.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/es5/script.min.js') }}"></script>

<!-- page vendor js -->
<script src="{{ asset('templates/backend/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('templates/backend/js/es5/script.min.js') }}"></script>
<!-- page custom js -->
{{--<script src="{{ asset('templates/backend/js/datatables.script.js') }}"></script>--}}

<!-- Include the ckEditor CDN -->
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


<script>
    // zero_configuration_table
    $(document).ready(function(){
        // $('#datatable').DataTable();
        $('#datatable').DataTable( {
            "paging":   true,
            "ordering": false,
            "info":     true
        } );
        $('#rating-datatable').DataTable( {
            "paging":   true,
            "ordering": false,
            "info":     true
        } );
    });
</script>

<!-- Datepicker CSS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(".date-filter-selector").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        defaultDate: "today",
        maxDate: "today",
    });
    /*$(".time-selector").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",
        time_24hr: false,
        // defaultDate: "12:00 AM"
    });*/
    /*$("body").on('change', '.time-selector', function f() {
        alert($('.time-selector').val())
    });*/
</script>

<div id="globalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content custom-modal">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="btn btn-round btn-white btn-fab text-danger close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <span class="loadForm"></span>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>

    // Error message for storing data
    function printErrorMsg (msg) {
        $(".print-error-msg").find(".row").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find('.row').append(
                '<div class="col-md-12 ml-auto mr-auto pt-1 pb-1 mt-1 mb-1 alert alert-danger">' +
                '    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '        <span class="material-icons">close</span>\n' +
                '    </button>' +
                '    <span>\n' +
                '        <b>' +value+ '</b>'+
                '    </span>' +
                '</div>'
            );
        });
    }

    // Create record
    $('body').on('click', '.createBtn', function() {
        let formType = $(this).data('formtype');
        let formSize = $(this).data('formsize');
        let globalModal = $('#globalModal');
        let modalDialog = $(".modal-dialog");
        let modalTitle = $(".modal-title");
        let closeBtn = $("#closeBtn");
        let submitBtn = $("#submitBtn");
        let route = $('.createBtn').data('route');

        if(formType == "modal"){
            globalModal.modal({
                backdrop: 'static',
                keyboard: false
            });
            if(formSize == "extraLarge"){
                modalDialog.addClass("modal-xl");
            }
            if(formSize == "large"){
                modalDialog.addClass("modal-lg");
            }
            if(formSize == "medium"){
                modalDialog.addClass("modal-md");
            }
            if(formSize == "small"){
                modalDialog.addClass("modal-sm");
            }
            modalTitle.html('Create Record');
            closeBtn.html('Close');
            submitBtn.html('Save');
            submitBtn.addClass('storeData');
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            dataType: 'html',
            success: function (data) {
                globalModal.find('.loadForm').html(data);
                //console.log(response);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    // Store record
    $('body').on('click', '.storeData', function(e) {
        e.preventDefault();

        let globalForm = $('#globalForm');
        let action = globalForm.attr('action');
        let submitBtn = $('#submitBtn');
        let globalModal = $('#globalModal');
        let globalTable = $('#globalTable');
        $.ajax({
            url: action,
            data:new FormData(globalForm[0]),
            // dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
            // dataType: "html",
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    globalModal.trigger("reset");
                    globalModal.modal('hide');
                    globalTable.replaceWith($('#globalTable',data));

                    let tr = $('tr');
                    let max = 0;
                    tr.each(function() {
                        let value = parseInt($(this).data('row'));
                        max = (value > max) ? value : max;
                    });
                    tr.each(function (index, value){
                        if ($(this).data('row') === max) {
                            $(this).css('background', '#d8f5e0');
                            $(this).delay(1500).queue(function (next) {
                                $(this).css('background', 'transparent');
                                next();
                            });
                        }
                    });

                    $('#datatable').DataTable( {
                        "paging":   true,
                        "ordering": false,
                        "info":     true
                    } );

                    $(".error").attr('hidden', true);
                    console.log(data);
                }else{
                    printErrorMsg(data.error);
                    setTimeout(function(){
                        $(".print-error-msg").fadeOut(3*1000);
                    }, 5*1000);
                    submitBtn.html('Save');
                }
            },
            error: function (data) {
                alert('Operation Failed!');
                submitBtn.html('Save');
            }
        });
    });

    // Show record
    $('body').on('click', '.showBtn', function() {
        let route = $(this).data('route');
        let formType = $(this).data('formtype');
        let formSize = $(this).data('formsize');
        let globalModal = $('#globalModal');
        let modalDialog = $(".modal-dialog");
        let modalTitle = $(".modal-title");
        let closeBtn = $("#closeBtn");
        let submitBtn = $("#submitBtn");
        if(formType == "modal"){
            globalModal.modal({
                backdrop: 'static',
                keyboard: false
            });
            if(formSize == "extraLarge"){
                modalDialog.addClass("modal-xl");
            }
            if(formSize == "large"){
                modalDialog.addClass("modal-lg");
            }
            if(formSize == "medium"){
                modalDialog.addClass("modal-md");
            }
            if(formSize == "small"){
                modalDialog.addClass("modal-sm");
            }
            modalTitle.html('Show Record');
            closeBtn.html('Close');
            submitBtn.remove();
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            dataType: 'html',
            success: function (data) {
                globalModal.find('.loadForm').html(data);
                //console.log(response);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    // Edit record
    $('body').on('click', '.editBtn', function() {
        let route = $(this).data('route');
        let formType = $(this).data('formtype');
        let formSize = $(this).data('formsize');
        let globalModal = $('#globalModal');
        let modalDialog = $(".modal-dialog");
        let modalTitle = $(".modal-title");
        let closeBtn = $("#closeBtn");
        let submitBtn = $("#submitBtn");
        if(formType == "modal"){
            globalModal.modal({
                backdrop: 'static',
                keyboard: false
            });
            if(formSize == "extraLarge"){
                modalDialog.addClass("modal-xl");
            }
            if(formSize == "large"){
                modalDialog.addClass("modal-lg");
            }
            if(formSize == "medium"){
                modalDialog.addClass("modal-md");
            }
            if(formSize == "small"){
                modalDialog.addClass("modal-sm");
            }
            modalTitle.html('Edit Record');
            closeBtn.html('Close');
            submitBtn.html('Update');
            submitBtn.addClass('updateData');
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            dataType: 'html',
            success: function (data) {
                globalModal.find('.loadForm').html(data);
                //console.log(response);
            },
            error: function (data) {
                //console.log('Error:', data);
            }
        });
    });

    // Update record
    $('body').on('click', '.updateData', function(e) {
        e.preventDefault();

        let globalForm = $('#globalForm');
        let action = globalForm.attr('action');
        let submitBtn = $('#submitBtn');
        let globalModal = $('#globalModal');
        let globalTable = $('#globalTable');
        $.ajax({
            url: action,
            data:new FormData(globalForm[0]),
            // dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
            // dataType: "html",
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    globalModal.trigger("reset");
                    globalModal.modal('hide');
                    globalTable.replaceWith($('#globalTable',data));

                    $('.globalTable').replaceWith($('.globalTable',data));
                    $('tr').each(function (index, value){
                        if ($(this).data('row') === $('#globalForm').data('id')) {
                            $(this).css('background', '#d8f5e0');
                            $(this).delay(1500).queue(function (next) {
                                $(this).css('background', 'transparent');
                                next();
                            });
                        }
                    });

                    $('#datatable').DataTable( {
                        "paging":   true,
                        "ordering": false,
                        "info":     true
                    } );

                    $(".error").attr('hidden', true);
                }else{
                    printErrorMsg(data.error);
                    setTimeout(function(){
                        $(".print-error-msg").fadeOut(3*1000);
                    }, 5*1000);
                    submitBtn.html('Save');
                }
            },
            error: function (data) {
                alert('Operation Failed!');
                submitBtn.html('Save');
            }
        });
    });

    // Delete single record
    $('body').on('click', '.deleteBtn', function(e) {
        var route = $(this).data('route');
        var el = this;
        // AJAX Request
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            type: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                // Removing row from HTML Table
                $(el).closest('tr').css('background', '#f5d8d8');
                $(el).closest('tr').fadeOut(800, function () {
                    $(this).remove();
                });
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>

<script>
    $('body').on('change', '.status-update', function(e) {
        e.preventDefault();
        let dataID = $(this).data('id');
        let statusForm = $('.status-form-'+dataID);
        let action = statusForm.attr('action');
        let globalTable = $('#globalTable');

        $.ajax({
            url: action,
            data:new FormData(statusForm[0]),
            // dataType:'json',
            async:false,
            type:'post',
            processData: false,
            contentType: false,
            // dataType: "html",
            success: function (data) {
                if($.isEmptyObject(data.error)){

                    $('.globalTable').replaceWith($('.globalTable',data));
                    $('tr').each(function (index, value){
                        if ($(this).data('row') === statusForm.data('id')) {
                            $(this).css('background', '#d8f5e0');
                            $(this).delay(1500).queue(function (next) {
                                $(this).css('background', 'transparent');
                                next();
                            });
                        }
                    });

                    $(".error").attr('hidden', true);
                }else{
                    printErrorMsg(data.error);
                    setTimeout(function(){
                        $(".print-error-msg").fadeOut(3*1000);
                    }, 5*1000);
                }
            },
            error: function (data) {
                alert('Operation Failed!');
            }
        });
    })
</script>

</body>


<!-- Mirrored from demos.ui-lib.com/gull-html/dashboard.v1.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Jan 2019 05:34:35 GMT -->
</html>
