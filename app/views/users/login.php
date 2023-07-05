<?php
    require_once '../../include.php';
    require_once '../../controllers/Users.php';

    $user = new Users;
    $user->Login();
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
	<main class="webpage-content">
		<section class="user-auth-form">
			<form id="login-form" action="login.php" method="post">
				<div class="user-auth-field">
					<label>
						<input type="text" class="input-field" id="username-field" name="username" placeholder="Username">
					</label>
					<div class="form-requirements invalid-input" id="username-requirements">
                        <?php
                        if(isset($_GET['usernameErr'])) {
                            echo $_GET['usernameErr'];
                            unset($_GET['usernameErr']);
                        }
                        ?>
					</div>
				</div>
				<div class="user-auth-field">
					<label>
						<input type="password" class="input-field" id="password-field" name="password" placeholder="Password">
					</label>
					<div class="form-requirements invalid-input" id="password-requirements">
                        <?php
                        if(isset($_GET['passwordErr'])) {
                            echo $_GET['passwordErr'];
                            unset($_GET['passwordErr']);
                        }
                        ?>
					</div>
				</div>
				<button type="submit" class="submit-btn" id="login-submit-btn" name="submit-btn" value="Login">Login</button>
				<hr>
				<p>Don't have an account yet? <a href="signup.php">Click to sign up</a></p>
			</form>
		</section>
	</main>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>