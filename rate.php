<?php
$filmID = $_POST['submit'];
$userID = $_SESSION['loginID'];
try {
  $dataBase = new PDO('mysql:host=localhost;dbname=afpaBay;charset=utf8', 'root', 'admin');
  $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $dbFilms_Users = $dataBase->prepare("INSERT INTO Films_Users(UserID, FilmID) VALUES (:userID, :filmID)");

  $dbFilms_Users->bindParam(':userID', $userID);
  $dbFilms_Users->bindParam(':filmID', $filmID);

  $dbFilms_Users->execute();
  if (headers_sent()) {
    die("Error: headers already sent!");
  }
  else {
    header("Location: index.php?afpabay", true);
    exit();
  }
}
catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
}
?>
