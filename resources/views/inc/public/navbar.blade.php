  <!-- Preloader -->
  <div class="loader-wrap">
    <div class="preloader"><div class="preloader-close">Preloader Close</div></div>
    <div class="layer layer-one"><span class="overlay"></span></div>
    <div class="layer layer-two"><span class="overlay"></span></div>        
    <div class="layer layer-three"><span class="overlay"></span></div>        
</div>

<header class="main-header">
  <!-- Header Top -->
  <div class="header-top">
    <div class="auto-container">
  <div class="inner">
    <div class="location">
      <p><i class="fas fa-map-marker-alt"></i><span>Main Office</span> {{$address->value??'Opp.to Kumari Cinema Kamal Pokhari Kathmandu'}}</p>
    </div>
      <div class="mail"><a href="mailto:{{$email->value??'info@asp.edu.np'}}"><i class="fa fa-envelope"></i>Official Mail: {{$email->value??'info@asp.edu.np'}}</a></div>
        <div class="social-links clearfix">
          <ul>
            <li><a href="{{$whatsapp->value??''}}"><span class="fab fa-whatsapp"></span></a></li>
            <li><a href="{{$twitter->value??''}}"><span class="fab fa-twitter"></span></a></li>
            <li><a href="{{$facebook->value??''}}"><span class="fab fa-facebook"></span></a></li>
          </ul>
        </div>
      <div class="author"><a href="#"><span class="fa fa-user"></span></a></div>
      </div>
    </div>
  </div>

  <!-- Header Upper -->
  <div class="header-upper">
      <div class="auto-container">
          <div class="top-left">
                  <!--Logo-->
                  <div class="logo-box">
                      <div class="logo"><a href="{{route('home.index')}}"><img src="{{asset('assets/images/logo.png')}}" alt=""></a></div>
                  </div>
              </div>
          <div class="inner-container">
              <!--Nav Box-->
              <div class="nav-outer clearfix">
                  <!--Mobile Navigation Toggler-->
                  <div class="mobile-nav-toggler"><span class="icon fal fa-bars"></span></div>

                  <!-- Main Menu -->
                  <nav class="main-menu navbar-expand-md navbar-light">
                      <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                          <ul class="navigation clearfix">
                            <li><a href="{{route('home.index')}}">Home</a></li>
                            <li><a href="#Courses">Courses</a></li>
                            <li><a href="#Blogs">Blogs</a></li>
                            <li><a href="#Contact">Contact</a></li>
                            <li><a href="{{route('account.index')}}">My Account</a></li>
                          </ul>
                      </div>
                  </nav>
                  <!-- Main Menu End-->
                  
                  <!-- /.main-nav__right -->
                  <div class="main-nav__right">
        
                  <div class="number"><a href="tel:{{$phone->value??''}}"><i class="fas fa-phone"></i>+977 {{$phone->value??''}}</a>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  <!--End Header Upper-->

  <!-- Sticky Header  -->
  <div class="sticky-header">
      <div class="auto-container clearfix">
          <!--Logo-->
          <div class="logo pull-left">
              <a href="{{route('home.index')}}" title=""><img src="{{asset('assets/images/logo.png')}}" alt="" title=""></a>
          </div>
          <!--Right Col-->
          <div class="pull-right">
              <!-- Main Menu -->
              <nav class="main-menu clearfix">
                  <!--Keep This Empty / Menu will come through Javascript-->
              </nav><!-- Main Menu End-->
          </div>
      </div>
  </div><!-- End Sticky Menu -->

  <!-- Mobile Menu  -->
  <div class="mobile-menu">
      <div class="menu-backdrop"></div>
      <div class="close-btn"><span class="icon flaticon-focus"></span></div>
      
      <nav class="menu-box">
          <div class="nav-logo"><a href="{{route('home.index')}}"><img src="{{asset('assets/images/logo.png')}}" alt="" title=""></a></div>
          <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
  <!--Social Links-->
  <div class="social-links">
    <ul class="clearfix">
      <li><a href="{{$twitter->value??''}}"><span class="fab fa-twitter"></span></a></li>
      <li><a href="{{$facebook->value??''}}"><span class="fab fa-facebook-square"></span></a></li>
      <li><a href="{{$facebook->linkedin??''}}"><span class="fab fa-linkedin"></span></a></li>
      <li><a href="{{$instagram->value??''}}"><span class="fab fa-instagram"></span></a></li>
    </ul>
          </div>
      </nav>
  </div><!-- End Mobile Menu -->
</header>