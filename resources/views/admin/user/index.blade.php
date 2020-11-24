@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Users</h3>
        <p>Here is the listing for the users you want to list.</p>

        <div class="card">
		  <div class="card-header">
		    <strong>Add New User</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\UserController@store') }}">
		    	@csrf
		    	<div class="form-group">
		    		<label for="name">Name</label>
		    		<input type="text" name="name" id="name" placeholder="Value" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="email">Email</label>
		    		<input type="email" name="email" id="meail" placeholder="someone@example.com" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="name">Password</label>
		    		<input type="password" name="password" id="password" placeholder="password" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="is_admin">User Type</label>
		    		<select name="is_admin" id="is_admin" class="form-control">
		    			<option value="0">Standard</option>
		    			<option value="1">Admin</option>
		    		</select>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Add</button>
		    	</div>
		    </form>
		  </div>
		</div>
		<div class="card mt-3">
			<div class="card-header">
				<strong>Available Users ({{ $users->count() }})</strong>
			</div>
			<div class="card-body">
				@if ($users->count() === 0)
				<div class="alert alert-danger">
					You have not added any users yet. Please use above form to add one.
				</div>
				@else
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.N</th>
								<th width="100px">Name</th>
								<th>E-Mail Address</th>
								<th>Type</th>
								<th width="170px">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $key=>$user)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->is_admin ? 'Admin' :  'Standard User' }}</td>
									<td>
										<form method="POST" action="{{ action('Admin\UserController@destroy', $user->id) }}">
											@csrf
											@method('DELETE')
											<a href="{{ action('Admin\UserController@edit', $user->id) }}" class="btn btn-sm btn-success">📝 Edit</a>
											<button class="btn btn-sm btn-danger">🗑 Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>
    </div>
@endsection
