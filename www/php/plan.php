<!DOCTYPE HTML>
<html lang="pl-PL">
    <head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../style/plan.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Plan WI1">
        <title>Plan WI1</title>
		<link rel="shortcut icon" href="../grafiki/logo.png" sizes="100x100">
    </head>
    <body>
        
	<div id="content">

		<div id="header"> <h1> 
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
		</h1> </div>
		<div id="plan"> 
			<table> <tr> <td> Godziny </td> <td> Budynek </td> <td> Przedmiot </td> <td> Typ zajęć </td> <td> Prowadzący </td> </tr>
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
                    echo $_GET['imie'];
                    echo $_GET['nazwisko'];
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
	</body>
</html>

