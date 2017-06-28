
<div class ="log-container">
  <div class ="register">
  <h4 class="logo" id="registerTitle">Register</h4>
    <form action="?register" method="post">
      <label for="register">Username :</label>
      <input type="text" name="register" placeholder="Root" required maxlength="32" />
      <label for="password">Password :</label>
      <input type="password" name="password" placeholder="******" required maxlength="100"/>
      <label for="email">E-mail :</label>
      <input type="email" name ="email" placeholder="root@admin.com" required maxlength="64"/>
      <div class="g-recaptcha" data-sitekey="6LeD_CYUAAAAAANs3uEBV2FLfYFBwAm8aoiEKhm5"></div>
      <input class="loguser" type="submit" value='Create an account' />
 
    </form>
  </div>
  <div class ="login">
  <h4 class="logo" id="loginTitle">Log in</h4>
    <form action="?login" method="post">
      <label for="login">Username :</label>
      <input type="text" name="login" placeholder="Root" required maxlength="32"/>
      <label for="password">Password :</label>
      <input type="password" name="password" placeholder="******" required maxlength="100" />
      <input class="loguser" type="submit" value='Log in' />
    </form>
  </div>
</div>
