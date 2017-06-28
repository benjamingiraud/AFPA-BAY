<div id="afpabay" class="main-container">
  <h3>AFPABAY</h3>
  <?php
    if (isset($_SESSION["login"])) {
      include 'greet.php';
    }
    else {
      include 'loginform.php';
    }
   ?>
  <div class="form-container">
    <form method="post" class="formupload" action="?uploaded" enctype="multipart/form-data">
     <label for="filmTitle">Title : </label>
     <input required type="text" id="filmTitle" name="filmTitle" placeholder="Title" maxlength="256">

     <label for="releaseDate">Released in : </label>
     <input required type="number" id="releaseDate" name="releaseDate" placeholder="e.g. 2000" min ="1850" maxlength="4">

     <label for="description">Description : </label>
     <textarea required id="description" name="description" style="height:200px" maxlength="2046"></textarea>

     <label for="imagesrc">Thumbnail : </label>
     <input required type="file" id="imagesrc" name="imagesrc">

     <label for="authors">Author(s) : </label>
     <input required type="texte" id="authors" name="authors" placeholder="author 1, author 2, author 3,...." maxlength="256">

     <label for="actors">Actors : </label>
     <input required type="texte" id="actors" name="actors" placeholder="actor 1, actor 2, actor 3,...." maxlength="256">


     <input id=sendupload class="logo" type="submit" value='&#xf093 Upload' >
 </form>
</div>
</div>
