<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Luxmi Infotech') }}</title>

    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/MoneAdmin.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/Font-Awesome/css/font-awesome.css') }}" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="{{ asset('css/admin/layout2.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/flot/examples/examples.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/timeline/timeline.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/style2.css') }}" />
    <!-- END PAGE LEVEL  STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Styles -->
    
</head>
<body class="padTop53">
    <!-- MAIN WRAPPER -->
    <div id="wrap" >
        <!-- HEADER SECTION -->
        <div id="top">
            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="/" class="navbar-brand">
                    
                    <img src="{{ asset('images/admin/logo.png') }}" alt="" />

                        
                        </a>
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                    <!--ADMIN SETTINGS SECTIONS -->
                     @if(Auth::check()) 
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                           <!--  <li><a href="#"><i class="icon-user"></i> User Profile </a>
                            </li>
                            <li><a href="#"><i class="icon-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li> -->
                            <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                    </li>
                    @endif
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>
        <!-- END HEADER SECTION -->
         <!-- MENU SECTION -->
       <div id="left" >
            
            <div class="media user-media well-small">
                @if(Auth::check()) 
                    <a class="user-link" href="#">
                        <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('images/admin/user.gif') }}" />
                    </a>
                    <br />
                    <div class="media-body">
                        <h5 class="media-heading"> DevilsHunt </h5>
                        <ul class="list-unstyled user-info">
                            <li>
                                 <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online
                            </li>
                        </ul>
                    </div>
                    <br />
                @endif
            </div>
            
            @if(Auth::check()) 
            <ul id="menu" class="collapse">
                <li class="panel @if(Request::segment(1) == 'home') active @endif">
                    <a href="/home" >
                        <i class="icon-table"></i> Dashboard
                    </a>                   
                </li>
                <li class="panel @if(Request::segment(1) == 'categories') active @endif ">
                    <a href="/categories" >
                        <i class="icon-user"></i> Categories
                    </a>                   
                </li>
                <li class="panel @if(Request::segment(1) == 'competitions') active @endif ">
                    <a href="/competitions" >
                        <i class="icon-user"></i> Competitions
                    </a>                   
                </li>
            </ul>

            @endif
        </div>
        <!--END MENU SECTION -->
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height: 700px;">
                @yield('content')
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END MAIN WRAPPER -->

    <!-- GLOBAL SCRIPTS -->
    <script src="{{ asset('plugins/jquery-2.0.3.min.js') }}"></script>
     <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>
    <!-- END GLOBAL SCRIPTS -->
    <script src="{{ asset('js/admin/resumable.js') }}"></script>
    <script src="{{ asset('js/admin/main.js') }}"></script>

</body>
</html>
