<!DOCTYPE HTML>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../style/plan.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="description" content="Plan WI2">
        <title>Plan WI2</title>
		<link rel="shortcut icon" href="../grafiki/logo.png" sizes="100x100">
    </head>
	<body>
	<div id="content">

		<div id="header"> <h1> Budynek WI-2 </h1> </div>
		<div id="menu"> 
				<ul> 
					<li> <button class="btn" onclick="menu(3)"> Piętro 3 </button> </li>
					<li> <button class="btn" onclick="menu(2)"> Piętro 2 </button> </li> 
					<li> <button class="btn" onclick="menu(1)"> Piętro 1 </button> </li>
					<li> <button class="btn" onclick="menu(0)"> Piętro 0 </button> </li>
				</ul>
			</div>
		<div id="wynik">
			<table>
			<?php
			
				$conn = new PDO("mysql:host=localhost;dbname=projekt","root","");
				if(isset($_GET['sala']))
				{
					$data=date("N");
					$czas=date("H:i");
					$select = $conn->prepare("SELECT id, numerSali, zastosowanie FROM pomieszczenia WHERE budynek='WI2' AND numerSali=:numer");
					$select->bindParam(':numer',$_GET['sala']);
					$select->execute();
					$result = $select->fetch();
					if($result != null)
					{
						
						echo "<tr> <td> numer sali: ".$result['numerSali']."</td> </tr>";
						echo "<tr> <td> typ sali: ".$result['zastosowanie']."</td> </tr>";
						
						if($result['zastosowanie']!='Gabinet')
						{
							$plan = $conn->prepare("SELECT * FROM plan WHERE sala_ID=:sala_ID AND dzienTygodnia=:dzien AND ( godzinaZakonczenia>:czas OR godzinaRozpoczecia>:czas ) ORDER BY godzinaRozpoczecia");
							$plan->bindParam(':sala_ID',$result['id']);
							$plan->bindParam(':dzien',$data);
							$plan->bindParam(':czas',$czas);
							$plan->execute();
							$plan = $plan->fetch();
							$pracownik = $conn->prepare("SELECT imie, nazwisko, tytul FROM pracownicy WHERE id=:id");
							$pracownik->bindParam(':id',$plan['pracownik_ID']);
							$pracownik->execute();
							$pracownik = $pracownik->fetch();
							if(isset($plan['id']))
							{
								echo "<tr> <td> najbliższe/aktualne zajęcia: ";
								echo $plan['przedmiot']." ".$plan['forma']." ";
								echo $plan['godzinaRozpoczecia']."-".$plan['godzinaZakonczenia']." ";
								echo $pracownik['tytul']." ".$pracownik['imie'] ." ".$pracownik['nazwisko'];
								
							}
								
							else echo "<tr> <td> najbliższe/aktualne zajęcia: brak zajęć </td> </tr>";
							
							echo "<tr> <td> link do planu: <a href='plan.php?budynek=WI2&&sala=".$_GET['sala']."'> PLAN </td> </tr>";
						}
						else
						{
							$select = $conn->prepare("SELECT p.id, p.imie, p.nazwisko, p.tytul FROM pracownicy as p JOIN pomieszczenia as s ON p.id=s.pracownik_ID WHERE s.budynek='WI2' AND s.numerSali=:numer");
							$select->bindParam(':numer',$_GET['sala']);
							$select->execute();
							$result = $select->fetch();
							$plan = $conn->prepare("SELECT * FROM plan WHERE pracownik_ID=:pracownik_ID AND dzienTygodnia=:dzien AND ( godzinaZakonczenia>:czas OR godzinaRozpoczecia>:czas ) ORDER BY godzinaRozpoczecia");
							$plan->bindParam(':pracownik_ID',$result['id']);
							$plan->bindParam(':dzien',$data);
							$plan->bindParam(':czas',$czas);
							$plan->execute();
							$plan = $plan->fetch();
								
							echo "<tr> <td> imię i nazwisko pracownika: ".$result['imie']." ".$result['nazwisko']."</td> </tr>";
							echo "<tr> <td> tytuły pracownika: ".$result['tytul']."</td> </tr>";
							if(isset($plan['id']))
							{
								echo "<tr> <td> najbliższe/aktualne zajęcia: ";//.$res['godzinaRozpoczecia']."-".$res['godzinaZakonczenia']." </td> </tr>";
								echo $plan['przedmiot']." ".$plan['forma']." ";
								echo $plan['godzinaRozpoczecia']."-".$plan['godzinaZakonczenia'];
								
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
	<script src="plan_wi2.js"> </script> 
	</body>
</html>