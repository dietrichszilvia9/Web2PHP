<?php
$servername = "localhost";
$username = "operett";
$password = "MizoKakao_1";
$dbname = "operett";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            echo "Sikeres bejelentkezés!";
    		session_start();
    		$_SESSION['username'] = $username;
			$_SESSION['role_id'] = $row['role_id'];
	
    		header("Location: http://operett.nhely.hu/index.php");
    		exit();
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nem létező felhasználónév!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
</head>
<body>
    <h1>Bejelentkezés</h1>
    <form action="bejelentkezes.php" method="POST">
        <label for="username">Felhasználónév:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Bejelentkezés</button>
    </form>
</body>
</html>
