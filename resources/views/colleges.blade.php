@extends('layouts.app')

@section('content')
	<h2 class="text-center">
		All Available Colleges
	</h2>
	<div class="bg-info text-light p-5 text-center" style="width: 40%; margin: 0 auto">
		<h3 class="text-center">Filter Colleges</h3>
		<p>Filter college by overall score, placement, pass percentage, budget and rating.</p>
		<form method="GET" action="" style="width: 250px; margin:0 auto">
	    			<select name="filter" class="form-control" style="width: 150px; display: inline-block;">
	    				<option {{ $filter == 'Overall' ? 'selected' : ''}} value="Overall">Overall</option>
	    				<option {{ $filter == 'Placement' ? 'selected' : ''}} value="Placement">Placement</option>
	    				<option {{ $filter == 'Pass' ? 'selected' : ''}} value="Pass">Pass Percentage</option>
	    				<option {{ $filter == 'Budget' ? 'selected' : ''}} value="Budget">Budget</option>
	    				<option {{ $filter == 'Rating' ? 'selected' : ''}} value="Rating">Rating</option>
	    			</select>
	    			<button class="btn btn-dark">Filter</button>
	    		</form>
	</div>
	<br>
    @foreach($colleges as $college)
    	<div class="row mb-5 pb-5 bg-dark text-light pt-5">
	    	<div class="offset-2 col-1">
	    		<img src="{{ Storage::url($college->logo) }}" width="150px; margin: 10px auto">
	    	</div>
	    	<div class="col-6 pl-5">
	    		<h2>
			  		<a href="/college/{{$college->id}}">{{ $college->name }}</a>
			  	</h2>
			  	<hr>
			  	<div style="font-size: 20px">
				    	<strong>Affiliation: {{ $college->affiliation->name }}</strong><br>
				    	<strong>Level: {{ $college->level->name }}</strong><br>
				    	<strong>Faculty: {{ $college->faculty->name }}</strong><br>
				    	<br>
				    <p>
				    	🌍 <a href="{{ $college->website }}" target="_new">Visit Website</a>
				    	<br>
						📍 {{ $college->location }}
						<br>
						📨 <a href="mailto:{{ $college->email }}" target="_new">{{ $college->email }}</a>
				    </p>
				    <br>
				    <p class="card-text">{{ $college->description }}</p>
				</div>
	    	</div>
	    </div>
    @endforeach
@endsection
