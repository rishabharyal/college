@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="offset-2 col-md-8">
            @guest
	            <div class="alert alert-info text-center">
	            	<h2>Please register to view the college search form.</h2>
	            	<br>
	            	<h5>You need to login to search college by faculty, level, affiliation, price range or marks for acceptance and scholarship. 
	            		<br>Please
	            		<a href="/login">login</a> or <a href="/register">register</a> to continue.
	            	</h5>
	            </div>
            @else
	            <div class="card">
	                <div class="card-header">
	                    <strong>Search</strong>
	                </div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-2 form-group">
	                            <label for="faculty">Faculty</label>
	                            <select class="form-control" name="faculty" id="faculty">
	                                <option>Select Faculty</option>
	                                @foreach($faculties as $faculty)
	                                	<option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
	                                @endforeach
	                            </select>
	                        </div>
	                        <div class="col-2 form-group">
	                            <label for="affiliation">Affilication</label>
	                            <select class="form-control" name="affiliation" id="affiliation">
	                                <option>Select Affilication</option>
	                                @foreach($affiliations as $affiliation)
	                                	<option value="{{ $affiliation->id }}">{{ $affiliation->name }}</option>
	                                @endforeach
	                            </select>
	                        </div>
	                        <div class="col-2 form-group">
	                            <label for="level">Level</label>
	                            <select class="form-control" name="level" id="level">
	                                <option>Select Level</option>
	                                @foreach($levels as $level)
	                                	<option value="{{ $level->id }}">{{ $level->name }}</option>
	                                @endforeach
	                            </select>
	                        </div>
	                        <div class="col-3 form-group">
	                            <label for="level">By Text</label>
	                            <input type="text" name="text" placeholder="By text..." class="form-control">
	                        </div>
	                        <div class="col-3 form-group">
	                            <label for="search">Search Now?</label>
	                            <button class="btn btn-success btn-block" id="search" name="search">Go</button>
	                        </div>
	                        <div class="col-2 offset-10">
	                            <input class="pt-1" type="checkbox" name="advanced" value="1" id="advanced">
	                            <label for="advanced">Show Advanced</label>
	                        </div>
	                    </div>
	                </div>
	            </div>
            @endguest
        </div>
        <div class="offset-2 col-md-8 pt-5">
        	<h2 class="text-center">Available Colleges</h2>
        	<div class="row">
        		@foreach($colleges as $college)
        			<div class="col-6 mt-5">
        				<div class="card border-success mb-3">
						  <div class="card-header text-center pt-3">
						  	<img src="{{ Storage::url($college->logo) }}" width="150px; margin: 10px auto">
						  	<br>
						  	<br>
						  	<h2>
						  		<a href="/college/{{$college->id}}">{{ $college->name }}</a>
						  	</h2>
						  </div>
						  <div class="card-body text-success">
						    <ul>
						    	<li>{{ $college->affiliation->name }}</li>
						    	<li>{{ $college->level->name }}</li>
						    	<li>{{ $college->faculty->name }}</li>
						    </ul>
						    <p>
						    	🌍 <a href="{{ $college->website }}" target="_new">Visit Website</a>
						    	<br>
								📍 {{ $college->location }}
								<br>
								📨 <a href="mailto:{{ $college->email }}" target="_new">{{ $college->email }}</a>
						    </p>
						    <p class="card-text">{{ $college->description }}</p>
						  </div>
						</div>
        			</div>
        		@endforeach
        	</div>
        	<h5 class="text-center">
        		<a href="/colleges">View All Colleges</a>
        	</h5>
        </div>
    </div>
@endsection
