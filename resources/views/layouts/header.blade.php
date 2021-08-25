<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link rel="shortcut icon" href="{{ asset('/images/front-logo.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- FooTable -->
    <link href="{{ asset('bootstrap/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/blueimp/css/blueimp-gallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <style type="text/css" media="print">
        @page { 
           
            #renz {
                font-size:8px; 
                size: landscape;
            }
        }
    </style>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:200px 120px;
        }
        @media (min-width: 768px) {
            .modal-xl {
                width: 100%;
                max-width:1700px;
            }
        }
        body {
  /* font-weight: bold; */
  color:black;
}
        .upperText
        {
            
            text-transform:uppercase;

        }
    </style>
</head>
<body >
    
    <div id="wrapper">
        <div id = "myDiv" style="display:none;" class="loader">
        </div>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" style='width:48px;height:48px;' src="{{ asset('/images/no_image.png')}}"/>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{Auth::user()->name}}<b class="caret"></b></span>
                                {{-- <span class="text-muted text-xs block">{{Auth::user()->}} </span> --}}
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"  onclick="logout(); show();">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            {{ config('app.name', 'Laravel') }}
                        </div>
                    </li>
                    <li @if($header == 'Home') class='active' @endif>
                        <a href="{{ url('/') }}"  onclick='show()' ><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> </a>
                    </li>
                    <li @if($header == 'Vouchers') class='active' @endif>
                        <a href="{{ url('/requests') }}" onclick='show()'><i class="fa fa-paper-plane"></i> <span class="nav-label">Vouchers</span></a>
                    </li>
                    {{-- <li @if($header == 'For Verifications') class='active' @endif>
                        <a href="{{ url('/for-verifications') }}" onclick='show()'><i class="fa fa-check"></i> <span class="nav-label">For Verifications</span><span class="label label-primary float-right">0</span></a>
                    </li>

                    <li @if($header == 'For Payments') class='active' @endif>
                        <a href="{{ url('/for-payments') }}" onclick='show()'><i class="fa fa-money"></i> <span class="nav-label">For Payments</span><span class="label label-info float-right">0</span></a>
                    </li> --}}
                    <li  @if($header == 'Reports') class='active' @endif>
                        <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                       
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Inventory') class='active' @endif><a href="{{ url('/report-daily-inventory') }}" onclick='show()'>Inventory</a></li> 
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Reimbursement') class='active' @endif><a href="{{ url('/report-daily-reimbursement') }}" onclick='show()'>Reimbursement</a></li> 
                        </ul>
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Receiving') class='active' @endif><a href="{{ url('/receiving') }}" onclick='show()'>Receiving</a></li> 
                        </ul>
                    </li>

                    <li  @if($header == 'Accounting Reports') class='active' @endif>
                        <a href="#"><i class="fa fa-database"></i> <span class="nav-label">Accounting Reports</span><span class="fa arrow"></span></a>
                       
                        <ul class="nav nav-second-level collapse">
                            <li @if($subheader == 'Accounting Monitoring') class='active' @endif><a href="{{ url('/accounting-monitoring') }}" onclick='show()'>Monitoring </a></li> 
                        </ul>
                       
                    </li>
                    
                    
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Welcome to {{ config('app.name', 'Laravel') }}.</span>
                        </li>
                        
                        <li>
                            <a href="{{ route('logout') }}"  onclick="logout(); show();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{$header}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">{{$header}}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>{{$subheader}}</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
            
            @yield('content')
        </div>
        {{-- <script> --}}
            <script type='text/javascript'>
                function show()
                {
                    document.getElementById("myDiv").style.display="block";
                }
                function logout()
                {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                }
            </script>
            
            <!-- Mainly scripts -->
       

            <!-- Custom and plugin javascript -->
        
            <script src="{{ asset('bootstrap/js/jquery-3.1.1.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
            
            <!-- Peity -->
            <script src="{{ asset('bootstrap/js/plugins/peity/jquery.peity.min.js') }}"></script>
            
            <!-- Custom and plugin javascript -->
            <script src="{{ asset('bootstrap/js/inspinia.js') }}"></script>
            
            <!-- iCheck -->
            <script src="{{ asset('bootstrap/js/plugins/iCheck/icheck.min.js') }}"></script>
            
            <script src="{{ asset('bootstrap/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
            <!-- Peity -->
            <script src="{{ asset('bootstrap/js/demo/peity-demo.js') }}"></script>
            <!-- Chosen -->
            <script src="{{ asset('bootstrap/js/plugins/chosen/chosen.jquery.js') }}"></script>
            <!-- Flot -->
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.spline.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.resize.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.pie.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/flot/jquery.flot.time.js') }}"></script>
            <link href="{{ asset('bootstrap/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
            <!-- Peity -->
            <script src="{{ asset('bootstrap/js/plugins/peity/jquery.peity.min.js') }}"></script>
            <!-- FooTable -->
            <script src="{{ asset('bootstrap/js/plugins/footable/footable.all.min.js') }}"></script>
            
            <!-- Custom and plugin javascript -->
            <script src="{{ asset('bootstrap/js/plugins/pace/pace.min.js') }}"></script>
            
            <!-- jQuery UI -->
            <script src="{{ asset('bootstrap/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
               <!-- Morris -->
            {{-- <script src="{{ asset('bootstrap/js/plugins/morris/raphael-2.1.0.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/plugins/morris/morris.js') }}"></script>
            <script src="{{ asset('bootstrap/js/demo/morris-demo.js') }}"></script> --}}
            {{-- <!-- Jvectormap -->
                <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
                <script src="{{ asset('bootstrap/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
                --}}
                <!-- Datatable -->
                <script src="{{ asset('bootstrap/js/plugins/dataTables/datatables.min.js') }}"></script>
                <script src="{{ asset('bootstrap/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
                <!-- EayPIE -->
                <script src="{{ asset('bootstrap/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>
                
                <!-- Sparkline -->
                <script src="{{ asset('bootstrap/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
                
                <!-- Sparkline demo data  -->
                <script src="{{ asset('bootstrap/js/demo/sparkline-demo.js') }}"></script>
                
                <!-- Switchery -->
                <script src="{{ asset('bootstrap/js/plugins/switchery/switchery.js') }}"></script>
                <!-- Input Mask-->
                <script src="{{ asset('bootstrap/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>
                <script src="{{ asset('bootstrap/js/plugins/summernote/summernote-bs4.js') }}"></script>
                
                <!-- blueimp gallery -->
                <script src="{{ asset('bootstrap/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>
                
                <!-- Jquery Validate -->
                <script src="{{ asset('bootstrap/js/plugins/validate/jquery.validate.min.js') }}"></script>
                    <!-- Date range picker -->
                <script src="{{ asset('bootstrap/js/plugins/daterangepicker/daterangepicker.js') }}"></script>

                   <!-- Data picker -->
                <script src="{{ asset('bootstrap/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

                <script src="{{ asset('bootstrap/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
                    <!-- ChartJS-->
            <script src="{{ asset('bootstrap/js/plugins/chartJs/Chart.min.js') }}"></script>
            <script src="{{ asset('bootstrap/js/demo/chartjs-demo.js') }}"></script>
            @if($header == 'Home')
            
            <script>
             var items = {!! json_encode($items) !!};
             var requests = {!! json_encode($requests) !!};
            //  console.log(requests);
            //  console.log(items);

             var voucher = [];
             var amount = [];
             var paid_weight = [];
             for (let i = 0; i < items.length; i++) {
               for(var a = 0; a<requests.length; a++)
               {
                    // console.log(requests[a].months);
                    // console.log(items[i]);
                   if(requests[a].months == items[i])
                   {
                       voucher[i] = requests[a].data; 
                       amount[i] = requests[a].sums; 
                       paid_weight[i] = requests[a].paid_weight; 
                       break;
                   }
                   else
                   {
                    voucher[i] = 0; 
                    amount[i] = 0;
                    paid_weight[i] = 0;
                   }
               }
            }
            var barData = {
                labels: items,
                datasets: [
                // {
                //     label: "Voucher",
                //     backgroundColor: 'rgba(220, 220, 220, 0.5)',
                //     pointBorderColor: "#fff",
                //     data: voucher
                // },
                {
                    label: "Amount",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data:amount,
                }
            ]
        };

        var monthly_paid = {
                labels: items,
                datasets: [
                // {
                //     label: "Voucher",
                //     backgroundColor: 'rgba(220, 220, 220, 0.5)',
                //     pointBorderColor: "#fff",
                //     data: voucher
                // },
                {
                    label: "Weight(KG)",
                    backgroundColor: 'rgb(0, 92, 230, 0.5)',
                    borderColor: "rgb(0, 92, 230, 0.7)",
                    pointBackgroundColor: "rgb(0, 92, 230, 1)",
                    pointBorderColor: "#fff",
                    data:paid_weight,
                }
            ]
        };

        var barOptions = {
            responsive: true,
            title: {
            display: false,
            text: 'Stacked Bars'
        },
        };


    var ctx2 = document.getElementById("monthly_report").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
            

    var daily = document.getElementById("daily_request").getContext("2d");
    new Chart(daily, {type: 'bar', data: monthly_paid, options:barOptions});
            </script>
           @endif

                <script>
                       $(document).ready(function(){
            $('.dataTables-example').DataTable({
                // pageLength: 25,
                paging:   false,
                responsive: true,
                ordering: false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    // { extend: 'copy'},
                    // {extend: 'csv'},
                    {extend: 'excel', title: 'Request'},
                    // {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });

                </script>
            </body>
            </html>
            