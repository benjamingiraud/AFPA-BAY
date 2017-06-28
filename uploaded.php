
<div id="afpabay" class="main-container">
  <h3>AFPABAY</h3>
  <div class="upload-container">
    <p>Thanks for uploading your film</p>
    <?php

      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["imagesrc"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["imagesrc"]["tmp_name"]);

      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["imagesrc"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          $target_file = $target_dir . $_POST["filmTitle"] . "." . $imageFileType;
          if (move_uploaded_file($_FILES["imagesrc"]["tmp_name"], $target_file)) {
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }

      $title       =    $_POST["filmTitle"];
      $date        =    $_POST["releaseDate"];
      $decription  =    $_POST["description"];
      $authors     =    $_POST["authors"];
      $actors      =    $_POST["actors"];
      $url         =    $target_file;

      require 'DataBase.php';
      DataBase::addFilm($title, $date, $decription, $authors, $actors, $url);

     ?>
   </div>
</div>
