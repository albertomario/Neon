<?php
include('./includes/loader.php');

$sPanelTitle = Core::GetSetting('panel_title');
$sRegistrationEnabled = Core::GetSetting('registration_enabled');

	if($sRegistrationEnabled->sValue == 'enabled'){
		if($LoggedIn === true){
			header("Location: member_home.php");
			die();
		} else {
			if(!empty($_GET['id'])){
				if($_GET['id'] == 'register'){
					if((!empty($_POST['username'])) && (!empty($_POST['email'])) && (!empty($_POST['passwordone'])) && (!empty($_POST['passwordtwo']))){
						$sErrorMessage = User::register($_POST['username'], $_POST['passwordone'], $_POST['passwordtwo'], $_POST['email']);
						echo $sErrorMessage;
					} else {
						$sErrorMessage = "No Error?";
					}
				} else { die("Error: Invalid variable value in variable id"); }
					echo Templater::AdvancedParse('/blue_default/register', $locale->strings, array(
					'LoggedIn' => $LoggedIn,
					'PageTitle'  => $sPanelTitle->sValue,
					'ErrorMessage'	=>	$sErrorMessage
					));
			} else {
					echo Templater::AdvancedParse('/blue_default/register', $locale->strings, array(
					'LoggedIn' => $LoggedIn,
					'PageTitle'  => $sPanelTitle->sValue,
					'ErrorMessage'	=>	""
					));
			}
		}
	}
?>