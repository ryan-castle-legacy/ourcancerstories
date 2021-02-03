@extends('website.layouts.userAccounts')

@section('content')
	<section>
		<div class='container'>
            <h1>Create an account</h1>

            @if ($errors->any())
                <pre>{{ var_dump($errors->all()) }}</pre>
            @endif

            @if (env('OPEN_TO_NEW_USERS') == false)
                <p>Sorry, we're not signing up anyone new at the moment.</p>
                <p><small>Still interested? Feel free to get-in-touch with us via <a href='mailto:{{ env('CONTACT_US_EMAIL') }}'>email</a>.</small></p>
            @else
                <form method='POST' action='{{ route('userAccounts-signup') }}'>
                    @csrf
                    <input type='text' name='firstname' id='firstname' value='{{ old('firstname') }}' placeholder='First name' required/>
                    <br/>
                    <input type='text' name='lastname' id='lastname' value='{{ old('lastname') }}' placeholder='Last name' required/>
                    <br/>
                    <input type='email' name='email' id='email' value='{{ old('email') }}' placeholder='Email address' required/>
                    <br/>
                    <input type='password' name='password' id='password' placeholder='Password' required/>
                    <br/>
                    <input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirm your password' required/>
                    <br/>
                    <input type='submit' value='Sign up'/>
                    <br/>
                    <p><small>By clicking this button you agree, to our <a href='{{ route('public-termsOfService') }}' target='_blank'>terms of service</a>.</small></p>
                </form>
            @endif
        </div>
	</section>
@endsection
