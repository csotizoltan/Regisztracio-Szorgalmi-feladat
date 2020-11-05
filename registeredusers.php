<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
	<title>Regisztrált felhasználók - Adminisztrátori oldal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="javascript.js"></script>
</head>
<body>

	<div class="container">


		<!-------------------------- Title -------------------------->	

		<div id="title">Szorgalmi feladat: Űrlap formázás, validálás, adatmentés és megjelenítés</div>
		<br />



		<!-------------------------- PHP: Metódusok meghívása -------------------------->

		<?php

		Database::initialize();

		registeredUsers();



		#-------------------------- Opening MySQL connection --------------------------


		class Database
		{
			private static $init = FALSE; /** TRUE if static variables have been initialized. FALSE otherwise */
			public static $conn;


			public static function initialize()
			{
				if (self::$init === TRUE) return;
				self::$init = TRUE;
				self::$conn = new mysqli("127.0.0.1", "czoltan", "alma123", "czoltan");

				if (self::$conn->connect_error) {
					die("<br />" . "<strong>Nem sikerült kapcsolódni az adatbázishoz!</strong>"
						. "<br /><br />" . self::$conn->connect_error . "<br />");
				}


				mysqli_query (Database::$conn, "SET NAMES utf-8"); # Beállítja a adatbázis utf8 kódkészletre
				} # /function: initialize
			} # /class Database




		#-------------------------- MySQL SELECT: Összes tétek --------------------------

		function registeredUsers() {


		mysqli_query(Database::$conn, "SET NAMES utf8"); # Beállítja a adatbázis utf8 kódkészletre


		$query = 	"SELECT 
						`Vezeteknev`, 
						`Keresztnev`, 
						`Iranyítoszam`, 
						`Helysegnev`, 
						`Telefonszam`, 
						`Email`, 
						`id`
					FROM SZF_regisztracio";


		$result = mysqli_query(Database::$conn, $query);


		if (!$result) {
			$message  = 'Invalid query: ' . mysqli_error() . "\n";
			$message = 'Whole query: ' . $query;
			die($message);
		}



		#--------------- Regisztrált felhasznélók Filterable Table ---------------

		echo "<div class='container mt-3'>";

		echo "<h3>Regisztrált felhasználók</h3><button type='button' class='btn btn-primary' id='ItemsPageReload' onclick='PageReload()''>Frissítés</button>";
		echo "<p>Kereshetsz a felhasználó nevére, irányítószámára, helységnévre, stb...</p>";

		echo "<input class='form-control' id='myInput' type='text' placeholder='Keresés...'>";
		echo "<br>";
			echo "<table class='table table-striped'>";
				#echo "<br>";
				echo "<thead>";

				if ($result->num_rows > 0) {
					echo "<tr>";
					echo "<th>Vezetéknév</th>";
					echo "<th>Keresztnév</th>";
					echo "<th>Irányítószám</th>";
					echo "<th>Helységnév</th>";
					echo "<th>Telefonszám</th>";
					echo "<th>E-mail cím</th>";
					echo "<th>ID</th>";
					echo "</tr>";

				echo "</thead>";
				echo "<tbody id='myTable'>";

				while($row = $result->fetch_assoc()) {
							echo "<tr>";
								echo "<td>" . $row['Vezeteknev'] . "</td>";
								echo "<td>" . $row['Keresztnev'] . "</td>";
								echo "<td>" . $row['Iranyítoszam'] . "</td>";
								echo "<td>" . $row['Helysegnev'] . "</td>";
								echo "<td>" . $row['Telefonszam'] . "</td>";
								echo "<td>" . $row['Email'] . "</td>";
								echo "<td>" . $row['id'] . "</td>";
							echo "</tr>";
						}

				echo "</tbody>";
			echo "</table>";
			echo "</div>" . "</div>";

				}
				else {
					echo "0 eredmény";
				}

				Database::$conn->close(); # Az adatbázis kapcsolat lezárása
	} # /function: allItems

	?>



<!-------------------------- Auto Page Reload  -------------------------->

<script type="text/javascript">
	setTimeout(PageReload, 180000)
</script>


</div> <!-- /.container -->



<!-------------------------- Footer  -------------------------->

	<footer id="footer">
		<a href="..\..\index.html">Kezdő oldal<span class="tab"></span></a>
		<a href="..\..\hazi_feladatok\index.html">Házi feladatok<span class="tab"></span></a>
		<a href="..\..\beadando_feladatok\index.html">Beadandó feladatok<span class="tab"></span></a>
		<a href="..\index.html">Gyakorló feladatok<span class="tab"></span></a>
		<a href="..\..\rolam.html">Rólam<span class="tab"></span></a>
		<a href="..\..\contact.html">Kapcsolat<span class="tab_owner"></span></a>
		<span id="tab_owner">Created by <a href="mailto:czoltan@atw.hu">Zoltán Csóti</a> (01.11.2020)</span>
	</footer>

</body>
</html>