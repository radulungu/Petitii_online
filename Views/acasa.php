<!DOCTYPE html>
<html>
<head>
	<title>Acasa</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		
		header {
			background: url(acasa.jpg) no-repeat center center  ;
    		-webkit-background-size: cover;
    		-moz-background-size: cover;
    		-o-background-size: cover;
			float: left;
			height: 100vh;
			background-position: center;
			width: 100%;
		}

		header.center {
			display: table-cell;
			width: 100%;
			text-align: center;
			vertical-align: middle;
		}

		h2 {
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			text-align: center;
			font-size: 300%;
			text-shadow: 3px 3px 5px rgb(120,120,120);
			margin-top: 3%;
		}

		p {
			text-indent: 30px;
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 170%;
			margin: 20% 2% 0%;
		}

		@media all and (max-width: 1000px)
	{
		header {
			background: url(acasa.jpg) no-repeat center center  ;
			background-color: grey;
    		-webkit-background-size: cover;
    		-moz-background-size: cover;
    		-o-background-size: cover;
			float: left;
			height: 100vh;
			background-position: center;
			width: 100%;
		}

		h2 {
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			text-align: center;
			font-size: 300%;
			text-shadow: 3px 3px 5px rgb(120,120,120);
			margin-top: 2%;
			margin-bottom: 30%;
		}

		p {
			text-indent: 30px;
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 170%;
			margin: 5% 2% 0%;
	}

	@media all and (max-width: 900px)
	{
		header {
			background: url(acasa.jpg) no-repeat center center  ;
			background-color: grey;
    		-webkit-background-size: cover;
    		-moz-background-size: cover;
    		-o-background-size: cover;
			float: left;
			height: 120vh;
			background-position: center;
			width: 100%;
		}
		h2 {
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			text-align: center;
			font-size: 300%;
			text-shadow: 3px 3px 5px rgb(120,120,120);
			margin-top: 2%;
			margin-bottom: 32%;
		}

		p {
			text-indent: 30px;
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 170%;
			margin: 5% 2% 0%;
	}

	@media all and (max-width: 600px)
	{
		header {
			background: url(acasa.jpg) no-repeat center center  ;
			background-color: grey;
    		-webkit-background-size: cover;
    		-moz-background-size: cover;
    		-o-background-size: cover;
			float: left;
			height: 120vh;
			background-position: center;
			width: 120%;
		}
		h2 {
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			text-align: center;
			font-size: 300%;
			text-shadow: 3px 3px 5px rgb(120,120,120);
			margin-top: 2%;
			margin-bottom: 35%;
		}

		p {
			text-indent: 30px;
			color: black;
			font-family: 'Comic Sans MS', cursive, sans-serif;
			font-size: 170%;
			margin: 5% 2% 0%;
	}
	
	</style>
</head>
<body background="acasa.jpg">

<?php 
    require "navBar.php";
?>

<header>
  <div class="center">
    <h2>Bine ati venit!</h2>
    <p align="justify"><b>Site-ul <a href="acasa.html" style="color: black"><i>Petitii online</i></a> pune la dispozitia dumneavoastra o platforma gratuita pentru conceperea de petitii. Dupa cum stiti, in ultimii ani, implicarea online vede o ascensiune continua mai ales in randul tinerilor. Astfel, consideram ca acestia trebuie sa gaseasca un loc in care sa isi exprime nemultumirile si nevoile. Asadar, scopul acestor petitii este atragerea atentiei publicului larg asupra problemelor societatii romanesti si nu numai.</b></p>
  </div>
</header>

</body>
</html>