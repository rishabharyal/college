@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-4 offset-4">
			<h2 class="text-center">
				{{ $user->name }}
			</h2>
			<p class="text-center">
				<div class="card card-success">
					<div class="card-header">
						<h3>Edit profile</h3>
					</div>
					<div class="card-body">
						<form method="post" action="/me" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" value="{{$user->name}}" class="form-control">
							</div>
							<div class="form-group">
								<label for="email">E-Mail Address</label>
								<input type="email" name="email" value="{{$user->email}}" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password (leave empty if you don't want to change)</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="college">College</label>
								<select name="college_id" id="college_id" class="form-control">
									<option value="0">Select College</option>
									@foreach($colleges as $college)
										<option {{ ($user->college()->first() && $user->college()->first()->id == $college->id) ? 'selected' : ''}} value="{{ $college->id }}">{{$college->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="faculty">Faculty</label>
								<select name="faculty_id" id="faculty_id" class="form-control">
									<option value="0">Select faculty</option>
									@foreach($faculties as $faculty)
										<option {{ ($user->faculty()->first() && $user->faculty()->first()->id == $faculty->id) ? 'selected' : ''}} value="{{ $faculty->id }}">{{$faculty->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="attachment">Document (photo or file that proves you studied this)</label>
								<input type="file" name="attachment" id="attachment" class="form-control">
							</div>
							<div class="form-group">
								<label>Verification Status: 
									@if ($user->membership)
										@if ($user->membership->is_verified) <strong class="text-success">Verified</strong> @else <strong class="text-danger">Not Verified Yet!</strong> @endif
									@else
										<strong class="text-info">Not Applied yet!</strong>
									@endif 
								</label>
							</div>
							<div class="form-group">
								<button class="btn btn-info btn-block">Save</button>
							</div>
						</form>
					</div>
				</div>
			</p>
		</div>
	</div>
@endsection
