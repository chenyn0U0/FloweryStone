	function logout(){
	        if(confirm("Are you sure you want to log out?"))
	        {
	        	document.getElementById('logout').click();
	        }
		}

		function clickonsmeat(d){

			if(confirm("Are you sure you want to work for 30 minutes feeding me?(Don't quit on the half way! I will be sad.)")){
				data=d.split(",");
				console.log(data);
				binddatatocard(data);
				prepareinformation();
			
				shownormalsm();
				var smonid=$("#smid").attr("value");
				var name="newfeed";
				$.post("saveworkdata.php", {thefunction:name,smid:smonid}, function(data){
					$("#taskid").attr("value",data);console.log("start task:"+data);
				});
				starttask();
				//设置倒计时↓

				clock=setInterval("everyseconds(t1,t2,t3,t4,t5,t6)", 1000);
			}
		}

		function clickonsm(d){
			data=d.split(",");
			console.log(data);
			binddatatocard(data);
			if(d[0]==1){//点击已有小怪兽
				prepareinformation();
			}
			else if(d[0]==0){//点击新建小怪兽
				prepareaddcard();
			}
			shownormalsm();
		}

		function clickonsmdelete(d){
			if(confirm("Are you sure you want me to leave?(I won't be back once I left.)")){
				data=d.split(",");
				console.log(data);
				var id=data[8];
				var name="deletesmallmonster";
				$.post("saveworkdata.php", {thefunction:name,smid:id}, function(data){
						location.reload();
					});
			}
		}

		function clickonbmfinish(){
			if(confirm("Are you sure my task is finished?")){
				var id=bmid.value;
				var name="finishbigmonster";
				$.post("saveworkdata.php", {thefunction:name,bmid:id}, function(data){
						console.log(data);
						location.href ="mainpage.php";
					});
			}
		}

		function clickonbmdelete(){
			if(confirm("Are you sure you want me (and all my lovely little friends!) to leave? - I won't be back once I left;(")){
				var id=bmid.value;
				var name="deletebigmonster";
				$.post("saveworkdata.php", {thefunction:name,bmid:id}, function(data){
					console.log(data);
					location.href ="mainpage.php";
				});
			}
		}


		function checkandpost(mode){
			if(idplace.value==0){}
			else{
				$("#smname").hide();
				$("#smnametext").show();
				$("#smdescription").hide();
   				$("#smdescriptiontext").show();
   				
   				if(mode=="smname"&&smname.value!=""){
   					$("#smnametext").text(filter(smname.value));
   					changefrontdatabytaskid(idplace.value,mode);
   				}
   				if(mode=="smdescription"&&filter(smdescription.value)!=""){
   					$("#smdescriptiontext").text(filter(smdescription.value));
   					changefrontdatabytaskid(idplace.value,mode);
   				}
			}
		}

		function bigcheckandpost(mode){
			if(bmname.value!=""&&bmdescription.value!=""){
				if(mode=="bmname"){
					$("#bmnametext").text(bmname.value);
					$("#bmname").hide();
					$("#bmnametext").show();
					var bigid=$("#bmid").attr("value");
					$.post("saveworkdata.php", {thefunction:"updatebmname",bmid:bigid,content:bmname.value}, function(data){
							});
				}
				if(mode=="bmdescription"){
					$("#bmdescriptiontext").text(bmdescription.value);
					$("#bmdescription").hide();
	   				$("#bmdescriptiontext").show();
	   				var bigid=$("#bmid").attr("value");
	   				$.post("saveworkdata.php", {thefunction:"updatebmdescription",bmid:bigid,content:bmdescription.value}, function(data){
							});
				}
			}
		}

		function filter(string) { 
			var filter = new RegExp("[.\*&\\\/\|:\.{},\n()';=\"]");
			var thestring = "";
			for (var i = 0; i < string.length; i++) { 
			thestring = thestring+string.substr(i, 1).replace(filter,' '); 
			} 
			return thestring; 
		} 


		function changefrontdatabytaskid(taskid,mode){
			for(var i=0;i<smonsinfo.length;i++){
				if(smonsinfo[i][8]==parseInt(taskid)){
					if(mode=="smname"){
						smonsinfo[i][2]=filter(smname.value);
						$.post("saveworkdata.php", {thefunction:"updatesmname",smid:taskid,content:filter(smname.value)}, function(data){
						});
					}
					if(mode=="smdescription"){
						smonsinfo[i][3]=filter(smdescription.value);
						$.post("saveworkdata.php", {thefunction:"updatesmdescription",smid:taskid,content:filter(smdescription.value)}, function(data){});
					}

				}
			}
		}

		$(document).ready(function(){
			$("#cardcontainer").hide();
			$("#hardblack").hide();
			$("#softblack").hide().click(function(){
				$("#cardcontainer").hide();
				$("#softblack").hide();
				updatesmons();
			});
			$("#smnametext").click(function(){
				if(smfinished.value==0){
	   				$("#smnametext").hide(0,function(){
	   					smname.value=$("#smnametext").text();
	   					$("#smname").show();
	   					smname.focus();
	   				});
   				}
   			});
   			$("#smdescriptiontext").click(function(){
   				if(smfinished.value==0){
	   				$("#smdescriptiontext").hide(0,function(){
	   					smdescription.value=$("#smdescriptiontext").text();
	   					$("#smdescription").show();
	   					smdescription.focus();
	   				});
	   			}
   			});


   			$("#bmname").hide();
   			$("#bmdescription").hide();
   			$("#bmnametext").click(function(){
   				$("#bmnametext").hide(0,function(){
   					bmname.value=$("#bmnametext").text();
   					$("#bmname").show();
   					bmname.focus();
   				});
   			});
   			$("#bmdescriptiontext").click(function(){
   				$("#bmdescriptiontext").hide(0,function(){
   					bmdescription.value=$("#bmdescriptiontext").text();
   					$("#bmdescription").show();
   					bmdescription.focus();
   				});
	   		});
 		 });

		function shownormalsm(){
			$("#cardcontainer").show("slow");
			$("#workingcard").hide();
			$("#softblack").css("opacity","0").show().animate({ opacity: '0.8' }, "slow");
		}

		function starttask(){
			$("#hardblack").show();
			$("#cardcontainer").show("slow");
			$("#softblack").hide();

			
			$("#cardcontainer").animate({left:'-=200px'});
			$("#feedmediv").hide("slow");
			$("#workingcard").show("slow");
		}

		function binddatatocard(d){
			if(d[0]==0){
				smfinished.value=0;
				idplace.value=0;
				smname.value="new monster";
				smdescription.value="";
			}

			//d→0是否存在（新建用），1任务是否已完成，2任务名，3任务描述，4任务总时间，5任务披萨数，6出现小怪兽id，7出现小怪兽图片路径，8此任务id，9此大任务id
			if(d[0]==1){//如果已有
				smfinished.value=d[1];
				idplace.value=d[8];

				if(d[1]==0) $("#feedmediv").show();
				if(d[1]==1) $("#feedmediv").hide();

				$("#smname").attr("value",d[2]);
				$("#smnametext").text(d[2]);

				$("#smdescription").attr("value",d[3]);
				$("#smdescriptiontext").text(d[3]);

				$("#smagetext").text("AGE : "+d[5]+" pizzas");
				//披萨图片绑定↓
				$("#pieeaten").html("");
				var lalala=(d[5]*10+20)+"px";
				$("#pieeaten").css("height",lalala);
				for(var i=0;i<d[5];i++){
					var apie=$("#pieeaten").html()+"<img src='img/Newadd/pie-bian.png' class='pie-bian' style='top:-"+(i*12)+"px;z-index:"+(4000-i)+"'/>"

					$("#pieeaten").html(apie);
				}
				
				//披萨图片绑定↑	
				if(d[1]=="1"){
					$("#monsterhead").attr("src",d[11]);
				}
				else $("#monsterhead").attr("src",d[7]);
				$("#moneatpie").attr("src",d[10]);
				$("#smid").attr("value",d[8]);
			}
			if(d[0]==0){//如果点击新建
				$("#smname").attr("value",d[2]);
				$("#smnametext").text(d[2]);

				$("#smdescription").attr("value",d[3]);
				$("#smdescriptiontext").text(d[3]);

				$("#pieeaten").html("");

				$("#monsterhead").attr("src",d[7]);
				$("#smid").attr("value",d[8]);
			}
		}

		function prepareinformation(){
			$("#smname").hide();
			$("#smnametext").show();
			$("#smdescription").hide();
			$("#smdescriptiontext").show();
			$("#smagediv").show();
			$("#addmediv").hide();
		}

		function prepareaddcard(){
			$("#smname").show();
			$("#smnametext").hide();
			$("#smdescription").show();
			$("#smdescriptiontext").hide();
			$("#smagediv").hide();
			$("#feedmediv").hide();
			$("#addmediv").show();
		}



//小怪兽可视化
		function updatesmons(){

			$("#smallmonsterscontainer").text("");

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
		        });
		    
		    // eachmonster.append("p")
		    // 	.text(function(d){if(d[0]==1) return d[3];});

		    var smbuttondiv=eachmonster.filter(function(d,i){if(d[0]==1) return 1;})
		    	.append("div")
		    	.attr("class","smbuttondiv");



			var eachmonstera=eachmonster.append("div")
		      //   .attr("href",function(d){
		      //   	return "javascript:clickonsm('"+d+"')";
		   		 // })
		        .attr("title",function(d){return d[3];})
		    	.attr("id",function(d){
		    		if(d[0]==0)	return "addnewsmondiv";
		    	});




		    eachmonstera.append("img")
		    	.attr("src",function(d){
		    		if(d[1]=="1") return d[11];
		    		else return d[7];
		    	})
		    	.attr("style","height:120px;width:120px;cursor:pointer")
		    	.attr("class",function(d){
		    		if(d[0]==0)	return "addnew";
		    	})
		    	.attr("onclick",function(d){
		        	return "javascript:clickonsm('"+d+"')";
		   		 });

		    eachmonstera.append("h3")
		    	.text(function(d){return d[2];})
		    	.attr("style","font-size:16px");






		    smbuttondiv.append("a")
		    	.attr("href",function(d){
		        	return "javascript:clickonsm('"+d+"')";
		   		 })
		    	.attr("title","See my details!")
		    	.append("img")
		    	.attr("src",function(d){
		    		if(d[0]=="1"){
		    			if(d[1]=="1") return "img/icon_view.png";
		    			if(d[1]=="0") return "img/icon_edit.png";
		    		}
		    	})
		    	.attr("style","	position: relative;top:10px;margin-right:20px;");;

		    smbuttondiv.append("a")
		    	.attr("href",function(d){
		        	return "javascript:clickonsmeat('"+d+"')";
		   		 })
		    	.attr("title","Start feeding me!")
		    	.append("img")
		    	.attr("src",function(d){if(d[0]=="1"&&d[1]==0) return "img/icon_feed.png";})
		    	.attr("style","	position: relative;top:0px;");

		    smbuttondiv.append("a")
		    	.attr("href",function(d){
		    		return "javascript:clickonsmdelete('"+d+"delete')";
		   		 })
		    	.attr("title","Delete me ;(")
		    	.append("img")
		    	.attr("src",function(d){if(d[0]=="1") return "img/icon_delete.png";})
		    	.attr("style","	position: relative;top:10px;margin-left:20px;");





	    }




		function feedme_click(){
			if(confirm("Are you sure you want to work for 30 minutes feeding me?(Don't quit on the half way! I will be sad.)")){
				var smonid=$("#smid").attr("value");
				var name="newfeed";
				$.post("saveworkdata.php", {thefunction:name,smid:smonid}, function(data){
					$("#taskid").attr("value",data);console.log("start task:"+data);
				});
				starttask();
				//设置倒计时↓

				clock=setInterval("everyseconds(t1,t2,t3,t4,t5,t6)", 1000);
				alert("Mission Start!❤ ");
			}
		}

		function iamfull_click(){
			if(confirm("Am I already grown up and would not need your sweeeeet work to feed me anymore?")){
				var smonid=$("#smid").attr("value");
				var name="finishfeedingnormal";
				$.post("saveworkdata.php", {thefunction: name, smid:smonid }, function(){
					alert("Thank you for all the pizzas you have given to me. I am a grown-up monster now. I would miss those days you feed me with your good work. Love you.");
					location.reload();
				});
			}
		}

		function addme_click(){

			$.post("saveworkdata.php", $("#smupdate").serialize(),function(data){console.log(data);location.reload();});
			
		}

	    // ##################################工作界面方法↓###########################################
	    function full_click(){
			if(confirm("Are you sure this task has already been finished?(You cannot work on this task anymore if you choose to finish it. Click on DROP button if you want to quit this task period.)")){

			}
	    }

	    function drop_click(){
	    	var smonid=$("#smid").attr("value");
	    	var taskid=$("#taskid").attr("value");
	    	$.post("saveworkdata.php", {thefunction: "dropduringwork", smid:smonid ,taskid:taskid },function(data){console.log(data);});
	    	if(confirm("Oh no! I am still hungry ;( ... Are you sure you want to stop your great work?")){
	    		//待加数据库操作
				clearInterval(clock);
	    		location.reload();
			}
			else{
				alert("Yooooooooo! Thank you for keep feeding me! I will grow up quickly I promise :)");
			}
	    }



	    var clock;
	    var timer=-1;
		var t1=30*60;
		var t2=25*60;
		var t3=20*60;
		var t4=15*60;
		var t5=10*60;
		var t6=5*60;
	    function everyseconds(t1,t2,t3,t4,t5,t6){
	    	console.log(timer);
			if(timer==-1) {
				timer=t1;
			}
			if(timer==t1-1){
	    		if(showdroptask) showguide("droptask");
	    	}

			if(timer<=t1&&timer>0){
				if(timer==t1||timer==t2||timer==t3||timer==t4||timer==t5||timer==t6||timer==0){
					getpizzapicsrc(timer,t1,t2,t3,t4,t5,t6);
				}
				var min=parseInt(timer/60);
				var sec=timer%60;
				var string;
				if(sec<10) string=min+" : 0"+sec;
				else string=min+" : "+sec;
				$("#currenttime").text(string);
				if(sec%2==1) {$("#timepiecover").show();}
				else {$("#timepiecover").hide();}
				timer--;
			}

			if(timer==0){
				var satisfied=0;
				//数据库update完成信息
				var smonid=$("#smid").attr("value");
	    		var taskid=$("#taskid").attr("value");
				$.post("saveworkdata.php", {thefunction: "finish30min", smid:smonid ,taskid:taskid },function(data){console.log(data);});
	    	
				if(confirm("Wow! I am one pizza older now! Thank you for feeding me with your great work! Have a five-minute relax please~ Love you❤~ ")){
					satisfied=1;		
				}
				else{
					if(confirm("Are you satisfied with your work for this pizza?")) satisfied=1;
					else satisfied=0;
				}
				//数据库update满意信息
				$.post("saveworkdata.php", {thefunction: "finishsatisfy", smid:smonid ,taskid:taskid ,satisfied:satisfied},function(data){console.log(data);});
	    	
				timer=-1;
				clearInterval(clock);
				location.reload();
			}
	    }



	    function getpizzapicsrc(time,t1,t2,t3,t4,t5,t6){

	    	if(time==t1){
	    		$("#haveaten").text("0 piece");
	    		$("#timepie").attr("src","img/Newadd/timepie.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover.png");
	    	}
	    	else if(time==t2){
	    		$("#haveaten").text("1 piece");
	    		$("#timepie").attr("src","img/Newadd/timepie25.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover25.png");
	    	}
	    	else if(timer==t3){
	    		$("#haveaten").text("2 pieces");
	    		$("#timepie").attr("src","img/Newadd/timepie20.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover20.png");
	    	}
	    	else if(timer==t4){
	    		$("#haveaten").text("3 pieces");
	    		$("#timepie").attr("src","img/Newadd/timepie15.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover15.png");
	    	}
	    	else if(timer==t5){
	    		$("#haveaten").text("4 pieces");
	    		$("#timepie").attr("src","img/Newadd/timepie10.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover10.png");
	    	}
	    	else if(timer==t6){
	    		$("#haveaten").text("5 pieces");
	    		$("#timepie").attr("src","img/Newadd/timepie5.png");
	    		$("#timepiecover").attr("src","img/Newadd/timepiecover5.png");
	    	}
	    	else if(timer==0){
	    		$("#haveaten").text("6 pieces");
	    		$("#timepie").attr("src","");
	    		$("#timepiecover").attr("src","");
	    	}
	    }