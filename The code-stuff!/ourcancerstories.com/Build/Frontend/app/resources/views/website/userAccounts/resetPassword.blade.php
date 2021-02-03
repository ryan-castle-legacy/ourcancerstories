@extends('website.layouts.userAccounts')

@section('content')
	<section>
		<div class='container'>
            <h1>Reset your password</h1>

            @if ($errors->any())
                <pre>{{ var_dump($errors->all()) }}</pre>
            @endif
            @if (Session::has('info'))
                <pre>{{ Session::get('info') }}</pre>
            @endif

            <form method='POST' action='{{ route('userAccounts-resetPassword') }}'>
                @csrf
                <input type='email' name='email' id='email' value='{{ old('email') }}' placeholder='Email address' required/>
                <br/>
                <input type='submit' value='Send reset email'/>
            </form>

			<p><a href='{{ route('userAccounts-login') }}'>Go back to login</a></p>

        </div>
	</section>
@endsection
