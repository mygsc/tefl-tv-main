<html>
<head></head>
<body align="center">
	{{ HTML::script('js/jwplayer/jwplayer.js')}}
	<script>jwplayer.key="c/DHClHu78RC4CxchFupQwt8/CyvNot0VjHn7A==";</script>
	<div id="myElement"></div>

	<script>
		var playerInstance = jwplayer("myElement");
		playerInstance.setup({
			image: "/videos/tefltv.mp4",
			file: "/videos/tefltv_partners.mp4",
			title: "My Cool Trailer"
		});
	</script>
</body>
</html>