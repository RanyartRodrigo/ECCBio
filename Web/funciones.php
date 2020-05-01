<?php
	function limpia($text){
		$text=str_replace(" ", "",$text);
		$text=str_replace("á", "a",$text);
		$text=str_replace("é", "e",$text);
		$text=str_replace("í", "i",$text);
		$text=str_replace("ó", "o",$text);
		$text=str_replace("ú", "u",$text);
		$text=str_replace("Á", "A",$text);
		$text=str_replace("É", "E",$text);
		$text=str_replace("Í", "I",$text);
		$text=str_replace("Ó", "O",$text);
		$text=str_replace("Ú", "U",$text);
		$text=str_replace("ñ", "n",$text);
		$text=str_replace("Ñ", "N",$text);
		return $text;
	}
?>