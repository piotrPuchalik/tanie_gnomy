<!DOCTYPE HTML>
<html lang="pl-PL">
    <head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../style/plan.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Plan budynku WI1">
        <title>¿Donde? - Budynek WI1</title>
		<link rel="shortcut icon" href="../grafiki/logo.png" sizes="100x100">
    </head>
    <body>  
	<div id="content">

		<div id="header"> <h1> Budynek WI-1 </h1> </div>
		<div id="menu"> 
			<ul> 
				<li> <button class="btn" onclick="menu(2)"> Piętro 2 </button> </li>
				<li> <button class="btn" onclick="menu(1)"> Piętro 1 </button> </li> 
				<li> <button class="btn" onclick="menu(0)"> Piętro 0 </button> </li>
				<li> <button class="btn" onclick="menu(-1)"> Piętro -1 </button> </li>
			</ul>
		</div>
		<div id="wynik">
			<table>
			<?php
			
				$conn = new PDO("mysql:host=localhost;dbname=donde","root","");
				if(isset($_GET['sala']))
				{
					$data=date("Y-m-d");
					$czas=date("H:i");
					$select = $conn->prepare("SELECT id, numerSali,typ_pomieszczenia FROM pomieszczenia WHERE budynek='WI1' AND numerSali=:numer");
					$select->bindParam(':numer',$_GET['sala']);
					$select->execute();
					$result = $select->fetch();
					if($result != null)
					{
						
						echo "<tr> <td> numer sali: ".$result['numerSali']."</td> </tr>";
						echo "<tr> <td> typ sali: ".$result['typ_pomieszczenia']."</td> </tr>";
						
						if($result['typ_pomieszczenia']!='gabinet')
						{
							$plan = $conn->prepare("SELECT * FROM zajecia WHERE id_sali=:id AND data>=:data AND ( godzina_zakonczenia>:czas OR godzina_rozpoczecia>:czas ) ORDER BY data, godzina_rozpoczecia");
							$plan->bindParam(':id',$result['id']);
							$plan->bindParam(':data',$data);
							$plan->bindParam(':czas',$czas);
							$plan->execute();
							$plan = $plan->fetch();
							$pracownik = $conn->prepare("SELECT imie, nazwisko, tytul FROM pracownicy WHERE id=:id");
							$pracownik->bindParam(':id',$plan['id_pracownika']);
							$pracownik->execute();
							$pracownik = $pracownik->fetch();
							if(isset($plan['id']))
							{
								
								echo "<tr> <td> najbliższe/aktualne zajęcia: ";
								echo $plan['data']." ";
								echo $plan['godzina_rozpoczecia']."-".$plan['godzina_zakonczenia']." ";
								echo $plan['nazwa_przedmiotu']." ".$plan['typ_zajęć']." ";
								echo $pracownik['tytul']." ".$pracownik['imie'] ." ".$pracownik['nazwisko'];
								
							}
								
							else echo "<tr> <td> najbliższe/aktualne zajęcia: brak zajęć </td> </tr>";
							
							echo "<tr> <td> link do planu: <a href='plan.php?budynek=WI1&&sala=".$_GET['sala']."'> PLAN </td> </tr>";
						}
						else
						{
							$select = $conn->prepare("SELECT p.id, p.imie, p.nazwisko, p.tytul FROM pracownicy as p JOIN pomieszczenia as s ON p.gabinet=s.id WHERE s.budynek='WI1' AND s.numerSali=:numer");
							$select->bindParam(':numer',$_GET['sala']);
							$select->execute();
							$result = $select->fetch();
							$plan = $conn->prepare("SELECT * FROM zajecia WHERE id_pracownika=:id_pracownika AND data>=:data AND ( godzina_zakonczenia>:czas OR godzina_rozpoczecia>:czas ) ORDER BY data, godzina_rozpoczecia");
							$plan->bindParam(':id_pracownika',$result['id']);
							$plan->bindParam(':data',$data);
							$plan->bindParam(':czas',$czas);
							$plan->execute();
							$plan = $plan->fetch();
								
							echo "<tr> <td> imię i nazwisko pracownika: ".$result['imie']." ".$result['nazwisko']."</td> </tr>";
							echo "<tr> <td> tytuły pracownika: ".$result['tytul']."</td> </tr>";
							if(isset($plan['id']))
							{
								echo "<tr> <td> najbliższe/aktualne zajęcia: ";
								echo $plan['data']." ";
								echo $plan['godzina_rozpoczecia']."-".$plan['godzina_zakonczenia']." ";
								echo $plan['nazwa_przedmiotu']." ".$plan['typ_zajęć']." ";
								echo $result['tytul']." ".$result['imie'] ." ".$result['nazwisko'];
								
							}
							else echo "<tr> <td> najbliższe/aktualne zajęcia: brak zajęć </td> </tr>";
							echo "<tr> <td> link do planu: <a href='plan.php?imie=".$result['imie']."&&nazwisko=".$result['nazwisko']."'> PLAN </td> </tr>";
						}
					}
				}
			?>
		</table>
		</div>
		<div id="plan">   
			<?xml version="1.0" encoding="utf-8"?>
				<div id="plandiv" class="mapdiv">	
				</div>
		</div>
	</div>
	<script src="../js/plan_wi1.js"> </script>       
	</body>
</html>