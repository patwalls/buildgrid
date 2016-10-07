<div class="new-login-outer-wrap" style="display:none;">
  <div class="new-login-wrap">
    <div class="new-login-header-wrap">
      <img src="{{ url('images/bg_door_logo.png') }}" alt="">
      <i class="icon ion-close-round" onClick="$('.new-login-outer-wrap').fadeOut();"></i>
    </div>
    <div class="new-login-content-wrap">
      @include('partials.easy-as-first-login')
      <div class="getting-started-btn-wrap">
        <a href="#" class="btn-green btn" onClick="$('.new-login-outer-wrap').fadeOut();">Get Started</a>
      </div>
    </div>
  </div>
</div>
