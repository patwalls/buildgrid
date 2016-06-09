<div class="wrap-outer" id="nav-desk">
  <div class="container-90">
    <div class="header-outer-wrap">
      <div class="header-item-wrap">
        <a href="{{ url('/') }}"><img src="/images/logo.png" alt=""></a>
      </div>
      <div class="header-item-wrap" id="right-header-wrap">
        <ul id="menu-target">
          <li><a @if( url() == '/') data-scroll @endif href="{{ url('/#nav-desk') }}"><span class="b1">Home</span></a></li>
          <li><a @if( url() == '/') data-scroll @endif href="{{ url('/#about-us') }}"><span class="b1">About Us</span></a></li>
          <li><a @if( url() == '/') data-scroll @endif href="{{ url('/#how-it-works') }}"><span class="b1">How it Works</span></a></li>
          <li><a @if( url() == '/') data-scroll @endif href="{{ url('/#developer-interest') }}"><span class="b1">Developer Interest</span></a></li>
          <li><a @if( url() == '/') data-scroll @endif href="{{ url('/#contact-us') }}"><span class="b1">Contact Us</span></a></li>
          @if (Auth::check())          
            <li><a href="{{ url('/home') }}"><span class="b1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span></a></li>
          @else
            <li><a href="{{ url('/login') }}"><span class="b1">Login</span></a></li>
            <li><a href="{{ url('/signup') }}"><span class="b1 signup">Sign Up</span></a></li>
          @endif
        </ul>
      </div>
      <div id="mobile-nav-icon">
        <a href="#" id="mobile-nav-link"><i class="icon ion-navicon-round"></i></a>
      </div>
    </div>
  </div>
</div>
<div id="mobile-menu-wrap">
  <div class="mobile-menu-inner-wrap">
    <ul id="mobile-menu-list" class="animated ">
      <li><a href="{{ url('/#home') }}"><span class="b1">Home</span></a></li>
      <li><a href="{{ url('/#about-us') }}"><span class="b1">About Us</span></a></li>
      <li><a href="{{ url('/#how-it-works') }}"><span class="b1">How it Works</span></a></li>
      <li><a href="{{ url('/#developer-interest') }}"><span class="b1">Developer Interest</span></a></li>
      <li><a href="{{ url('/#contact-us') }}"><span class="b1">Contact Us</span></a></li>
          @if (Auth::check())
            <li><a href="{{ url('/home') }}"><span class="b1 signup">Account</span></a></li> 
          @else
      <li><a href="{{ url('/login') }}"><span class="b1">Login</span></a></li>
      <li id='signup-mobile-item'><a href="{{ url('/signup') }}"><span class="b1 signup">Sign Up</span></a></li>
          @endif
    </ul>
  </div>
</div>
