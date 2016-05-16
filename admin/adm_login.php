<?php
require_once '../account_inc/functions.php';
require_once '../core/db.php';
require_once '../core/init.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();

?>

<?php
include 'includes/head.php';
?>

<style>
 body{
   background-image: url("/takeiteasy/images/blog-pic2.jpg");
   background-size: 100vw 100vh;
   background-attachment: fixed;
 }
</style>

<div id="login-form">
	
	<div>
		<?php
			if($_POST){
			// Form validation
			if(empty($_POST['email']) || empty($_POST['password'])){
			  $errors[] = 'You must provide email and password';
			}
			// Validate email
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			  $errors[] = 'You must enter validate email';
			}
			
			//password is more than 6 character
			if(strlen($password) < 6){
			  $errors[] = 'Password must be at 6 characters.';
			}
			
			// Check if email exists in the database
			$query = $db->query("SELECT * FROM admin WHERE email = '$email'");
			$user = mysqli_fetch_assoc($query);
			$userCount = mysqli_num_rows($query);
			if($userCount < 1){
			  $errors[] = "That email doesn't exit in our database";
			}
			
			if(!password_verify($password, $user['password'])){
			  $errors[] = 'The password does not match our records. Please try again.';
			}
			
			//Check for errors
			if(!empty($errors)){
			  echo display_errors($errors);
			}else {
			  //log user in
			  $user_id = $user['id'];
			  login($user_id);
			}
			
			}
		;?>
  </div>



  <h2 class="text-center">Login</h2><hr>
  <form action="adm_login.php" method="post">
    <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
  </div><br>
    <div class="form-group">
     <input type="submit" value="Login" class="btn btn-primary">
    </div>
  </form>
  <p class="text-right"><a href="/takeiteasy/index.php" alt="home">Visiter le site</a></p>
</div>


<?php
include 'includes/footer.php';
?>

