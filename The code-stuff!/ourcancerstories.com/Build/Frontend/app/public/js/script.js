// * File: 				/js/script.js
// * Description:		This file holds the JavaScript for the AtomizeCRM Frontend.
// * Created:			19th December 2020 at 11:03
// * Updated:			11th January 2021 at 15077
// * Author:			Ryan Castle
// * Notes:

// ----------

// Debounce
var debounce = false;
var requestBaseURL = 'http://167.99.89.67';


// Code to execute once this script has been read
var initialise = function() {

    // Await DOM to load for DOM-based code to execute
    document.addEventListener('DOMContentLoaded', DOMBasedFunctionality);

};


// DOM-based code
var DOMBasedFunctionality = function() {

    // Gather all search-fields
    var searchFields = document.querySelectorAll('.search-field');
    // Loop through the found search-fields
    for (var i = 0; i < searchFields.length; i++) {
        // Add an event-listener to the search-fields to detect a key-down event
        searchFields[i].addEventListener('keydown', searchFieldChange);
        // Add an event-listener to the search-fields to detect a value change event
        searchFields[i].addEventListener('input', searchFieldChange);
    }

    // Gather all search-field-clears
    var searchFieldClears = document.querySelectorAll('.search-field-clear');
    // Loop through the found search-field-clears
    for (var i = 0; i < searchFieldClears.length; i++) {
        // Add an event-listener to the search-field-clears to detect a click event
        searchFieldClears[i].addEventListener('click', searchFieldClear);
    }


    // Gather all navigation-based dropdown links
    var navigationDropdownLinks = document.querySelectorAll('#navigation .navigation-link[dropdown-target]');
    // Loop through the found navigation-based dropdown-links
    for (var i = 0; i < navigationDropdownLinks.length; i++) {
        // Add an event-listener to the navigation-based dropdown-links to detect a click event
        navigationDropdownLinks[i].addEventListener('click', toggleNavigationLinkDropdown);
    }


    // Gather all navigation-based dropdown-togglers
    var navigationDropdownTogglers = document.querySelectorAll('#navigation .dropdown-toggler');
    // Loop through the found navigation-based dropdown-togglers
    for (var i = 0; i < searchFieldClears.length; i++) {
        // Add an event-listener to the navigation-based dropdown-togglers to detect a click event
        navigationDropdownTogglers[i].addEventListener('click', toggleNavigationDropdown);
    }


    // Set an event listener for the user clicking 'sign out' from the navigation
    document.getElementById('sign-out').addEventListener('click', signTheUserOut);


	// Check if the element exists
	if (document.querySelector('.topbar-add-new-button')) {
	    // Set an event listener for the '+ add new' button
	    document.querySelector('.topbar-add-new-button').addEventListener('click', openTheAddNewDropdown);
	}


	// Gather all hover-triggered tooltips
    var hoverTriggeredTooltips = document.querySelectorAll('.data-show-tooltip-on-hover');
    // Loop through the found hover-triggered tooltips
    for (var i = 0; i < hoverTriggeredTooltips.length; i++) {
		// Add an event-listener to the hover-triggered tooltips to detect a mouseover event
        hoverTriggeredTooltips[i].addEventListener('mouseover', showExtraDataTooltip);
		// Add an event-listener to the hover-triggered tooltips to detect a mouseout event
        hoverTriggeredTooltips[i].addEventListener('mouseout', hideExtraDataTooltip);
    }


    // Track all clicks (to close dropdowns that aren't focussed on, etc)
    document.body.addEventListener('click', respondToAllWindowClicks);


	// Gather all on-change triggers
    var onChangeTriggers = document.querySelectorAll('[on-change]');
    // Loop through the found on-change triggers
    for (var i = 0; i < onChangeTriggers.length; i++) {
		// Add an event-listener to the triggers to detect a change or keyup and set the function that the trigger will action.
		onChangeTriggers[i].addEventListener('keyup', eval(onChangeTriggers[i].getAttribute('on-change')));
        onChangeTriggers[i].addEventListener('change', eval(onChangeTriggers[i].getAttribute('on-change')));
    }


	// Get any validation items
    var validationItems = document.querySelectorAll('[valid-check]');
    // Loop through the found validator items
    for (var i = 0; i < validationItems.length; i++) {
		// Add an event-listener to the triggers to detect a change or keyup and set the function that the trigger will action.
		validationItems[i].addEventListener('keyup', handleSuccessOnlyIf);
        validationItems[i].addEventListener('change', handleSuccessOnlyIf);
    }


	// Gather all close buttons for popups
	var popupOpeners = document.querySelectorAll('.button-link-opener');
	// Loop through the openers
    for (var i = 0; i < popupOpeners.length; i++) {
		// Add an event-listener to the open the popup
        popupOpeners[i].addEventListener('click', openPopup);
    }


	// Gather all close buttons for popups
	var popupClosers = document.querySelectorAll('.button-link-close');
	// Loop through the closers
    for (var i = 0; i < popupClosers.length; i++) {
		// Add an event-listener to the close the popup
        popupClosers[i].addEventListener('click', closePopup);
    }


	// Check if the element exists
	if (document.getElementById('add-new-domain')) {
		// Set an event listener for the 'Continue and verify website ownership' button
		document.getElementById('add-new-domain').addEventListener('click', addNewDomainToOrganisation);
	}


	// Gather all filter toggle buttons
	var filterTogglers = document.querySelectorAll('.toggle-filters');
	// Loop through the filter togglers
    for (var i = 0; i < filterTogglers.length; i++) {
		// Add an event-listener to the filter togglers
        filterTogglers[i].addEventListener('click', toggleFilters);
    }

};


// Toggle filter buttons
var toggleFilters = function(e) {
	// Get the toggler button
	var toggler = $(e.target).closest('.toggle-filters');
	// Get the target filter block to show
	var filterBlock = $('.filter-block[filters="' + $(toggler).attr('filter-block') + '"]');

	var filterHeight = $(filterBlock)[0].clientHeight;
	var mainPosition = 70;

	// See if the toggle has been selected
	if (toggler.hasClass('selected')) {
		// Remove class to mark the filters as closed
		toggler.removeClass('selected');
		// Set the text for the toggler
		toggler.find('span').text($(toggler).attr('filter-off'));
		// Show filter block
		$(filterBlock).removeClass('toggled-shown');
		// Delay the movement of the main data records
		setTimeout(function() {
			// Move the top position of the main
			$('#body-container-main')[0].style.top = (mainPosition) + 'px';
			$('#body-container-main')[0].style.height = 'calc(100% - ' + mainPosition + 'px)';
			// Clear any filters

		}, 200);
	} else {
		// Add class to mark the filters as open
		toggler.addClass('selected');
		// Set the text for the toggler
		toggler.find('span').text($(toggler).attr('filter-on'));

		// Move the top position of the main
		$('#body-container-main')[0].style.top = (filterHeight + mainPosition) + 'px';
		$('#body-container-main')[0].style.height = 'calc(100% - ' + (filterHeight + mainPosition) + 'px)';
		// Show filter block
		$(filterBlock).addClass('toggled-shown');
	}
};


// Hold the timeout's items
var addNewDomainToOrganisation_timeoutHolder;
var addNewDomainToOrganisation_timeoutLimit = 8000;
// Handle form to add new websites to an organisation
var addNewDomainToOrganisation = function(e) {
	// Disable the form for processing
	$(e.target).closest('.popup').addClass('processing');
	// Get the domain
	var url = $('[popup-name="add-new-connected-website"] input[name="website"]').val();
	// Remove everything but the domain's host
	var domain = url.replace('http://','').replace('https://','').split(/[/?#]/)[0];
	// Add the route 'http://'
	var domainPlusHTTP = 'http://' + domain;
	// Try catch (to surpress errors)
	try {
		// Create XML HTTP Request
		var request = new XMLHttpRequest();
		// Send AJAX request to see if the domain results in a valid website
		request.open('HEAD', domainPlusHTTP);
		// Add CORS header to reqiest
		request.setRequestHeader('Access-Control-Allow-Origin', '*');
		// Send request to target
		request.send(null);
		// Set timeout for stopping the domain to take too long
		addNewDomainToOrganisation_timeoutHolder = setTimeout(addNewDomainToOrganisation_timeout, addNewDomainToOrganisation_timeoutLimit);
		// Listen for response
		request.onreadystatechange = function() {
			// Check if readyState is 4 (done - finished processing)
			if (request.readyState === 4) {
				// Clear any error timeouts
				window.clearTimeout(addNewDomainToOrganisation_timeoutHolder);
				// Display a toast to the user regading the success
				createToast('info', '\'' + domain + '\' has now been added to your list of websites.', 'fas fa-browser', 8000);
				// Get popup that is connected to this event
				var popup = $('[popup-name="add-new-connected-website"]');
				// Fade the popup
				popup.addClass('fading');
				// Delay clearing values and messages/errors for CSS transitions
				setTimeout(function() {
					// Stops the processing as it was successful
					$('.popup.processing').removeClass('processing');
					// Close the popup
					popup.removeClass('show');
					// End the fading transition
					popup.removeClass('fading');
					// Delay a next-steps popup to the user about adding widgets to their new website
					setTimeout(function() {


						console.log('next step...');


					}, 500);
				}, 500);
				// Add domain name to the the list of domains that the organisation can now go to verify with a widget's code
				sendValidConnectedWebsiteToAPI(domain);
			}
		};
	} catch (error) {
		console.log(error);
	}
};


// Add domain name to the the list of domains that the organisation can now go to verify with a widget's code
var sendValidConnectedWebsiteToAPI = function(domain) {
	// Create XML HTTP Request
	var request = new XMLHttpRequest();
	// Open POST request
	request.open('POST', requestBaseURL + '/dashboard/organisations/connected-websites');
	// Set request header for how the request was sent
	request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	// Set request header for sending data
	request.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
	// Send request to target
	request.send(JSON.stringify({ domain: domain, org: $('meta[name="organisation-id"]').attr('content') }));
	// Listen for response
	request.onreadystatechange = function() {
		// Check if readyState is 4 (done - finished processing)
		if (request.readyState === 4) {
			// Check if the request was successful
			if (request.status === 200) {

				console.log(request.responseText);

				// // Check if response data is a JSON object
				// if (JSON.parse(request.responseText)) {
				// 	// Parse response text through callback
				// 	return callback(JSON.parse(request.responseText));
				// }
			}
			// Print error
			return console.error(JSON.parse(request.responseText));
		}
	}
};


// Handle timeouts for the addNewDomainToOrganisation method
var addNewDomainToOrganisation_timeout = function(error) {
	// Clear any existing timeouts
	window.clearTimeout(addNewDomainToOrganisation_timeoutHolder);
	// Get the error info message
	var message = $('[error-note-for="newConnectedWebsite"]')
	// Set the message for the user to respond
	message[0].innerHTML = "<i class='fas fa-exclamation-triangle'></i>The website that you are trying to add did not respond after " + (addNewDomainToOrganisation_timeoutLimit / 1000) + " seconds. Are you sure this is the correct website address?";
	// Display the message to the user
	$(message).addClass('show');
	// Stops the processing for another try
	$('.popup.processing').removeClass('processing');
};


// Open a popup
var openPopup = function(e) {
	// Get popup that is connected to this event
	var popup = $('.popup[popup-name="' + $(e.target).attr('popup-target') + '"]');
	// Clear values in the popup
	$($(popup).find('input')).val('');
	// Clear messages/errors in the popup
	$(popup).find('.error-note.show').removeClass('show');
	// Fade the popup
	popup.addClass('show');
};


// Close a popup
var closePopup = function(e) {
	// Get popup that is connected to this event
	var popup = $(e.target).closest('.popup');
	// Fade the popup
	popup.addClass('fading');
	// Delay clearing values and messages/errors for CSS transitions
	setTimeout(function() {
		// Close the popup
		popup.removeClass('show');
		// End the fading transition
		popup.removeClass('fading');
	}, 500);
};


// Handle if an input is valid
var handleSuccessOnlyIf = function(e) {
	// Get the success-required input
	var input = $(e.target);
	// Get the disable-able item
	var disableable = $('[success-only-if="' + $(input).attr('valid-check') + '"]');
	// Switch to see what type of validation is required
	switch (disableable.attr('success-only-if')) {
		case 'valid-domain-name':
			// Check if value is valid or not
			if (isValidDomain(input.val())) {
				// Enable the disable-able item
				$(disableable).removeAttr('disabled');
			} else {
				// Disable the disable-able item
				$(disableable).attr('disabled', 'disabled');
			}
		break;
	}
};


// Handle the add a connected website popup's input
var handleConnectedWebsiteInput = function(e) {
	// Get the input
	var input = $(e.target).closest('input[type="text"]');
	// Get any error-notes for the input
	var errorNote = $('[error-note-for="' + input.attr('error-notice-by') + '"]');
	// Set the message for the user to respond
	errorNote[0].innerHTML = "<i class='fas fa-exclamation-triangle'></i>The website's domain name that you have input is invalid.";
	// Check if the value given is a valid domain name
	if (isValidDomain(input.val())) {
		// Check if there is an error note
		if (errorNote.length > 0) {
			// Hide the error note
			$(errorNote[0]).removeClass('show');
		}
	} else {
		// Check if there is an error note
		if (errorNote.length > 0) {
			// Show the error note
			$(errorNote[0]).addClass('show');
		}
	}
};


// Check if the value given is a valid domain name
var isValidDomain = function(string) {
	// Set regular expression for domain names
    var re = new RegExp(/^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/);
	// Return whether the string is valid or not
    return string.match(re);
}


// Hides the extra-data's tooltip
var showExtraDataTooltip = function(e) {
	// Get the target's DOM object
	var target = $(e.target).closest('.data-show-tooltip-on-hover');
	// Get the tooltip's data
	var data = $(target).attr('tooltip-data');
	// Check if the data exists
	if (data.trim().length > 0) {
		// Create a new instance of the tooltip template
		var tooltip = $('.dom-template.tooltip').clone();
		// Create a unique ID to the new item
	    var uniqueId = createUniqueId(32);
	    // Add the unique ID to the tooltip element
	    $(tooltip).attr('id', 'domcreated' + uniqueId);
	    // Set the tooltip's data text
	    $(tooltip).find('.tooltip-data')[0].innerHTML = data;
	    // Remove the template class
	    $(tooltip).removeClass('dom-template');
	    // Set a timeout
	    setTimeout(function() {
	        // Add the show class
	        $(tooltip).addClass('show');
	    }, 50);
	    // Append the toast to the body
	    $(tooltip).appendTo(target);
		// Set the position of the tooltip
		$(tooltip).css('margin-left', ($(tooltip).outerWidth() - $(target).outerWidth()) / -2);
	}
};


// Hides the extra-data's tooltip
var hideExtraDataTooltip = function(e) {
	// Remove the template class
	$('.tooltip:not(.dom-template)').remove();
};


// Open the 'add-new' dropdown
var openTheAddNewDropdown = function() {
    // Get the dropdown
    var dropdown = $('.dropdown-list[dropdown-name="add-new"]');
    // Set attribute to stop the newly displayed dropdown from being closed by closeAllPopUps()
    dropdown.attr('newly-opened', true);
    // Open the dropdown
    dropdown.attr('is-open', true);
}


// Respond to all clicks (to close dropdowns that aren't focussed on, etc)
var respondToAllWindowClicks = function(e) {
    // Close any popups (excluding the event's target)
    closeAllPopUps(e.target);
}


// Close all pop-ups
var closeAllPopUps = function(exclusion = null) {
    // Find whether the exclusion is a pop-up
    exclusion = $(exclusion).closest('.dropdown-list');
    // Find all pop-ups
    var popUps = document.querySelectorAll('.dropdown-list');
    // Loop through the found elements
    for (var i = 0; i < popUps.length; i++) {
        // Check if the exclusion is this pop-up
        if (exclusion.length > 0 && exclusion[0] === popUps[i]) {
            // Keep open the pop-up
        } else {
            // Check that the pop-up is not newly-opened
            if (!$(popUps[i]).attr('newly-opened') == true) {
                // Set the 'is-open' attribute to false
                $(popUps[i]).attr('is-open', false);
            } else {
                // Remove newly-opened attribute
                $(popUps[i]).removeAttr('newly-opened');
            }
        }
    }
}


// Sign the user out
var signTheUserOut = function(e) {
    // Prevent immediate sign out
    e.preventDefault();
    // Show the sign-out toast
    createToast('sign-out', 'We\'re signing you out - see you next time!', 'fas fa-hand-peace', false);
    // Delay the user for a short space of time (makes them think that something is happening)
    setTimeout(function() {
        // Send them to the logout route
        window.location.href = ('http://' + window.location.host + '/logout');
    }, 1750);
}


// Create a 'toast' template element and display it to the user
var createToast = function(type, message, icon, timeToHide = 4000) {
    // Grab and clone the template element to create the new toast
    var toast = $('.dom-template.toast').clone();
    // Create a unique ID to the new item
    var uniqueId = createUniqueId(32);
    // Add the unique ID to the toast element
    $(toast).attr('id', 'domcreated' + uniqueId);
    // Set the toast's type
    $(toast).attr('toast-type', type);
    // Set the toast's message text
    $($(toast).find('i')[0]).attr('class', icon);
    // Set the toast's message text
    $(toast).find('p')[0].innerText = message;
    // Remove the template class
    $(toast).removeClass('dom-template');
    // Set a timeout
    setTimeout(function() {
        // Add the show class
        $(toast).addClass('show');
    }, 50);
    // Append the toast to the body
    $(toast).appendTo('body');
    // Check if a timeout is needed
    if (timeToHide !== false) {
        // Set a timeout
        setTimeout(function() {
            // Remove the show class
            $(toast).removeClass('show');
            // Set a timeout to allow for transition to pass
            setTimeout(function() {
                // Delete the toast
                $('#domcreated' + uniqueId).remove();
            }, 500);
        }, timeToHide);
    }
};


// Creates a unique ID for DOM elements
var createUniqueId = function(length) {
    // Storage of the result
    var result = '';
    // All characters allowed
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    // Loop through charaters
    for (var i = 0; i < length; i++ ) {
        // Find a random character
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    // Return result
    return result;
}


// Actions to fire when a search-field has changed
var searchFieldChange = function(e) {
    // Find the 'clear' icon
    var clearIcon = $($(e.target).closest('.search-field')[0]).find('.search-field-clear');
    // Check if the value of the input is not empty
    if (e.target.value.trim().length > 0) {
        // Display the icon to the user
        $(clearIcon).addClass('show');
    } else {
        // Hide the icon to the user
        $(clearIcon).removeClass('show');
    }
};


// Actions to fire when a search-field needs to be cleared
var searchFieldClear = function(e) {
    // Find the field attached to the 'clear' button
    var searchField = $(e.target).closest('.search-field')[0];
    // Clear the value of the input attached to the search-field
    var x = $(searchField).find('input')[0].value = '';
    // Hide the icon to the user
    $(searchField).find('.search-field-clear').removeClass('show');
};


// [ALIAS - Only difference is the event] Actions to fire when a dropdown needs toggled
var toggleNavigationLinkDropdown = function(e) {
    // Find the label for the dropdown attached to this toggling
    var dropdownLabel = $(e.target).closest('.navigation-link');
    // Call the master method
    toggleNavigationDropdown(e, dropdownLabel);
}


// Actions to fire when a dropdown needs toggled
var toggleNavigationDropdown = function(e, dropdownLabel = false) {
    // Ensure if the debounce is false to make sure no bouncing
    if (debounce !== true) {
        // Set debounce as true
        debounce = true;
        // Check if the label has not been worked out already
        if (dropdownLabel == false) {
            // Find the label for the dropdown attached to this toggling
            dropdownLabel = $(e.target).closest('.navigation-link');
        }
        // Find the dropdown attached to this toggling
        var dropdown = $('.navigation-dropdown[dropdown-name="' + $(dropdownLabel[0]).attr('dropdown-target') + '"]');
        // Find whether the navigation is open already
        if ($(dropdown[0]).attr('is-open') == 'true') {
            // Change the statuses to false and hide the dropdown
            $(dropdown[0]).attr('is-open', false);
            $(dropdownLabel[0]).attr('is-open', false);
            // Delay the zero-height until the transition has finished
            setTimeout(function() {
                // Set the height of a dropdown (so that the other items in the list stack don't abruptly moved down)
                setDropdownHeight(dropdown, true);
            }, 175);
        } else {
            // Set the height of a dropdown (so that the other items in the list stack don't abruptly moved down)
            setDropdownHeight(dropdown, false);
            // Change the statuses to true and show the dropdown
            $(dropdown[0]).attr('is-open', true);
            $(dropdownLabel[0]).attr('is-open', true);
        }
        // Delay for a few moments to stop any animation bounce
        setTimeout(function() {
            // End debounce
            debounce = false;
        }, 300);
    }
};


// Set the height of a dropdown from the total height of the links it contains
var setDropdownHeight = function(dropdown, setToZero) {
    // Storage for the overall height of the dropdrown
    var dropdownHeight = 0;
    // Check if the height must be calculated
    if (setToZero == false) {
        // Gather all navigation-dropdown-link in the dropdown
        var links = $(dropdown[0]).find('.navigation-dropdown-link');
        // Loop through the found navigation-dropdown-links
        for (var i = 0; i < links.length; i++) {
            // Add the height to the total
            dropdownHeight += $(links[0]).outerHeight();
        }
    }
    // Set the dropdown's height to the total link heights
    $(dropdown[0]).css('height', (dropdownHeight + 'px'));
};


// ----------

// Execute this script
initialise();
