@extends('layouts.admin')
@section('title', 'List of Users')

@section('content')

<!-- CONTAINER FLUID -->
<div class="container-fluid">
	<!-- ROW 1 -->
    <div class="row">
    	<div class="col-md-6">
	        <h2 style="margin-top:4px;">List of Roles </h2>
	    </div>
	    <div class="col-md-6">


            <a href="{{ url('roles/create') }}" class="btn btn-primary btn-sm" style="float:right;"><i class="fas fa-user-plus"></i> Add Role</a>
	    </div>
    </div>
    <!-- END ROW 1 -->
    <br />
	<div class="card">
		<div class="card-body">
			<div class="table-responsive table-hover usersTableData" id="usersTableData">
		    	<table id="myTable" class="table" style="white-space: nowrap;">
				  	<thead>
				    	<tr>
					      <th scope="col">#</th>
					      <th scope="col">Name</th>
					      <th scope="col">Action</th>
				    	</tr>
				  	</thead>
				  	<tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @role('admin')
                                    <button> <a href="{{ url('roles/edit/'.$role->id) }}"> Edit</a></button>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
				  	</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- END CARD --}}

	<!-- EDIT USER MODAL -->
	<div class="modal fade editUserModal" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUserEdit" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelUserEdit" style="font-size:18px !important;">Edit User</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="requestUserData">

		  </div>
	    </div>
	  </div>
	</div>
	<!-- END EDIT USER MODAL -->

	<!--DELETE USER MODAL -->
	<div class="modal fade deleteUserModal" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelUserDelete" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelUserDelete" style="font-size:18px !important;">Delete Confirmation !</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Are you sure, you want to delete this User?
     	  </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No, Cancel</button>
	        <button type="button" class="btn btn-md btn-primary deleteUserBtn" id="deleteUserBtn">Yes, Delete</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- END DELETE USER MODAL -->
</div>
<!--END CONTAINER FLUID-->

@endsection
