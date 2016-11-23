<?php session_start(); ?>
<form action="mcr.php?cmd=ATTACK" method="post">
	<center>
	<h1>Primary Attack</h1>
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
				<b>Offensive Attack</b>
			</TD>
			<TD>
				<b>Attack Chart</b>
			</TD>
			<TD>
				<b>Against Armor Type</b>
			</TD>
		</TR>
		<TR align="left" valign="top">
			<TD>
				Modified Offensive Attack<br />
				Roll: <input type="Text" value="0" name="roll"><br />
				<br />
				Roll + OB + Item Bonus + Special Bonus<br />
			</TD>
			<TD>
				<input type="radio" name="attackchart" value="1HC" checked /> 1-H Concussion<br />
				<input type="radio" name="attackchart" value="1HS" /> 1-H Slash<br />
				<input type="radio" name="attackchart" value="2HW" /> 2-H Weapon<br />
				<input type="radio" name="attackchart" value="BAL" /> Ball <br />
				<input type="radio" name="attackchart" value="BOL" /> Bolt <br />
				<input type="radio" name="attackchart" value="GRA" /> Grapple or Unbalance <br />
				<input type="radio" name="attackchart" value="MIS" /> Missle <br />
				<input type="radio" name="attackchart" value="TAC" /> Tooth and Claw <br />
			</TD>			
			<TD>
				<input type="radio" name="armortype" value="NONE" checked /> None <br />
				<input type="radio" name="armortype" value="SOFT" /> Soft leather <br />
				<input type="radio" name="armortype" value="RIGID" /> Rigid leather<br />
				<input type="radio" name="armortype" value="CHAIN" /> Chain <br />
				<input type="radio" name="armortype" value="PLATE" /> Plate <br />
			</TD>
			<TD>
				<input type="submit" value="submit" />
			</TD>
		</TR>
	</TABLE>
	</center>
	<hr />
	<center> &copy; 2010 <a href="http://www.itsmetor.com">www.itsmetor.com</a> <a href="index.html">MERP Critical Resolver</a></center>
</form>