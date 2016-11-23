<?php

include_once dirname(__FILE__).'/mcr.database.php';
include_once dirname(__FILE__).'/mcr.codes.php';

/**
 * 
 * 
 */
 
session_start();
 
$cmd = GetPageParam('cmd');
switch($cmd)
{
	case "ATTACK":
		$roll = GetPageParam('roll');
		$attackchart = GetPageParam('attackchart');
		$armortype = GetPageParam('armortype');
		
		if (is_an_int($roll) == FALSE) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please enter a valid roll value</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;
		}
		if ($roll < 0) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please enter a valid positive roll value</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;
		}
		
		if (($attackchart <> '1HS') && 
			($attackchart <> '1HC') && 
			($attackchart <> '2HW') && 
			($attackchart <> 'BAL') && 
			($attackchart <> 'BOL') && 
			($attackchart <> 'GRA') && 
			($attackchart <> 'MIS') && 
			($attackchart <> 'TAC')) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please select a valid attack chart</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php');
			exit;
		}

		if (($armortype <> 'NONE') && 
			($armortype <> 'SOFT') && 
			($armortype <> 'RIGID') && 
			($armortype <> 'CHAIN') && 
			($armortype <> 'PLATE'))
		{
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please select a valid armor type</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;
		}

		$attack = GetAttack($roll, $attackchart, $armortype);
		ResolveAttack($roll, $attackchart, $armortype, $attack);
		
		break;
	case "CRITICAL":
		$cancelbutton = GetPageParam('CANCELBUTTON');
		if ($cancelbutton == 'Start Over') {
			header( 'Location: http://www.itsmetor.com/apps/mcr/primary.php' );
			exit;
		}
		
		$roll = GetPageParam('roll');
		
		if (is_an_int($roll) == FALSE) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please enter a valid roll value</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/secondaryresolution.php' );
			exit;
		}
		if ($roll < 0) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please enter a valid positive roll value</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/secondaryresolution.php' );
			exit;
		}
		
		$criticaltable = GetPageParam('criticaltable');
		
		if (($criticaltable <> 'COLD') && 
			($criticaltable <> 'CRUSH') && 
			($criticaltable <> 'ELECTRICITY') && 
			($criticaltable <> 'GRAPPLING') && 
			($criticaltable <> 'HEAT') && 
			($criticaltable <> 'IMPACT') && 
			($criticaltable <> 'PHYSICAL_LARGE') && 
			($criticaltable <> 'PUNCTURE') && 
			($criticaltable <> 'SLASH') && 
			($criticaltable <> 'SPELL_LARGE') && 
			($criticaltable <> 'UNBALANCING')) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Error: Please select a valid critical table</font>"; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/secondaryresolution.php');
			exit;
		}
		
		$criticalletter ='T';
		if (isset($_SESSION['CRITICAL'])) {
			$criticalletter = $_SESSION['CRITICAL'];
		}

		$modified_roll = 0;
		// modify the roll based upon the critical letter
		if ($criticalletter == "T") {
			$modified_roll = $roll - 50;
		} else if ($criticalletter == "A") {
			$modified_roll = $roll - 20;
		} else if ($criticalletter == "B") {
			$modified_roll = $roll - 10;
		} else if ($criticalletter == "C") {
			$modified_roll = $roll + 0;
		} else if ($criticalletter == "D") {
			$modified_roll = $roll + 10;
		} else if ($criticalletter == "E") {
			$modified_roll = $roll + 20;
		}
		
		$secondarycritical = GetSecondaryCritical($modified_roll, $criticaltable);
		ResolveCritical($roll, $secondarycritical, $criticaltable, $criticalletter, $modified_roll);
		
		break;
	default:
		//
		break;
}

function ResolveAttack($roll, $attackchart, $armortype, $attack)
{
	if($attack != null)
	{
		$_SESSION['DAMAGE'] = $attack['DAMAGE']; 
		$_SESSION['FUMBLE'] = $attack['FUMBLE'];
		$_SESSION['DESCRIPTION'] = $attack['DESCRIPTION'];
		$_SESSION['CRITICAL'] = $attack['CRITICAL'];
		$_SESSION['ROLL'] = $roll;
		$_SESSION['ATTACK_CHART'] = $attackchart;
		$_SESSION['ARMOR_TYPE'] = $armortype;
	
		$error_message =  "<b>Damage: " . $attack['DAMAGE'] . "</b><br />";
		$error_message .= "<b>Critical: " . $attack['CRITICAL'] . "</b><br />";
		$error_message .= "<font color=\"grey\">Modified OB: " . $roll . "</font><br />";
		$error_message .= "<font color=\"grey\">Using Chart: " . GetAttackChartDescription($attackchart) . "</font><br />";
		$error_message .= "<font color=\"grey\">Against Armor Type: " . GetArmorTypeDescription($armortype) . "</font><br />";			
		$error_message .= "<font color=\"grey\">Description: " . $attack['DESCRIPTION'] . "</font><br />";
		$error_message .= "<font color=\"grey\">Possible Fumble: " . $attack['FUMBLE'] . "</font><br />";
		
		
		if ($attack['FUMBLE'] == "TRUE") {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Possible Fumble: Check the fumble range <br />for the specific weapon being used.</font><br />" . $error_message; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;
		}
		else if ($attack['DAMAGE'] == 0) {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">No damage, no critical.</font><br />" . $error_message; 
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;			
		}
		else if (($attack['DAMAGE'] > 0) && (strlen($attack['CRITICAL']) == 0)) {
			$_SESSION['ERROR_MESSAGE'] = $error_message;
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );	
			exit;
		}
		else if (($attack['DAMAGE'] > 0) && (strlen($attack['CRITICAL']) > 0)) {
			$_SESSION['ERROR_MESSAGE'] = $error_message;
			
			
			header( 'Location: http://www.itsmetor.com/apps/mcr/secondary.php' );
			exit;
		}
		else {
			$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Unhandled scenario, try again!</font><br />" . $error_message;
			header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
			exit;
		}
	}
	else
	{
		$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Attack data not available, try again with different parameters.</font>"; 
		header( 'Location: http://www.itsmetor.com/apps/mcr/primaryresolution.php' );
		exit;
	}
}

function ResolveCritical($roll, $secondarycritical, $criticaltable, $criticalletter, $modified_roll)
{
	if($secondarycritical != null)
	{
		$_SESSION['CRITICAL_DESC'] = $secondarycritical['CRITICAL_DESC']; 
		$_SESSION['SECONDARY_ROLL'] = $roll;
		$_SESSION['SECONDARY_ROLL_MODIFIED'] = $modified_roll;
		$_SESSION['CRITICAL_TABLE'] = $criticaltable;
		
		//$error_message =  "<b>Secondary Roll: " . $roll . "</b><br />";
		//$error_message .= "<b>Critical: " . $secondarycritical['CRITICAL_DESC'] . "</b><br />";
		//$error_message .= "<font color=\"grey\">Critical Table: " . $criticaltable . "</font><br />";
		//$error_message .= "<font color=\"grey\">Critical Letter: " . $criticalletter . "</font><br />";
		//
		//$_SESSION['ERROR_MESSAGE'] = $error_message;
		
		header( 'Location: http://www.itsmetor.com/apps/mcr/attackresolution.php' );
		exit;
	}
	else
	{
		$_SESSION['ERROR_MESSAGE'] = "<font color=\"red\">Critical data not available, try again with different parameters.</font>"; 
		header( 'Location: http://www.itsmetor.com/apps/mcr/secondaryresolution.php' );
		exit;
	}
}

function GetPageParam($field_name)
{	
	$value = null;
	
	switch(true)
	{
		case isset($_GET[$field_name]):
			$value = $_GET[$field_name];
			break;
		case isset($_POST[$field_name]):
			$value = $_POST[$field_name];
			break;
		default:						
			$value = null;
	}			
	
	return $value;
}
	
?>