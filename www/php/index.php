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
echo '<p>Logowanie</p>
<form action="" method="post">
    Login: <input type="text" name="username"><br>
    Hasło: <input type="password" name="password"><br>
    <input type="submit" value="Zaloguj">
</form>';
// pobranie danych z formularza
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    /*// zapytanie do bazy danych
    $sql = "SELECT id, username, password FROM admini WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // pobranie wiersza z danymi użytkownika
        $row = $result->fetch_assoc();
    }*/
// Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM admini WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
// Jeśli znaleziono użytkownika, ustawiamy sesję i wysyłamy odpowiedź "success"
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        echo "success";
        header('Location: admin.php');
    } else {
        // W przeciwnym razie wyświetlamy błąd
        echo "error: Invalid username or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donde</title>
    <link rel="shortcut icon" href="logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;900&display=swap"
            rel="stylesheet"
    />
</head>
<body>

</body>
</html>