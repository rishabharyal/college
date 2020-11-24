@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Affilications</h3>
        <div class="card">
		  <div class="card-header">
		    <strong>Edit Affilication: {{ $affiliation->name }}</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\AffiliationController@update', $affiliation->id) }}">
		    	@csrf
		    	@method('PUT')
		    	<div class="form-group">
		    		<label for="name">Name</label>
		    		<input type="text" name="name" id="name" placeholder="Value" class="form-control" value="{{ $affiliation->name }}">
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name="description" id="description" placeholder="About this affilication..." class="form-control" rows="3">{{ $affiliation->description }}</textarea>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Update</button>
		    	</div>
		    </form>
		  </div>
		</div>
    </div>
@endsection
