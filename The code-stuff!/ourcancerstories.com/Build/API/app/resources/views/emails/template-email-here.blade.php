@extends('emails.layouts.accounts')

@section('main-content')
	<p class='bold'>Hello {{ $emailData['message']['name'] }}!</p>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary add-mt add-mb'>
		<tbody>
			<tr>
				<td align='left'>
					<table role='presentation' border='0' cellpadding='0' cellspacing='0'>
						<tbody>
							<tr>
								<td><a href='{{ env('WWW_URL') }}' target='_blank'>Call To Action</a></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	<p>Catch you later!</p>
	<p class='team'>{{ env('EMAIL_TEAM_NAME') }}</p>
@endsection

@section('unsubscribe')
	<td class='content-block'>
		<a href='{{ env('WWW_URL') }}'>Unsubscribe</a>.
	</td>
@endsection
