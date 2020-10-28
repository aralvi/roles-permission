@extends('layouts.admin')
@section('title', 'Add New Permission')

@section('content')
<div class="container-fluid">

    <!-- ROW 1 -->
    <div class="row">
        <div class="col-md-12">
            <h2 style="margin-top:4px;">Add New Permision</h2>
        </div>
    </div>
    <!-- END ROW 1 -->
    <br />
    <div class="card">
        <div class="card-body">
            <form action="{{ url('assign-permissions/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="admin-details">
                    <div class="form-row">

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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="permission">Permission*</label>
                                <select name="permission[]" id="permission" class="form-control searchableSelectBoxMultiple" multiple>
                                    @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>

                                    @endforeach
                                </select>
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



