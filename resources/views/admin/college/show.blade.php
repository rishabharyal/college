@extends('layouts.admin')

@section('content')
    <div class="mt-1">
    	<h3 class="text-center mb-3">{{ $college->name }}</h3>
        <div class="card">
		  <div class="card-header">
		    <strong>College Student Verification</strong>
		  </div>
		  <div class="card-body">
		  	@if($college->students()->count())
		  		<table class="table table-striped">
		  			<tr>
		  				<th>S.N</th>
		  				<th>Student Name</th>
		  				<th>Faculty</th>
		  				<th>Document</th>
		  				<th>Is Verified</th>
		  				<th>Actions</th>
		  			</tr>
		  			@foreach($college->students()->get() as $key=>$student)
		  				<tr>
		  					<td>{{ $key+1 }}</td>
		  					<td>{{ $student->name}}</td>
		  					<td>{{ $student->faculty()->first()->name}}</td>
		  					<td>
		  						<a href="{{ Storage::url($student->pivot->verification_document) }}">🔗 Show Document</a>
		  					</td>
		  					<td style="font-weight: bolder">{{ $student->pivot->is_verified ? 'VERIFIED' : 'NOT VERIFIED'}}</td>
		  					<td>
		  						@if ($student->pivot->is_verified)
		  							<a href="/admin/college/{{$college->id}}/remove/student/{{$student->id}}" class="btn btn-danger btn-sm">❌ Remove Student</a>
		  						@else
		  							<a href="/admin/college/{{$college->id}}/reject/student/{{$student->id}}" class="btn btn-primary btn-sm">❌ Remove Request</a>
		  							<a href="/admin/college/{{$college->id}}/accept/student/{{$student->id}}" class="btn btn-success btn-sm">✅ Accept Request</a>
		  						@endif
		  					</td>
		  				</tr>
		  			@endforeach
		  		</table>
		  	@endif
		  </div>
		</div>
		<div class="card mt-1">
		  <div class="card-header">
		    <strong>College Ratings</strong>
		  </div>
		  <div class="card-body">
		  	@if($college->ratings()->count())
		  		<table class="table table-striped">
		  			<tr>
		  				<th>S.N</th>
		  				<th>Student Name</th>
		  				<th>Faculty</th>
		  				<th>Topic</th>
		  				<th>Rating Given</th>
		  			</tr>
		  			@foreach($college->ratings()->get() as $key=>$rating)
		  				<tr>
		  					<td>{{ $key+1 }}</td>
		  					<td>{{ $rating->user->name}}</td>
		  					<td>{{ $rating->user->faculty()->first()->name}}</td>
		  					<td>{{ $rating->topic }}</td>
		  					<td>{{ $rating->rating_given }} of 5</td>
		  				</tr>
		  			@endforeach
		  		</table>
		  	@endif
		  </div>
		</div>
    </div>
@endsection
