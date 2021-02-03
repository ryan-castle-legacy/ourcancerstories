@extends('website.layouts.userAccounts')

@section('content')
	<section>
		<div class='container'>
            <h1>Your password reset link has expired</h1>
            <p>If you need to reset your password, <a href='{{ route('userAccounts-resetPassword') }}'>click here</a> to re-send.</p>
        </div>
	</section>
@endsection
