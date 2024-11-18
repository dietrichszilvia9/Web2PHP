<?php
	class Szolgaltatas {
		
		public function alkotok()  {
			$eredmeny = "";
			
			try {
				$dbh = new PDO('mysql:host=localhost;dbname=operett', 'operett', 'MizoKakao_1',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
		
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
			}
			catch (PDOException $e) {
			  $eredmeny["hibakod"] = 1;
			  $eredmeny["uzenet"] = $e->getMessage();
			}
			return $eredmeny;
		}
		
		public function muvek()  {
			$eredmeny = "";

			try {
				$dbh = new PDO('mysql:host=localhost;dbname=operett', 'operett', 'MizoKakao_1',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
				$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
		
				$sql = "select m.cim,m.eredeti,m.szinhaz,m.ev,a.nev from operett.mu m join operett.kapcsolat k on m.id=k.muid join operett.alkoto a on a.id=k.alkotoid";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th>Mű címe</th><th>Eredeti cím</th><th>Színház</th><th>Évszám</th><th>Alkotó</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1.3px solid black; text-align: center; padding: 5px; margin: 2px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			}
			catch (PDOException $e) {
			  $eredmeny["hibakod"] = 1;
			  $eredmeny["uzenet"] = $e->getMessage();
			}
			
			return $eredmeny;
		}

	}
	$options = array(
	"uri" => "http://operett.nhely.hu/soap_szerver.php");
	$server = new SoapServer(null, $options);
	$server->setClass('Szolgaltatas');
	$server->handle();
?>
