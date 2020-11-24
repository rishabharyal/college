@extends('layouts.app')

@section('content')
    <div class="row">
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
        <div class="offset-2 col-md-8">
        	<br>
        	<br>
        	<hr>
        	<h2 class="text-center">Other Colleges</h2>
        	<div class="row">
        		@foreach($colleges as $college)
        			<div class="col-4 mt-5">
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
