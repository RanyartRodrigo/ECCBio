<?php	
	if ( 0 < $_FILES['file']['error'] ) {
        $jsondata[0] = "Error no file";
    } else {
		$name = date('jnyGis');	
		$fileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
		if(strtolower($fileType) == "kml" || strtolower($fileType) == "kmz"){
			if(move_uploaded_file($_FILES["file"]["tmp_name"], "/var/www/html/utilities/$name.$fileType")) {
				$jsondata[0] = true;
				$jsondata[1] = "http://www.wegp.unam.mx/utilities/$name.$fileType";
				exec("{ sleep 10; rm -f /var/www/html/utilities/$name.$fileType; } > /dev/null 2>/dev/null &");
			} else {
				$jsondata[0] = "Error no move";
			}
		} else {
			$jsondata[0] = "Error no type $fileType ".$_FILES["file"]["name"];
		}		
	}	
	echo json_encode($jsondata);
?>
