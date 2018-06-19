<?php
    require "../Controllers/check_auth.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Acasa</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		
		header {
			float: left;
			height: 100vh;
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
		table, td, th {
    		border: 1px solid black;
		}

		table {
    		border-collapse: collapse;
    		width:95%;
    		margin: 0% 2% 0% 2%;
		}

		th {
    		height: 50px;
		}

		td {
			text-align: center;
		}
	</style>
</head>
<?php
    include('../Controllers/HelperClasses/connection.php');
    $conn = OracleConnection::getConnection();
	require "navBar.php";
    require "../Controllers/myCreations.php";
    require "../Controllers/mySignatures.php";
    
    if ($_SESSION["Auth_is_admin"] == 1) {
        
        require "../Controllers/adminRaports.php";

    }
?>

<header>
    <a href="../Controllers/logout.php">
        <input type="submit" class="button" value="Logout" style="background-color:blue;">
    </a>

    <?php if($_SESSION["Auth_is_admin"] == 1): ?>
        <h2 align=center>Reports</h2>
        <table align=center>
        <tr>
        <th>ID Petitie</th>
        <th>Creator_ID</th>
        <th>Name</th>
        <th>Domeniu</th>
        <th>Numar_Semnaturi</th>
        <th>Data Expirare</th>
        <th>Valabilitate</th>
        <th>Option</th>
        </tr>
        <?php foreach ($results_reports as $row): ?>
            <tr>
            <td><?php echo  $row['ID']; ?></td>
            <td><?php echo  $row['CREATOR_ID']; ?></td>
            <td><?php echo  $row['NAME']; ?></td>
            <td><?php echo  $row['DOMENIU']; ?></td>
            <td><?php echo  $row['NUMAR_SEMNATURI']; ?></td>
            <td><?php echo  $row['EXPIRARE']; ?></td>
            <td><?php if (strtotime(date('d-M-y', strtotime($row['EXPIRARE']))) > strtotime(date('d-M-y', strtotime("now")))) {echo "DA";} else { echo "NU";}?></td>
            <td><a href="../Controllers/deletePetitionAdmin.php<?php echo "?petitie_id=" . $row['ID']; ?>"><input type="submit" class="button" value="Delete" style="background-color:red;"></a>
            </td>
            </tr>

        <?php endforeach ?>
        </table>
        
        <div align=center>
            <a href="../Controllers/htmlExport.php">
                <input type="submit" class="button" value="html export" style="background-color:green;">
            </a>
            <a href="../Controllers/pdfExport.php">
                <input type="submit" class="button" value="pdf export" style="background-color:red;">
            </a>
        </div>
    <?php endif ?>
  
    <h2 align=center>Creatii</h2>
    <table align=center>
    <tr>
    <th>ID Petitie</th>
    <th>Creator_ID</th>
    <th>Name</th>
    <th>Domeniu</th>
    <th>Numar_Semnaturi</th>
    <th>Data Expirare</th>
    <th>Valabilitate</th>
    <th>Option</th>
    </tr>
    <?php foreach ($results_creations as $row): ?>
        <tr>
        <td><?php echo  $row['ID']; ?></td>
        <td><?php echo  $row['CREATOR_ID']; ?></td>
        <td><?php echo  $row['NAME']; ?></td>
        <td><?php echo  $row['DOMENIU']; ?></td>
        <td><?php echo  $row['NUMAR_SEMNATURI']; ?></td>
        <td><?php echo  $row['EXPIRARE']; ?></td>
        <td><?php if (strtotime(date('d-M-y', strtotime($row['EXPIRARE']))) > strtotime(date('d-M-y', strtotime("now")))) {echo "DA";} else { echo "NU";}?></td>
        <td><a href="../Controllers/deletePetition.php<?php echo "?petitie_id=" . $row['ID']; ?>"><input type="submit" class="button" value="Delete" style="background-color:red;"></a>
        </td>
        </tr>
    <?php endforeach ?>
    </table>
    
    <h2 align=center>Semnaturi</h2>
    <table align=center>
    <tr>
    <th>ID Petitie</th>
    <th>Creator_ID</th>
    <th>Name</th>
    <th>Domeniu</th>
    <th>Numar_Semnaturi</th>
    <th>Data Expirare</th>
    <th>Valabilitate</th>
    <th>Option</th>
    </tr>
    <?php foreach ($results_signatures as $row): ?>
        <tr>
        <td><?php echo  $row['ID']; ?></td>
        <td><?php echo  $row['CREATOR_ID']; ?></td>
        <td><?php echo  $row['NAME']; ?></td>
        <td><?php echo  $row['DOMENIU']; ?></td>
        <td><?php echo  $row['NUMAR_SEMNATURI']; ?></td>
        <td><?php echo  $row['EXPIRARE']; ?></td>
        <td><?php if (strtotime(date('d-M-y', strtotime($row['EXPIRARE']))) > strtotime(date('d-M-y', strtotime("now")))) {echo "DA";} else { echo "NU";}?></td>
        <td>
        <a href="../Controllers/unsign.php<?php echo "?petitie_id=" . $row['ID']; ?>"><input type="submit" class="button" value="Unsign" style="background-color:red;"></a>
        </td>
        </tr>
    <?php endforeach ?>
    </table>
    
</table>
</header>

</body>
</html>