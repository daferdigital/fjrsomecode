<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

<script src="js/jquery-1.2.6.pack.js" type="text/javascript" charset="utf-8"></script>
 <script src="js/jquery-maximage.js" type="text/javascript" charset="utf-8"></script>
 
<style>
	img.bgmaximage {position:fixed !important;}
</style>

<script>
$(function(){
	jQuery('img.bgmaximage').maxImage({
		isBackground: true,
		overflow: 'auto'
 	});
});	
</script>
</head>

<body>
<img src="imagenes/fondo_llam.jpg" src="img_prue.jpg" class="bgmaximage" />  
</body>
</html>