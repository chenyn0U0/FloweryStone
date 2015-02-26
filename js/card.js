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
			}
			if(d[0]==0){//如果点击新建
				$("#smname").attr("value",d[2]);
				$("#smnametext").text(d[2]);

				$("#smdescription").attr("value",d[3]);
				$("#smdescriptiontext").text(d[3]);

				$("#pieeaten").html("");

				$("#monsterhead").attr("src",d[7]);
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

		function feedme_click(){
			starttask();
		}

		function iamfull_click(){
			if(confirm("Are you sure this task has already been finished?")){

			}
		}

		function addme_click(){
			document.getElementById('newSmonster').click();
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