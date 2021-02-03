@extends('website.layouts.public')

@section('content')
	<section>
		<div class='container'>
            <h1>Create a Blog</h1>

            @if ($errors->any())
                <pre>{{ var_dump($errors->all()) }}</pre>
            @endif

            @if (env('OPEN_TO_NEW_BLOGS') == false)
                <p>Sorry, we're not accepting any new blogs at the moment.</p>
                <p><small>Still interested? Feel free to get-in-touch with us via <a href='mailto:{{ env('CONTACT_US_EMAIL') }}'>email</a>.</small></p>
            @else
                <form method='POST' action='{{ route('blogger-create') }}'>
                    @csrf
					<input type='text' name='blog_name' id='blog_name' value='{{ old('blog_name') }}' placeholder='Your blogs name' required/>
                    <br/>
					https://ourcancerstories.com/blog/<input type='text' name='blog_url' id='blog_url' value='{{ old('blog_url') }}' placeholder='your-unique-url' required/>
                    <br/>
					<input type='text' name='description' id='description' value='{{ old('description') }}' placeholder='Your blogs description' required/>
                    <br/>
                    <input type='submit' value='Create my blog'/>
                </form>
            @endif
        </div>
	</section>
@endsection
