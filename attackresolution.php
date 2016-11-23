<?php session_start(); ?>
<form action="primary.php" method="post">
	<center>
	<h1>Attack Resolution</h1>
	<hr />
	
	<?php
	if(isset($_SESSION['ERROR_MESSAGE']))
	{
		unset($_SESSION['ERROR_MESSAGE']); 
	}
	?> 
	
	<TABLE>
		<TR align="left" valign="top">
			<TD>
				<?php
					include_once dirname(__FILE__).'/mcr.codes.php';
					
					if(isset($_SESSION['CRITICAL_DESC']))
					{
						echo "Primary Attack: " . $_SESSION['ROLL'] . "<br />";
						echo "Primary Attack Description: " . $_SESSION['DESCRIPTION'] . "<br />";
						echo "Primary Attack Chart: " . GetAttackChartDescription($_SESSION['ATTACK_CHART']) . "<br />";
						echo "Primary Attack Armor Type: " . GetArmorTypeDescription($_SESSION['ARMOR_TYPE']) . "<br />";
						echo "Secondary Critical Roll: " . $_SESSION['SECONDARY_ROLL'] . "<br />";
						echo "Secondary Critical Roll Modified: " . $_SESSION['SECONDARY_ROLL_MODIFIED'] . "<br />";
						echo "Secondary Critical Description: " . $_SESSION['CRITICAL_DESC'] . "<br />";
						echo "Critical Table: " . $_SESSION['CRITICAL_TABLE'] . "<br />";
						
						unset($_SESSION['CRITICAL_DESC']);	
						unset($_SESSION['SECONDARY_ROLL']);
						unset($_SESSION['CRITICAL_TABLE']);						
					}
				?>
			</TD>
			<TD>
				<input type="submit" name="CANCELBUTTON" value="Start Over" />
			</TD>
		</TR>
	</TABLE>
	</center>
	<hr />
	<center> &copy; 2010 <a href="http://www.itsmetor.com">www.itsmetor.com</a> <a href="index.html">MERP Critical Resolver</a></center>
</form>