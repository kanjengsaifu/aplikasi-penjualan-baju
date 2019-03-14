<?php
  require_once("../pengaturan/pengaturan.php");
  $judul = "Maryam Store";
?>
<html>
  
  <!-- Bagian head -->
  <?php include("../template/head.php") ?>
  <style type="text/css">
    body {
      background: url('../assets/img/background.jpg');
      background-repeat: no-repeat;
      background-size: auto;
    }
    #login-form {
      width: 400px;
      margin: 100px auto;
    }
  </style>
<body>
    <div class="card" id="login-form">
      <div class="card-header">
        <p style="font-size: 20pt; font-weight: bold; text-align: center;"><?=$nama_perusahaan?></p>
      </div>
      <div class="card-body">
        <form method="POST" action="proses-login.php">
          <div class="form-group">
            <label for="username"></label>
            <input type="text" class="form-control" name="username" placeholder="Username" required />
          </div> 
          <div class="form-group">
            <label for="password"></label>
            <input type="password" class="form-control" name="password" placeholder="Password" required />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>                      		                            
    <!-- semua asset js dibawah ini -->
    <?php
      include("../template/script.php");
      if(isset($_GET['login']))
      {
        echo "<script>alert('Username atau Password salah');</script>";
      }
    ?>
  </body>
</html>
