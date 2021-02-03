@extends('website.layouts.userAccounts')

@section('content')
	<section>
		<div class='container'>
            <h1>Login to your account</h1>

            @if ($errors->any())
                <pre>{{ var_dump($errors->all()) }}</pre>
            @endif
            @if (Session::has('info'))
                <pre>{{ Session::get('info') }}</pre>
            @endif

            <form method='POST' action='{{ route('userAccounts-login') }}'>
                @csrf
                <input type='email' name='email' id='email' value='{{ old('email') }}' placeholder='Email address' required/>
                <br/>
                <input type='password' name='password' id='password' placeholder='Password' required/>
                <br/>
                <input type='submit' value='Login'/>
            </form>

			<p><a href='{{ route('userAccounts-resetPassword') }}'>Forgot your password?</a></p>

        </div>
	</section>
@endsection
