<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('dist/img/adlaw_logo.jpeg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADLAW</span>
    </a>
    @if (Auth::check()) 
      @if (Auth::user()->user_type_id == 'X') 
          <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @if(!empty($userProfile->photo_path))
          <div class="image">
            <img src="{{  url('public/profile-image/'.$userProfile->photo_path) }}" class="img-circle elevation-2" width="200px" height="400px">
          </div>
          @else
          <div class="image">
            <img src="{{ asset('lawyer/img/2801143.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          @endif
          <div class="info">
          @if (!empty($userProfile->firstname) && !empty($userProfile->middlename) && !empty($userProfile->lastname))
            <a href="#" class="d-block">
            {{ $userProfile->firstname}}&nbsp {{ $userProfile->middlename ?? null}}&nbsp{{ $userProfile->lastname ?? null}}
            </a>
            @else
            <a href="#" class="d-block">{{ Auth::user()->user_name }}</a>
            @endif
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Admin Dashboard
                  <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                  Countries
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.countries') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Counties</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>
                  States
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.states') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>States</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-city"></i>
                <p>
                  Cities
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.cities') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cities</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-laptop"></i>
                <p>
                  Specialization
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.spcl') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Specializations</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Education categories
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.educatg') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>categories</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                  Educations
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.qual') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edgucations</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
                <p>
                  Packages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.package') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Packages</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    @else
          <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @if(!empty($userProfile->photo_path))
        <div class="image">
          <img src="{{  url('public/profile-image/'.$userProfile->photo_path) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        @else
        <div class="image">
          <img src="{{ asset('lawyer/img/2801143.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        @endif
        <div class="info">
        @if (!empty($userProfile->firstname) && !empty($userProfile->middlename) && !empty($userProfile->lastname))
          <a href="#" class="d-block">{{ $userProfile->firstname}}&nbsp {{ $userProfile->middlename ?? null}}&nbsp{{ $userProfile->lastname ?? null}}</a>
          @else
          <a href="#" class="d-block">{{ Auth::user()->user_name }}</a>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('basicinfo') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Basic Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('specialization') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Specialization Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('qualification') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Education</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('prectecing.court') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Practicing Courts</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
      @endif
    @endif
   
  </aside>