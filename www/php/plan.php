<!DOCTYPE HTML>
<html lang="pl-PL">
    <head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../style/plan.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Plan WI1">
        <title>¿Donde? - Plan</title>
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
					$pracownik = $conn->prepare("SELECT tytul FROM pracownicy WHERE imie=:imie AND nazwisko=:nazwisko");
					$pracownik->bindParam(':imie',$_GET['imie']);
					$pracownik->bindParam(':nazwisko',$_GET['nazwisko']);
					$pracownik->execute();
					$pracownik = $pracownik->fetch();
				if($pracownik != null)echo "Zajęcia prowadzącego: ".$pracownik['tytul']." ".$_GET['imie']." ".$_GET['nazwisko'];
				else echo "Zajęcia prowadzącego: ".$_GET['imie']." ".$_GET['nazwisko'];
			}
			?> 
		</h1> </div>
		<div id="plan"> 
			<table>
			<?php

				if(isset($_GET['budynek']) && isset($_GET['sala']))
				{
					echo "<tr> <td> Data </td> <td> Od </td> <td> Do </td> <td> Przedmiot </td> <td> Forma </td> <td> Prowadzący </td> </tr>";
					$select = $conn->prepare("SELECT * FROM zajecia as z JOIN pomieszczenia as p ON p.id=z.id_sali WHERE p.budynek=:budynek AND p.numerSali=:numer");
					$select->bindParam(':numer',$_GET['sala']);
					$select->bindParam(':budynek',$_GET['budynek']);
					$select->execute();
					$result = $select->fetchAll();
					$sel = $conn->prepare("SELECT tytul, imie, nazwisko FROM pracownicy WHERE id=:id");
					foreach($result as $row)
					{
						echo "<td> ".$row['data']." </td>";
						echo "<td> ".$row['godzina_rozpoczecia']." </td>";
						echo "<td> ".$row['godzina_zakonczenia']." </td>";
						$sel->bindParam(':id',$row['pracownik_ID']);
						echo "<td> ".$row['nazwa_przedmiotu']." </td>";
						echo "<td> ".$row['typ_zajęć']."</td>";
						$sel->bindParam(':id',$row['id_pracownika']);
						$sel->execute();
						$res = $sel->fetch();
						echo "<td> ".$res['tytul']." ".$res['imie']." ".$res['nazwisko']." </td> </tr>";
					}
				}
				else if(isset($_GET['imie']) && isset($_GET['nazwisko']))
				{
					echo "<tr> <td> Data </td> <td> Od </td> <td> Do </td> <td> Sala </td> <td> Przedmiot </td> <td> Forma </td> </tr>";
					$select = $conn->prepare("SELECT * FROM zajecia as z JOIN pracownicy as p ON p.id=z.id_pracownika WHERE p.imie=:imie AND p.nazwisko=:nazwisko");
					$select->bindParam(':imie',$_GET['imie']);
					$select->bindParam(':nazwisko',$_GET['nazwisko']);
					$select->execute();
					$result = $select->fetchAll();
					$sel = $conn->prepare("SELECT budynek, numerSali FROM pomieszczenia WHERE id=:id");
					foreach($result as $row)
					{
						echo "<td> ".$row['data']." </td>";
						echo "<td> ".$row['godzina_rozpoczecia']." </td>";
						echo "<td> ".$row['godzina_zakonczenia']." </td>";
						$sel->bindParam(':id',$row['id_sali']);
						$sel->execute();
						$res = $sel->fetch();
						echo "<td> ".$res['budynek']."-".$res['numerSali']." </td>";
						echo "<td> ".$row['nazwa_przedmiotu']." </td>";
						echo "<td> ".$row['typ_zajęć']."</td> </tr>";
						
					}

				}
			?>
			</table>
		</div>
	</body>
</html>
</html>

