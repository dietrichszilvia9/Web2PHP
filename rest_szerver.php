<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=operett', 'operett', 'JELSZO_JON_IDE',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM alkoto";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Alkotó név</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1.3px solid black; text-align: center; padding: 5px; margin: 2px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
			
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);

				echo $incoming;
				
				$sql = "insert into alkoto(nev) values (:nev)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":nev"=>$data["nev"]));			
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." új sor beszúrva: ".$newid;
			break;
			
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);

				if($data['nev'] != "" && $data['id'] != "") 
				{
					$sql = "update alkoto set nev=:nev where id=:id";
					$sth = $dbh->prepare($sql);
					$count = $sth->execute([
								":nev" => $data["nev"],
								":id" => $data["id"]
							]);
					$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
				} else {
					echo "A nev és az id paraméter nem lehet üres.";
				}
			break;
			
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				
				$sql = "delete from alkoto where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>