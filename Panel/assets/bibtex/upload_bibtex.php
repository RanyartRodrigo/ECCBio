<?php

$target_dir = "../../uploads";

$fileName=basename($_FILES["file"]["name"]);

$fileType = pathinfo($fileName,PATHINFO_EXTENSION);

$newFileName=uniqid()."-".$fileName;

$uploadOk = 1;

// BIB EXTENSION VALIDATION

	if($fileType=="bib"){
		//echo "File is a bib file." ;
		$uploadOk = 1;
	} else{
		//echo "Not a bib file";
		$uploadOk = 0;
	}

//FILE UPLOAD
	if ($uploadOk == 0) {
		echo 1;
	} else { // if everything is ok, try to upload file
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$newFileName)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			//echo "File: ".$newFileName;
			//
			$_GET['library']=1;
			require_once('bibtexbrowser.php');
			global $db;
			$db = new BibDataBase();
			$db->load($target_dir.$newFileName);
			
			$_GET['bib']=$target_dir.$newFileName;
			$_GET['all']=1;
			$_GET['academic']=1;
			$_GET['author']
			include( 'bibtexbrowser.php' );
		
			///
			unlink($target_dir.$newFileName);
			
		} else {
			echo 2;
		}
	}
?>

