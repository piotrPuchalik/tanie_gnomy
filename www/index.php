<?php
    if (isset($_GET['error'])) {
        echo '<p> Błędny login lub hasło. </p>';
    }
?>
<?php
session_start();
// połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$conn = new mysqli("$servername", $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// pobranie danych z formularza
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}
// zapytanie do bazy danych
$sql = "SELECT id, username, password FROM admini WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // pobranie wiersza z danymi użytkownika
    $row = $result->fetch_assoc();
}




$conn->close();
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <link rel="stylesheet" href="../style/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Donde? - Login page</title>
    <link rel="shortcut icon" href="logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;900&display=swap"
            rel="stylesheet"
    />
</head>
<body>
    <div>
            <div class="logowanie">
                <h1>Logowanie</h1>
                <img type="shortLine" src="../grafiki/shortLine.svg" alt="error">
            <form action="login.php" method="post">
                <!-- <label for="username">Nazwa użytkownika:</label> -->
                <input type="text" id="username" name="username" placeholder="Nazwa użytkownika" required>
                <img type="longLine" src="../grafiki/longLine.svg" alt="error">
                <!-- <label for="password">Hasło:</label> -->
                <input type="password" id="password" name="password" placeholder="Hasło" required>
                <img type="longLine" src="../grafiki/longLine.svg" alt="error">
                <input type="submit" name="submit" value="Zaloguj">
                <p id="error"></p>
            </form>
        </div>
    </div>
</body>
</html>