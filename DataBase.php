<?php

class DataBase {

  function connect() {
    try {
      $dataBase = new PDO('mysql:host=localhost;dbname=afpaBay;charset=utf8', 'root', 'admin');
      $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dataBase;
    }
    catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  function showList($user) {
    $dataBase = DataBase::connect();
    $reponse = $dataBase->query('SELECT * from Films');

    while ($data = $reponse->fetch()) {
        echo "<div class='film-container'>
                 <div class='left-container'>
                   <div class='thumbnail-container'>
                     <img src=" . $data['image'] . ">
                   </div>
                   <form class='rate-form' action='?rate' method='post'>
                     <input class='logo favorite' type='submit' name='submit' value='&#xf08a' />
                     <input class='logo ratedown' type='submit' name='submit' value='&#xf087' />
                     <input class='logo rateup' type='submit' name='submit' value='&#xf088' />
                     <button class='logo seen' type='submit' name='submit' " . DataBase::check($data['id'], $user) . " value=" . $data['id'] . ">&#xf06e</button>
                   </form>
                 </div>
                <div class='description-container'>
                  <div class='title-container'>
                    <h4>" . $data['title'] . "</h4>
                    <span> <i>Release date</i> : " . $data['releaseDate'] . "</span>
                  </div>
                  <div class='synopsis-container'>
                    <p>" . $data['description'] . "</p>
                  </div>
                  <div class='mvp-container'>
                    <div class='author-container'>
                      <p class='centered'>Author :</p>
                      <p>" . $data['author'] . "</p>
                    </div>
                    <div class='actors-container'>
                      <p class='centered'>Actors :</p>
                      <p>" . $data['actors'] . "</p>
                    </div>
                  </div>
                </div>
              </div>";
    }
  }
  function showListFiltered($filter, $filterType, $user) {
    $dataBase = DataBase::connect();
    $filterreponse = NULL;
    $newFilter = strtolower($filter);

    switch($filterType) {
      case 'Title':
        $filterreponse = $dataBase->prepare("SELECT * FROM Films WHERE LOWER(title) LIKE '%' :title '%'");
        $filterreponse->bindParam(':title', $newFilter);
        break;
      case 'DateB':
        $filterreponse = $dataBase->prepare("SELECT * FROM Films WHERE releaseDate <= :released");
        $filterreponse->bindParam(':released', $newFilter);
        break;
      case 'DateA':
        $filterreponse = $dataBase->prepare("SELECT * FROM Films WHERE releaseDate >= :released");
        $filterreponse->bindParam(':released', $newFilter);
        break;
      case 'Author':
      case 'Actors':
        $filterreponse = $dataBase->prepare("SELECT * FROM Films WHERE LOWER(actors) LIKE '%' :actors '%'");
        $filterreponse->bindParam(':actors', $newFilter);
        break;
    }
    $filterreponse->execute();
    while ($data = $filterreponse->fetch())
    {
        echo "<div class='film-container'>
                <div class='left-container'>
                  <div class='thumbnail-container'>
                    <img src=" . $data['image'] . ">
                  </div>
                  <form class='rate-form' action='?rate' method='post'>
                    <input class='logo favorite' type='submit' value='&#xf08a' />
                    <input class='logo ratedown' type='submit' value='&#xf087' />
                    <input class='logo rateup' type='submit' value='&#xf088' />
                    <input class='logo seen' type='submit'" . DataBase::check($data['id'], $user) . "name='submit' value='&#xf06e' />
                  </form>
                </div>
              <div class='description-container'>
                <div class='title-container'>
                  <h4>" . $data['title'] . "</h4>
                  <span> <i>Release date</i> : " . $data['releaseDate'] . "</span>
                </div>
                <div class='synopsis-container'>
                  <p>" . $data['description'] . "</p>
                </div>
                <div class='mvp-container'>
                  <div class='author-container'>
                    <p class='centered'>Author :</p>
                    <p>" . $data['author'] . "</p>
                  </div>
                  <div class='actors-container'>
                    <p class='centered'>Actors :</p>
                    <p>" . $data['actors'] . "</p>
                  </div>id
                </div>
              </div>
            </div>";
    }
  }
  function check($currentfilmID, $currentUser) {
    $userID = $currentUser;
    $filmID = $currentfilmID;

    $dataBase = DataBase::connect();

    $dbFilms_Users = $dataBase->prepare("SELECT * FROM Films_Users WHERE UserID = :userID AND FilmID = :filmID");

    $dbFilms_Users->bindParam(':userID', $userID);
    $dbFilms_Users->bindParam(':filmID', $filmID);

    $dbFilms_Users->execute();

    if ($dbFilms_Users->fetch()) {
      return 'disabled title="Already seen"';
    }
  }
  function signUp($login, $password, $email) {
    $info;
    $dataBase = DataBase::connect();
    $dbFilms = $dataBase->prepare("INSERT INTO Users(login,
                                                   password,
                                                   email) VALUES (
                                                   :login,
                                                   :password,
                                                   :email)"
                               );

    $dbFilms->bindParam(':login', $login);
    $dbFilms->bindParam(':password', $password);
    $dbFilms->bindParam(':email', $email);

    $dbFilms->execute();
  }
  function signIn($login, $password) {
    $dataBase = DataBase::connect();

    $dbFilms = $dataBase->prepare("SELECT * FROM Users WHERE login = :login");
    $dbFilms->bindParam(":login", $login, PDO::PARAM_STR);
    $dbFilms->execute();
    $dbUser = $dbFilms->fetch();

    if (password_verify($password, $dbUser['password'])) {
      $info = [true, $dbUser['id']];
    } else {
      $info = [false, $dbUser['id']];
    }
    if (headers_sent()) {
       die("Error: headers already sent!");
    }
    else {
       header("Location: index.php?afpabay", true);
       return $info;
       exit();
    }
  }
  function addFilm($title, $date, $decription, $authors, $actors, $url) {
      $dataBase = DataBase::connect();
      $dbFilms = $dataBase->prepare("INSERT INTO Films(title,
                                          description,
                                          image,
                                          releaseDate,
                                          author,
                                          actors) VALUES (
                                          :title,
                                          :decription,
                                          :url,
                                          :release,
                                          :authors,
                                          :actors)"
                                        );

        $dbFilms->bindParam(':title', $title);
        $dbFilms->bindParam(':decription', $decription);
        $dbFilms->bindParam(':url', $url);
        $dbFilms->bindParam(':release', $date);
        $dbFilms->bindParam(':authors', $authors);
        $dbFilms->bindParam(':actors', $actors);

        $dbFilms->execute();
  }
}
?>
