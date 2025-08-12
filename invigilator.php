<?php session_start();?>
<?php include('head.php');?>
<link rel="stylesheet" href="popup_style.css">

<?php
  include('connect.php');
  if(isset($_POST['btn_login'])) {
    $unm = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = hash('sha256', $_POST['password']);

    function createSalt()
    {
        return '2123293dsj2hu2nikhiljdsd';
    }
    $salt = createSalt();
    $pass = hash('sha256', $salt . $passw);

    // Using prepared statements for security
    $sql = "SELECT * FROM tbl_teacher WHERE temail = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $unm, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    
    if($count == 1) {
      // Store session data
      $_SESSION["id"] = $row['id'];
      $_SESSION["password"] = $row['password'];
      $_SESSION["temail"] = $row['temail'];
      $_SESSION["fname"] = $row['tfname'];
      $_SESSION["lname"] = $row['tlname'];
      
      // Success message and redirect
      ?>
      <div class="popup popup--icon -primary js_primary-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup__content__title">Success</h3>
          <p>Login Successfully</p>
          <p>
            <?php echo "<script>setTimeout(\"location.href = 'invigilatorPanel.php';\",1500);</script>"; ?>
          </p>
        </div>
      </div>
      <?php
    } else {
      // Error message for invalid login
      ?>
      <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup__content__title">Error</h3>
          <p>Invalid Email or Password</p>
          <p>
            <a href="invigilator.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
          </p>
        </div>
      </div>
      <?php
    }
  }
?>

<style>
header {
  
}
</style>

<header>
</header>

<div id="main-wrapper" style='background:;'>
  <div class="unix-login">
    <div class="container-fluid" style="background-color:;">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <div class="login-content card">
            <div class="login-form" style='background:#f1f1f1;'>
              <center><h2>INVIGILATOR LOGIN</h2></center><br>
              <form method="POST">
                <div class="form-group">
                  <label>Email Address</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <div class="checkbox">
                  <label class="pull-right">
                    <a href="login.php">Admin Login</a>
                  </label>   
                </div>
                <button type="submit" name="btn_login" class="btn btn-warning btn-flat m-b-30 m-t-30">Log in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
	
<script src="js/lib/jquery/jquery.min.js"></script>
<script src="js/lib/bootstrap/js/popper.min.js"></script>
<script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/sidebarmenu.js"></script>
<script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="js/custom.min.js"></script>

</body>
</html>