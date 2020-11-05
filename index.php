<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
	<title>Bootsrap regisztráció adatbázis</title>
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



		<!-------------------------- PHP -------------------------->

		<?php


		#-------------------------- Globális változók deklarálása és metódusok meghívása --------------------------


		global $conn;

		databaseConnection();

		validation();



		#-------------------------- From adatainak validálása --------------------------



		function validation() {

			$allInputValidate = true;

			if (isset($_POST['vezeteknev'])) {
				if (empty($_POST['vezeteknev'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg a vezetéknévét!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['keresztnev'])) {
				if (empty($_POST['keresztnev'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg a keresztnévét!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['iranyítoszam'])) {
				if (empty($_POST['iranyítoszam'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg az irányítószámát!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['helysegnev'])) {
				if (empty($_POST['helysegnev'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg a helységnevet!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['telefonszam'])) {
				if (empty($_POST['telefonszam'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg a telefonszámát!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['email'])) {
				if (empty($_POST['email'])) {
				
				echo "<div class='alert alert-danger alert-dismissible fade show' id='registration_failed' role='alert'>
				Kérjük adja meg az email címét!
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button></div>";

				$allInputValidate = false;
				}
			}

			if (isset($_POST['vezeteknev']) && isset($_POST['keresztnev']) && isset($_POST['iranyítoszam']) && isset($_POST['helysegnev']) && isset($_POST['telefonszam']) & isset($_POST['email']) && $allInputValidate) {
			Rergistration(); // MySQL Insert futtatása (új regsiztáció hozzáadása)
			}

		} # /function: validation



		#-------------------------- Opening MySQL connection --------------------------


		function databaseConnection() {

			$conn = new mysqli("localhost", "czoltan", "alma123", "czoltan");
			mysqli_set_charset($conn,"utf8");

			if ($conn->connect_error) {
				die("Nem sikerült kapcsolódni az adatbázishoz!" . $conn->connect_error);
			}

			$conn->query("SET NAMES utf8"); # Beállítja az adatbázis utf8 kódkészletre

			return $conn;
		} #function: databaseConnection


		
		#-------------------------- MySQL Insert: regisztráció --------------------------

		function Rergistration () {

			$conn = databaseConnection();

			$sql = "INSERT INTO SZF_regisztracio 
						(Vezeteknev, 
						Keresztnev, 
						Iranyítoszam, 
						Helysegnev, 
						Telefonszam,
						Email)
				VALUES ('" . $_POST['vezeteknev'] . "',
						'" . $_POST['keresztnev'] . "',
						'" . $_POST['iranyítoszam'] . "',
						'" . $_POST['helysegnev'] . "',
						'" . $_POST['telefonszam'] . "',
						'" . $_POST['email'] . "')";


			if ($conn->query($sql) === TRUE) {
				echo '<div class="alert alert-success" id="registration_success" role="alert">
				<span id="thank_you"><b>Köszönjük!</b></span><br />
				A regisztrációját rögzítettük.</div>';
			}
			else {
				echo "<div class='alert alert-danger' id='order_failed' role='alert'>
				<span id='error'>Hiba a regisztráció felvétele során:<br /></span>" . $sql . "<br />" . $conn->error . "</div>";
			}

			$conn->close(); # Az adatbázis kapcsolat lezárása

			} #function: Rergistration

		?>



		<!-------------------------- Form -------------------------->

		<div id="person_form">

			<span class="form">
			<p id="form_title">Regisztráció</p>

			<br />

			<form method="post" action="#"><!-- action="registeredusers.php"> -->

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="vezeteknev">Vezetéknév</label>
						<input type="text" class="form-control" id="vezeteknev" name="vezeteknev" placeholder="Szép">
					</div>
					<div class="form-group col-md-6">
						<label for="keresztnev">Keresztnév</label>
						<input type="text" class="form-control" id="keresztnev" name="keresztnev" placeholder="Virág">
					</div>
				</div>

				<br />

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="iranyítoszam">Irányítószám</label>
						<input type="number" class="form-control" id="iranyítoszam" name="iranyítoszam" placeholder="1111">
					</div>
					<div class="form-group col-md-6">
						<label for="helysegnev">Helységnév</label>
						<input type="text" class="form-control" id="helysegnev" name="helysegnev" placeholder="Budapest">
					</div>
				</div>

				<br />

				<div class="form-row">							

					<div class="form-group col-md-6">
						<label for="telefonszam">Telefonszám</label>
						<input type="text" class="form-control" id="telefonszam" name="telefonszam" placeholder="20/30/70 123-4567">
					</div>
					<div class="form-group col-md-6">
						<label for="email">E-mail cím</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="valaki@valami.hu">
					</div>
				</div>

				<br />

				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="gridCheck" required>
						<label class="form-check-label" for="gridCheck">Elfogadom az ÁSZF és az Adatvédelmi szabályzatot</label>
					</div>
				</div>

				<div class="col-xs-12 text-center">
					<button type="submit" name="submit" class="order-submit" id="orderbutton" value="delivery">Regisztráció</button>
				</div>
			</form>

		</div><!-- /.person_form -->

	</div> <!-- /.container -->



	<!-------------------------- ClearUrl  -------------------------->

	<script type="text/javascript">
		var url = "<?php echo 'http://users.atw.hu/' . $_SERVER['REQUEST_URI'];?>"; // Javascript url változóban tárolja PHP URL értékét
	</script>



	<!-------------------------- Footer -------------------------->

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