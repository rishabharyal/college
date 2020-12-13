@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="offset-2 col-md-8">
            @guest
            	<div class="card">
	                <div class="card-header">
	                    <strong>Search</strong>
	                </div>
	                <div class="card-body">
	                    <form method="GET" action="{{ action('HomeController@index') }}">
	                    	<div class="row">
	                    		<div class="col-4 offset-3 form-group">
		                            <input  value="{{ $request->get('text') }}" type="text" name="text" placeholder="By college name, location, email, phone, etc" class="form-control">
		                        </div>
		                        <div class="col-2 form-group">
		                            <input type="submit" class="btn btn-success btn-block" id="search" name="search" value="Go">
		                        </div>
		                    </div>
		                </form>
		                <div class="alert alert-info text-center pb-0">
			            	<p class="pb-0">
			            		Note: To view advanced filter option, you need to
			            		<a href="/login">login</a> or <a href="/register">register</a> to continue.
			            	</p>
			            </div>
		            </div>
		        </div>
            @else
	            <div class="card">
	                <div class="card-header">
	                    <strong>Search</strong>
	                </div>
	                <div class="card-body">
	                    <form method="GET" action="{{ action('HomeController@index') }}">
	                    	<div class="row">
		                        <div class="col-2 form-group">
		                            <label for="faculty">Faculty</label>
		                            <select class="form-control" name="faculty" id="faculty">
		                                <option value="0">Select Faculty</option>
		                                @foreach($faculties as $faculty)
		                                	<option {{ $request->get('faculty') == $faculty->id ? 'selected' : '' }} value="{{ $faculty->id }}">{{ $faculty->name }}</option>
		                                @endforeach
		                            </select>
		                        </div>
		                        <div class="col-2 form-group">
		                            <label for="affiliation">Affilication</label>
		                            <select class="form-control" name="affiliation" id="affiliation">
		                                <option value="0">Select Affilication</option>
		                                @foreach($affiliations as $affiliation)
		                                	<option {{ $request->get('affiliation') == $affiliation->id ? 'selected' : '' }} value="{{ $affiliation->id }}">{{ $affiliation->name }}</option>
		                                @endforeach
		                            </select>
		                        </div>
		                        <div class="col-2 form-group">
		                            <label for="level">Level</label>
		                            <select class="form-control" name="level" id="level">
		                                <option value="0">Select Level</option>
		                                @foreach($levels as $level)
		                                	<option {{ $request->get('level') == $level->id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->name }}</option>
		                                @endforeach
		                            </select>
		                        </div>
		                        <div class="col-3 form-group">
		                            <label for="text">By Text (Email, phone, location or college name)</label>
		                            <input  value="{{ $request->get('text') }}" type="text" name="text" placeholder="By college name, location, email, phone, etc" class="form-control">
		                        </div>
		                        <div class="col-3 form-group">
		                            <label for="search">Search Now?</label>
		                            <input type="submit" class="btn btn-success btn-block" id="search" name="search" value="Go">
		                        </div>
		                        <div class="col-2 form-group">
		                            <label for="location">Location</label>
		                            <select class="form-control" name="location" id="location">
		                                <option value="0">Select Location</option>
		                                @foreach($locations as $location)
		                                	<option {{ $request->get('location') == $location ? 'selected' : '' }} value="{{ $location }}">{{ $location }}</option>
		                                @endforeach
		                            </select>
		                        </div>
		                        <div class="col-2 form-group">
		                            <label for="start_fee">Fee From:</label>
		                            <input value="{{$request->get('start_fee')}}" type="text" name="start_fee" id="start_fee" placeholder="Eg: 500000" class="form-control">
		                        </div>
		                        <div class="col-2 form-group">
		                            <label for="end_fee">Fee To:</label>
		                            <input value="{{$request->get('end_fee')}}" type="text" name="end_fee" id="end_fee" placeholder="Eg: 700000" class="form-control">
		                        </div>
		                    </div>
	                    </form>
	                </div>
	            </div>
            @endguest
        </div>
        @if($request->has('search') && $resultColleges)
	          	<div class="offset-2 col-md-8 mt-3">
	          		<div class="card">
	          			<div class="card-header mb-0 pb-0">
	          				<p class="text-center">Search Results ({{ $resultColleges->count() }})</p>
	          			</div>
	          			<div class="card-body">
	                    	@if ($resultColleges->count()>0)
                    			@foreach($resultColleges as $college)
                    				<div class="row pt-2" style="background: #EEE">
                    					<div class="col-1">
	                    					<img src="{{ Storage::url($college->logo) }}" width="100%;">
	                    				</div>
	                    				<div class="col-8">
	                    					<h5><a target="_new" href="/college/{{$college->id}}">{{$college->name}}</a></h5>
										    	<span style="display: inline-block; font-size: 12px; background-color: #CCC; padding:5px; border-radius: 5%">{{ $college->affiliation->name }}</span>
										    	<span style="display: inline-block; font-size: 12px; background-color: #CCC; padding:5px; border-radius: 5%">{{ $college->level->name }}</span>
										    	<span style="display: inline-block; font-size: 12px; background-color: #CCC; padding:5px; border-radius: 5%">{{ $college->faculty->name }}</span>
	                    					<p>
	                    						<br>
										    	🌍 <a href="{{ $college->website }}" target="_new">Visit Website</a>
										    	<br>
												📍 {{ $college->location }}
												<br>
												📨 <a href="mailto:{{ $college->email }}" target="_new">{{ $college->email }}</a>
										    </p>
	                    				</div>
                    				</div>
                    			@endforeach
	                    	@else
	                    		<div class="alert alert-info">
	                    			No search results found for the query above.
	                    		</div>
	                    	@endif
	          			</div>
	          		</div>
	          	</div>
	    @endif
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
						  <div class="card-body">
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
						    <p class="card-text">{{ substr($college->description, 0, 250) }}...</p>
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
