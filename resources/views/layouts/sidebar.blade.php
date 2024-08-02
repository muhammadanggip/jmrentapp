<style>
  .sidebar-wrapper .sidebar-header .logo-img {
    width: 179px;
  }
</style>
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div class="logo-icon">
      <img src="{{ URL::asset('build/images/logo-icon.png') }}" class="logo-img" alt="">
    </div>
    <div class="sidebar-close">
      <span class="material-icons-outlined">close</span>
    </div>
  </div>
  <div class="sidebar-nav">
    <ul class="metismenu" id="sidenav">
      @if(Auth::user()->role == 'admin')
      <li class="menu-label">Master Data</li>
      <li>
        <a href="{{ url('/') }}">
          <div class="parent-icon"><i class="material-icons-outlined">home</i>
          </div>
          <div class="menu-title">Dashboard</div>
        </a>
      </li>
      <li>
        <a href="{{ url('/users') }}">
          <div class="parent-icon"><i class="material-icons-outlined">person</i>
          </div>
          <div class="menu-title">Master Pengguna</div>
        </a>
      </li>
      <li>
        <a href="{{ url('/cars') }}">
          <div class="parent-icon"><i class="material-icons-outlined">directions_car</i>
          </div>
          <div class="menu-title">Master Mobil</div>
        </a>
      </li>
      <li class="menu-label">Transaksi</li>
      <li>
        <a href="{{ url('/transaction-logs') }}">
          <div class="parent-icon"><i class="material-icons-outlined">swap_horiz</i>
          </div>
          <div class="menu-title">Transaksi Rental</div>
        </a>
      </li>
      @endif
      @if(Auth::user()->role == 'user')
      <li class="menu-label">Menu</li>
      <li>
        <a href="{{ url('/') }}">
          <div class="parent-icon"><i class="material-icons-outlined">home</i>
          </div>
          <div class="menu-title">Dashboard</div>
        </a>
      </li>
      <li>
        <a href="{{ url('/rentals') }}">
          <div class="parent-icon"><i class="material-icons-outlined">time_to_leave</i>
          </div>
          <div class="menu-title">Rental Mobil</div>
        </a>
      </li>
      @endif
  </div>
</aside>