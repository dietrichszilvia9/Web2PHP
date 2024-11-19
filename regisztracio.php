<?php
// Kapcsolódás az adatbázishoz
$servername = "localhost";
$username = "operett";
$password = "MizoKakao_1";
$dbname = "operett";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (email, username, full_name, password_hash) VALUES ('$email', '$username', '$full_name', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
</head>
<body>
    <h1>Regisztráció</h1>
    <form action="regisztracio.php" method="POST">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="username">Felhasználónév:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="full_name">Teljes név:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Regisztráció</button>
    </form>
</body>
</html>
