<?php session_start(); ?>
<form action="primary.php" method="post">
	<center>
	<h1>Primary Attack Resolution</h1>
	<hr />
	<TABLE>
		<TR>
			<TD>
				<?php 
				if(isset($_SESSION['ERROR_MESSAGE']))
				{ 
					echo "<TABLE><TR><TD>";
					echo $_SESSION['ERROR_MESSAGE'];
					echo "</TD></TR></TABLE>";
					unset($_SESSION['ERROR_MESSAGE']); 
				}	
				?>
			</TD>
			<TD>
				To begin again, click: <input type="submit" value="Start Over" />
			</TD>
		</TR>
	</TABLE>
	</center>
	<hr />
	<center> &copy; 2010 <a href="http://www.itsmetor.com">www.itsmetor.com</a> <a href="index.html">MERP Critical Resolver</a> </center>
</form>