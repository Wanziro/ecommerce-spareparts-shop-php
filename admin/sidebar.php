<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fa fa-store"></i>
    </div>
    <div class="sidebar-brand-text mx-3">AER</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="dashboard.php">
      <i class="fa fa-dashboard"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <li class="nav-item my-0 py-0">
    <a class="nav-link" href="shops.php">
      <i class="fa fa-list-alt"></i>
      <span>Shops</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-bus"></i>
      <span>Manage Vehicles</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="vehicles.php">
          <i class="fa fa-bus"></i>
          <span>Vehicles</span>
        </a>

        <a class="collapse-item" href="v_marks.php">
          <i class="fa fa-fighter-jet"></i>
          <span>Vehicle Marks</span></a>

        <a class="collapse-item" href="v_models.php">
          <i class="fa fa-fighter-jet"></i>
          <span>Vehicle Models</span>
        </a>
        <a class="collapse-item" href="fuels.php">
          <i class="fa fa-fighter-jet"></i>
          <span>Fuels</span>
        </a>
        <a class="collapse-item" href="engines.php">
          <i class="fa fa-fighter-jet"></i>
          <span>Engines</span>
        </a>

      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
      <i class="fa fa-list-alt"></i>
      <span>Reports</span>
    </a>
    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="sold_cars.php">
          <i class="fa fa-list-alt"></i>
          <span>Sold cars</span>
        </a>

        <a class="collapse-item" href="sold_trucks.php">
          <i class="fa fa-list-alt"></i>
          <span>Sold Trucks</span>
        </a>
        <a class="collapse-item" href="sold_cars.php">
          <i class="fa fa-list-alt"></i>
          <span>Sold cars</span>
        </a>
        <a class="collapse-item" href="sold_motor.php">
          <i class="fa fa-list-alt"></i>
          <span>Sold Motorcycle</span>
        </a>
      </div>
    </div>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Spare Parts
  </div>

  <li class="nav-item my-0 py-0">
    <a class="nav-link" href="spare_parts_categories.php">
      <i class="fa fa-list-alt"></i>
      <span>Spare Part Categories</span></a>
  </li>
  <li class="nav-item my-0 py-0">
    <a class="nav-link" href="spare_parts.php">
      <i class="fa fa-cog"></i>
      <span>Spare Parts</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block my-0 py-0">
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-car"></i>
      <span>Car renting</span>
    </a>
    <div id="collapsePages3" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="cars_for_renting.php">
          <span>Cars list</span>
        </a>

        <a class="collapse-item" href="add_car_for_renting.php">
          <span>Add car</span>
        </a>

        <a class="collapse-item" href="booking_info.php">
          <span>Booking info</span>
        </a>

      </div>
    </div>
  </li>
  <hr class="sidebar-divider d-none d-md-block my-0 py-0">
  <li class="nav-item my-0 py-0">
    <a class="nav-link" href="profile.php">
      <i class="fa fa-user"></i>
      <span>Profile</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../logout.php">
      <i class="fa fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>