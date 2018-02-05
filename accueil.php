<?php
session_start();
if (!isset($_SESSION['username'])) {
	header ('Location: index.php');
	ChromePhp::log($_SESSION);
	exit();
}
include "ChromePhp.php";
?>
<html>
<head>
  <title>Espace accueil</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css"</link>
	<link rel="stylesheet" href="style.css" type="text/css"</link>
	<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>

</head>

<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
		<a class="navbar-item"
			<span class="icon is-large"><i class="fas fa-3x fa-paw"></i></span>
			<p class="navTitle"> PetList</p>
		</a>
  </div>
	<div class="navbar-end">
	<div class="navbar-item">
		<div class="field is-grouped">
			<p class="control">
				<a class="button is-primary" href="deconnexion.php">
					<span class="icon">
						<i class="fas fa-sign-out-alt"></i>
					</span>
	    	<span>Déconnexion</span>
				</a>
			</p>
		</div>
	</div>
</div>
</nav>


<section class="hero is-info">
	<div class="hero-body">
		<div class="container">
			<h1 class="title">
	Bienvenue <?php echo htmlentities(trim($_SESSION['username'])); ?> !<br />
			</h1>
			<h2 class="subtitle">
				Commence à ajouter la fiche de tes compagnons préférés !
			</h2>
			<a class="button is-success is-inverted" href="ajout.php">
				<span class="icon">
					<i class="fas fa-plus"></i>
				</span>
			<span>Ajoute un compagnon</span>
			</a>
		</div>
	</div>
</section>
<div class="container">
<p class="titre2 title is-1">La liste de mes compagnons :</p>
<div class='columns is-multiline is-mobile'>
<?php
$con = mysqli_connect("localhost", "root", "root", "test");

if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id=$_SESSION['id'];
$query = "SELECT * FROM `pets` WHERE user='$id'";
$result = mysqli_query($con, $query) or die(mysql_error());
while ($data = mysqli_fetch_array($result)) {
switch ($data['specie']) {
    case "Chat":
    $img='img/cat.jpg';
        break;
    case "Hamster":
    $img='img/hamster.jpg';
        break;
    case "Lapin nain":
    $img='img/bunny.jpg';
        break;
    case "Chien":
    $img='img/dog.jpg';
        break;
    case "Poisson rouge":
    $img='img/fish.jpg';
        break;
    case "Furet":
    $img='img/furet.jpg';
        break;
    case "Cobaye":
    $img='img/cobaye.jpg';
        break;
};
	// on affiche les résultats
  echo "
	  <div class='column is-one-quarter'>
	<div class='card'>
<div class='card-image'>
    <figure class='image is-4by3'>
      <img class='card_img' src=".$img." alt='Placeholder image'>
    </figure>
  </div>
  <div class='card-content'>
    <div class='media'>
      <div class='media-content card_title'>
        <p class='title is-4'>".$data['name']."</p>
        <p class='subtitle is-6'>".$data['specie']. " ".$data['sex']."</p>
      </div>
			<div class='media-right'>
			<a href='edit.php?data=".$data['id']."'><span class='icon'>
				<i class='fas fa-edit'></i>
			</span></a>
			<a href='delete.php?data=".$data['id']."'><span class='icon'>
				<i class='fas fa-trash'></i>
			</span></a>
      </div>
    </div>

    <div class='content'>
		";
		if($data['birthdate'] !== ""){
			echo "naissance le : " .$data['birthdate']. "<br>";
		};
		if($data['description'] !== ""){
			echo $data['description']. "<br>";
		};
		if($data['food'] !== ""){
			echo	"il aime manger : " .$data['food']."<br>";
		};
		echo "
	</div>
  </div>
	</div>
</div>";
}
mysqli_free_result ($result);
?>
</div>
</div>
<footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        <strong>PetList</strong> by <a href="http://www.linkedin.com/in/sabrina-mardjoeki">Sabrina Mardjoeki</a>. The source code is here
        <a href="https://github.com/Saminemjo">
					<span class="icon"><i class="fab fa-github"></i>
				</span></a>.
      </p>
    </div>
  </div>
</footer>
</body>
</html>
