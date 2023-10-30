<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user" style="font-size: 1.4rem;"></i>
          @if (!empty($userProfile) && count($userProfile) > 0)
          {{ $userProfile[0]->firstname}}&nbsp {{ $userProfile[0]->middlename ?? null}}&nbsp{{ $userProfile[0]->lastname ?? null}}
          @else
          {{ Auth::user()->user_name }}
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <div class="dropdown-divider"></div>
          <a href="{{ route('profile') }}" class="dropdown-item dropdown-footer">Profile</a>
          <div class="dropdown-divider"></div>
          
          <a href="{{ route('logout') }}" >
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item dropdown-footer" href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('LogOut') }}
                     </a>
                </form>
                </a>
        </div>
      </li>
    </ul>
  </nav>