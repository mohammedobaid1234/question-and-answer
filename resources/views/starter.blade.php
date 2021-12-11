<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{asset("assets/admin/css/style.css")}}>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href={{asset("assets/admin/posts/form/style.css")}}>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="path/to/select2.min.css" rel="stylesheet" />
    <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
    @yield('style')
    @yield('link')
    <title>@yield('title')</title>
</head>
<body>
    <div>
        <!-- start Header -->
        <header>
            <nav class="navbar navbar-light bg-light justify-content-between">
                <div class="container">

                    <a href="{{route('home')}}" class="navbar-brand"><i class="fab fa-stack-overflow" style="color: #f48024;"></i> stack<span style="font-weight: bold;">overflow</span></a>
                    <a href="">About</a>
                    <a href="">Products</a>
                    <a href="">For Teams</a>
                    {{-- <form class="form-inline" action="{{route('main.search')}}" method="POST" style="width: 40%;">
                        @csrf   
                        </i><input class="form-control mr-sm-2 empty" name="name" type="search" placeholder=" &#xf002;  Search" aria-label="Search">
                       <button class="btn btn-primary">Search</button>
                    </form> --}}
                    <form style="margin-bottom: 20px;" action="{{route('main.search')}}" method="GET" class="form-inline my-2 my-lg-0">
                        {{-- @csrf --}}
                        <input class="form-control mr-sm-2" type="search" name="slug" placeholder="Enter part of Question" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    @guest
                    <a  href="{{route('login')}}" class="btn btn-dark" type="submit" style="margin-right: 5px; color:#fff"> Log In</a>
                     <a href="{{route('register')}}" class="btn btn-primary" type="submit">Sign up</a>
                    @endauth
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link class="btn-primary" :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>      
                    @endauth

                    
                </div>
            </nav>
        </header>
        <!-- End Header -->
        <!-- Stat Content -->
        <div class=" main_content">
            <!-- start Aside -->
  
            <div class="aside">
                <ul>
                    
                    <li class="normal1 normal"><a href="{{route('home')}}">Home</a></li>
                    <li class="read">Public</li>
                    <li class="normal1" ><a href="{{route('home')}}" ><i class="fas fa-globe-americas"></i> Question</a></li>
                    <li class="inside normal1"><a href="{{route('tags.index')}}">Tags</a></li>
                    <li class="inside normal1"> <a href="{{route('users.index')}}">Users</a></li>
                    <li class="read">COLLECTIVES <i class="fas fa-info-circle"></i></li>
                    <li class="normal normal1"><a href="" ><i class="fas fa-certificate" style="color: #f48024;"></i> Explore Collectives</a></li>
                    <li class="read">FIND A JOB</li>
                    <li class="inside normal1"><a href="">Jobs</a></li>
                    <li class="inside normal1"><a href="">Companies</a></li>
                    <li class="read">TERMS</li>
                    <li>
                        <div>
                            <p><span style="font-weight: bold;">Stack Overflow for Teams</span> – Collaborate and share knowledge with a private group.</p>
                            <img src="images/teams-illo-free-sidebar-promo.svg" alt="">
                            <button class="btn btn-primary" >Create a free Team </button>
                            <span>what is Team?</span>
                        </div>
                    </li>
                </ul>
            </div>
           <!-- End Aside -->
            
            <!--Start Main  -->
            
            <div class="main container">
                
                <!--Stat Main Header -->
                @yield('header')
                <!--End Main Header -->
                <!--Start Main Body For questions -->
                <div class="wrap-cntaner ">
                    <div class="users">
                        @yield('questions')
                    </div>
                               
                                    
                </div>
                <!--End Main Body For questions -->
             </div>
         
            <!--End Main  -->
            <!--Start Notification -->
            <?php
            // if exssist noNofication that main no nofication in this page
                if(isset($noNotfication)){

                }else{?>
                    <x-notification />
              <?php  }?>
            
            
            <!--End Notification -->
            
            <div class="clearFix"></div>
        </div>
        <!-- End Content -->

        <div class="clearFix"></div>
        <!-- Start Footer -->
        <footer class="page-footer font-small bg-dark" style="color: #fff;">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2021/7/4 Copyright:
            <span style="color: #f48024;"> Mohammed Obaid</span>
            </div>
            <!-- Copyright -->
        
        </footer>
        <!-- Start Footer -->
    </div>
</body>
<script src="js/jquery-3.6.0.min.js"></script>
<!-- <script type="text/javascript" src="js/jquery-2.1.4.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('js/vote.js')}}" ></script>
<script>
    const userId = "{{ Auth::id() }}"
</script>
<script src="{{asset('js/app.js')}}"></script>
@yield('script')
</html>