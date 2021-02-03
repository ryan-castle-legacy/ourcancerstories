@extends('emails.layouts.accounts')

@section('main-content')
	<p class='bold'>Hi {{ $emailData['message']['name'] }},</p>
	<p>Let's reset your password so you can get back to your account.</p>
	<table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary add-mt add-mb'>
		<tbody>
			<tr>
				<td align='left'>
					<table role='presentation' border='0' cellpadding='0' cellspacing='0'>
						<tbody>
							<tr>
								<td><a href='{{ env('WWW_URL') }}/reset-password/{{ $emailData['message']['resetPasswordToken'] }}' target='_blank'>Reset Password</a></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<p>If you did not ask to reset your password, you may want to review your recent account access for any unusual activity.</p>
	<p>We're here to help if you need it.</p>
	<p class='team'>{{ env('EMAIL_TEAM_NAME') }}</p>
@endsection

@section('unsubscribe')
@endsection
