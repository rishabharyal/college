@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Edit College: {{ $college->name }}</h3>
        <p>Please edit your college information, change logo, etc.</p>

        <div class="card">
		  <div class="card-header">
		    <strong>Edit College</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\CollegeController@update', $college->id) }}" enctype="multipart/form-data">
		    	@csrf
		    	@method('PUT')
		    	<div class="row">
		    		<div class="col-6">
		    			<div class="form-group">
			    		<label for="name">Name</label>
			    		<input value="{{ $college->name }}" type="text" name="name" id="name" placeholder="Value" class="form-control">
			    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="name">Location</label>
				    		<input value="{{ $college->location }}" type="text" name="location" id="location" placeholder="Eg: Baneshwor" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="phone_number">Phone Number</label>
				    		<input value="{{ $college->phone_number }}" type="text" name="phone_number" id="phone_number" placeholder="Eg: 412001" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="fee_amount">Total Course Fees</label>
				    		<input value="{{ $college->fee_amount }}" type="text" name="fee_amount" id="fee_amount" placeholder="Eg: 700000" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="minimim_acceptance_percentage">Minimum Acceptance Percentage</label>
				    		<input value="{{ $college->minimim_acceptance_percentage }}" type="text" name="minimim_acceptance_percentage" id="minimim_acceptance_percentage" placeholder="Eg: 40" class="form-control">
				    	</div>
		    		</div>	
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="name">Minimum Scholarship Percentage</label>
				    		<input value="{{ $college->minimum_scholarship_percentage }}" type="text" name="minimum_scholarship_percentage" id="minimum_scholarship_percentage" placeholder="Eg: 40" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="website">Website</label>
				    		<input value="{{ $college->website }}" type="text" name="website" id="website" placeholder="Eg: http://example.com" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="pass_percent">Pass Percent</label>
				    		<input value="{{$college->pass_percent}}" type="text" name="pass_percent" id="pass_percent" placeholder="Eg: 50" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="extra_activities">No Of Extra Curriculum Activities</label>
				    		<input value="{{$college->extra_activities}}" type="text" name="extra_activities" id="extra_activities" placeholder="Eg: 5" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="placements">Avg Placement (Placements/no of batch)</label>
				    		<input value="{{$college->placements}}" type="text" name="placements" id="placements" placeholder="Eg: 500" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="email">E-Mail Address</label>
				    		<input value="{{ $college->email }}" type="text" name="email" id="email" placeholder="Eg: contact@college.com" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="level_id">Level</label>
				    		<select class="form-control" name="level_id" id="level_id">
				    			<option disabled="">Select Level</option>
				    			@foreach($levels as $level)
				    				<option {{ $level->id == $college->level_id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->name }}</option>
				    			@endforeach
				    		</select>
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="faculty_id">Faculty</label>
				    		<select class="form-control" name="faculty_id" id="faculty_id">
				    			<option disabled="">Select Faculty</option>
				    			@foreach($faculties as $faculty)
				    				<option {{ $faculty->id == $college->faculty_id ? 'selected' : '' }} value="{{ $faculty->id }}">{{ $faculty->name }}</option>
				    			@endforeach
				    		</select>
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
		    				<label for="logo">Select Logo</label>
		    				<input class="form-control" type="file" name="logo" id="logo" placeholder="Select Logo">
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name="description" id="description" placeholder="About this level..." class="form-control" rows="3">{{$college->description}}</textarea>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Add</button>
		    	</div>
		    </form>
		  </div>
		</div>
    </div>
@endsection
