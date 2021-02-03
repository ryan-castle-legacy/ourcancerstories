@extends('website.layouts.userAccounts')

@section('content')
	<section>
		<div class='container'>
			<h1>Reset your password</h1>

            @if ($errors->any())
                <pre>{{ var_dump($errors->all()) }}</pre>
            @endif

            <form method='POST' action='{{ route('userAccounts-resetPassword-submit', ['resetPasswordToken' => $resetPasswordToken]) }}'>
                @csrf
                <input type='password' name='password' id='password' placeholder='Password' required/>
                <br/>
                <input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirm your password' required/>
                <br/>
                <input type='submit' value='Continue'/>
            </form>
        </div>
	</section>
@endsection
