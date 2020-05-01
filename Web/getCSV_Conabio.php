<?php  
	//Error reporting
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	// header('Content-Type: text/html; charset=UTF-8');
	$file = $_REQUEST['file'];

	
	function csv_to_array($filename='', $delimiter=',')
	{
	    if(!file_exists($filename) || !is_readable($filename))
	        return FALSE;

	    $header = NULL;
	    $data = array();
	    if (($handle = fopen($filename, 'r')) !== FALSE)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
	        {
	            if(!$header)
	                $header = $row;
	            else
	                // $data[] = array_combine($header, $row);
	                $data[] = array(mb_convert_encoding($row, "UTF-8", "auto"));
	        }
	        fclose($handle);
	    }
	    return $data;
	}
	
	
	//header('Access-Control-Allow-Origin: http://www.wegp.unam.mx', false);
	
	if (($handle = fopen($file, "r")) === FALSE)
    throw new Exception("Couldn't open books.csv");

	$data = "";

	// get file all strin in data
	while (!feof($handle)) {
	    $data .= fgets($handle, 5000);
	}

	// convert encoding
	//$data = mb_convert_encoding($data, "UTF-8", "auto");

	// str_getcsv
	//$csv = str_getcsv($data);
	
	//$csv = array_map('str_getcsv', $data);
	$csv = array_map('str_getcsv', file($file));
	//$csv = array_map('utf8_encode', file($file));
	//$csv = csv_to_array($file);
	
	echo json_encode($csv);
?>
