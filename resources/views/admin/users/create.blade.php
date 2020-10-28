@extends('layouts.admin')
@section('title', 'Add New User or Customer')

@section('content')
<div class="container-fluid">

    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-12">
            <h2 style="margin-top:4px;">Add New User or Customer</h2>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('users/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-details">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label for="first_name">First Name*</label>
                              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" autocomplete="first_name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label for="last_name">Last Name*</label>
                              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" autocomplete="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label for="email">Email address*</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" autocomplete="email">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                              <label for="password">Password*</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" autocomplete="new-password">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password*</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password" autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="role">Role*</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="" selected="selected" disabled="disabled">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="reset" class="btn btn-secondary btn-md"><i class="fas fa-redo-alt"></i> Reset Form</button>
                <button type="submit" class="btn btn-primary btn-md"><i class="fas fa-check-circle"></i> Save</button>
            </form>
        </div>
      </div>
    </div>
    {{-- END CARD --}}
<!-- END CONTIANER FLUID -->
@endsection

@section('script')
    <script>
        jQuery('.datetimepicker').datetimepicker({
            format: 'Y-m-d',
        });
    </script>
@endsection

