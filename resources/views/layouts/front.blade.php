<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
<!--Header Section Starts-->
<div class="main-div equal-height-col">
    <section class="left-sec column">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" class="img-responsive">
        </div>
        <div class="left-bottom">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Categories</a></li>
                <li><a href="">Competition</a></li>
                <li><a href="">News</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Publish Media</a></li>
                <li><a href="">Apply</a></li>
            </ul>
        </div>
        <div class="fav-sec">
            <p>Find Your Favorite Image, Video, and Other With Devilshunt Gallery.</p>
            <a href="" class="btn red-btn">Explore More</a>
        </div>
        <div class="notify-sec">
            <ul>
                <li><a href="">All Categories <span>17</span></a></li>
                <li><a href="">Dancing Star <span>12</span></a></li>
                <li><a href="">Singing Star <span>5</span></a></li>
            </ul>
        </div>
        <div class="add-sec">
            Add Banner
        </div>
    </section>

    <section class="right-sec column">
        <div class="right-top">
            <div class="right-top-left">
                <div class="menu-icon">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="serach-box">
                    <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search Movie" />
                </div>
            </div>
            <div class="right-top-right">
                <span class="upload">
                    <a href="" class="btn white-btn"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Video</a>
                </span>

                @if(Auth::check()) 
                    <span class="upload">
                        <a href="javascript:void(0);" class="btn white-btn"> {{ Auth::user()->name }} </a>
                    </span>
                    <span class="sign"><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <span class="sign"><a href="/login">Sign In or Sign Up</a></span>
                @endif

            </div>
        </div>
        <div class="right-bottom">
            <!-- Content Start -->
            @yield('content')
            <!--content End -->
        </div>
        <div class="bottom-banner">
            <a href="">
                <img src="{{ asset('images/bottom-banner.jpg') }}" class="img-responsive">
            </a>
        </div>
        <footer>
            <ul class="foot-nav">
                <li><a href="">Publish Media</a></li>                      
                <li><a href="">News</a></li> 
                <li><a href="/about">About Us</a></li> 
                <li><a href="/contact">Contact</a></li> 
            </ul>
            <div class="copy"> &copy; 2015 devilshunt.com. All right reserved.</div>
        </footer>
    </section>   
</div>
    
    
    
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/custom-functions.js') }}"></script>
<script src="{{ asset('js/resumable.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
    

</body>
</html>
