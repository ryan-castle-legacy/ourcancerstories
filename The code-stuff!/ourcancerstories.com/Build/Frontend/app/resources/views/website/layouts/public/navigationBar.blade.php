<nav>
	<div class='container'>
		<a href='{{ route('community-home') }}'>Community</a>
		<a href='{{ route('blogger-home') }}'>Blogs</a>
		@auth
			@if (Auth::user()->blog_url)
				<a href='{{ route('blogger-page', ['blog_url' => Auth::user()->blog_url]) }}'>My Blog - {{ Auth::user()->blog_url }}</a>
				<a href='{{ route('blogger-write') }}'>Write a post</a>
			@else
				<a href='{{ route('blogger-create') }}'>Create a Blog</a>
			@endif
			<a href='{{ route('userAccounts-logout') }}'>Logout</a>
		@endauth
		@guest
			<a href='{{ route('userAccounts-signup') }}'>Signup</a>
			<a href='{{ route('userAccounts-login') }}'>Login</a>
		@endguest
	</div>
</nav>
