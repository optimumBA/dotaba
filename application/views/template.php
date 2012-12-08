<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<?php echo $content; ?>
	<?php if (Kohana::$environment === Kohana::DEVELOPMENT): ?>
		<?php echo View::factory('profiler/stats') ?>
	<?php endif ?>
</body>
</html>