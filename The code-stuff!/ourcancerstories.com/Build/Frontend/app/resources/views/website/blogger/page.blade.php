@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
			<h1>{{ $blog['name'] }}</h1>
			<p>{{ $blog['description'] }}</p>
			<p><small>{{ $blog['owner']->firstname.' '.$blog['owner']->lastname }} - <a href='{{ route('community-profile', ['profile_url' => $blog['owner']->profile_url]) }}'>Owner's Profile</a></small></p>
			<hr/>

			Articles will go here...
		</div>
	</section>
@endsection
