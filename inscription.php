<html>
<head>
  <title>Inscription</title>
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
</nav>
<section class="hero is-danger">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
      Inscription
      </h1>
      <h2 class="subtitle">
        Primary subtitle
      </h2>
    </div>
  </div>
</section>
<div class="container main">
<?php
$con = mysqli_connect("localhost", "root", "root", "test");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($con, $username);
    $username = stripslashes($_POST['username']);
    $email = mysqli_real_escape_string($con, $email);
    $email = stripslashes($_POST['email']);
    $password = mysqli_real_escape_string($con, $password);
    $password = stripslashes($_POST['password']);
    $trn_date = date("Y-m-d H:i:s");
    $query = "INSERT into `users` (username, password, email, trn_date)
  VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo   "
          <div class='columns is-mobile is-centered'>
          <div class='column is-one-quarter is-narrow is-centered'>
          <div class='notification is-success'>
          <h3>Vous avez bien été enregistré</h3><br/>
          Cliquez <a href='index.php'>ici</a> pour vous connecter.
          </div>
          </div>
          </div>";
    }
} else {
    ?>


<br/>
<form name="registration" action="" method="post">
  <div class="field">
    <p class="control has-icons-left">
      <input class="input" name="username" type="text" placeholder="Nom d'utilsateur">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
    </p>
  </div>
  <div class="field">
    <p class="control has-icons-left has-icons-right">
      <input class="input" type="email" name="email" placeholder="Email" required>
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
      <input class="input" type="password" placeholder="Password" required>
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
    </p>
  </div>
  <div class="field">
    <p class="control">
      <button class="button is-success">
        s'inscrire
      </button>
    </p>
  </div>
</form>
<?php
}
?>
</div>
<footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        <strong>PetList</strong> by <a href="www.linkedin.com/in/sabrina-mardjoeki">Sabrina Mardjoeki</a>. The source code is here
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
