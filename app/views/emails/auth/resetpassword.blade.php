<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form: {{ URL::route('get.admin.pwdreset', array($token)) }}.<br/>
		</div>
	</body>
</html>