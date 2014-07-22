<?php
if($argc > 1){
	$csv = fopen($_SERVER['argv'][1], "r");
	$existing = fopen("existing.csv","wb");
	$cc = 1;

	$opts = array(
  	'http'=>array(
    	'method'=>"GET",
    	'header'=>"User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:30.0) Gecko/20100101 Firefox/30.0\r\n" .
    		  	  "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n" .
    		  	  "Accept-language: es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3\r\n" .
              	  "Cookie: foo=bar\r\n"
  				 )
				);

	$context = stream_context_create($opts);

	while (!feof($csv) ) {
		$line = fgetcsv($csv, 1024);

		$number = substr($line[0], 1);

		$datos = file_get_contents("https://v.whatsapp.net/v2/exist?in=$number&cc=$cc", false, $context);
		$try = str_split($datos);
		$exist = $try[11];
		if($exist == "c"){
			echo $cc.$number." - E\n";
			fwrite($existing,$cc.$number.",\n");
			}
		else 
			echo $cc.$number." - F\n";

	}

fclose($csv);
fclose($existing);

}
else
	echo "\nUsage: script.php path/to/file\n"; 

?>