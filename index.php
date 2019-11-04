<?php 
$path = './video.json';
$token_validate = 'bs22ds4a55ds1wee55d12s3a5d';

$html = false;

if(isset($_POST['form_valid_token']) && $_POST['form_valid_token'] == $token_validate){
	if(file_put_contents($path, $_POST['datos'])){
		echo json_encode(["DG_status"=>"Guardo"]);
	}else{
		echo json_encode(["DG_status"=>"Error"]);
	}
}else{

	$content = json_decode(file_get_contents($path));
	if(!$html){
		echo '[';
	}

	foreach ($content->request->files->progressive as $key => $value) {
		if($value->width == '1920' && $value->height == '1080'){
			if(!$html){
				echo json_encode($value,JSON_UNESCAPED_SLASHES);
			}else{
				echo '<center><a href="'.$value->url.'" target="_blank">Abrir video</a> <br><br><br></center>';
			}
		}

	}
	if(!$html){
		echo ','; 
	}

}
	if(!$html){
		echo json_encode(["Volver"=>"https://localhost/step2.php"],JSON_UNESCAPED_SLASHES);
		echo ']'; 
	}else{
		echo '<center><a href="https://localhost/step2.php">Extraer otro video</a> </center><br>';
	}
 ?>