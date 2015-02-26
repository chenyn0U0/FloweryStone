<?php 
	session_start(); 
	if (!isset($_SESSION['phonenumber'])){
		header('Location: login.php');
	}

	if (isset($_POST['logout'])) {
		unset($_SESSION['phonenumber']);
		header('Location: login.php');
	}
?>

<!DOCTYPE html>  
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>Time Management</title>

	<link rel="stylesheet" href="stylesheets/mainstyle.css">
	<script src="js/jquery.js"></script>




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
		<div class="pagecontext">

<?php
	$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
	//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
	if ($con->connect_errno) {
	   printf("Connect failed: %s\n", $con->connect_error);
	   exit();
	}

	$stmt=$con->prepare("SELECT bigmonsters.id,bigmonsters.description,bigmonsters.name,houseinfo.housepic FROM s1425535.bigmonsters , s1425535.houseinfo where bigmonsters.finished=0 and bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
	$stmt->execute();
	$stmt->bind_result($monsterid,$monsterdescription,$monstername,$housesrc);
?>
	
<div  id="housesdiv" onmousemove="test(event)">

	<table  id="houses">
		<tr>
		
			<?php
				while ($stmt->fetch()) {
				 printf("<td><a title='%s' href=\"javascript:submit('%s',true)\";><div style='margin:50px; text-align:center' id='%s'><img style='height:180px;width:180px;' src='%s'/><p>%s</p></div></a></td>",$monsterdescription,$monsterid,$monstername,$housesrc,$monstername); 
				}
				$stmt->close();
				$con->close();
			?>
		
			<td>
			<a href="javascript:submit(0);">
				<div style='margin:50px; text-align:center' id='newhouse'>
					<img style='height:180px;width:180px;' src='img/house/newhouse.png'/>
					<p style=''>Adopt another lovely monster~</p>
				</div>
			</a>
			</td>
		</tr>
	</table>

	<form id="houseselection" action="monsterHome.php" method="post" style="display:none">
	    <input type="hidden" name="monsterid" id="monsterid"/>
	    <input type="submit" name="housesubmit" id="housesubmit"/>
	</form>
</div>


<div id="choosemonsdiv">
	<img id="choosemons" src="img/monsters/mo-choose.png" class="none"/>
</div>




		</div>
	</div>

	<div class="footercontainer">
		<div class="footer">
			<div id="teamlogo">
				<img src="img/team.png"/>
			</div>
			</div>
		</div>
	</div>

</body>
</html>


<script type="text/javascript">
	function submit(id)
	{
	    document.getElementById("monsterid").value = id;
	    document.getElementById("housesubmit").click();
	}

	function logout(){
        if(confirm("Are you sure you want to log out?"))
        {
        	document.getElementById('logout').click();
        }
	}
</script>



<script type="text/javascript">

	var scroll="none";
	var ondiv=false;

	setInterval("divscroll(scroll)", 100);

	$('#housesdiv').hover(function(){ondiv=true;},function(){ondiv=false;})

	function test(e){
		var width = $('#housesdiv').width(); 
		var left = $('#housesdiv').offset().left; 

		var scrollborder1=0.1*width;
		var scrollborder2=0.25*width;

		var pointX = e.pageX;
		var pointY = e.pageY;

		var positiontoleft=pointX-left;
		var positiontoright= left+width-pointX;

		if(positiontoleft<scrollborder1) scroll="left1";
		else if(positiontoleft<scrollborder2) scroll="left2";
		else if(positiontoright<scrollborder1) scroll="right1";
		else if(positiontoright<scrollborder2) scroll="right2";
		else scroll="none";
	}


	function divscroll(scroll){
		console.log(scroll);
		if(ondiv){ 
			if(scroll=="left1"){
				var pos = $('#housesdiv').scrollLeft();
				$('#housesdiv').animate({scrollLeft: (pos - 50)},98);
			}
			if(scroll=="left2"){
				var pos = $('#housesdiv').scrollLeft();
				$('#housesdiv').animate({scrollLeft: (pos - 20)},98);
			}
			if(scroll=="right1"){
				var pos = $('#housesdiv').scrollLeft();
				$('#housesdiv').animate({scrollLeft: (pos + 50)},98);
			}
			if(scroll=="right2"){
				var pos = $('#housesdiv').scrollLeft();
				$('#housesdiv').animate({scrollLeft: (pos + 20)},98);
			}
		}
	}

</script>