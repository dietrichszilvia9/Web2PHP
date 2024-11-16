<?php
$url = "http://operett.nhely.hu/rest_szerver.php";
$result = "";
if(isset($_POST['id']))
{
  $_POST['id'] = trim($_POST['id']);
  $_POST['nev'] = trim($_POST['nev']);
  
  if($_POST['id'] == "" && $_POST['nev'] != "") //POST - INSERT
  {
      $data = Array("nev" => $_POST["nev"]);
      $ch = curl_init($url);
	  
      curl_setopt($ch, CURLOPT_POST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  elseif($_POST['id'] >= 1 && ($_POST['nev'] != "")) //PUT - UPDATE
  {
      $data = Array("id" => $_POST["id"], "nev" => $_POST["nev"]);
      $ch = curl_init($url);
	  
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  elseif($_POST['id'] >= 1) //DELETE
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
	  
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  else
  {
    echo "Hiba: Rossz azonosító: ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restful-kliens</title>
</head>
<body>
    <?= $result ?>
    <br>
    <h2>Módosítás / Beszúrás</h2>
	<p>Törléshez írjon be csak egy ID-t.<br>Frissítéshez írjon be egy ID-t és egy nevet.<br>Új beszúráshoz írjon be csak egy nevet.</p>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Alkotó név: <input type="text" name="nev" maxlength="45"><br><br>
    <input type="submit" value = "Küldés">
    </form>
	<h1>Alkotók (GET)</h1>
    <?= $tabla ?>
</body>
</html>
