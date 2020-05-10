<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css?2') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/fc7fae72fc.js"></script>

    @yield('header')


<style>

    /*
    * Sidebar
    */
    .sidebar {
        min-height: 100vh;
        min-width: 260px;
        max-width: 260px;
        background-color: #66615b;
        transition: all 0.3s;
    }

    .sidebar.active {
        margin-left: -260px;
    }

    .sidebar .logo {
        position: relative;
        padding: 7px .7rem;
        z-index: 4;
        font-size: 24px;
        
    }

    .sidebar .simple-text {
        color: #fff;
        line-height: 40px;
    }

    .wrapper {
        align-items: stretch;
        display: flex;
    }

    .sidebar .nav {
        display: block;
    }

    .sidebar .nav li {
        display: list-item;
    }

    .sidebar li>a {
        display: list-item;
        color: #fff;
        margin: 0px;
        font-size: 16px;
        padding: 10px 23px;
        line-height: 20px;
        
    }

    .subnav li>a {
        display: list-item;
        color: #fff;
        margin: 0px;
        font-size: 14px;
        padding: 10px 23px;
        line-height: 30px;
        padding-left: 60px;
    }

    a.active, li.active {
        background-color: green; 
        color: 
    }

    .sidebar .nav .icon {
        margin-right: 12px;
        font-size: 25px;
        width: 34px;
        text-align: center;
        color: hsla(0,0%,100%,.5);
    }

    .sidebar .nav .photo {
        margin-right: 12px;
        font-size: 25px;
        width: 34px;
        text-align: center;
    }

    /*
    * Sidebar -> Navbar
    */
    .navbar-divider {
        background-color: hsla(0, 0%, 71%, .2);
        border:solid;
        border-width: thin 1px 1px 1px;
        border-color: hsla(0, 0%, 71%, .2);
        width: 70%;
        margin: auto;
    }

    .navbar {
        position: relative;
        display: flex;
        justify-content: space-between;
        width: 100%;
        z-index: 1029;

        border-bottom:1px solid #ddd;
        min-height: 53px;
    }

    .navbar-toggle-icon {
        font-size: 25px;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display:block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    /*
    * Main Panel
    */

    .main-panel {
        width: 100%;
        background-color: #f4f3ef;
    }

    .main-panel>.content {
        padding: 0 30px 30px;
        min-height: calc(100vh -160px);
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -260px;
        }
        #sidebar.active {
            margin-left: 0;
        }
    }

    a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
    }

    #sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
    }
}


</style>
</head>
<body>
    <div id="app" class="wrapper"> 

        <!-- Sidebar Start -->
        <div id="sidebar" class="sidebar">
            <div class="logo mt-2">
                <div class="simple-text text-center">
                    Church in Auckland
                </div>
            </div>
            <hr class="navbar-divider my-2"/>

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="profile"> <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                        <svg class="bi bi-people-circle photo" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                        <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                        </svg>My User Profile</a>
                        <ul class="collapse list-unstyled subnav show" id="profileSubmenu">
                            <li class="profile my-profile">
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
                            </li>
                        </ul> 
                    </li>

                    <hr class="navbar-divider my-2"/>

                    <li class="dashboard"> <a href="#"><svg class="bi bi-house-door icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 01.708 0l6 6a.5.5 0 01.146.354v7a.5.5 0 01-.5.5H9.5a.5.5 0 01-.5-.5v-4H7v4a.5.5 0 01-.5.5H2a.5.5 0 01-.5-.5v-7a.5.5 0 01.146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 01.5-.5h3a.5.5 0 01.5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 01.5-.5h1a.5.5 0 01.5.5z" clip-rule="evenodd"/>
                        </svg>Dashboard</a> 
                    </li>
                    @can('show_people')
                    <li> 
                        <a href="#peopleSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle people">
                            <svg class="bi bi-people icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.995-.944v-.002.002zM7.022 13h7.956a.274.274 0 00.014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 00.022.004zm7.973.056v-.002.002zM11 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zM6.936 9.28a5.88 5.88 0 00-1.23-.247A7.35 7.35 0 005 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 015 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 116 0 3 3 0 01-6 0zm3-2a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"/>
                        </svg>People</a>
                        <ul class="collapse list-unstyled subnav show" id="peopleSubmenu">
                            @can('create_people')
                            <li class="people create">
                                <a href="{{route('people.create')}}">Add Person</a>
                            </li>
                            @endcan
                            <li class="people index"> 
                                <a href="{{route('people.index')}}">View people</a>
                            </li>
                        </ul> 
                    </li>
                    @endcan
                    @can('show_events')
                    <li> 
                        <a href="#eventSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle events">
                        <svg class="bi bi-calendar icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14 0H2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M6.5 7a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>Events</a> 
                        <ul class="collapse list-unstyled subnav show" id="eventSubmenu">
                            @can('create_events')
                            <li class="events create">
                                <a href="{{route('events.create')}}">Add Event</a>
                            </li>
                            @endcan
                            <li class="events index">
                                <a href="{{route('events.index')}}">View Events</a>
                            </li>
                        </ul> 
                    </li>
                    @endcan
                    @can('show_users')
                    <li> 
                        <a href="{{route('users.index')}}"  aria-expanded="false" class="users">
                        <svg class="bi bi-calendar icon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14 0H2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M6.5 7a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm-9 3a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2zm3 0a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                        </svg>Manage Users</a> 
                    </li>
                    @endcan
                    <li><hr/></li>
                </ul>
            </div>
        </div>
        <!-- Main Panel Start -->
        <div class="main-panel">

            <!--  Navbar Start -->
            <div class="navbar fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" id="sidebarCollapse" class="btn navbar-toggle-icon">
                            <svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                            </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  Content Start -->
            <div class="content">
            
            @yield('content')

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?1') }}"></script>

    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            var selector1 = "";
            if(location.href.includes("people")){
                selector1 = ".people";
            }
            if(location.href.includes("events")){
                selector1 = ".events";
            }
            $('a'+selector1).toggleClass("active");

            var selector2 = ""
            if(location.href.includes("create")){
                selector2 = ".create";
            } else {
                selector2 = ".index";
            }

            $('li'+selector1+selector2).toggleClass("active");
            

        });
    </script>

@yield('footer')

</body>
</html>
