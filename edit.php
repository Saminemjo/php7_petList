<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
if(isset($_GET["data"]))
 {
     $data = $_GET["data"];
 }
include 'ChromePhp.php';
ChromePhp::log('Hello console!');
ChromePhp::log($data);
$con = mysqli_connect("localhost", "root", "root", "test");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query="SELECT * FROM `pets` WHERE id=$data";
$result = mysqli_query($con, $query);
$dataArray = mysqli_fetch_array($result);
ChromePhp::log($dataArray);
?>
<html>
<head>
  <title>Edition</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css"</link>
  <link rel="stylesheet" href="./style.css"</link>
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
      <a class="navbar-item" href="accueil.php">
        Accueil
      </a>
    </div>
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
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
  			Editer les informations
      </h1>
      <h2 class="subtitle">
        Modifiez la fiche de votre compagnon
      </h2>
    </div>
  </div>
</section>
<div id="main" class="container main_add">
  <p class="titre2 title is-1"> Mon compagnon <?php echo $dataArray['name']?></p>
  <div class="formulaire2 columns is-mobile is-centered">
    <div class="column is-half is-narrow">
      <?php
      // $con = mysqli_connect("localhost", "root", "root", "test");
      // // Check connection
      // if (mysqli_connect_errno()) {
      //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
      // }
      // // If form submitted, insert values into the database.
      if (isset($_POST['submit'])) {
          $name = $_POST['name'];
          $sex = $_POST['sex'];
          $identity = $_POST['identity'];
          $food = $_POST['food'];
          $description = $_POST['description'];
          $birthdate = $_POST['birthdate'];
          $query2 = "UPDATE pets SET name = '$name', sex='$sex', identity='$identity', food='$food', description='$description', birthdate='$birthdate' WHERE id='$data'";
          $result2 = mysqli_query($con, $query2);
          ChromePhp::log($data);
          if ($result2) {
              header("Location: accueil.php");
          } else {
              echo "<div id='myAlert' class='notification is-danger'>
											<button class='delete' onClick='myFunction2()'></button>
											Une erreur s'est produite, ton compagnon n'a pas été modifié !
										</div>";
          }
      } {
      ?>

<form name="newPet" action="" method="post">
    <div class="field">
      <label class="label">Espèce</label>
      <div class="control">
    <div class="select is-fullwidth">
      <select id="espece" name="specie" disabled>
        <option><?php echo $dataArray['specie']?></option>
      </select>
    </div>
    </div>
  </div>
  <div class="field">
  <div class="control" value=<?php echo $dataArray['sex']?> >
    <label class="radio">
      <input type="radio" name="sex" value="Femelle" <?php if ($dataArray['sex'] == 'Femelle') echo 'checked="checked"'; ?> >
      Femelle
    </label>
    <label class="radio">
      <input type="radio" name="sex" value="Mâle" <?php if ($dataArray['sex'] == 'Mâle') echo 'checked="checked"'; ?>>
    Mâle
    </label>
  </div>
</div>

  <div class="field">
    <label class="label">Nom *</label>
    <div class="control">
      <input class="input liquid_input" type="text" name="name" placeholder="Pupuce" value=<?php echo $dataArray['name']?> required>
    </div>
  </div>
  <div class="field">
    <label class="label">Puce d'identification</label>
    <div class="control">
      <input class="input liquid_input" type="text" name="identity" placeholder="45558225KLM552" value=<?php echo $dataArray['identity']?> >
    </div>
  </div>

  <div class="field">
    <label class="label">Date de naissance</label>
    <div class="control">
      <input class="input liquid_input" name="birthdate" type="date" placeholder="Date de naissance" value=<?php echo $dataArray['birthdate']?>>
    </div>
  </div>

  <div class="field">
    <label class="label">Ce qu'il aime manger :</label>
    <div class="control">
      <input class="input liquid_input" name="food" type="text" placeholder="Miam" value=<?php echo $dataArray['food']?> >
    </div>
  </div>


  <div class="field">
    <label class="label">Comportement</label>
    <div class="control">
      <textarea class="textarea liquid_input" placeholder="Il dort beaucoup la journée..." name="description"><?php echo $dataArray['description']?></textarea>
    </div>
  </div>



  <div class="field is-grouped">
    <div class="control">
      <button type="submit" name="submit" class="button is-link">Soumettre</button>
    </div>
    <div class="control">
      <button class="button is-text">Annuler</button>
    </div>
  </div>
</form>
<?php
}
?>
</div>

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

<script>
function bg(){
	switch (document.getElementById('espece').value) {
  case 'Chien':
	document.getElementById('main').style.backgroundImage="url('./img/dog.jpg')";
    break;
  case 'Chat':
	document.getElementById('main').style.backgroundImage="url('./img/cat.jpg')";
		break;
  case "Cobaye":
	document.getElementById('main').style.backgroundImage="url('./img/cobaye.jpg')";
		break;
  case "Furet":
	document.getElementById('main').style.backgroundImage="url('./img/furet.jpg')";
		break;
  case 'Lapin nain':
	document.getElementById('main').style.backgroundImage="url('./img/bunny.jpg')";
		break;
  case 'Hamster':
	document.getElementById('main').style.backgroundImage="url('./img/hamster.jpg')";
		break;
  case 'Poisson rouge':
	document.getElementById('main').style.backgroundImage="url('./img/fish.jpg')";
		break;
  default:
    console.log('oups');
}}
bg();
function myFunction() {
    document.getElementById("myDIV").style.display = "none";
}
function myFunction2() {
    document.getElementById("myAlert").style.display = "none";
}
</script>
<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
</body>
</html>





<?php







?>
