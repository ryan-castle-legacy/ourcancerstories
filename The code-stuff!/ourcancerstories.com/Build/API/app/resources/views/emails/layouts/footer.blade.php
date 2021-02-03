<div class='footer'>
	<table role='presentation' border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<td class='content-block zero-pb'>
				<img class='footer-logo' src='{{ env('WWW_URL') }}/img/email-logo.png'>
			</td>
		</tr>
		<tr>
			<td class='content-block zero-ps'>
				<p style='color:#000000;max-width:200px;margin-top:2px;'>{{ env('MARKETING_MESSAGE') }}</p>
			</td>
		</tr>
		<tr>
			<td class='content-block zero-pb'>
				<span>Copyright &copy; {{ date('Y', time()) }}, All rights reserved.</span>
			</td>
		</tr>
		<tr>
			<td class='content-block zero-ps'>
				<span>Sent by <a href='{{ env('WWW_URL') }}'>AtomizeCRM</a></span>
			</td>
		</tr>
			@yield('unsubscribe')
		</tr>
	</table>
</div>
