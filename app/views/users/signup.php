<?php
    require_once '../../include.php';
    require_once '../../controllers/Users.php';

    $user = new Users;
    $user->Signup();
?>
<html lang="en-US">
<?php require APPDIR.'/views/include/head.php' ?>
<body>
    <?php require APPDIR.'/views/include/header.php' ?>
	<main class="webpage-content">
		<section class="user-auth-form">
			<form id="signup-form" onsubmit="return validateSignup()" action="signup.php" method="post">
				<div class="user-auth-field">
					<label>
						<input type="text" class="input-field" id="username-field" name="username" placeholder="Username">
					</label>
					<div class="form-requirements" id="username-requirements">
						Usernames must be between 6 and 32 characters
					</div>
					<div class="invalid-input">
						<?php
                        if(isset($_GET['usernameErr']) && $_GET['usernameErr'] != '') {
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
					<div class="form-requirements" id="password-requirements">
						Passwords requirements:
						<ul id="password-requirements-list">
							<li id="minCharacters">At least eight characters</li>
							<li id="minCapital">At least one capital letter</li>
							<li id="minNumber">At least one number</li>
							<li id="containsUsername">Cannot contain username</li>
						</ul>
						<div class="invalid-input">
							<?php
							if(isset($_GET['passwordErr']) && $_GET['passwordErr'] != '') {
								echo $_GET['passwordErr'];
								unset($_GET['passwordErr']);
							}
							?>
						</div>
					</div>
				</div>
				<div class="user-auth-field">
					<label>
						<input type="password" class="input-field" id="confirm-password-field" name="confirmPassword" placeholder="Confirm Password">
					</label>
					<div class="form-requirements" id="confirm-password-match">
						<div class="invalid-input">
							<?php
							if(isset($_GET['confirmPasswordErr']) && $_GET['confirmPasswordErr'] != '') {
								echo $_GET['confirmPasswordErr'];
								unset($_GET['confirmPasswordErr']);
							}
							?>
						</div>
					</div>
                    <br>
				</div>
				<button type="submit" class="submit-btn" id="signup-submit-btn" name="submit-btn" value="Signup">Sign Up</button>
				<hr>
				<p>Already have an account? <a href="login.php">Click to login</a></p>
			</form>
		</section>
	</main>
    <script src='<?php echo 'http://localhost:63342/SimpleProject/public/javascript/signup.js' ?>' ></script>
    <?php require APPDIR.'/views/include/footer.php' ?>
</body>
</html>