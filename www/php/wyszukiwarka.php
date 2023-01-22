<?php

error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['function'])) {
        $function = $_POST['function'];
        if ($function == "function1") {
            function1();
        } elseif ($function == "function2") {
            function2();
        }
    }
}
function function1(){
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "donde";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
if(isset($_POST['employeeName']) or isset($_POST['employeeSurname']) or isset($_POST['date']) or isset($_POST['time']) == NULL) */
//get the search query from the form


    $employeeName = mysqli_real_escape_string($conn, $_POST['employeeName']);
    $employeeSurname = mysqli_real_escape_string($conn, $_POST['employeeSurname']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    /*    echo $time;
        echo '<br>';
        echo '8:15-10:00';*/
    if (strcmp($time, '8:15-10:00') == 0) {

        $time2 = '10:15-12:00';
    }
//build the query
//$sql = "SELECT * FROM employees WHERE name LIKE '%$employeeName%' AND surname LIKE '%$employeeSurname%' AND date = '$date' AND time = '$time' ";

    $sql = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time' OR zajecia.godziny ='$time2' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2";

//$sql = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
//FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2;";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table name="dane" id="tabelaDane" style="display: block"> <tr>  <th> Numer sali </th> <th> budynek </th> <th> godziny </th><th> nazwa przedmiotu </th><th> nazwisko </th> </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            // to output mysql data in HTML table format
            echo '<tr > <td>' . $row["numerSali"] . '</td>
        <td>' . $row["budynek"] . '</td>
        <td> ' . $row["godziny"] . '</td>
        <td>' . $row["nazwa_przedmiotu"] . '</td>
        <td>' . $row["nazwisko"] . '</td>
        </tr>';

        }

    } else {
        //echo "No results found.";
    }
$conn->close();
}
//$sql2 = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
//FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time2' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2";

//$result2 = $conn->query($sql2);
//if ($result2->num_rows > 0) {
//    echo '<table> <tr>  <th> Numer sali </th> <th> budynek </th> <th> godziny </th><th> nazwa przedmiotu </th><th> nazwisko </th> </tr>';
//    while($row = mysqli_fetch_assoc($result2)){
//        // to output mysql data in HTML table format
//        echo '<tr > <td>' . $row["numerSali"] . '</td>
//        <td>' . $row["budynek"] . '</td>
//        <td> ' . $row["godziny"] . '</td>
//        <td>' . $row["nazwa_przedmiotu"] . '</td>
//        <td>' . $row["nazwisko"] . '</td>
//        </tr>';
//
//    }
//} else {
//    echo "No results found.";
//}

//if(isset($_POST['roomNumber']) or isset($_POST['buildingNumber']) or isset($_POST['date']) or isset($_POST['time']) ) {




/*if($_SERVER["REQUEST_METHOD"] === "POST") {
    echo 'POST';*/
    // form has been submitted, process the data
  /*  $employeeName = $_POST['employeeName'];
    $employeeSurname = $_POST['employeeSurname'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    //validate the data before using them
    if(!empty($employeeName) && !empty($employeeSurname) && !empty($date) && !empty($time)){
        //validation passed, do something with the data
    }else{
        //validation failed, show an error message
    }*/


function function2(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donde";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber']);
    $buildingNumber = mysqli_real_escape_string($conn, $_POST['buildingNumber']);
    $date = mysqli_real_escape_string($conn, $_POST['date2']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    /*$sql = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
    FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time' OR zajecia.godziny ='$time2' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2";*/
    if (strcmp($time, '8:15-10:00') == 0) {

        $time2 = '10:15-12:00';
    }



$sql =  "   SELECT pomieszczenia.numerSali, pomieszczenia.budynek,pracownicy.imie, pracownicy.nazwisko, zajecia.godziny, zajecia.data FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pomieszczenia.numerSali = '$roomNumber' AND pomieszczenia.budynek = '$buildingNumber' AND zajecia.data = '$date' AND zajecia.godziny = '$time' OR zajecia.godziny='$time2'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table name="dane" id="tabelaDane" style="display: block"> <tr><th> Numer Sali </th><th> Numer Budynku </th>  <th> Imię </th> <th> Nazwisko </th> <th> godziny </th><th> Data </th> </tr>';
        while($row = mysqli_fetch_assoc($result)){
            // to output mysql data in HTML table format
            echo '<tr > 
            <td>' . $row["numerSali"] . '</td>
            <td>' . $row["budynek"] . '</td>
            <td>' . $row["imie"] . '</td>
            <td>' . $row["nazwisko"] . '</td>
            <td> ' . $row["godziny"] . '</td>
            <td>' . $row["data"] . '</td>
            </tr>';

        }
    } else {
        echo "No results found.";
    }
    $conn->close();
}



?>


<!DOCTYPE HTML>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../grafiki/logo.png" sizes="100x100">


        <meta name="description" content="Wyszukiwarka pracowników i pomieszczeń WI ZUT">
        <title>¿Donde? - Wyszukiwarka</title>
    </head>
<body>

    <!--<label for="myCheck">Checkbox:</label> 
    <input type="checkbox" id="myCheck" onclick="myFunction()">
    <br>-->
    <div>
    <input type="radio" name="przycisk" id="pracownik" onclick="showPracownik()" >Pracownik</input>
    <br>
    <input type="radio" name="przycisk" id="sala"  onclick="showSala()">Sala</input>
    </div>
<div id="employeeList" class="employeeList" style="display: none;">
    <form method="post">
       <div class="">
            <h1 >Wyszukaj pracownika</h1></div>
        <input type="hidden" name="function" value="function1">
            <label for="employeeName">Imię</label>
            <input type="text" name="employeeName">
            <br>

            <label for="employeeSurname">Nazwisko</label>
            <input type="text" name="employeeSurname">
        <br>
            <label for="date">Data</label>
            <input type="date" name="date" id="date">
        <br>    
            <label for="time">Godzina</label>
            <select id="time" name = "time">
                <option value="8:15-10:00" name="time">8:15-10:00</option>
                <option value="10:15-12:00" name="time">10:15-12:00</option>
                <option value="12:15-14:00" name="time">12:15-14:00</option>
                <option value="14:15-16:00" name="time">14:15-16:00</option>
                <option value="16:15-18:00" name="time">16:15-18:00</option>
                <option value="18:15-20:00" name="time">18:15-20:00</option>
              </select>
        <br>
            <input type="submit">
        
    </form>
</div>
<script>
    var date = new Date();
    
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    
    var today = year + "-" + month + "-" + day;       
    document.getElementById("date").value = today;
        </script>


<div id="roomList" class="roomList"style="display: none;">
    <form method="POST">
       <div class="">
            <h1 >Wyszukaj Salę</h1></div>
        <input type="hidden" name="function" value="function2">
        <label for="roomNumber">Numer Sali</label>
            <input type="text" name="roomNumber">
            <br>
            <label for="buildingNumber">Numer budynku</label>
            <input type="text" name="buildingNumber">
        <br>
        <label for="date2">Data</label>
        <input type="date" name="date2" id="date2">
        <br>
        <label for="time">Godzina</label>
        <select id="time" name = "time">
            <option value="8:15-10:00" name="time">8:15-10:00</option>
            <option value="10:15-12:00" name="time">10:15-12:00</option>
            <option value="12:15-14:00" name="time">12:15-14:00</option>
            <option value="14:15-16:00" name="time">14:15-16:00</option>
            <option value="16:15-18:00" name="time">16:15-18:00</option>
            <option value="18:15-20:00" name="time">18:15-20:00</option>
        </select>
        <br>

            <input type="submit">
        
    </form>
</div>

    <script>
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        document.getElementById("date2").value = today;
    </script>
    <script>
        const targetDiv = document.getElementById("employeeList");
        const btn = document.getElementById("pracownik");
    const targetDiv2 = document.getElementById("roomList");
        const btn2 = document.getElementById("sala");
        let tabelaDane = document.getElementById("tabelaDane");
function showPracownik()
{
    targetDiv.style.display = "block";
    targetDiv2.style.display = "none";


    tabelaDane.remove();
};


    function showSala()
    {
        targetDiv.style.display = "none";
        targetDiv2.style.display = "block";

        tabelaDane.remove();

    };


    </script>
</body>
    <style>

        th, td {
            border: 1px solid;

        }
    </style>
</html>