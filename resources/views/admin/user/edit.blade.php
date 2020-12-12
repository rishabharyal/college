@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Users</h3>
        <div class="card">
		  <div class="card-header">
		    <strong>Edit User: {{ $user->name }}</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\UserController@update', $user->id) }}">
		    	@csrf
		    	@method('PUT')
		    	<div class="form-group">
		    		<label for="name">Name</label>
		    		<input value="{{ $user->name }}" type="text" name="name" id="name" placeholder="Value" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="email">Email</label>
		    		<input value="{{ $user->email }}" type="email" name="email" id="meail" placeholder="someone@example.com" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="name">Password</label>
		    		<input type="password" name="password" id="password" placeholder="password" class="form-control">
		    	</div>
		    	@if(Auth::user()->is_admin === 2)
		    		<div class="form-group">
			    		<label for="is_admin">User Type</label>
			    		<select name="is_admin" id="is_admin" class="form-control">
			    			<option {{ !$user->is_admin ? 'selected' : ''}} value="0">Standard</option>
			    			<option {{ $user->is_admin == 1 ? 'selected' : ''}} value="1">College (Admin)</option>
			    			<option {{ $user->is_admin == 2 ? 'selected' : ''}} value="2">Super Admin</option>
			    		</select>
			    	</div>
		    	@else
		    		<input type="hidden" name="is_admin" value="1">
		    	@endif
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Update User</button>
		    	</div>
		    </form>
		  </div>
		</div>
    </div>
@endsection
