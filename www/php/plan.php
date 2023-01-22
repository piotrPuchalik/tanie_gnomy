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
			$conn = new PDO("mysql:host=localhost;dbname=projekt","root","");
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
			<table> <tr> <td> Dzień tygodnia </td> <td> Czas zajęć </td> <td> Sala </td> <td> Przedmiot </td> <td> Forma </td> <td> Prowadzący </td> </tr>
			<?php
				
				if(isset($_GET['budynek']) && isset($_GET['sala']))
				{
					$select = $conn->prepare("SELECT pl.dzienTygodnia, pl.godzinaRozpoczecia, pl.godzinaZakonczenia, pl.sala_ID, pl.przedmiot, pl.forma, pl.pracownik_ID FROM plan as pl JOIN pomieszczenia as p ON p.id=sala_ID WHERE p.budynek=:budynek AND p.numerSali=:numer");
					$select->bindParam(':numer',$_GET['sala']);
					$select->bindParam(':budynek',$_GET['budynek']);
					$select->execute();
					$result = $select->fetchAll();
					$sel = $conn->prepare("SELECT tytul, imie, nazwisko FROM pracownicy WHERE id=:id");
					foreach($result as $row)
					{
						switch($row['dzienTygodnia'])
						{
							case 1: {echo "<tr> <td> Poniedziałek </td>";break;}
							
							case 2: {echo "<tr> <td> Wtorek </td>";break;}
							
							case 3: {echo "<tr> <td> Środa </td>";break;}
							
							case 4: {echo "<tr> <td> Czwartek </td>";break;}
							
							case 5: {echo "<tr> <td> Piątek </td>";break;}
							
							case 6: {echo "<tr> <td> Sobota </td>";break;}
							
							case 7: {echo "<tr> <td> Niedziela </td>";break;}
						}
						echo "<td> ".$row['godzinaRozpoczecia']."-".$row['godzinaZakonczenia']." </td>";
						echo "<td> ".$_GET['budynek']."-".$_GET['sala']." </td>";
						echo "<td> ".$row['przedmiot']." </td>";
						echo "<td>".$row['forma']."</td>";
						$sel->bindParam(':id',$row['pracownik_ID']);
						$sel->execute();
						$res = $sel->fetch();
						echo "<td> ".$res['tytul']." ".$res['imie']." ".$res['nazwisko']." </td> </tr>";
					}
				}
				else if(isset($_GET['imie']) && isset($_GET['nazwisko']))
				{
					$select = $conn->prepare("SELECT pl.dzienTygodnia, pl.godzinaRozpoczecia, pl.godzinaZakonczenia, pl.sala_ID, pl.przedmiot, pl.forma, pl.pracownik_ID, p.tytul FROM plan as pl JOIN pracownicy as p ON p.id=pl.pracownik_ID WHERE p.imie=:imie AND p.nazwisko=:nazwisko");
					$select->bindParam(':imie',$_GET['imie']);
					$select->bindParam(':nazwisko',$_GET['nazwisko']);
					$select->execute();
					$result = $select->fetchAll();
					foreach($result as $row)
					{
						switch($row['dzienTygodnia'])
						{
							case 1: {echo "<tr> <td> Poniedziałek </td>";break;}
							
							case 2: {echo "<tr> <td> Wtorek </td>";break;}
							
							case 3: {echo "<tr> <td> Środa </td>";break;}
							
							case 4: {echo "<tr> <td> Czwartek </td>";break;}
							
							case 5: {echo "<tr> <td> Piątek </td>";break;}
							
							case 6: {echo "<tr> <td> Sobota </td>";break;}
							
							case 7: {echo "<tr> <td> Niedziela </td>";break;}
						}
						echo "<td> ".$row['godzinaRozpoczecia']."-".$row['godzinaZakonczenia']." </td>";
						$sel = $conn->prepare("SELECT budynek, numerSali FROM pomieszczenia WHERE id=:id");
						$sel->bindParam(':id',$row['sala_ID']);
						$sel->execute();
						$res = $sel->fetch();
						echo "<td> ".$res['budynek']."-".$res['numerSali']." </td>";
						echo "<td> ".$row['przedmiot']." </td>";
						echo "<td>".$row['forma']."</td>";
						echo "<td> ".$row['tytul']." ".$_GET['imie']." ".$_GET['nazwisko']." </td> </tr>";
					}
			
				}
			?>
			</table>
		</div>
	</body>
</html>