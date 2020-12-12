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
		  	@auth
		  		<a class="btn btn-success" href="/favorite/{{$college->id}}">❤️ @if($favorite) Remove From @else Add To @endif Favorite</a>
		  	@endauth
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
			    <br>
			</div>
			<hr>
			<div>
				<h3 class="text-center">Ratings</h3>

				<p>
					Average Rating: <strong>{{ intval($averageRating->average_rating) > 0 ? intval($averageRating->average_rating) : 'No ratings yet!' }}</strong>
					<hr>
					@if ($user && $user->college()->first() && $user->college()->first()->id === $college->id)
							<div class="card mb-4">
								<div class="card-header">
									Add New Rating
								</div>
								<div class="card-body">
									<form method="post" action="/rating">
										@csrf
										<input type="hidden" name="college_id" value="{{$college->id}}">
										<select name="rating" class="form-control">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<select name="topic" class="form-control">
											@foreach($topics as $topic)
												<option value="{{$topic}}">{{$topic}}</option>
											@endforeach
										</select>
										<button class="btn btn-info">💾</button>
									</form>
								</div>
							</div>
						@endif
					@if ($user && $user->ratings()->count())
						<div class="row">
							@foreach($user->ratings()->where('college_id', $college->id)->get() as $ur)
								<div class="col-3 bg-dark text-light p-1">
									<form method="post" action="/rating/{{$ur->id}}">
										@csrf
										<select name="rating" class="form-control">
											<option {{ $ur->rating_given == 1 ? 'selected' : ''}} value="1">1</option>
											<option {{ $ur->rating_given == 2 ? 'selected' : ''}} value="2">2</option>
											<option {{ $ur->rating_given == 3 ? 'selected' : ''}} value="3">3</option>
											<option {{ $ur->rating_given == 4 ? 'selected' : ''}} value="4">4</option>
											<option {{ $ur->rating_given == 5 ? 'selected' : ''}} value="5">5</option>
										</select>
										<select name="topic" class="form-control">
											@foreach($topics as $topic)
												<option {{ $ur->topic == $topic ? 'selected' : ''}} value="{{$topic}}">{{$topic}}</option>
											@endforeach
										</select>
										<button class="btn btn-info">💾</button>
										<a href="/rating/{{$ur->id}}/delete" class="btn btn-danger">🗑</a>
									</form>
								</div>
								
							@endforeach
						</div>
					@endif

					@if($ratingByTopic->count())
						Ratings By Topic:
						<br>
						@foreach($ratingByTopic as $topic)
							<span>{{ $topic->topic . ': ' . round($topic->average_rating) }} </span> <br>
						@endforeach

						<div class="row">
							@foreach($allRatings as $rating)
								<div class="col-3 bg-dark text-light m-1">
									{{ $rating->user->name }}<br>
									{{ $rating->topic }}<br>
									{{ $rating->rating_given }}<br>
								</div>
							@endforeach
						</div>
					@endif
				</p>
			</div>


			
    	</div>
        <div class="offset-2 col-md-8">
        	<br>
        	<br>
        	<hr>
        	<h2 class="text-center">Similar Colleges</h2>
        	<p class="text-center">
        		Similar colleges are calculated by college description, faculty, level and address using consine similarity.
        	</p>
        	<div class="row">
        		@foreach($similarColleges as $college)
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
