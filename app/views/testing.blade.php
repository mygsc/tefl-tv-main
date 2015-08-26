<?php $mystring = "<a href='https://google.com'>click's me</a>"; ?>

<html>
<head>
	<meta property="og:description" content='{{ preg_replace("/&#?[a-z0-9]{2,8};/i","",$mystring); }}'>
</head>
<body align="center">

</body>
</html>