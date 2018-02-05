<?php
if(isset($_GET["data"]))
 {
     $data = $_GET["data"];
 }
$con = mysqli_connect("localhost", "root", "root", "test");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query3 = "DELETE FROM pets WHERE id=$data";
$result = mysqli_query($con, $query3);
if ($result) {
    header("Location: accueil.php");
} else {
    echo "
    <html>
    <head>
      <title>Suppression</title>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css'</link>
      <link rel='stylesheet' href='./style.css'</link>
    </head>
    <body>
    <div id='myAlert' class='notification is-danger'>
      Une erreur s'est produite, ton compagnon n'a pas été inséré !
      <button class='is-danger' href='accueil.php></button>
      </div>
      </body>
      </html>
  ";
}
?>
