 <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> 
 <link rel="stylesheet" href="css/style.css">

<?php
function upload_file($path, $new_name){
		
	//$userfile_error is size in bytes
	$userfile_error = @$_FILES['file']['error'];

	if ($userfile_error > 0){
		echo '<div align=center><b>Problem: ';
		switch ($userfile_error){
			case 1: echo 'Photo exceeded upload_max_filesize Go <a href="javascript:history.go(-1)">Back</a>'; break;
			case 2: echo 'Photo exceeded 25KB Go <a href="javascript:history.go(-1)">Back</a>'; break;
			case 3: echo 'Photo only partially uploaded Go <a href="javascript:history.go(-1)">Back</a>'; break;
			case 4: echo 'No passport photo uploaded Go <a href="javascript:history.go(-1)">Back</a>'; break;
			}
			exit;
		}
	/*$userfile_error = $_FILES['file']['error'];
	
	if($userfile_error==4){
	echo 'You have not attached a passport photograph. Go <a href="javascript:history.go(-1)">Back</a> and attach it';
	exit;
	}
*/
	//$userfile where file went on webserver
	$userfile = @$_FILES['file']['tmp_name'];

	//$userfile_name is original fie name
	$userfile_name = @$_FILES['file']['name'];

	//$userfile_size is size in bytes
	$userfile_size = @$_FILES['file']['size'];

	//$userfile_type is mime type
	$userfile_type = @$_FILES['file']['type'];
	
	$extension = explode('.',$userfile_name);

	$exten = @$extension[1];
	
	if (($exten != 'gif') && ($exten != 'jpg') && ($exten != 'png') && ($exten != 'jpeg') && ($exten != 'JPG')){
			echo '<div align=center><b>Your passport photo MUST be JPEG, GIF OR PNG. The passport submitted is: '.$userfile_name.' Go <a href="javascript:history.go(-1)">Back</a> and re-select a passport photo with the right extension';
			exit;
			}
	
	global $newfile_name;
	
	$newfile_name = time().'.'.$extension[1];

	/*check if the file is of the right MIME type
	if ($userfile_type != 'image/gif'){
		echo 'The picture should either be in JPEG or GIF format';
		exit;
		}
	*/
	//put file in the right directory/* || ($userfile_type != 'image/gif'))*/
	$upfile = $path.'/'.$newfile_name;
	
	if (is_uploaded_file($userfile)){
		if (!move_uploaded_file($userfile, $upfile)){
			echo 'Could not move file to destination directory';
			exit;
			}
		}
	else {
		echo 'Problem: Possible file upload attack. Filename: '.$userfile_name;
		exit;
		}
	;
}	
?>


