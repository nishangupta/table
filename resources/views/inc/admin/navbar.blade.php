<nav class="main-header text-sm navbar navbar-expand navbar-info navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('admin.index')}}" class="nav-link">Dashboard</a>
    </li>
  </ul>

  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" placeholder="Search" aria-label="Search" autocomplete="false">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form>

  <ul class="navbar-nav ml-auto">
    
    <li class="nav-item" >
        <a  href="#" data-toggle="modal" data-target="#logoutModal" title="Logout" class="nav-link"><i class="fas fa-power-off"></i></a>
    </li>

  </ul>
</nav>