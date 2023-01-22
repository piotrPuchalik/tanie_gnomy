<?php

/*error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['function'])) {
        $function = $_GET['function'];
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


    $employeeName = mysqli_real_escape_string($conn, $_GET['employeeName']);
    $employeeSurname = mysqli_real_escape_string($conn, $_GET['employeeSurname']);
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $time = mysqli_real_escape_string($conn, $_GET['time']);
    /*    echo $time;
        echo '<br>';
        echo '8:15-10:00';
    if (strcmp($time, '8:15-10:00') == 0) {

        $time2 = '10:15-12:00';
    }

    $sql = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time' OR zajecia.godziny ='$time2' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2";


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

function function2(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donde";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$roomNumber = mysqli_real_escape_string($conn, $_GET['roomNumber']);
    $buildingNumber = mysqli_real_escape_string($conn, $_GET['buildingNumber']);
    $date = mysqli_real_escape_string($conn, $_GET['date2']);
    $time = mysqli_real_escape_string($conn, $_GET['time']);

    $sql = "SELECT pomieszczenia.numerSali, pomieszczenia.budynek, zajecia.godziny, zajecia.nazwa_przedmiotu, pracownicy.nazwisko
   FROM zajecia JOIN pomieszczenia ON zajecia.id_sali = pomieszczenia.id JOIN pracownicy ON zajecia.id_pracownika = pracownicy.id WHERE pracownicy.imie = '$employeeName' AND pracownicy.nazwisko = '$employeeSurname' AND zajecia.data ='$date' AND zajecia.godziny ='$time' OR zajecia.godziny ='$time2' AND pracownicy.id = zajecia.id_pracownika AND zajecia.id_sali = pomieszczenia.id LIMIT 2";
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
        echo '<a href="plan.php"/>';
    } else {
        echo "No results found.";
    }
    $conn->close();
}


*/
?>



<?php
/*$conn = new PDO("mysql:host=localhost;dbname=donde","root","");
if(isset($_GET['budynek']) && isset($_GET['sala']))
{
    echo "Zajęcia w sali ".$_GET['budynek']."-".$_GET['sala'];
}

else if(isset($_GET['imie']) && isset($_GET['nazwisko'])) {
    $select = $conn->prepare("SELECT tytul FROM pracownicy WHERE imie=:imie AND nazwisko=:nazwisko");
    $select->bindParam(':imie', $_GET['imie']);
    $select->bindParam(':nazwisko', $_GET['nazwisko']);
    $select->execute();
    $res = $select->fetch();
    if ($res != null) echo "Zajęcia prowadzącego: " . $res['tytul'] . " " . $_GET['imie'] . " " . $_GET['nazwisko'];
    else echo "Zajęcia prowadzącego: " . $_GET['imie'] . " " . $_GET['nazwisko'];


    if (isset($_GET['budynek']) && isset($_GET['sala'])) {
        $select = $conn->prepare("SELECT zj.godzina_rozpoczecia, zj.godzina_zakonczenia, zj.id_sali, zj.nazwa_przedmiotu, zj.typ_zajęć, zj.id_pracownika FROM zajecia as zj JOIN pomieszczenia as p ON p.id=id_sali WHERE p.budynek=:budynek AND p.numerSali=:numer");
        $select->bindParam(':numer', $_GET['sala']);
        $select->bindParam(':budynek', $_GET['budynek']);
        $select->execute();
        $result = $select->fetchAll();
        $sel = $conn->prepare("SELECT tytul, imie, nazwisko FROM pracownicy WHERE id=:id");
        foreach ($result as $row) {
            echo "<td> " . $row['godzina_rozpoczecia'] . "-" . $row['godzina_zakonczenia'] . " </td>";
            echo "<td> " . $_GET['budynek'] . "-" . $_GET['sala'] . " </td>";
            echo "<td> " . $row['nazwa_przedmiotu'] . " </td>";
            echo "<td>" . $row['typ_zajęć'] . "</td>";
            $sel->bindParam(':id', $row['id_pracownika']);
            $sel->execute();
            $res = $sel->fetch();
            echo "<td> " . $res['tytul'] . " " . $res['imie'] . " " . $res['nazwisko'] . " </td> </tr>";
        }
    } else if (isset($_GET['imie']) && isset($_GET['nazwisko'])) {
        echo $_GET['imie'];
        echo $_GET['nazwisko'];
        $select = $conn->prepare("SELECT  zj.godzina_rozpoczecia, zj.godzina_zakonczenia, zj.id_sali, zj.nazwa_przedmiotu, zj.typ_zajęć, zj.id_pracownika, p.tytul FROM zajecia as zj JOIN pracownicy as p ON p.id=zj.id_pracownika WHERE p.imie=:imie AND p.nazwisko=:nazwisko");
        $select->bindParam(':imie', $_GET['imie']);
        $select->bindParam(':nazwisko', $_GET['nazwisko']);
        $select->execute();
        $result = $select->fetchAll();
        foreach ($result as $row) {

            echo "<td> " . $row['godzina_rozpoczecia'] . "-" . $row['godzina_zakonczenia'] . " </td>";
            $sel = $conn->prepare("SELECT budynek, numerSali FROM pomieszczenia WHERE id=:id");
            $sel->bindParam(':id', $row['id_sali']);
            $sel->execute();
            $res = $sel->fetch();
            echo "<td> " . $res['budynek'] . "-" . $res['numerSali'] . " </td>";
            echo "<td> " . $row['nazwa_przedmiotu'] . " </td>";
            echo "<td>" . $row['typ_zajęć'] . "</td>";
            echo "<td> " . $row['tytul'] . " " . $_GET['imie'] . " " . $_GET['nazwisko'] . " </td> </tr>";
        }

    }


}
*/?>

<!DOCTYPE HTML>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../style/wyszukiwarka.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Plan WI1">
    <title>Plan WI1</title>
    <link rel="shortcut icon" href="../grafiki/logo.png" sizes="100x100">
</head>
<body>

<div>
    <input type="radio" name="przycisk" id="pracownik" onclick="showPracownik()" >Pracownik</input>
    <br>
    <input type="radio" name="przycisk" id="sala"  onclick="showSala()">Sala</input>
</div>
<div id="employeeList" class="employeeList" style="display: none;">
    <form method="get">
        <div class="">
            <h1 >Wyszukaj pracownika</h1></div>
        <input type="hidden" name="function">
        <label for="imie">Imię</label>
        <input type="text" name="imie">
        <br>

        <label for="employeeSurname">Nazwisko</label>
        <input type="text" name="nazwisko">
        <br>
        <label for="date">Data</label>
        <input type="date" name="date" id="date">
        <br>
        <label for="time">Godzina</label>
        <input type="text" name="godzinaRozpoczecia">
        <br>
        <input type="text" name="godzinaZakonczenia">
        <br>
        <input type="submit" onclick="funkcja()">

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
    <form method="get">
        <div class="">
            <h1 >Wyszukaj Salę</h1></div>
        <input type="hidden" name="function" >
        <label for="roomNumber">Numer Sali</label>
        <input type="text" name="sala">
        <br>
        <label for="buildingNumber">Numer budynku</label>
        <input type="text" name="budynek">
        <br>
        <label for="date2">Data</label>
        <input type="date" name="date2" id="date2">
        <br>
        <label for="time">Godzina</label>
        <input type="text" name="godzinaRozpoczecia">
        <br>
        <input type="text" name="godzinaZakonczenia">
        <br>

        <input type="submit" onclick="funkcja()">

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
<style>

    th, td {
        border: 1px solid;

    }
</style>



<div id="content">

    <div id="tabelaHeader" > <h1>
            <?php
            $conn = new PDO("mysql:host=localhost;dbname=donde","root","");
            if(isset($_GET['budynek']) && isset($_GET['sala']))
            {
                echo "Zajęcia w sali ".$_GET['budynek']."-".$_GET['sala'];
            }

            else if(isset($_GET['imie']) && isset($_GET['nazwisko']))
            {
                $select = $conn->prepare("SELECT tytul FROM pracownicy WHERE imie=:imie AND nazwisko=:nazwisko");
                $select->bindParam(':imie',$_GET['imie']);
                $select->bindParam(':nazwisko',$_GET['nazwisko']);
                $select->execute();
                $res = $select->fetch();
                if($res != null)echo "Zajęcia prowadzącego: ".$res['tytul']." ".$_GET['imie']." ".$_GET['nazwisko'];
                else echo "Zajęcia prowadzącego: ".$_GET['imie']." ".$_GET['nazwisko'];

            }

            ?>
        </h1>
    </div>
    <div id="plan">
        <table id ="tabelka"> <tr> <td> Godziny </td> <td> Budynek </td> <td> Przedmiot </td> <td> Typ zajęć </td> <td> Prowadzący </td> </tr>

            <?php

            if(isset($_GET['budynek']) && isset($_GET['sala']))
            {
                $select = $conn->prepare("SELECT zj.godzina_rozpoczecia, zj.godzina_zakonczenia, zj.id_sali, zj.nazwa_przedmiotu, zj.typ_zajęć, zj.id_pracownika FROM zajecia as zj JOIN pomieszczenia as p ON p.id=id_sali WHERE p.budynek=:budynek AND p.numerSali=:numer");
                $select->bindParam(':numer',$_GET['sala']);
                $select->bindParam(':budynek',$_GET['budynek']);
                $select->execute();
                $result = $select->fetchAll();
                $sel = $conn->prepare("SELECT tytul, imie, nazwisko FROM pracownicy WHERE id=:id");
                foreach($result as $row)
                {
                    echo "<td> ".$row['godzina_rozpoczecia']."-".$row['godzina_zakonczenia']." </td>";
                    echo "<td> ".$_GET['budynek']."-".$_GET['sala']." </td>";
                    echo "<td> ".$row['nazwa_przedmiotu']." </td>";
                    echo "<td>".$row['typ_zajęć']."</td>";
                    $sel->bindParam(':id',$row['id_pracownika']);
                    $sel->execute();
                    $res = $sel->fetch();
                    echo "<td> ".$res['tytul']." ".$res['imie']." ".$res['nazwisko']." </td> </tr>";
                }
            }
            else if(isset($_GET['imie']) && isset($_GET['nazwisko']))
            {
                $select = $conn->prepare("SELECT  zj.godzina_rozpoczecia, zj.godzina_zakonczenia, zj.id_sali, zj.nazwa_przedmiotu, zj.typ_zajęć, zj.id_pracownika, p.tytul FROM zajecia as zj JOIN pracownicy as p ON p.id=zj.id_pracownika WHERE p.imie=:imie AND p.nazwisko=:nazwisko");
                $select->bindParam(':imie',$_GET['imie']);
                $select->bindParam(':nazwisko',$_GET['nazwisko']);
                $select->execute();
                $result = $select->fetchAll();
                foreach($result as $row)
                {

                    echo "<td> ".$row['godzina_rozpoczecia']."-".$row['godzina_zakonczenia']." </td>";
                    $sel = $conn->prepare("SELECT budynek, numerSali FROM pomieszczenia WHERE id=:id");
                    $sel->bindParam(':id',$row['id_sali']);
                    $sel->execute();
                    $res = $sel->fetch();
                    echo "<td> ".$res['budynek']."-".$res['numerSali']." </td>";
                    echo "<td> ".$row['nazwa_przedmiotu']." </td>";
                    echo "<td>".$row['typ_zajęć']."</td>";
                    echo "<td> ".$row['tytul']." ".$_GET['imie']." ".$_GET['nazwisko']." </td> </tr>";
                }

            }
            ?>

        </table>
    </div>
</div>
    <script>
        function funkcja() {
            var tabela = document.getElementById("tabelaHeader");
            tabela.classList.add("tabela-content");
            tabela.remove("content-stary")
            var tabela2 =document.getElementById("tabelka");
            tabela2.classList.add("tabela-header");
            tabela.remove("tabelka-stary")


        }
    </script>
</body>
</html>

