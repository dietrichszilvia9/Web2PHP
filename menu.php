<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=operett', 'operett', 'JELSZÓ', 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
} catch (PDOException $e) {
    die("Hiba: " . $e->getMessage());
}

$sql = "SELECT m.*,p.page_link FROM menu_items m left join pages p on m.page_id=p.page_id ORDER BY m.parent_id, m.order_num";
$sth = $dbh->query($sql);
$menuItems = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
