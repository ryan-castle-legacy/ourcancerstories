<style>

	img {
		border: none;
		-ms-interpolation-mode: bicubic;
		max-width: 100%;
	}

	body {
		background-color: #f6f6f6;
		font-family: sans-serif;
		-webkit-font-smoothing: antialiased;
		font-size: 14px;
		line-height: 1.4;
		margin: 0;
		padding: 0;
		-ms-text-size-adjust: 100%;
		-webkit-text-size-adjust: 100%;
	}

	table {
		border-collapse: separate;
		mso-table-lspace: 0pt;
		mso-table-rspace: 0pt;
		width: 100%;
	}

	table td {
		font-family: sans-serif;
		font-size: 14px;
		vertical-align: top;
	}

	.body {
		background-color: #ffffff;
		width: 100%;
	}

	.container {
		display: block;
		margin: 0 auto !important;
		max-width: 580px;
		padding: 10px;
		width: 580px;
	}

	.content {
		box-sizing: border-box;
		display: block;
		margin: 0 auto;
		max-width: 580px;
		padding: 10px;
	}

	.main {
		background: #ffffff;
		border-radius: 3px;
		width: 100%;
	}

	.wrapper {
		box-sizing: border-box;
		padding: 0px 0px 0px 0px;
	}

	.content-block {
		padding-bottom: 10px;
		padding-top: 10px;
	}

	.zero-pb {
		padding-bottom: 0px;
	}

	.zero-pt {
		padding-top: 0px;
	}

	.zero-ps {
		padding-top: 4px;
	}

	.footer {
		clear: both;
		margin: 20px 0px 20px 0px;
		padding: 20px 0px 20px 0px;
		text-align: left;
		width: 100%;
		border-top: 1px solid #cfcfcf;
	}

	.footer td,
	.footer p,
	.footer span,
	.footer a {
		color: #999999;
		font-size: 12px;
		text-align: left;
	}

	.add-mb {
		margin-bottom: 18px;
	}

	.add-mt {
		margin-top: 28px;
	}

	h1,
	h2,
	h3,
	h4 {
		color: #000000;
		font-family: sans-serif;
		font-weight: 400;
		line-height: 1.4;
		margin: 0;
		margin-bottom: 30px;
	}

	h1 {
		font-size: 35px;
		font-weight: 300;
		text-align: left;
		text-transform: capitalize;
	}

	p,
	ul,
	ol {
		font-family: sans-serif;
		font-size: 14px;
		font-weight: normal;
		margin: 0;
		margin-bottom: 15px;
	}

	p li,
	ul li,
	ol li {
		list-style-position: inside;
		margin-left: 5px;
	}

	a {
		color: #735fd7;
		text-decoration: underline;
	}

	p.bold {
		font-weight: 800;
		font-size: 16px;
	}

	p.team {
		margin-top: -10px;
		font-weight: 800;
		font-size: 15px;
	}

	.btn {
		box-sizing: border-box;
		width: 100%;
	}

	.btn > tbody > tr > td {
		padding-bottom: 15px;
	}

	.btn table {
		width: auto;
	}

	.btn table td {
		background-color: #ffffff;
		border-radius: 4px;
		text-align: left;
	}

	.btn a {
		background-color: #ffffff;
		border: solid 1px #735fd7;
		border-radius: 4px;
		box-sizing: border-box;
		color: #735fd7;
		cursor: pointer;
		display: inline-block;
		font-size: 14px;
		font-weight: bold;
		margin: 0;
		padding: 12px 18px;
		text-decoration: none;
		text-transform: capitalize;
	}

	.btn-primary table td {
		background-color: #735fd7;
	}

	.btn-primary a {
		background-color: #735fd7;
		border-color: #735fd7;
		color: #ffffff;
	}

	.last {
		margin-bottom: 0;
	}

	.first {
		margin-top: 0;
	}

	.align-center {
		text-align: center;
	}

	.align-right {
		text-align: right;
	}

	.align-left {
		text-align: left;
	}

	.clear {
		clear: both;
	}

	.mt0 {
	margin-top: 0;
	}

	.mb0 {
		margin-bottom: 0;
	}

	.preheader {
		color: transparent;
		display: none;
		height: 0;
		max-height: 0;
		max-width: 0;
		opacity: 0;
		overflow: hidden;
		mso-hide: all;
		visibility: hidden;
		width: 0;
	}

	hr {
		border: 0;
		border-bottom: 1px solid #f6f6f6;
		margin: 20px 0;
	}

	.footer-logo {
		width: 200px;
		height: auto;
	}

	@media only screen and (max-width: 620px) {

		table[class=body] h1 {
			font-size: 28px !important;
			margin-bottom: 10px !important;
		}

		table[class=body] p,
		table[class=body] ul,
		table[class=body] ol,
		table[class=body] td,
		table[class=body] span,
		table[class=body] a {
			font-size: 16px !important;
		}

		table[class=body] .wrapper,
		table[class=body] .article {
			padding: 10px !important;
		}

		table[class=body] .content {
			padding: 0 !important;
		}

		table[class=body] .container {
			padding: 0 !important;
			width: 100% !important;
		}

		table[class=body] .main {
			border-left-width: 0 !important;
			border-radius: 0 !important;
			border-right-width: 0 !important;
		}

		table[class=body] .btn table {
			width: 100% !important;
		}

		table[class=body] .btn a {
			width: 100% !important;
		}

		table[class=body] .img-responsive {
			height: auto !important;
			max-width: 100% !important;
			width: auto !important;
		}
	}

	@media all {

		.ExternalClass {
			width: 100%;
		}

		.ExternalClass,
		.ExternalClass p,
		.ExternalClass span,
		.ExternalClass font,
		.ExternalClass td,
		.ExternalClass div {
			line-height: 100%;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
			font-size: inherit;
			font-family: inherit;
			font-weight: inherit;
			line-height: inherit;
		}

		.btn-primary table td:hover {
			background-color: #735fd7 !important;
		}

		.btn-primary a:hover {
			background-color: #735fd7 !important;
			border-color: #735fd7 !important;
		}
	}

</style>
