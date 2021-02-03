@php

	// Check if $navigationCurrent is set
	if (!isset($navigationCurrent)) {
		// Set default of 'dashboard'
		$navigationCurrent = 'dashboard';
	}
	// Explode array for dropdown selections
	$navigationCurrentExploded = explode('.', $navigationCurrent);

@endphp
<nav id='navigation' class=''>

	<a id='navigation-logo'></a>

	<div id='navigation-search' class='search-field'>
		<input type='search' placeholder='Search for everything' spellcheck='false'>
		<i class='far fa-search search-field-finder'></i>
		<i class='far fa-times-circle search-field-clear'></i>
	</div>

	<div class='navigation-links'>

		<a href='{{ route('dashboard-home') }}' class='navigation-link @php if (@$navigationCurrentExploded[0] == 'dashboard') { echo 'navigation-link-current'; } @endphp'>
			<i class='fas fa-tachometer'></i>
			<span class='label'>Dashboard</span>
		</a>

	</div>

	<hr/>

	<div class='navigation-links'>

		<a class='navigation-link @php if (@$navigationCurrentExploded[0] == 'settings') { echo 'navigation-link-current'; } @endphp'>
			<i class='fas fa-cog'></i>
			<span class='label'>Settings</span>
		</a>

		<a href='{{ route('userAccounts-logout') }}' id='sign-out' class='navigation-link'>
			<i class='fas fa-sign-out-alt'></i>
			<span class='label'>Sign Out</span>
		</a>

	</div>

</nav>
