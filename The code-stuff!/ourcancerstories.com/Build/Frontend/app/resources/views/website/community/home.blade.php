@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
			<h1>Community Home Page</h1>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit!</p>
		</div>
		<div class='container'>
			<h2>Users:</h2>
			@foreach ($users as $user)
				<p>{{ $user->firstname.' '.$user->lastname }} - <a href='{{ route('community-profile', ['profile_url' => $user->profile_url]) }}'>Profile</a></p>
			@endforeach
		</div>
	</section>
@endsection
