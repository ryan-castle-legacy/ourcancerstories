<hr/>
<footer>
	<div class='container'>
		<div class='footer_details'>
			<a class='footer_details_logo'></a>
			<p class='footer_details_desc'>{{ env('MARKETING_MESSAGE') }}</p>
			<p class='footer_details_sprint'>{{ date('Y', time()) }} &copy; {{ env('SITE_NAME') }}</p>
		</div>
	</div>
</footer>
