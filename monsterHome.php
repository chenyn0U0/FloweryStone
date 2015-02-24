<?php 
	session_start(); 
	if (!isset($_SESSION['phonenumber'])){
		header('Location: login.php');
	}

	if(isset($_POST['newmonster'])){
		$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
		//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
		if ($con->connect_errno) {
		   printf("Connect failed: %s\n", $con->connect_error);
		   exit();
		}

		$stmt=$con->prepare("INSERT INTO s1425535.bigmonsters(ownerNum,name,description,houseid,adopttime,adoptip) VALUES ('".$_SESSION["phonenumber"]."','".$_POST["newname"]."','".$_POST["newdescription"]."','".$_POST["newhouse"]."','".date('Y-m-d H:i:s',time())."','".$_SERVER["REMOTE_ADDR"]."')");
		$stmt->execute();
		$stmt->close();
		
		$_POST["monsterid"]=mysqli_insert_id($con);
		mysql_close($con);
	}

	if (!isset($_POST['monsterid'])){
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
	<script src="js/d3.min.js"></script>

	<script type="text/javascript">
		function logout(){
	        if(confirm("Are you sure you want to log out?"))
	        {
	        	document.getElementById('logout').click();
	        }
		}

		function clickonsm(d){
			data=d.split(",");
			console.log(data);
		}
	</script>
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
			<!-- 右边小怪兽带着小小怪兽布局 -->
			<div id="bigmonster">
				<?php
					if($_POST['monsterid']!=0){
						$con = new mysqli("localhost","s1425535","InQzRF8RSn","s1425535");
						//$con = new mysqli("playground.eca.ed.ac.uk","s1425535","InQzRF8RSn","s1425535");
						if ($con->connect_errno) {
						   printf("Connect failed: %s\n", $con->connect_error);
						   exit();
						}

						$stmt=$con->prepare("SELECT bigmonsters.id,bigmonsters.name,bigmonsters.description,houseinfo.housepic FROM s1425535.bigmonsters,s1425535.houseinfo where bigmonsters.id=".$_POST['monsterid']." and bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
						$stmt->execute();
						$stmt->bind_result($monsterid,$monstername,$description,$housepic);
						$stmt->fetch();
						$stmt->close();

						$stmt2=$con->prepare("SELECT smallmonsters.finished,smallmonsters.name,smallmonsters.description,smallmonsters.totaltime,smallmonsters.pizzaamount,smallmonsters.smallmonsterID,smallmonstersinfo.normalpic,smallmonsters.id FROM s1425535.smallmonsters,s1425535.smallmonstersinfo WHERE smallmonstersinfo.smallmonsterid=smallmonsters.smallmonsterID and smallmonsters.bigmonsterID=".$monsterid.";");
						$stmt2->execute();
						$stmt2->bind_result($smfinished,$smname,$smdescription,$smtotaltime,$smpizzaamount,$smid,$smpic,$taskid);


						//计算大怪兽手下完成小怪兽百分比并决定大怪兽图片
						$bigsrc="img/monsters/M1.png";
						$finishedsmnum=0;
						$totalsmnum=0;

						echo "<script> var smonsinfo=[";//创建小怪兽的json文件
						while($stmt2->fetch()){
							//文件格式：【0是否存在（新建用），1任务是否已完成，2任务名，3任务描述，4任务总时间，5任务披萨数，6出现小怪兽id，7出现小怪兽图片路径，8此任务id，9此大任务id】
							echo "[1,".$smfinished.",'".$smname."','".$smdescription."','".$smtotaltime."',".$smpizzaamount.",".$smid.",'".$smpic."',".$taskid.",".$monsterid."],";
							if($smfinished==1) $finishedsmnum++;
							$totalsmnum++;
						}
						echo "[0,0,'new monster','Adopt your new small monster','00:00:00',0,1,'img/monsters/newmonster.png',0,".$monsterid."]";//新建图片待修改/新建任务id默认为0
						echo "];console.log(smonsinfo);</script>";

						if($totalsmnum==0||$finishedsmnum/$totalsmnum<0.3) $bigsrc="img/monsters/M1.png";
						elseif ($finishedsmnum/$totalsmnum<0.7) $bigsrc="img/monsters/M2.png";
						else $bigsrc="img/monsters/M3.png";


						$stmt2->close();
					?>
					<img src=<?php echo "'".$bigsrc."'" ?> style="height:250px"/>
				</div>
				<div id="smallmonsterscontainer">
					<script>
						var radius=350;

						var eachmonster=d3.select("#smallmonsterscontainer")
							.selectAll("div")
							.data(smonsinfo)
					        .enter()
					        .append("div")
					        .attr("class","smallmonsterposition")
					        .append("div")
					        .attr("style",function(d,i){
					        	if(smonsinfo.length==1){
					        		var string="text-align:center;position:relative;top:-"+(radius+70)+"px;";
						        	return string;
					        	}
					        	else{
						        	var la=smonsinfo.length-i-1;
						        	var string="text-align:center;position:relative;left:"+(Math.cos(Math.PI/(smonsinfo.length-1)*la)*radius)+"px;top:-"+(Math.sin(Math.PI/(smonsinfo.length-1)*la)*radius+70)+"px;";
						        	return string;
					        	}
					        })
					        .append("a")
					        .attr("href",function(d){
					        	return "javascript:clickonsm('"+d+"')";
					   		 })
					        .attr("title",function(d){return d[3];});


					    // eachmonster.append("p")
					    // 	.text(function(d){if(d[0]==1) return d[3];});

					    eachmonster.append("img")
					    	.attr("src",function(d){return d[7];})
					    	.attr("style",function(d){
					    		return "height:120px;width:120px;";
					    	});

					    eachmonster.append("h3")
					    	.text(function(d){return d[2];});
				        
					</script>
				</div>
				<!-- 右边小怪兽带着小小怪兽布局 -->
				<div id="lefthomediv">
					<div id='monsterhome'>
						<!-- 左边小怪兽房间及其信息 -->
					<?php
							printf("<h1>%s </h1><h3>'s HOME</h3><p>%s</p><a href='mainpage.php' title='Go back to see other monsters.''><img src='%s'></img><a>",$monstername,$description,$housepic); 
							$con->close();
						}
						else{
					//####################################################################################newhouse######################################################################################################
					?>
			<img src="img/monsters/M1.png" style="height:250px"/>
			<a href="javascript: document.getElementById('newmonster').click()"><div id="adoptme">Adopt me!</div></a>
			<div id="newbigmonsterform">
				<table style="text-align:left;width:600px;vertical-align:top">
					<form  method="POST">
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
						}
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