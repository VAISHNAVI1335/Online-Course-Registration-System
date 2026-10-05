<?php
session_start(); include "config.php"; $message=""; $type="info";
if(isset($_POST["register"])){
$name=trim($_POST["name"]); $email=trim($_POST["email"]); $mobile=trim($_POST["mobile"]);
$password=$_POST["password"]; $confirm=$_POST["confirm_password"];
if($name==""||$email==""||$mobile==""||$password==""){ $message="Please fill all fields."; $type="danger"; }
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){ $message="Enter a valid email."; $type="danger"; }
elseif($password!==$confirm){ $message="Passwords do not match."; $type="danger"; }
else{
$check=mysqli_prepare($conn,"SELECT id FROM students WHERE email=?"); mysqli_stmt_bind_param($check,"s",$email); mysqli_stmt_execute($check); mysqli_stmt_store_result($check);
if(mysqli_stmt_num_rows($check)>0){$message="Email already registered."; $type="warning";}
else{
$hash=password_hash($password,PASSWORD_DEFAULT); $stmt=mysqli_prepare($conn,"INSERT INTO students(name,email,mobile,password) VALUES(?,?,?,?)");
mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$mobile,$hash);
if(mysqli_stmt_execute($stmt)){$message="Registration successful! You can login now."; $type="success";}else{$message="Registration failed."; $type="danger";}
mysqli_stmt_close($stmt);
} mysqli_stmt_close($check);
}}
include "includes/header.php"; include "includes/navbar.php"; ?>
<div class="container py-4"><div class="form-box"><div class="text-center mb-4"><div class="big-icon">👩‍🎓</div><h2>Student Registration</h2><p class="text-muted">Create your CourseHub account</p></div>
<?php if($message) echo '<div class="alert alert-'.$type.'">'.htmlspecialchars($message).'</div>'; ?>
<form method="POST">
<div class="mb-3"><label>Full Name</label><input name="name" class="form-control form-control-lg" required></div>
<div class="mb-3"><label>Email Address</label><input type="email" name="email" class="form-control form-control-lg" required></div>
<div class="mb-3"><label>Mobile Number</label><input name="mobile" class="form-control form-control-lg" required></div>
<div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control form-control-lg" required></div>
<div class="mb-4"><label>Confirm Password</label><input type="password" name="confirm_password" class="form-control form-control-lg" required></div>
<button name="register" class="btn btn-primary btn-lg w-100">Create Account</button></form>
<p class="text-center mt-4 mb-0">Already registered? <a href="login.php">Login</a></p></div></div>
<?php include "includes/footer.php"; ?>