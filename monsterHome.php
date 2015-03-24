<?php 

	require "phpfunction.php";
	checklogstatus();

	

	if (!isset($_POST['monsterid'])){
		header('Location: login.php');
	}




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
	<div id="hardblack" class="black"></div>
	<div id="softblack" class="black"></div>
	<div id="cardcontainer">
		<!-- ##################################################小怪兽信息/增添↓######################################################### -->
		<div id="infocard" class="smallcard"> 
	    	<div class="eatingmon" id="eatingmon">
	            <img src="img/Newadd/moneatpie.png" id="monsterhead" class="moneatpie">
	        </div>

	        <div class="info" id="info">
	        	<form id="smupdate" method="post">
	        	<div class="monname" id="monname">
	        		<!-- <form id="nametext" class="nametext">  -->
		            <table style="color:white" border="0">
		                <tr>
			                <td style=""> 
			                	NAME&nbsp&nbsp:&nbsp
			                </td>
		                	<td colspan="" style="">  
		                   		<p id="smnametext"></p>
		          	       		<div id="nameinput" class="nameinput">
		                   		<input type="text" id="smname" name="smname" tabindex="1">
		                   		</div>
		               		</td>
		              	</tr>
		            </table>
		            <!-- </form> -->
		        </div>
	    
		        <div class="mondetail" id="mondetail" style="margin-top:10px">
		        	<!-- <form id="detailtext" class="detailtext"> -->
		            <table style="color:white" border="0">
		              	<tr>
		                	<td colspan="" style="">
		                  		DETAIL:&nbsp
		                	</td>
		                	<td olspan="" >
		                  		<p id="smdescriptiontext" ></p>
		                  		<textarea rows="5" style="resize:none" name="smdescription"  id="smdescription"></textarea>
			                </td>
			            </tr>
			        </table>
			        <!-- </form> -->
		      	</div>

		      	<div id="smagediv" class="Age" style="display:none">
		          	<p id="smagetext">AGE : 2 pizzas</p>
		      	</div>

	      		<div class="pieeaten" id="pieeaten">
	            </div>
	        
		        <div id="feedmediv" class="cardbutton" style="display:none">
		        	<table>
		        		<tr>
		        			<td>
				            <a href="javascript:feedme_click()">
				            	<img src="img/Newadd/full&dropbuttom.png" width="100" height="34" alt=""/>
				            	<P class="cardbutton-text">Feed me</p>
				            	<input id="smid" type="hidden"/>
				            </a>
				        	</td>
				            <td>
				            <a href="javascript:iamfull_click()">
				            	<img src="img/Newadd/full&dropbuttom.png" width="100" height="34" alt=""/>
				            	<P class="cardbutton-text">I am full</p>
				            </a>
				        </td>
		    			</tr>
		            </table>
		        </div>

		       	<div id="addmediv" class="cardbutton">
		            <a href="javascript:addme_click()">
		            	<img src="img/Newadd/full&dropbuttom.png" width="100" height="34" alt=""/>
		            	<P class="cardbutton-text">Add me</p>
		            	<input id="bmid" name="bmid" type="hidden" value=<?php echo "'".$_POST['monsterid']."'";?>/>
		            	<input id="newSmonster" name="newSmonster" type="hidden" value="true" style="display:none"/>
		            </a>
		        </div>
		        </form>
		  	</div>
		</div>
		<!-- ##################################################小怪兽信息/增添↑######################################################### -->
		<div id="workingcard" class="smallcard"> 
			<div class="eatingmon">
		        
		        <table>
		        	<tr>
		        		<td>
		        			<img src="img/Newadd/moneatpie.png" alt="" style="margin-left: 70px;margin-right: 50px;" class="moneatpie" id="moneatpie"/>
					    </td>
					    <td>
					    	<a href="javascript:full_click()" style="display:none">
					        	<img src="img/Newadd/fullbutton.png" alt="Full" style="margin-top: 35px;margin-bottom: 20px;" class="full" id="full"/>
					        </a>
					        <a href="javascript:drop_click()">
					        	<img src="img/Newadd/dropbutton.png" alt="Drop" style="margin-top: 20px" class="drop" id="drop"/>
					        </a>
					    </td>
					</tr>
				</table>
		    </div>
	  
    <!--downside-->   
			<div class="timeinformation">
	       		<div class="eatingperiod">
	            	<img src="img/Newadd/timepie.png" width="144" height="140" class="timepie" id="timepie"/>
		            <img src="img/Newadd/timepiecover.png" width="144" height="140" style="position:relative;left:-150px" class="timepiecover" id="timepiecover" />
		         	
		            <table style="margin-top:20px;">
		             	<tr>
			        		<td width="150px">
				            	<p>Current:</p><p id="currenttime">30 : 00</p><br/>
				            </td>
						    <td>
						    	<p>Have eaten:</p><p id="haveaten">0 piece</p><br/>
						   	</td>
						</tr>
						<tr style="display:none">
			        		<td>
			        			<p>Total:</p><p id="totaltime">01:33:52</p>
			        		</td>
						    <td>     
						    	<input type="hidden" id="taskid"/>
						    </td>
						</tr>
					</table>
		        </div>
		          	

			</div>
		</div>
		<!-- ###################################################工作界面↑########################################################## -->
	</div>


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
						$con =getconnection();

						$stmt=runsql($con,"SELECT bigmonsters.id,bigmonsters.name,bigmonsters.description,houseinfo.housepic FROM s1425535.bigmonsters,s1425535.houseinfo where bigmonsters.id=".$_POST['monsterid']." and bigmonsters.houseid=houseinfo.houseid and bigmonsters.ownerNum=".$_SESSION['phonenumber'].";");
						$stmt->bind_result($monsterid,$monstername,$description,$housepic);
						$stmt->fetch();
						$stmt->close();

						$stmt2=runsql($con,"SELECT smallmonsters.finished,smallmonsters.name,smallmonsters.description,smallmonsters.totaltime,smallmonsters.pizzaamount,smallmonsters.smallmonsterID,smallmonstersinfo.normalpic,smallmonsters.id FROM s1425535.smallmonsters,s1425535.smallmonstersinfo WHERE smallmonstersinfo.smallmonsterid=smallmonsters.smallmonsterID and smallmonsters.bigmonsterID=".$monsterid.";");
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

						updatesmons();


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