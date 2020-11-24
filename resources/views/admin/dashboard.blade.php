@extends('layouts.admin')

@section('content')
    <div class="mt-1">
        <h3>Dashboard Stats</h3>
        <p>Here is the very basic numeric overview of the users, colleges and other entities that are used across the site.</p>
        <div class="row">
        	<div class="col-3">
        		<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
				  <div class="card-body">
				    <h3 class="card-title">
				    	<a class="text-white" href="/admin/users">Users</a>
				    </h3>
				    <h1 class="card-text">{{ $data['users'] }}</h1>
				  </div>
				</div>
        	</div>
        	<div class="col-3">
        		<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
				  <div class="card-body">
				    <h3 class="card-title">
				    	<a class="text-white" href="/admin/levels">Levels</a>
				    </h3>
				    <h1 class="card-text">{{ $data['levels'] }}</h1>
				  </div>
				</div>
        	</div>
        	<div class="col-3">
        		<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
				  <div class="card-body">
				    <h3 class="card-title">
				    	<a class="text-white" href="/admin/faculties">Faculties</a>
				    </h3>
				    <h1 class="card-text">{{ $data['faculties'] }}</h1>
				  </div>
				</div>
        	</div>
        	<div class="col-3">
        		<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
				  <div class="card-body">
				    <h3 class="card-title">
				    	<a class="text-white" href="/admin/colleges">Colleges</a>
				    </h3>
				    <h1 class="card-text">{{ $data['colleges'] }}</h1>
				  </div>
				</div>
        	</div>
        	<div class="col-3">
        		<div class="card text-white mb-3" style="max-width: 18rem;background-color: #1abc9c">
				  <div class="card-body">
				    <h3 class="card-title">
				    	<a class="text-white" href="/admin/colleges">Affiliations</a>
				    </h3>
				    <h1 class="card-text">{{ $data['affiliations'] }}</h1>
				  </div>
				</div>
        	</div>
        </div>
    </div>
@endsection
