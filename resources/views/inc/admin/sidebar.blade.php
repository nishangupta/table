<aside class="main-sidebar sidebar-dark-info elevation-4" >
  <a href="{{route('admin.index')}}" class="brand-link bg-info" >
    <img src="{{asset($LOGO->value??'img/AdminLTELogo.png')}}"
    alt="" class="brand-image img-circle elevation-3"
      style="opacity: 1">
    <span class="brand-text font-weight-light">{{$NAME->value??'Management'}}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="https://ui-avatars.com/api?name=Admin}}"
          class="img-circle elevation-2" alt="">
      </div>
      <div class="info">
        <a href="{{route('account.index')}}" class="d-block">Admin</a>
      </div>
    </div>
    
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-flat flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('admin.index')}}" class="nav-link {{request()->segment(2) == ''?'active':''}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview {{request()->segment(2) == 'table'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-door-open"></i>
            <p>
              Table
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('tableType.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Table types</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('table.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('table.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{request()->segment(2) == 'reservation'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-tags"></i>
            <p>
              Reservations
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('reservation.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('reservation.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        {{-- <li class="nav-item has-treeview {{request()->segment(2) == 'sale'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-users"></i>
            <p>
              Guest
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('sale.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('sale.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li> --}}

        {{-- <li class="nav-item has-treeview {{request()->segment(2) == 'purchase'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-user-edit"></i>
            <p>
              Staffs
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('purchase.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('purchase.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li> --}}
        
        <li class="nav-item has-treeview {{request()->segment(2) == 'menu'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-bars"></i>
            <p>
              Menus
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('menu.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('menu.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{request()->segment(2) == 'food'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-utensils"></i>
            <p>
              Foods
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('food.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('food.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>
{{--         

        <li class="nav-item has-treeview {{request()->segment(2) == 'feedback'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-comment-alt"></i>
            <p>
              Feedbacks
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('feedback.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li> --}}
{{-- 
        <li class="nav-item has-treeview {{request()->segment(2) == 'income'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-credit-card"></i>
            <p>
              Incomes
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('income.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage</p>
              </a>
            </li>
          </ul>
        </li>
         --}}
        {{-- <li class="nav-item has-treeview {{request()->segment(2) == 'setting'?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('setting.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Setting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('setting.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Setting</p>
              </a>
            </li>
          </ul>
        </li> 

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fas fa-user-shield"></i>
            <p>
              Account Information
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @role('admin')
            <li class="nav-item">
              <a href="{{route('usermanagement.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User Management</p>
              </a>
            </li>
            @endrole
            <li class="nav-item">
              <a href="{{route('admin-password.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li> --}}

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>