<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Admin registration</h2>

		<div>
			To reset your password, complete this form: {{ URL::route('get.admin.adminsignup', array($code)) }}.<br/>
		</div>
	</body>
</html>