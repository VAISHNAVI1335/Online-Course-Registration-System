<?php
session_start(); include "config.php"; $message="";
if(isset($_POST["login"])){
$email=trim($_POST["email"]); $password=$_POST["password"];
$stmt=mysqli_prepare($conn,"SELECT id,name,email,password FROM students WHERE email=?"); mysqli_stmt_bind_param($stmt,"s",$email); mysqli_stmt_execute($stmt);
$student=mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if($student && password_verify($password,$student["password"])){$_SESSION["student_id"]=$student["id"];$_SESSION["student_name"]=$student["name"];header("Location: dashboard.php");exit;}
$message="Invalid email or password.";
}
include "includes/header.php"; include "includes/navbar.php"; ?>
<div class="container py-4"><div class="form-box"><div class="text-center mb-4"><div class="big-icon">🔐</div><h2>Student Login</h2><p class="text-muted">Access your learning dashboard</p></div>
<?php if($message) echo '<div class="alert alert-danger">'.htmlspecialchars($message).'</div>'; ?>
<form method="POST"><div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control form-control-lg" required></div>
<div class="mb-4"><label>Password</label><input type="password" name="password" class="form-control form-control-lg" required></div>
<button name="login" class="btn btn-primary btn-lg w-100">Login</button></form>
<p class="text-center mt-4">New student? <a href="register.php">Create Account</a></p></div></div>
<?php include "includes/footer.php"; ?>