@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Levels</h3>
        <div class="card">
		  <div class="card-header">
		    <strong>Edit Level: {{ $level->name }}</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\LevelController@update', $level->id) }}">
		    	@csrf
		    	@method('PUT')
		    	<div class="form-group">
		    		<label for="name">Name</label>
		    		<input type="text" name="name" id="name" placeholder="Value" class="form-control" value="{{ $level->name }}">
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name="description" id="description" placeholder="About this level..." class="form-control" rows="3">{{ $level->description }}</textarea>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Update</button>
		    	</div>
		    </form>
		  </div>
		</div>
    </div>
@endsection
