	function logout(){
	        if(confirm("Are you sure you want to log out?"))
	        {
	        	document.getElementById('logout').click();
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

		$(document).ready(function(){
			$("#cardcontainer").hide();
			$("#hardblack").hide();
			$("#softblack").hide().click(function(){
				$("#cardcontainer").hide();$("#softblack").hide();
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
			//d→0是否存在（新建用），1任务是否已完成，2任务名，3任务描述，4任务总时间，5任务披萨数，6出现小怪兽id，7出现小怪兽图片路径，8此任务id，9此大任务id
			if(d[0]==1){//如果已有
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
				$("#monsterhead").attr("src",d[7]);
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
			document.getElementById('newSmonster').click();
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