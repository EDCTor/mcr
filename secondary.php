<?php session_start(); ?>
<form action="mcr.php?cmd=CRITICAL" method="post">
	<center>
	<h1>Secondary Attack</h1>
	<hr />
	
	<?php
	include_once dirname(__FILE__).'/mcr.codes.php';
	
	if(isset($_SESSION['ERROR_MESSAGE']))
	{ 
		echo "<TABLE><TR><TD>";
		echo $_SESSION['ERROR_MESSAGE'];
		echo "</TD></TR></TABLE>";
		unset($_SESSION['ERROR_MESSAGE']); 
	}
	?>
	
	<TABLE>
		<TR align="left" valign="top">
			<TD>
				<b>Secondary Critical</b>
			</TD>
			<TD>
				<b>Critical Type</b>
			</TD>
		</TR>
		<TR align="left" valign="top">
			<TD>
				Unmodified Secondary Critical Roll<br />
				Roll: <input type="Text" value="0" name="roll" /><br />
				Critical: &nbsp
				<?php
					if(isset($_SESSION['CRITICAL']))
					{
						echo "<b>" . $_SESSION['CRITICAL'] . "</b>"; 
					}
				?>
			</TD>
			<TD>
				<input type="radio" name="criticaltable" value="COLD" <?php if (GetLikelyCritical("COLD", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Cold <br />
				<input type="radio" name="criticaltable" value="CRUSH" <?php if (GetLikelyCritical("CRUSH", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Crush <br />
				<input type="radio" name="criticaltable" value="ELECTRICITY" <?php if (GetLikelyCritical("ELECTRICITY", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Electricity <br />
				<input type="radio" name="criticaltable" value="GRAPPLING" <?php if (GetLikelyCritical("GRAPPLING", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Grapple <br />
				<input type="radio" name="criticaltable" value="HEAT" <?php if (GetLikelyCritical("HEAT", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Heat <br />
				<input type="radio" name="criticaltable" value="IMPACT" <?php if (GetLikelyCritical("IMPACT", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Impact <br />
				<input type="radio" name="criticaltable" value="PHYSICAL_LARGE" <?php if (GetLikelyCritical("PHYSICAL_LARGE", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Physical Large Creatures <br />				
				<input type="radio" name="criticaltable" value="PUNCTURE" <?php if (GetLikelyCritical("PUNCTURE", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Puncture <br />
				<input type="radio" name="criticaltable" value="SLASH" <?php if (GetLikelyCritical("SLASH", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Slash <br />				
				<input type="radio" name="criticaltable" value="SPELL_LARGE" <?php if (GetLikelyCritical("SPELL_LARGE", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Spell Large Creatures <br />
				<input type="radio" name="criticaltable" value="UNBALANCING" <?php if (GetLikelyCritical("UNBALANCING", $_SESSION['ATTACK_CHART'])) { echo("checked"); } ?> /> Unbalancing <br />
			</TD>
			<TD>
				<input type="submit" name="SECONDARYSUBMIT" value="Submit" /> OR <input type="submit" name="CANCELBUTTON" value="Start Over" />
			</TD>
		</TR>
	</TABLE>
	</center>
	<hr />
	<center> &copy; 2010 <a href="http://www.itsmetor.com">www.itsmetor.com</a> <a href="index.html">MERP Critical Resolver</a> </center>
</form>