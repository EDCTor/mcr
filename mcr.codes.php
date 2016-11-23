<?php if(!strcasecmp($_SERVER['SCRIPT_FILENAME'], __FILE__)){die("This page cannot be accessed directly");}?>
<?php

//
// locate a likely critical type based upon the attack chart
// while not guaranteed to be correct, should provide an above average success rate and prevent user clicks
//
function GetLikelyCritical($criticaltype, $attackchart)
{ 
	$matches = FALSE;
	switch($attackchart)
	{
		case "1HS":
			if ($criticaltype == "SLASH") { $matches = TRUE; }
			break;
		case "1HC":
			if ($criticaltype == "CRUSH") { $matches = TRUE; }
			break;
		case "2HW":
			if ($criticaltype == "CRUSH") { $matches = TRUE; }
			break;
		case "BAL":
			if ($criticaltype == "HEAT") { $matches = TRUE; }
			break;
		case "BOL":
			if ($criticaltype == "ELECTRICITY") { $matches = TRUE; }
			break;
		case "GRA":
			if ($criticaltype == "GRAPPLING") { $matches = TRUE; }
			break;
		case "MIS":
			if ($criticaltype == "PUNCTURE") { $matches = TRUE; }
			break;
		case "TAC":
			if ($criticaltype == "UNBALANCING") { $matches = TRUE; }
			break;
		default:
			break;
	}

	return $matches;
}
			
function GetArmorTypeDescription($code) {

	$description = "UNKNOWN";
	switch($code)
	{
		case "NONE":
			$description = "No Armor";
			break;
		case "SOFT":
			$description = "Soft Leather";
			break;
		case "RIGID":
			$description = "Rigid Leather";
			break;
		case "CHAIN":
			$description = "Chain Armor";
			break;
		case "PLATE":
			$description = "Plate Armor";
			break;
		default:
			break;
	}

	return $description;
}

function GetAttackChartDescription($code)
{
	$description = "UNKNOWN";
	switch($code)
	{
		case "1HS":
			$description = "1 Handed Slashing";
			break;
		case "1HC":
			$description = "1 Handed Concussion";
			break;
		case "2HW":
			$description = "2 Handed Weapon";
			break;
		case "BAL":
			$description = "Ball Spells";
			break;
		case "BOL":
			$description = "Bolt Spells";
			break;
		case "GRA":
			$description = "Grappling and Unbalancing";
			break;
		case "MIS":
			$description = "Missle";
			break;
		case "TAC":
			$description = "Tooth and Claw";
			break;
		default:
			break;
	}

	return $description;
}


?>