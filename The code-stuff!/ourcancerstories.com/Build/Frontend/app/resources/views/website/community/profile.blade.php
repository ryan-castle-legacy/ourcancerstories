@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
			<h1>{{ $user['firstname'].' '.$user['lastname'] }}</h1>
			<p><span>{{ $user['profile_url'] }}</span></p>
			@if ($user['blog_url'] != null)
				<p><a href='{{ route('blogger-page', ['blog_url' => $user['blog_url']]) }}'>Go to their blog - {{ $user['blog']->name }}</a></p>
			@endif
		</div>
	</section>
@endsection
