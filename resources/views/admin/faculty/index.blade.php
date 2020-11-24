@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Faculties</h3>
        <p>Here is the listing for the faculties of education you want to list.</p>

        <div class="card">
		  <div class="card-header">
		    <strong>Add New Faculty</strong>
		  </div>
		  <div class="card-body">
		    <form method="post" action="{{ action('Admin\FacultyController@store') }}">
		    	@csrf
		    	<div class="form-group">
		    		<label for="name">Name</label>
		    		<input type="text" name="name" id="name" placeholder="Value" class="form-control">
		    	</div>
		    	<div class="form-group">
		    		<label for="description">Description</label>
		    		<textarea name="description" id="description" placeholder="About this faculty..." class="form-control" rows="3"></textarea>
		    	</div>
		    	<div class="form-group text-right">
		    		<button class="btn btn-success">Add</button>
		    	</div>
		    </form>
		  </div>
		</div>
		<div class="card mt-3">
			<div class="card-header">
				<strong>Available Faculties ({{ $faculties->count() }})</strong>
			</div>
			<div class="card-body">
				@if ($faculties->count() === 0)
				<div class="alert alert-danger">
					You have not added any faculties yet. Please use above form to add one.
				</div>
				@else
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.N</th>
								<th width="100px">Value</th>
								<th>Description</th>
								<th width="170px">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($faculties as $key=>$faculty)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $faculty->name }}</td>
									<td>{{ $faculty->description ?? '-' }}</td>
									<td>
										<form method="POST" action="{{ action('Admin\FacultyController@destroy', $faculty->id) }}">
											@csrf
											@method('DELETE')
											<a href="{{ action('Admin\FacultyController@edit', $faculty->id) }}" class="btn btn-sm btn-success">📝 Edit</a>
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
