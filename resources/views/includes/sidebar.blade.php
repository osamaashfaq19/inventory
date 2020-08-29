<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Inventory" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ session('fullname') }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link <?= (Request::segment(1) == 'dashboard' ? 'active' : '') ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  
		   <li class="nav-item">
            <a href="{{ url('stores') }}" class="nav-link <?= (Request::segment(1) == 'stores' ? 'active' : '') ?>">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>
			      	Stores
              </p>
            </a>
          </li>
		  
          <li class="nav-item">
            <a href="{{ url('products') }}" class="nav-link <?= (Request::segment(1) == 'products' ? 'active' : '') ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
				      Products
              </p>
            </a>
          </li>
		  
		  <li class="nav-item" style='display:none;'>
            <a href="{{ url('stock-management') }}" class="nav-link ">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
				Stock In
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="{{ url('orders') }}" class="nav-link <?= (Request::segment(1) == 'orders' ? 'active' : '') ?>">
              <i class="nav-icon fas fa-pencil-alt"></i>
              <p>
				Book Order
              </p>
            </a>
          </li>
		  
		  <li class="nav-item" style='display:none;'>
            <a href="{{ url('reports') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
				Reports
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="{{ url('users') }}" class="nav-link <?= (Request::segment(1) == 'users' ? 'active' : '') ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
				User Management
              </p>
            </a>
          </li>
		  
		  <li class="nav-item">
            <a href="{{ url('dashboard/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
				Signout
              </p>
            </a>
          </li>
		  
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>