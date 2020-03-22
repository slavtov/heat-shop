<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Error <?=$errno; ?></title>
</head>
<body>
	<h1>Error <?=$errno; ?></h1>
	<p><b>Type:</b> <?=$type; ?></p>
	<p><b>Text:</b> <?=$errstr; ?></p>
	<p><b>File:</b> <?=$errfile; ?></p>
	<p><b>Line:</b> <?=$errline; ?></p>
	<p>Please, back to <a href="/">main</a></p>
</body>
</html>