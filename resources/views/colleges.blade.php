@extends('layouts.app')

@section('content')
	<h2 class="text-center">
		All Available Colleges
	</h2>
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
