@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Colleges</h3>
        <p>Here is the listing for the colleges that you can browse throughout the website.</p>

        <div class="card">
		  <div class="card-header">
		    <strong>Add New College</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\CollegeController@store') }}" enctype="multipart/form-data">
		    	@csrf
		    	<div class="row">
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="name">Name</label>
				    		<input type="text" name="name" id="name" placeholder="Value" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="city">City</label>
				    		<input type="text" name="city" id="city" placeholder="Eg: Kathmandu" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="location">Location</label>
				    		<input type="text" name="location" id="location" placeholder="Eg: Baneshwor" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="phone_number">Phone Number</label>
				    		<input type="text" name="phone_number" id="phone_number" placeholder="Eg: 412001" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="fee_amount">Total Course Fees</label>
				    		<input type="text" name="fee_amount" id="fee_amount" placeholder="Eg: 700000" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="minimim_acceptance_percentage">Minimum Acceptance Percentage</label>
				    		<input type="text" name="minimim_acceptance_percentage" id="minimim_acceptance_percentage" placeholder="Eg: 40" class="form-control">
				    	</div>
		    		</div>	
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="name">Minimum Scholarship Percentage</label>
				    		<input type="text" name="minimum_scholarship_percentage" id="minimum_scholarship_percentage" placeholder="Eg: 40" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="website">Website</label>
				    		<input type="text" name="website" id="website" placeholder="Eg: http://example.com" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="pass_percent">Pass Percent</label>
				    		<input type="text" name="pass_percent" id="pass_percent" placeholder="Eg: 50" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="extra_activities">No Of Extra Curriculum Activities</label>
				    		<input type="text" name="extra_activities" id="extra_activities" placeholder="Eg: 5" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="placements">Avg Placement (Placements/no of batch)</label>
				    		<input type="text" name="placements" id="placements" placeholder="Eg: 500" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="email">E-Mail Address</label>
				    		<input type="text" name="email" id="email" placeholder="Eg: contact@college.com" class="form-control">
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
				    		<label for="level_id">Level</label>
				    		<select class="form-control" name="level_id" id="level_id">
				    			<option disabled="">Select Level</option>
				    			@foreach($levels as $level)
				    				<option value="{{ $level->id }}">{{ $level->name }}</option>
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
				    				<option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
				    			@endforeach
				    		</select>
				    	</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
		    				<label for="logo">Select Logo</label>
		    				<input class="form-control" style="width: 100%" type="file" name="logo" id="logo" placeholder="Select Logo">
		    			</div>
		    		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name="description" id="description" placeholder="About this level..." class="form-control" rows="3"></textarea>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Add</button>
		    	</div>
		    </form>
		  </div>
		</div>
		<div class="card mt-3">
			<div class="card-header">
				<strong>Available Colleges ({{ $colleges->count() }})</strong>
			</div>
			<div class="card-body">
				@if ($colleges->count() === 0)
				<div class="alert alert-danger">
					You have not added any colleges yet. Please use above form to add one.
				</div>
				@else
					<table class="table table-striped table-responsive">
						<thead>
							<tr>
								<th>S.N</th>
								<th>Logo</th>
								<th width="100px">Name</th>
								<th width="100px">Address</th>
								<th width="100px">Website</th>
								<th width="100px">Email</th>
								<th>Description</th>
								<th width="170px">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($colleges as $key=>$college)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>
										<img src="{{ Storage::url($college->logo) }}" style="width: 75px;">
									</td>
									<td>{{ $college->name }}</td>
									<td>{{ $college->location }}</td>
									<td>
										<a href="{{ $college->website }}" target="_new">{{ $college->website }}</a>
									</td>
									<td>{{ $college->email }}</td>
									<td>{{ $college->description ?? '-' }}</td>
									<td>
										<form method="POST" action="{{ action('Admin\CollegeController@destroy', $college->id) }}">
											@csrf
											@method('DELETE')
											<a href="{{ action('Admin\CollegeController@show', $college->id) }}" class="btn btn-sm btn-info">👁‍🗨 Show</a>
											<a href="{{ action('Admin\CollegeController@edit', $college->id) }}" class="btn btn-sm btn-success">📝 Edit</a>
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
