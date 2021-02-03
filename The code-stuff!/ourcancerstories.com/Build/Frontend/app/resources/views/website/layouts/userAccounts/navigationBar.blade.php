<nav>
	<div class='container'>
		<a href='{{ route('public-home') }}'>Landing Page</a>
		@auth
			<a href='{{ route('community-home') }}'>Dashboard</a>
			<a href='{{ route('userAccounts-logout') }}'>Logout</a>
		@endauth
		@guest
			<a href='{{ route('userAccounts-signup') }}'>Signup</a>
			<a href='{{ route('userAccounts-login') }}'>Login</a>
		@endguest
	</div>
</nav>
<hr/>
