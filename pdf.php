<?php

require_once('tcpdf/tcpdf.php');

$param1 = $_POST["text1"];
$param2 = $_POST["text2"];
$param3 = $_POST["dropdown"];

class MYPDF extends TCPDF {

	public function LoadData($cim, $alkoto, $relacio) {
		$rows = array();

		try {
			
			$dbh = new PDO('mysql:host=localhost;dbname=operett', 'operett', 'MizoKakao_1',
						array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
			$sql = "";
			if($relacio == "AND")
			{
				$sql = "select m.cim,m.eredeti,m.szinhaz,m.ev,a.nev from operett.mu m join operett.kapcsolat k on m.id=k.muid join operett.alkoto a on a.id=k.alkotoid where m.cim LIKE :cim AND a.nev LIKE :alkoto"; 
			} else {
				$sql = "select m.cim,m.eredeti,m.szinhaz,m.ev,a.nev from operett.mu m join operett.kapcsolat k on m.id=k.muid join operett.alkoto a on a.id=k.alkotoid where m.cim LIKE :cim OR a.nev LIKE :alkoto"; 				
			}
			    
			$sth = $dbh->prepare($sql);
			$sth->bindValue(':cim', '%'.$cim.'%');
			$sth->bindValue(':alkoto', '%'.$alkoto.'%');
			$sth->execute();
			$rows = $sth->fetchAll(PDO::FETCH_NUM);
		}
		catch (PDOException $e) {
		}
		return $rows;
	}

	public function ColoredTable($caption, $header,$rows) {
		$this->SetFont('times', 'B', 16);
		$this->SetTextColor(0, 0, 0);

		$this->cell(180, 18, $caption, 0, 0, 'C', 0);
		$this->Ln();
		
		$this->SetLineWidth(0.2);

		$this->SetFont('times', 'B', 10);
		$this->SetFillColor(0, 0, 0);
		$this->SetTextColor(255,255,255);
		$this->SetDrawColor(0,0,0);

		$w = array(45, 40, 40, 40, 20);
		$num_headers = count($header);
		for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 12, $header[$i], 1, 0, 'C', 1);
		}
		$this->Ln();

		$this->SetFont('times', '', 10);
		$this->SetDrawColor(0,0,0);

		$i = 1;
		foreach($rows as $row) {
			if($i) {
				$this->SetFillColor(255,255,255);
				$this->SetTextColor(0,0,0);
			}
			else {
				$this->SetFillColor(240,240,240);
				$this->SetTextColor(0,0,0);
			}
			$this->Cell($w[0], 14, $row[0], 'LRB', 0, 'R', 1, '', 0, false, 'T', 'T');
			$this->Cell($w[1], 14, $row[1], 'LRB', 0, 'L', 1, '', 0, false, 'T', 'T');
			$this->Cell($w[2], 14, $row[2], 'LRB', 0, 'L', 1, '', 0, false, 'T', 'T');
			$this->Cell($w[3], 14, $row[3], 'LRB', 0, 'L', 1, '', 0, false, 'T', 'T');
			$this->MultiCell($w[4], 14, $row[4], 'LRB','L', 1, 0);
			$this->Ln();
			$i = !$i;
		}
	}
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('operett.nhely.hu');
$pdf->SetTitle('Muvek');
$pdf->SetSubject('Muvek listája');

$pdf->SetHeaderData("nje.png", 15, "Muvek", "MUVEK ALKOTÁSOK\n".date('Y.m.d',time()));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/hun.php')) {
	require_once(dirname(__FILE__).'/lang/hun.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetFont('Helvetica', '', 14, '', true);

$pdf->AddPage();

$caption = 'Operett adatbázis extraktum';

$header = array('Név', 'Eredeti név', 'Színház', 'Évszám', 'Alkotó neve');

$rows = $pdf->LoadData($param1,$param2,$param3);

$pdf->ColoredTable($caption, $header, $rows);

$pdf->Output('muvek.pdf', 'I');