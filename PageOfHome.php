<?php
	session_start(); 
	if (!isset($_SESSION['phonenumber'])){
		header('Location: login.php');
	}

	$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
	//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
	if ($con->connect_errno) {
	   printf("Connect failed: %s\n", $con->connect_error);
	   exit();
	}

	$stmt=$con->prepare("SELECT bigmonsters.id,bigmonsters.name,houseinfo.housepic FROM s1425535.bigmonsters , s1425535.houseinfo where bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
	$stmt->execute();
	$stmt->bind_result($monsterid,$monstername,$housesrc);
?>
	
<div  id="housesdiv" onmousemove="test(event)" style="overflow:hidden;width:960px; height:400px">

	<table  id="houses">
		<tr>
		
			<?php
				while ($stmt->fetch()) {
				 printf("<td><a href=\"javascript:submit('%s',true)\";><div style='margin:50px; text-align:center' id='%s'><img style='height:180px;width:180px;' src='%s'/><p>%s</p></div></a></td>",$monsterid,$monstername,$housesrc,$monstername); 
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



<script type="text/javascript">
	function submit(id)
	{
	    document.getElementById("monsterid").value = id;
	    document.getElementById("housesubmit").click();
	}
</script>



<script src="js/jquery.js"></script>

<script type="text/javascript">


	var width = $('#housesdiv').width(); 
	var left = $('#housesdiv').offset().left; 
	var scroll="none";
	var ondiv=false;

	setInterval("divscroll(scroll)", 100);

	$('#housesdiv').hover(function(){ondiv=true;},function(){ondiv=false;})

	function test(e){

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
		if(ondiv){ 
			console.log(scroll);
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