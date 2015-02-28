<?php 

	require "phpfunction.php";
	checklogstatus();


?>

<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Time Management</title>

	<link rel="stylesheet" href="stylesheets/mainstyle.css">
	<link href="stylesheets/infocard.css" rel="stylesheet" type="text/css">

	<script src="js/jquery.js"></script>
	<script src="js/d3.min.js"></script>
	<script src="js/card.js"></script>

</head>

<body>
	<div class="headercontainer">
		<div class="header">
			<div id="logocontainer">
				<div id="logo">
					<img src="img/logo.png">
				</div>
				<div id="logotext">
					<h1 style="margin-bottom:5px"><b>M</b>ami <b>M</b>onster</h1>
					<p style="color:white;margin-top:5px">WORK <b>SMART</b> LIVE <b>BETTER</b></p>
				</div>
			</div>
			<div id="userstatus">
				<a href="javascript:logout()"><img src="img/user-m.png"/> <b><?php echo $_SESSION['phonenumber']; ?></b></a>
				<form action="" method="POST">
				<input style="display:none" type="submit" name="logout" id="logout">
				</form>
			</div>
		</div>
	</div>
	<div class="pagecontextcontainer">
		<div class="pagecontext" style="text-align:left">
			<div id="bigmonster">

			<img src="img/monsters/M1.png" style="height:250px"/>
			<a href="javascript: document.getElementById('newmonster').click()"><div id="adoptme">Adopt me!</div></a>
			<div id="newbigmonsterform">
				<table style="text-align:left;width:600px;vertical-align:top">
					<form action="saveworkdata.php"  method="POST">
					<tr>
						<td style="width:250px"><h3>Give me a name:</h3></td>
						<td><input name="newname" class="bminputbox" type="text" value="Your project name." onFocus="if(value==defaultValue){value='';this.style.color='#000'}" onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999999"/></td>
					</tr>
					<tr>
						<td style="width:250px"><h3>Details about me:</h3></td>
						<td><textarea name="newdescription" rows="5" class="bminputbox" style="resize:none"/></textarea></td>
						<input name="newhouse" type="hidden" value="1"/>
						<input name="newmonster" id="newmonster" type="submit" style="display:none"/>
					</tr>
				</form>
				</table>
			</div>
		</div>
			<div id="lefthomediv">
				<div id='monsterhome'>
					<?php
							printf("<h1>%s </h1><h3>'s HOME</h3><p>%s</p><a href='mainpage.php' title='Go back to see other monsters.''><img src='%s'></img><a>","New project","Adopt me please!","img/house/house1.png"); 
				?>	
				</div>
			</div>
		</div>
	</div>

	<div class="footercontainer">
		<div class="footer">
			<div id="teamlogo">
				<img src="img/team.png">
			</div>
			</div>
		</div>
	</div>


</body>
</html>