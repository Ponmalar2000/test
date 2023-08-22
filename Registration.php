
  
<?php
include'config.php';
  $query2 = "select * from reg order by rid desc limit 1";
  $result2 = mysqli_query($conn,$query2);
  $row = mysqli_fetch_array($result2);
  $last_id = $row[ 'rid'];
  if ($last_id == "")
  {
      $customer_ID = "REG 1";
  }
  else
  {
      $customer_ID = substr($last_id, 3);
      $customer_ID = intval($customer_ID);
      $customer_ID = "REG " . ($customer_ID + 1);
  }

?>
<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
     $rid = $_POST['rid'];
	$email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $gender = $_POST['gender'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM reg WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO reg (username, rid, email, phoneno, password, cpassword, gender)
					VALUES ('$username', '$rid', '$email', '$phoneno', '$password', '$cpassword', '$gender')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Registration Completed Sucessfully.')</script>";

				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('oops.!! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('oops.!! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>
 


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Registration Form </title>
    <link rel="stylesheet" href="regstyle.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="registration.php" Method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">User Name</span>
            <input type="text" name="username" placeholder="Enter your username" value="<?php echo $username; ?>" required>
          </div>
          <div class="input-box">
<span class ="details">Registration Id</span>
<input type="text" name= "rid" value="<?php echo $customer_ID; ?>"readonly>
</div>
          
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email"] placeholder="Enter your email" value="<?php echo $email; ?>" required >
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name="phoneno"  placeholder="Enter your number" value="<?php echo $phoneno; ?>"  required >
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password"  name="password" placeholder="Enter your password" value="<?php echo $_POST["password"]; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="cpassword" placeholder="Confirm your password" value="<?php echo $_POST["cpassword"]; ?>" required >
          </div>
        </div>
        <div class="gender-details">
          <input type="radio"  name="gender" value="m" id="dot-1" value="<?php echo $gender; ?>">
          <input type="radio" name="gender" value="f" id="dot-2" value="<?php echo $gender; ?>">
          <input type="radio" name="gender" value="o" id="dot-3" value="<?php echo $gender; ?>">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>        <div class="button">
          <input type="submit" value="Register" name="submit">
<p class="login-register-text" style="font-size: 26px;  font-weight: 600;  color: #fff;">  
<a href="login.php">Have an account? Login Here</a>.</p>
		
        </div>
      </form>
    </div>
  </div>

</body>
</html>
