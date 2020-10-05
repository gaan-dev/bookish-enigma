<?php

// Helper functions,
function verifyCsrf(){
	if (!empty($_POST['token'])) {
	    if (hash_equals($_SESSION['token'], $_POST['token'])) {
	         return true;
	    } else {
	    	return false;
	    }
	}
}

function redirect($url){
	return header("Location: {$url}");
}

// Shamelessly stolen from W3schools of all places. I guess it'll do?
function storeFile($file){
	$relative_dir = '/images/';
	$relative_uri = $relative_dir . bin2hex(random_bytes(16)) . '.' . pathinfo($file["name"])['extension'];
	$target_file = __DIR__.'/../public' . $relative_uri;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($file["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

	// Check file size
	if ($file["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($file["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	return $relative_uri;
}

function sanitize($payload){
	foreach($payload as $key=>$value){
		$value = stripslashes($value);
	}
	return $payload;
}
