<?php

function uploadFotos($foto,$nome_foto,$nome_foto_pequena,$path_foto,$tipo_arquivo,$foto_existente=NULL){
	
	$new_width 	= 100;
	$new_height = 100;
	
	var_dump($foto['tmp_name']);
	exit;
	
	if($foto['tmp_name']) {
		list($width, $height, $type, $attr) = getimagesize($foto['tmp_name']);
	
	
	$uploadfile 	   = $path_foto.basename($nome_foto);
	$uploadfilepequena = $path_foto.basename($nome_foto_pequena);
		
	move_uploaded_file($foto['tmp_name'], $uploadfile);
		
	if ($tipo_arquivo=="png"){
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$image = imagecreatefrompng($uploadfile);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagepng($image_p, $uploadfilepequena, 1);
	}elseif($tipo_arquivo == "jpg" || $tipo_arquivo == "jpeg"){
		#if ($foto['size'] > 100000){
			$localimage = $uploadfile;
				
			if ($content = file_get_contents($localimage)) {
				if (!empty($content)) {
					$fp = fopen($uploadfilepequena, "w");
					fwrite($fp, $content);
					fclose($fp);
				}
			}
			#$image_p = imagecreatetruecolor($width, $height);
			#$image = imagecreatefrompng($uploadfile);
			#imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			#imagepng($image_p, $uploadfilepequena, 100);
		#}else{
		#	$localimage = $uploadfile;
			
		#	if ($content = file_get_contents($localimage)) {
		#		if (!empty($content)) {
		#			$fp = fopen($uploadfilepequena, "w");
		#			fwrite($fp, $content);

		#	fclose($fp);
		#	}
		#}
			
// 			$image_p = imagecreatetruecolor($width, $height);
// 			$image = imagecreatefromjpeg($uploadfile);
// 			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
// 			imagejpeg($image_p, $uploadfilepequena, 100);		
		#}	
	}elseif($tipo_arquivo == "gif"){
		$image = imagecreatefromgif($uploadfile);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagegif($image_p, $uploadfilepequena, 100);
	}else{
		echo "<script>alert('Erro ao incluir Pessoa');history.go(-1);</script>";
		exit();
	}
		
	imagedestroy($image_p);
	
	if ($foto_existente){
		$arrayFoto = explode(".",$foto_existente);
		$foto_normal = $path_foto.basename($arrayFoto[0].".".$arrayFoto[1]);
		$foto_tumb   = $path_foto.basename($arrayFoto[0]."_tumb.".$arrayFoto[1]);
		unlink(realpath($foto_normal));
		unlink(realpath($foto_tumb));
	}
	}
	
	
	
}


?>