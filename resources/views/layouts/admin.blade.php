<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('admin/fonts/feather/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/DataTables/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/libs/DataTables/css/rowReorder.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/libs/select2/dist/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/libs/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/datetimepicker-master/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/datepicker-bootstrap/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/theme.min.css') }}" id="stylesheetLight">

    @yield('style')
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" media="all">

    <script>
        var token = '{{ csrf_token() }}';
        var url = '{{ url('/') }}';
    </script>

</head>
<body>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" id="sidebar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="{{url('/admin/dashboard')}}">
            <strong>Shop Panel</strong>
        </a>
        <div class="navbar-user d-md-none">
            <div class="dropdown">

            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <ul class="navbar-nav">



                <li class="nav-item {{request()->is('users') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('users')}}">
                        <i class="fe fe-users"></i> Users
                    </a>
                </li>
                @role('admin')
                <li class="nav-item {{request()->is('roles') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('roles')}}">
                        <i class="fe fe-roles"></i> Roles
                    </a>
                </li>
                <li class="nav-item {{request()->is('permissions') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('permissions')}}">
                        <i class="fe fe-permissions"></i> Permissions
                    </a>
                </li>
                <li class="nav-item {{request()->is('assign-permissions') ? 'active' : ''}}">
                    <a class="nav-link" href="{{url('assign-permissions')}}">
                        <i class="fe fe-permissions"></i>Assign Permissions
                    </a>
                </li>
@endrole
            </ul>
            <hr>
            <ul class="navbar-nav">
                <li class="nav-item {{ request()->is('/profile') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/profile')}}">
                        <i class="fe fe-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item {{ request()->is('/password') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/password')}}">
                        <i class="fe fe-edit"></i> Change Password
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fe fe-logout"></i> Logout
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<nav class="navbar navbar-vertical navbar-vertical-sm fixed-left navbar-expand-md " id="sidebarSmall" style="display: none"></nav>

    <div class="main-content">
        <nav class="navbar navbar-expand-md navbar-light d-none d-md-flex" id="topbar">
            <div class="container-fluid">
            <a href="{{ url('/') }}" target="_self" style="width: 120px; padding: 5px; text-align: center; background: #000; color: #fff; font-weight: bold; border-radius: 10px;">Go to Site</a>

                <!-- Form -->
                <form class="form-inline mr-4 d-none d-md-flex"></form>

                <!-- User -->
                <div class="navbar-user">
                    <div class="dropdown">

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </nav>

        <br>
        <div id="success_errror_any">
            @if (session('success'))
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ session('success') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ session('error') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="container-fluid">
                    <div class="alert alert-danger alert-block" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-block hide" id="messageDiv" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong id="message"></strong>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        <br>
        <br>
        <br>

    </div>
    {{-- END MAIN CONTENT --}}

    <script src="{{ asset('admin/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/libs/DataTables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/libs/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/libs/DataTables/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('admin/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/libs/summernote/summernote-lite.js') }}"></script>
    <script src="{{ asset('admin/js/theme.min.js')}}"></script>
    <script src="{{ asset('admin/js/custom.js')}}"></script>
    <script src="{{asset('admin/libs/datetimepicker-master/build/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('admin/libs/datepicker-bootstrap/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/libs/dropzone/dropzone.js')}}"></script>

    <script type="text/javascript">
        $(document).ready( function () {
          $('.searchableSelectBox').select2();
          $('.searchableSelectBoxMultiple').select2();
        });
        $('#summernote').summernote({
          placeholder: 'Enter Page Content Here...',
          tabsize: 2,
          height: 100
        });
    </script>

    @yield('script')

</body>
</html>
