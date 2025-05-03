<?php
	require_once("includes/header.php");
	require_once("includes/classes/Account.php");
	require_once("includes/classes/FormSanitizer.php");
	require_once("includes/classes/Constants.php");

	$detailsMessage = "";
	$passwordMessage = "";

	if(isset($_POST["saveDetailsButton"])) {
		$account = new Account($con);

		$firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
		$lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
		$email = FormSanitizer::sanitizeFormEmail($_POST["email"]);

		if($account->updateDetails($firstName, $lastName, $email, $userLoggedIn)) {
			$detailsMessage = "<div class='alertSuccess'>
									Details updated successfully!
								</div>";
		}
		else {
			$errorMessage = $account->getFirstError();

			$detailsMessage = "<div class='alertError'>
									$errorMessage
								</div>";
		}
	}

	if(isset($_POST["savePasswordButton"])) {
		$account = new Account($con);

		$oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]); 
		$newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
		$newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);

		if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)) {
			$passwordMessage = "<div class='alertSuccess'>
									Password updated successfully!
								</div>";
		}
		else {
			$errorMessage = $account->getFirstError();

			$passwordMessage = "<div class='alertError'>
									$errorMessage
								</div>";
		}
	}

?>

<div class="settingsContainer column">

    <div class="formSection">

        <form method="POST">

            <h2>User details</h2>
            
            <?php
            $user = new User($con, $userLoggedIn);

            $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getFirstName();
            $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getLastName();
            $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
            ?>

            <input type="text" name="firstName" placeholder="First name" value="<?php echo $firstName; ?>">
            <input type="text" name="lastName" placeholder="Last name" value="<?php echo $lastName; ?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">

            <div class="message">
                <?php echo $detailsMessage; ?>
            </div>
            
            <input type="submit" name="saveDetailsButton" value="Save">


        </form>

    </div>

    <div class="formSection">
	
	<h2style="color: black;">Developed by:-<h2>		
	 <ul>
            <li style="color:#7fffcf   ;">ANUSHKA VERMA (23103389)</li><br>
            <li style="color: #7fffcf;">SAMBHAV JAIN  (23103395)</li><br>
            <li style="color: #7fffcf;">ANUSHREE SAHU (23103396)</li><br>
            <li style="color: #7fffcf;">ARPITA TOMAR  (23103400)</li><br>
        </ul> 
	<h2style="color: black;">DATABASE SYSTEMS AND WEB MINI PROJECT<h2>
    </div>
</div>