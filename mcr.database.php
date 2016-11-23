<?php if(!strcasecmp($_SERVER['SCRIPT_FILENAME'], __FILE__)){die("This page cannot be accessed directly");}?>
<?php

////////////////////////////////////////////////////////////////////////////////
// Database Information (the most important part!)
////////////////////////////////////////////////////////////////////////////////

define('MYSQL_USER',     'dbname');
define('MYSQL_PASS',     'secret');
define('MYSQL_HOST',     'localhost');	// should not have to change thos 90% of the time
 
/**
 * INPUT: 
 * 		roll (integer)
 *		attack chart enum(1HC, 1HS, 2HW, BAL, BOL, GRA, MIS, TAC)
 *		armor type enum (NONE, SOFT, RIGID, CHAIN, PLATE)
 */
function GetAttack($roll, $attackchart, $armortype)
{

	// unsure the user is supplying a valid integer (sql injection protection)
	if (is_an_int($roll) == FALSE) {
		$roll = 0;
	}
		
	$con = mysql_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS);
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}

	mysql_select_db("itsmet00_merp", $con);

	$sql = "SELECT DAMAGE, FUMBLE, DESCRIPTION, CRITICAL ";
	$sql .= "FROM `V_ATTACKCHART` "; 
	$sql .= "WHERE `RID` IN (";
	$sql .= "   SELECT MAX(`RID`) FROM `V_ATTACKCHART` ";
	$sql .= "   WHERE `RID` <= " . $roll . " ";
	$sql .= "   AND `ARMORTYPECODE` = '" . mysql_real_escape_string($armortype) . "' ";
	$sql .= "   AND `ATTACKCHARTTYPE` = '" . mysql_real_escape_string($attackchart) . "' ";
	$sql .= ") ";
	$sql .= "AND `ARMORTYPECODE` = '" . mysql_real_escape_string($armortype) . "' ";
	$sql .= "AND `ATTACKCHARTTYPE` = '" . mysql_real_escape_string($attackchart) . "' ";

	//echo "<br />" . $sql . "<br />";

	$result = mysql_query($sql);

	if ($result) {
		return mysql_fetch_array($result);
	}
}

/**
 * INPUT: 
 * 		roll (integer)
 *		criticaltable (enum): CRUSH, SLASH, etc.
 */
function GetSecondaryCritical($roll, $criticaltable)
{

	// unsure the user is supplying a valid integer (sql injection protection)
	if (is_an_int($roll) == FALSE) {
		$roll = 0;
	}
		
	$con = mysql_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PASS);
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}

	mysql_select_db("itsmet00_merp", $con);

	$sql = "SELECT "; 
	
	switch($criticaltable)
	{
		case "CRUSH":
			$sql .= " CRUSH as CRITICAL_DESC ";
			break;
		case "COLD":
			$sql .= " COLD as CRITICAL_DESC ";
			break;
		case "ELECTRICITY":
			$sql .= " ELECTRICITY as CRITICAL_DESC ";
			break;
		case "GRAPPLING":
			$sql .= " GRAPPLING as CRITICAL_DESC ";
			break;
		case "HEAT":
			$sql .= " HEAT as CRITICAL_DESC ";
			break;
		case "IMPACT":
			$sql .= " IMPACT as CRITICAL_DESC ";
			break;
		case "PHYSICAL_LARGE":
			$sql .= " PHYSICAL_LARGE as CRITICAL_DESC ";
			break;
		case "PUNCTURE":
			$sql .= " PUNCTURE as CRITICAL_DESC ";
			break;
		case "SLASH":
			$sql .= " SLASH as CRITICAL_DESC ";
			break;
		case "SPELL_LARGE":
			$sql .= " SPELL_LARGE as CRITICAL_DESC ";
			break;
		case "UNBALANCING":
			$sql .= " UNBALANCING as CRITICAL_DESC ";
			break;
		default:
			die("Error: Invalid Secondary Critical Table Type.");
			break;
	}
		
	$sql .= "FROM `S_SECONDARYCRITICAL` "; 
	$sql .= "WHERE `RID` IN (";
	$sql .= "   SELECT MAX(`RID`) FROM `S_SECONDARYCRITICAL` ";
	$sql .= "   WHERE `RID` <= " . $roll . " ";
	$sql .= ") ";

	//echo "<br />" . $sql . "<br />";

	$result = mysql_query($sql);

	if ($result) {
		return mysql_fetch_array($result);
	}
}

function is_an_int($int){
       
	// First check if it's a numeric value as either a string or number
	if(is_numeric($int) === TRUE){
	   
		// It's a number, but it has to be an integer
		if((int)$int == $int){
			return TRUE;
		// It's a number, but not an integer, so we fail
		}else{
			return FALSE;
		}
	// Not a number
	} else { 
		return FALSE;
	}
}

?>