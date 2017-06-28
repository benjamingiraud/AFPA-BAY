<div class ="log-container">
  <div class ="greet">
    <h4>Welcome, <?php echo $_SESSION["login"]; ?> </h4>
    <a class="logo upload" title="Upload a new film!" href="index.php?upload">&#xf093</a>
    <form class="disconnect" action="?logout" method="post">
      <input class="logo" type="submit" name="disconnect" value="&#xf011"/>
    </form>
  </div>
</div>
