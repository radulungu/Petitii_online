<?php
    require "../Controllers/check_auth.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Creeaza petitie</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		
		h2 {
			text-align: center;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 35px;
			text-shadow: 3px 3px 5px rgb(120,120,120);
		}

		#paragraf {
			text-indent: 30px;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 15px;
			margin: 2%;
			border: 1px solid black;
			border-radius: 20px;
    		background-color: rgba(180,180,180,0.3);
    		padding: 10px;
    		box-shadow: 8px 8px 5px rgb(120,120,120);
		}

		#creare {
			background-color: rgba(180,180,180,0.3);
			margin: 2%;
			border: 1px solid black;
			border-radius: 20px;
			padding: 10px;
			box-shadow: 8px 8px 5px rgb(120,120,120);
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 15px;
			padding-left: 30px;
		}

	</style>
</head>
<body>

<?php
    require "navBar.php";
?>

<h2>Creeaza-ti propria petitie!</h2>

<div id="paragraf">
	<p align="justify">Cu ajutorul site-ului nostru aveti posibilitatea sa creati si sa publicati orice petitie doriti si sa o faceti cunoscuta lumii intregi. Utilizand site-ul nostru pentru a va face cunoscute gandurile, veti beneficia de impact si vizibilitate catre publicul larg. Acestea fiind spuse, de ce sa mai asteptati? Creati-va chiar acum propria petitie!</p>
</div>


<form action="../Controllers/newPetitie.php" method="GET" id="creare">
	Denumire petitie:<br><br>
    <input type="text" class="campuri" name="denumire_petitie" maxlength="50" placeholder="Denumire petitie..." required>
    <br><br>
    Domeniu petitie:<br><br>
    <select class="campuri" name="domeniu">
    	<option value="cultural">Cultural</option>
    	<option value="ecologic">Ecologic</option>
    	<option value="economic">Economic</option>
    	<option value="legislativ">Legislativ</option>
    	<option value="social">Social</option>
  	</select>
    <br><br>
    Data expirare:<br><br>
    <input type="date" class="campuri" name="data_expirare" min="2017-08-01" max="2030-01-01">
    <br><br>
    Descriere petitie:<br><br>
    <textarea class="textarea" name="descriere" rows="10" cols="40" maxlength="1000" placeholder="Descriere petitie..." required></textarea>
    <br><br>
    <input type="submit" class="button" value="Creeaza petitie">
</form>

</body>
</html>