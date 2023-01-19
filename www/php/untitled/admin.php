<?php

// połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$conn = new mysqli("$servername", $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id,username,imie,nazwisko,haslo,email,tytul FROM pracownicy";
//fire query
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
{
echo '<table> <tr> <th> Id </th> <th> username </th> <th> imie </th> <th> nazwisko </th><th> haslo </th><th> email </th><th> tytul </th> </tr>';
    while($row = mysqli_fetch_assoc($result)){
    // to output mysql data in HTML table format
    echo '<tr > <td>' . $row["id"] . '</td>
        <td>' . $row["username"] . '</td>
        <td> ' . $row["imie"] . '</td>
        <td>' . $row["nazwisko"] . '</td>
        <td>' . $row["haslo"] . '</td>
        <td>' . $row["email"] . '</td>
        <td>' . $row["tytul"] . '</td>
        </tr>';

    }

    echo '</table>';
    echo'<form method="POST">';
    echo '<button class="ADD" type="submit" name="buttonAdd">ADD</input></button>';
    echo '<button class="DELETE" type="submit" name="buttonDelete">DELETE</input></button>';
    echo '<button class="EDIT" type="submit" name="buttonEdit">EDIT</input></button>';
    echo '</form>';

}
else
{
echo "0 results";
}


if(isset($_POST['buttonAdd']))
{
    echo'<form method="post">
    ID: <input type="text" name="id"><br>
Username: <input type="text" name="username"><br>
Imie: <input type="text" name="imie"><br>
Nazwisko: <input type="text" name="nazwisko"><br>
Haslo: <input type="password" name="haslo"><br>
Email: <input type="text" name="email"><br>
Tytul: <input type="text" name="tytul"><br>
    <input type="submit" name="submit" value="Add">
</form>';


}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $haslo = $_POST['haslo'];
    $email = $_POST['email'];
    $tytul = $_POST['tytul'];

    $error = false;
    if (empty($id)) {
        echo "ID is required <br>";
        $error = true;
    }
    if (empty($username)) {
        echo "Username is required <br>";
        $error = true;
    }
    if (empty($imie)) {
        echo "Imie is required <br>";
        $error = true;
    }
    if (empty($nazwisko)) {
        echo "Nazwisko is required <br>";
        $error = true;
    }
    if (empty($haslo)) {
        echo "Haslo is required <br>";
        $error = true;
    }
    if (empty($email)) {
        echo "Email is required <br>";
        $error = true;
    }
    if (empty($tytul)) {
        echo "Tytul is required <br>";
        $error = true;
    }

    if (!$error) {
        $conn = mysqli_connect("localhost", "root", "", "projekt");
        $sql = "INSERT INTO pracownicy (id, username, imie, nazwisko, haslo, email, tytul)
        VALUES ('$id', '$username', '$imie', '$nazwisko', '$haslo', '$email', '$tytul')
        ON DUPLICATE KEY UPDATE 
        username = '$username', imie = '$imie', nazwisko = '$nazwisko', haslo = '$haslo', email = '$email', tytul = '$tytul' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        header("location:admin.php");
        mysqli_close($conn);
    }
}


if(isset($_POST['buttonDelete']))
    {
        echo '<form method="post">
       Id: <input type="text" name="inputID">
       <input type="submit" name="submitID" value="Submit">
    </form>';
    }
if (isset($_POST['inputID'])) {
    $id = $_POST['inputID'];
    if(is_numeric($id) == true)
        {
            $sql = "SELECT id FROM pracownicy WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            foreach($result as $row) {
            $result1 = $row['id'];
            echo'result = ';
            echo $result1;
            echo '<br>';
        }
    settype($result1,"integer");
    if ($result1 > 0)
        {
            $sql = "DELETE FROM pracownicy WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            header("location:admin.php");
        }
    else
        {
            $message = "Id doesnt exists";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
<style>
    table, th, td {
        border: 1px solid;
    }
</style>

<!DOCTYPE HTML>
<html lang="pl-PL">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Admin page">
    <title>¿Donde? -Admin page</title>
  </head>
  <body>

  </body>
</html>