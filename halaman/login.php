<?php
  require_once("../vendor/autoload.php");
  require_once("../pengaturan/pengaturan.php");
  require_once("../pengaturan/helper.php");
  require_once("../pengaturan/database.php");
?>

<html>
  
  <!-- Bagian head -->
  <?php include("../template/head.php") ?>
  <style>
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700);
body {
    background: -webkit-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -moz-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -ms-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: -o-linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    background: linear-gradient(90deg, #FF512F 10%, #DD2476 90%);
    font-family: 'Open Sans', sans-serif!important;
}
.well{
    background-color:#fff!important;
    border-radius:0!important;
    border:none!important;
}

.well.login-box {
    width:300px;
    margin:0 auto;
    display:none;
}
.well.login-box legend {
  font-size:26px;
  text-align:center;
  font-weight:300;
}
.well.login-box label {
  font-weight:300;
  font-size:16px;
  
}
.well.login-box input[type="text"] {
  box-shadow:none;
  border-color:#ddd;
  border-radius:0;
}

.well.welcome-text{
    font-size:21px;
}

/* Notifications */

.notification{
    position:fixed;
    top: 20px;
    right:0;
    background-color:#FF4136;
    padding: 20px;
    color: #fff;
    font-size:21px;
    display:none;
}
.notification-success{
  background-color:#3D9970;
}

.notification-show{
    display:block!important;
}

  </style>
  <body>
    <div class="container">
      <div class="row">
      <div class="col-md-12">
        <div class="well login-box">
          <form action="">
            <legend>Login</legend>
            <div class="form-group">
              <label for="username-email">E-mail or Username</label>
              <input value='' id="username-email" placeholder="E-mail or Username" type="text" class="form-control" />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" value='' placeholder="Password" type="text" class="form-control" />
            </div>
            <div class="form-group text-center">
              <button class="btn btn-danger btn-cancel-action">Cancel</button>
              <input type="submit" class="btn btn-success btn-login-submit" value="Login" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
