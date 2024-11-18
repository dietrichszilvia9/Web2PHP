<?php
   $options = array(
   "location" => "http://operett.nhely.hu/soap_szerver.php",
   "uri" => "http://operett.nhely.hu/soap_szerver.php",
   'keep_alive' => false,
   );		
   try {
	$kliens = new SoapClient(null, $options);
	echo $kliens->muvek()."<br>";
	echo $kliens->alkotok()."<br>"; 

   } catch (SoapFault $e) {
		var_dump($e);
   }
?>
