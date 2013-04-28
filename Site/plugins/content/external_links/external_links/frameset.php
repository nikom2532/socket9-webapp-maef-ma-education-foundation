<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $_GET['url']; ?></title>
</head>
 
 
<frameset border="0" rows="90,*">
	<frame rel="nofollow" id="up" name="up" src="up.html" scrolling="no" />
	<frame rel="nofollow" id="down" name="down" src="<?php echo $_GET['url']; ?>" scrolling="auto" />
 
 
	<noframes>
		<body>
			<p>Esta página utiliza marcos, pero su explorador no las admite. <a href="http://www.mozilla-europe.org/">Descarga</a> la última versión</p>
		</body>
	</noframes>
</frameset>