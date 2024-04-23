<nav class="sidebar">
    <div class="sidebar-header">
      <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="" style="width:60px !important;">
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item nav-category">Organization</li>
        @can('viewAny',\App\Models\Department::class)
            <li class="nav-item">
                <a href="{{ route('department.index') }}" class="nav-link">
                <i class="link-icon" data-feather="tag"></i>
                <span class="link-title">Department</span>
                </a>
            </li>
        @endcan
        @can('viewAny',\App\Models\Designation::class)
            <li class="nav-item">
                <a href="{{ route('designation.index') }}" class="nav-link">
                <i class="link-icon" data-feather="pocket"></i>
                <span class="link-title">Designation</span>
                </a>
            </li>
        @endcan
        <li class="nav-item nav-category">Leave</li>
        @can('viewAny', \App\Models\Holidays::class)
        <li class="nav-item">
            <a href="{{ route('holiday.index') }}" class="nav-link">
            <i class="link-icon" data-feather="archive"></i>
            <span class="link-title">Holiday</span>
            </a>
        </li>
        @endcan
        @can('viewAny', \App\Models\LeaveType::class)
        <li class="nav-item">
            <a href="{{ route('leavetype.index') }}" class="nav-link">
            <i class="link-icon" data-feather="bookmark"></i>
            <span class="link-title">Leave Type</span>
            </a>
        </li>
        @endcan
        @can('viewAny', \App\Models\LeaveApplication::class)
        <li class="nav-item">
            <a href="{{ route('leaveapplication.index') }}" class="nav-link">
            <i class="link-icon" data-feather="file-plus"></i>
            <span class="link-title">Leave Application</span>
            </a>
        </li>
        @endcan
        <li class="nav-item nav-category">Employees</li>
        @can('viewAny',\App\Models\User::class)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Manage Employees</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                <ul class="nav sub-menu">
                    @can('viewAny',\App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('employees.index') }}" class="nav-link">Employees</a>
                        </li>
                    @endcan
                    @can('viewAny',\App\Models\UserType::class)
                        <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link">{{ trans('general.permissions') }}</a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
      </ul>
    </div>
</nav>
