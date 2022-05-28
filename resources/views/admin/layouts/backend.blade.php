<!DOCTYPE HTML>
<html>
    <head>
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="{{ config('app.name') }}" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('template/css/font-awesome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('adminLte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('adminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('adminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('adminLte/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminLte/css/adminlte.min.css') }}">
    
        <link rel="stylesheet" href="{{ asset('adminLte/plugins/datatables/buttons.bootstrap4.min.css') }}">

        <link rel="stylesheet" href="{{ asset('/template/css/table.dataTable.css') }}">
        <link rel="stylesheet" href="{{ asset('/template/css/new_style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!--<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>-->
        <script src="{{ asset('template/js/menu_jquery.js') }}  "></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            body{ 
                font-family: "Open Sans",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol" !important;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btnmenu" data-widget="pushmenu" href="#" role="button"><i class="fa fa-fw fa-ellipsis-v"></i></a>
                    </li>
                    <!---<li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('admin/home')}}" class="nav-link"> <i class="fas fa-house-user"></i></a>
                    </li>-->
                    <li class="nav-item d-none d-sm-inline-block">
                        <!--<a href="#" class="nav-link">Contact</a>-->
                    </li>
                </ul>

              
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">{{ \Auth::guard('admin')->user()->name }}</span>
                    </li>     
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">10</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="text-center">
                                <h5 class="dropdown-header text-uppercase text-dark">
                                      <span class="spinner-grow text-danger spinner-grow-sm" role="status" aria-hidden="true"></span> Progress</h5>
                            </div>
                        </div>

                    </li> 

                    <div class="d-flex align-items-center">
                        <div class="dropdown d-inline-block ml-2 show ">
                            <button type="button" class="btn btn-sm btn-dual bg-light" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                                <span class="d-sm-inline-block"><i class="fa fa-user-circle-o text-success m-2"></i>Profile</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown" style="position: absolute; transform: translate3d(-76px, 31px, 0px); top: 0px;left:0px; will-change: transform;" x-placement="bottom-end">
                                <div class="top_left">
<!--                                    <a  class="nav-link" style="Color:Black"  href="{{ url('admin/configurations') }}">
                                        Configurations <i class="fas fa-gears"></i>
                                    </a>-->
                                    <a class="nav-link bg-danger" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        Logout <i class="fas fa-sign-out"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>

                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{url('admin\home')}}" class="brand-link">

                    <span class="brand-text font-weight-light"></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('person.jpg') }}">
                        </div>
                        <div class="info">
                            <a href="{{ url('admin/users/role/1') }}" class="d-block">Super Admin</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul id="menu" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                             @php
                                $get_route = explode('.',Request::route()->getName());
                                $list = list($get_route) = $get_route;
                                $current_url = @$list[0];
                                $base_url = @$list[1];
                            @endphp
                            <li class="nav-item">
                                <a href="{{ url('admin/dashboard') }}" class="nav-link">
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/products') }}" class="nav-link">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <p>Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/orders') }}" class="nav-link">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <p>
                                        Orders
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            @if(session('flash_message') || session('error'))
                <div class="toast col-12 mr-4 rounded-0 animated fadeInDown shadow @if(session('error')) bg-danger @else bg-success @endif text-white w-100 mt-3" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; right: 0; z-index: 10">                       
                    <div class="toast-body">
                        <i class="fa @if(session('error')) fa-exclamation-triangle @else fa-check-circle @endif" style="font-size:20px"></i>
                         @if(session('flash_message')) {{session('flash_message')}} @else {{session('error')}} @endif 
                        <button type="button" class="toastclose close" data-dismiss="toast" style="outline: none;border:none"><span aria-hidden="true">&times;</span></button>
                   </div>
                </div>
             @endif
            
            @yield('content')
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">  
            <div class="modal-body">
                <div id="ladiv"></div>
            </div>
        </div>
    </div>
        </div>
        <style type="text/css" class='fa-star-o'>
            /*table tr th:first-child {width: 50px !important;}*/
            .menu-open li.nav-item p {
                text-transform: capitalize;
            }
        </style>
        <script>
            var toggle = true;
           
            $(".sidebar-icon").click(function () {
                if (toggle)
                {
                    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                    $("#menu span").css({"position": "absolute"});
                } else
                {
                    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                    setTimeout(function () {
                        $("#menu span").css({"position": "relative"});
                    }, 400);
                }

                toggle = !toggle;
            });
            $("#menu li a").each(function () {
                if ((window.location.href == $(this).attr('href'))) {
                    $(this).addClass('active');
                    if ($(this).parent().parent().parent().hasClass('has-treeview')) {
                        $(this).parent().parent().parent().addClass('menu-open');
                        // $(this).parent().parent().parent().find('a.nav-link').addClass('active');
                    }
                }
            });
        </script>

        <!-- jQuery -->
        <script src="{{ asset('adminLte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('adminLte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>
        $(document).ready(function(){
            setTimeout(function() { $(".toast").addClass('fadeOutUp'); }, 10000);
        //            $('.toast').toast({delay: 10000});
            
         $('.toastclose').on('click',function(){
             $(".toast").addClass('fadeOutUp');
         });
        });    
    </script>   
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
        <script src="{{ asset('adminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    
        <script src="{{ asset('adminLte/js/adminlte.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('adminLte/js/pages/dashboard.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminLte/js/demo.js') }}"></script>
        <!-- jQuery -->
        <!-- Bootstrap 4 -->
        <!-- DataTables -->
        <script src="{{ asset('adminLte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

         <!--<script src="{{ asset('adminLte/plugins/datatables/be_tables_datatables.min.js') }}"></script>-->
        <script src="{{ asset('adminLte/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <!--<script src="{{ asset('adminLte/plugins/datatables/buttons.flash.min.js') }}"></script>-->

        <script src="{{ asset('adminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('adminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        
        <script type="text/javascript">
         $(function() {
             $("img.imgthumb").click(function(e) {
                $('#exampleModal').modal('show'); 
                 var newImg = '<img src='
                                + $(this).attr("src") +' ></img>';
                 $('#ladiv')
                    .html($(newImg)
                    // .animate({ height: '500', width: '700' }, 1500));
                    .animate());
             });
         });    
     </script>
    </body>
</html>







