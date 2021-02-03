<!DOCTYPE html>
<html>
	<head>
		<meta name='viewport' content='width=device-width'/>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
		<title>{{ $emailData['subject'] }}</title>
		@include('emails.layouts.styles')
	</head>
	<body>
		<span class='preheader'>{{ $emailData['message']['previewMessage'] }}</span>
		<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
			<tr>
				<td>&nbsp;</td>
				<td class='container'>
					<div class='content'>
						<table role='presentation' class='main'>
							<tr>
								<td class='wrapper'>
									<table role='presentation' border='0' cellpadding='0' cellspacing='0'>
										<tr>
											<td>
												<p></p>
												@yield('main-content')
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						@include('emails.layouts.footer')
					</div>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>
