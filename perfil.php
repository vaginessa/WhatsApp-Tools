<html>
<head>
	<title>WA Tools</title>
</head>
<body>
  <div>
    <div>
      <div>
<div>
          <div>
            <div></div>
            <div>
            <div>
              <h2>WA Tools</h2>
             
                <ol>
                  <li>
                    <div>
                        <h3>Información del contacto / Contact information</h3>
                        <ul>
                          
                          
                        </ul>

                     
             
<?php

 
 $username = '';
 $password = '';
 $debug = false;
 $contacts = $_POST["pais"].$_POST["numero"];
 $msg = $_POST["mensaje"];
 set_time_limit(10);
 require_once '/src/whatsprot.class.php';



$nickname = "WA Tools";
$target = $contacts;
 
$w = new WhatsProt($username, $identity, $nickname, $debug);
$w->connect();

$w->loginWithPassword($password);

if($msg!=""){
echo "<b>El mensaje:</b> ".$msg."  <b>Ha sido enviado con éxito.</b><br><br>";
$w->sendMessage($contacts , $msg);
$w->sendMessage($contacts , "Mensaje enviado desde http://watools.es");

}

function onGetRequestLastSeen($username, $msgid, $seconds)
{
	//echo "Received last seen seconds: '$seconds'";
    //$now = time();
    //$lastSeen = $now - $seconds;
   
    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($seconds / $secondsInADay);

    // extract hours
    $hourSeconds = $seconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the value
    if (($seconds==null) & ($minutes==null) & ($hours==null) & ($days==null))
    	echo "El contacto tiene desactivado esta función";
    else if (($seconds==0) & ($minutes==0) & ($hours==0) & ($days==0))
    	echo "En línea";
    else
    	echo $days . " días " . $hours . " horas " . $minutes . " minutos";
  
}

$w->eventManager()->bind('onGetRequestLastSeen', 'onGetRequestLastSeen');
$w->sendGetRequestLastSeen($contacts);


//This function only needed to show how eventmanager works.
function onGetProfilePicture($from, $target, $type, $data)
{
    if ($type == "preview") {
        $filename = "preview_" . $target . ".jpg";
    } else {
        $filename = $target . ".jpg";
    }
    $filename = WhatsProt::PICTURES_FOLDER."/" . $filename;
    

    $fp = @fopen($filename, "w");
    if ($fp) {
        fwrite($fp, $data);
        fclose($fp);
    
    }
    
    echo '<a href="'.$filename.'"><center><img src="'.$filename.'" height="250" width="250"></center></a><br><br>';
    echo '<center><b>Pulsa en la imagen para verlo a tamaño completo</b></center>';
    
    
}


$w->eventManager()->bind("onGetProfilePicture", "onGetProfilePicture");
$w->sendGetProfilePicture($target, true);
 
?>
 <ul>
                          <li>
                          </li>
                        </ul>
                      <div>
                      </div>
                    </div>
                  </li>
                </ol>
</html>
