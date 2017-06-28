<div id="afpabay" class="main-container">
  <h3>AFPABAY</h3>
  <div class="afpabay-wrapper">
    <div class="films-container">
      <?php
        if (isset($_SESSION["login"])) {
          include 'greet.php';
        }
        else {
          include 'loginform.php';
        }
       ?>
      <div class ="filteradd-container">
        <form action="?filter" method="post">
          <label for="Filter">Filter by : </label>
            <select id="filter" name="filter">
              <option value="Title">Title</option>
              <option value="DateB">Before: Year</option>
              <option value="DateA">After: Year</option>
              <option value="Author">Author</option>
              <option value="Actors">Actors</option>
            </select>
            <input id='tfilter' type="text" name="txtFilter" />
            <input id="ifilter" type="submit" value=&#xf002 />
        </form>
      </div>
      <?php
       if (isset($_SESSION['loginID'])) {
           require 'DataBase.php';
           $currentUser = $_SESSION['loginID'];
           if (isset($_POST["txtFilter"])) {
               DataBase::showListFiltered($_POST["txtFilter"], $_POST["filter"], $currentUser);
           }
           else {
               DataBase::showList($currentUser);
           }
       } else
           echo "<div class='connectionrequired-container'>
                    <span class='logo warning'>You must be connected to see this content</span>
                </div>";
      ?>
    </div>
  </div>
</div>
