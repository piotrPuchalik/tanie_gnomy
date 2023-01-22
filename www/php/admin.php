<?php

// połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donde";

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
    <input type="submit" name="buttonAdd2" value="Add">
</form>';


}

if (isset($_POST['buttonAdd2'])) {
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
        $conn = mysqli_connect("localhost", "root", "", "donde");

        $sql = "SELECT * FROM pracownicy WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            echo'ID already exists in the database, please use a different ID';
        } else {
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
}

if(isset($_POST['buttonDelete']))
    {
        echo '<form method="post">
       Id: <input type="text" name="inputID">
       <input type="submit" name="buttonDelete2" value="Submit">
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
            /*$message = "Id doesnt exists";
            echo "<script type='text/javascript'>alert('$message');</script>";*/
            echo 'ID doesnt exists';
        }
    }
}



if(isset($_POST['buttonEdit'])) {

    echo '<form method="post">
    ID: <input type="text" name="id"><br>
    Username: <input type="text" name="username"><br>
    Imie: <input type="text" name="imie"><br>
    Nazwisko: <input type="text" name="nazwisko"><br>
    Haslo: <input type="password" name="haslo"><br>
    Email: <input type="text" name="email"><br>
    Tytul: <input type="text" name="tytul"><br>
    <input type="submit" name="buttonEdit2" value="Edit">
</form>';

}
if (isset($_POST['buttonEdit2'])) {
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
            $conn = mysqli_connect("localhost", "root", "", "donde");
            $sql = "SELECT * FROM pracownicy WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $sql = "UPDATE pracownicy SET username='$username', imie='$imie', nazwisko='$nazwisko', haslo='$haslo', email='$email', tytul='$tytul' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "Record updated successfully";
                    header("location:admin.php");

                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            } else {
                echo "ID does not exist in the database";
            }
            mysqli_close($conn);
        }
    }



//Import
echo'<br>';
echo'<form action="" method="post" name="frmCSVImport" id="frmCSVImport"
	enctype="multipart/form-data" onsubmit="return validateFile()">
	<div Class="input-row">
		<label>Choose your file. </label> 
		<input type="file" name="file" id="file"
			class="file" accept=".csv,.xls,.xlsx">
			<br>
			<button type="submit" id="submit" name="buttonImport" class="btn-submit">Import
				CSV and Save Data</button>
	</div>
</form>';

if(isset($_FILES["file"])) {
    $file_path = $_FILES["file"]["tmp_name"];
    if (file_exists($file_path)) {
        //if($_FILES["file"]["name"] == "pracownicy.csv"
            $status=unlink('pracownicy.csv');
            $new_file_path = "C:/xampp/htdocs/tanie_gnomy/www/php/pracownicy.csv"; //jeszczer raz hehe
            move_uploaded_file($file_path, $new_file_path);
            $file = fopen("pracownicy.csv", "r");
            $string = "pracownicy,csv";


    } else {
        echo "The file doesn't exist in the server";
    }


    $conn = mysqli_connect("localhost", "root", "", "donde");

    /*while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {

        if(isset($data[0]) && isset($data[1]) && isset($data[2])&&isset($data[3])&&isset($data[4])&&isset($data[5])&&isset($data[6])){
            $sql = "INSERT INTO pracownicy (id, username, imie, nazwisko, haslo, email, tytul) VALUES ('$data[0]', '$data[1]', '$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
            mysqli_query($conn, $sql);
        }
    }*/
    if (($handle = fopen("pracownicy.csv", "r")) !== FALSE) {
        $n = 1;
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

            // SQL query to store data in
            // database our table name is
            // table2
            $sql = 'INSERT INTO pracownicy (id, username, imie, nazwisko, haslo, email, tytul) VALUES ("' . $row[0] . '","' . $row[1] . '","' . $row[2] . '","' . $row[3] . '","' . $row[4] . '","' . $row[5] . '","' . $row[6] . '") ON DUPLICATE KEY UPDATE id = "'.$row[0].'", username = "'.$row[1].'", imie = "'.$row[2].'", nazwisko = "'.$row[3].'", haslo = "'.$row[4].'", email = "'.$row[5].'",tytul = "'.$row[6].'"';
            mysqli_query($conn, $sql);
        }
        fclose($file);
        mysqli_close($conn);
        header("location:admin.php");
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