@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
			<h1>Blogs:</h1>
			@foreach ($blogs as $blog)
				<p>{{ $blog->name }} - <a href='{{ route('blogger-page', ['blog_url' => $blog->blog_url]) }}'>Go to blog</a></p>
			@endforeach
		</div>
	</section>
@endsection
