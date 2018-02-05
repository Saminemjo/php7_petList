<?php
$con = mysqli_connect("localhost", "root", "root", "test");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
session_start();

?>

<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css"</link>
  <link rel="stylesheet" href="style.css" type="text/css"</link>
</head>

<body>
  <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
      <a class="navbar-item"
        <span class="icon is-large"><i class="fas fa-3x fa-paw"></i></span>
        <p class="navTitle"> PetList</p>
      </a>
  </div>
</nav>
<div class="container is-fluid main">
<div class="columns is-centered">
  <div class="column"></div>
  <div class="column titre ">
    <p class="title is-1 ">Accueil</p>
    <p class="subtitle is-3 ">Subtitle 3</p>
  </div>
  <div class="column"></div>
</div>

<?php
if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($con, $username);
    $username = stripslashes($_POST['username']);
    $password = mysqli_real_escape_string($con, $password);
    $password = stripslashes($_POST['password']);

    $query = "SELECT * FROM `users` WHERE username='$username' AND password='".md5($password)."'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows==1) {
        $_SESSION['username'] = $username;
        while ($row = mysqli_fetch_array($result)) {
            echo "id: " . $row["id"]. "<br>";
            $_SESSION['id'] = $row['id'];
        }

        header("Location: accueil.php");
    } else {
        echo
    "
    <div class='columns is-mobile is-centered'>
    <div class='column is-one-quarter is-narrow is-centered'>
    <div id='myAlert' class='notification is-danger'>
    <h3>Identifiant ou mot de passe incorrect.</h3><br/>
    Cliquez <a href='index.php'>ici</a> pour vous connecter.
    </div>
    </div>
    </div>";
    }
} else {
    ?>
<br/>
<div class="formulaire columns is-mobile is-centered">
  <div class="column is-one-quarter is-narrow">
  <form action="" method="post" name="login">
    <div class="field">
      <p class="control has-icons-left has-icons-right">
        <input class="input liquid_input" type="text" name="username" placeholder="Nom d'utilisateur" required>
        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
        <span class="icon is-small is-right">
          <i class="fas fa-check"></i>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control has-icons-left">
        <input class="input liquid_input" type="password" placeholder="Password" required>
        <span class="icon is-small is-left">
          <i class="fas fa-lock"></i>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button is-info">
          se connecter
        </button>
      </p>
    </div>
  </form>
  <a href="inscription.php">Vous inscrire</a>
</div>
</div>

<?php
}
?>
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

<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
</body>

</html>
