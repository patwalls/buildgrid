<div class="wrap-outer" id="nav-desk">
  <div class="container-90">
    <div class="header-outer-wrap">
      <div class="header-item-wrap">
        <img src="/images/logo.png" alt="">
      </div>
      <div class="header-item-wrap" id="right-header-wrap">
        <ul id="menu-target">
          <li><a data-scroll href="#nav-desk"><span class="b1">Home</span></a></li>
          <li><a data-scroll href="#about-us"><span class="b1">About Us</span></a></li>
          <li><a data-scroll href="#how-it-works"><span class="b1">How it Works</span></a></li>
          <li><a data-scroll href="#developer-interest"><span class="b1">Developer Interest</span></a></li>
          <li><a data-scroll href="#contact-us"><span class="b1">Contact Us</span></a></li>
          @if (Auth::check())          
            <li><a href="/home"><span class="b1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span></a></li>
          @else
            <li><a href="/login"><span class="b1">Login</span></a></li>
            <li><a href="/signup"><span class="b1 signup">Sign Up</span></a></li>
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
      <li><a href="#home"><span class="b1">Home</span></a></li>
      <li><a href="#about-us"><span class="b1">About Us</span></a></li>
      <li><a href="#how-it-works"><span class="b1">How it Works</span></a></li>
      <li><a href="#developer-interest"><span class="b1">Developer Interest</span></a></li>
      <li><a href="#contact-us"><span class="b1">Contact Us</span></a></li>
          @if (Auth::check())
            <li><a href="/home"><span class="b1 signup">Account</span></a></li> 
          @else
      <li><a href="/login"><span class="b1">Login</span></a></li>
      <li id='signup-mobile-item'><a href="/signup"><span class="b1 signup">Sign Up</span></a></li>
          @endif
    </ul>
  </div>
</div>
