@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
			{{-- <label>New post</label>
			<input name='article_name' type='text' placeholder='Enter title'/> --}}

			<link rel='stylesheet' type='text/css' href='{{ asset('css/text-editor.css') }}'/>
			@include('website.blogger.text-editor')

			<script src='{{ asset('js/11-text-editor.js') }}'></script>
			<script src='{{ asset('js/9-text-editor.js') }}'></script>
			<script src='{{ asset('js/8-text-editor.js') }}'></script>
			<script src='{{ asset('js/10-text-editor.js') }}'></script>
			<script src='{{ asset('js/7-text-editor.js') }}'></script>
			<script src='{{ asset('js/6-text-editor.js') }}'></script>
			<script src='{{ asset('js/5-text-editor.js') }}'></script>
			<script src='{{ asset('js/4-text-editor.js') }}'></script>
			<script src='{{ asset('js/3-text-editor.js') }}'></script>


		</div>
	</section>
@endsection
