<div id='body-container-top' class='container'>

    <div class='body-container-top-left'>

		@if (isset($pageTitle))
			<h1>{{ $pageTitle }}</h1>
		@endif

		@if (isset($pageFilterToggle))
			<a class='toggle-filters' filter-block='{{ $pageFilterToggle }}' filter-on='{{ $pageFilterToggleLabels['on'] }}' filter-off='{{ $pageFilterToggleLabels['off'] }}'>
				<i class='fas fa-filter'></i>
				<span>{{ $pageFilterToggleLabels['off'] }}</span>
			</a>
		@endif

    </div>

    {{-- <div class='body-container-top-right'>

        <button class='topbar-add-new-button'><i class='fas fa-plus'></i>Add New</button>

    </div>

    <div class='dropdown-list' dropdown-name='add-new' is-open='false'>

        <a class='dropdown-list-item add-new-contact-button'>
            <i class='fas fa-user'></i>
			<span class='label'>Contact</span>
        </a>

        <a class='dropdown-list-item add-new-ticket-button'>
            <i class='fas fa-ticket'></i>
			<span class='label'>Ticket</span>
        </a>

    </div> --}}

</div>
