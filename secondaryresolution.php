<?php session_start(); ?>
<form action="mcr.php?cmd=CRITICAL" method="post">
	<center>
	<h1>Secondary Attack</h1>
	<hr />
	
	<?php
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
				<b>Attack Chart</b>
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
				<input type="radio" name="criticaltable" value="COLD" checked /> Cold <br />
				<input type="radio" name="criticaltable" value="CRUSH" /> Crush <br />
				<input type="radio" name="criticaltable" value="ELECTRICITY" /> Electricity <br />
				<input type="radio" name="criticaltable" value="GRAPPLE" /> Grapple <br />
				<input type="radio" name="criticaltable" value="HEAT" /> Heat <br />
				<input type="radio" name="criticaltable" value="IMPACT" /> Impact <br />
				<input type="radio" name="criticaltable" value="PHYSICAL_LG" /> Physical Large Creatures <br />				
				<input type="radio" name="criticaltable" value="PUNCTURE" /> Puncture <br />
				<input type="radio" name="criticaltable" value="SLASH" /> Slash <br />				
				<input type="radio" name="criticaltable" value="SPELL_LG" /> Spell Large Creatures <br />
				<input type="radio" name="criticaltable" value="UNBALANCING" /> Unbalancing <br />
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