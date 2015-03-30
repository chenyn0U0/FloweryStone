<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Item</title>
  	
	<script src="js/jquery.js"></script>
</head>
<body>
<input id="moviename" type="text"/>
<button onclick="addpic()">click add pic</button>
<p></p>
<script>
function addpic(){
	$.ajax({ url: "http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=myy4rbbyzaxthq748vneq2px&q="+moviename.value+"&page_limit=1", 
        dataType:"jsonp",context: document.body, success: function(data){
        
        var id=data.movies[0].id;
        

        $.ajax({ url: "http://api.rottentomatoes.com/api/public/v1.0/movies/"+id+"/reviews.json?apikey=myy4rbbyzaxthq748vneq2px", 
            dataType:"jsonp",context: document.body, success: function(comment){
                console.log(comment);
                for(var i=0;i<comment.reviews.length;i++){
                    $("p").after(comment.reviews[i].critic+":    "+comment.reviews[i].quote+"<hr/>");
                }
        }});

        // var pic=data.results[0].poster_path;

        // 
    }});
}
	



</script>



</body>
</html> -->

<!-- 
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">  
<script src="js/jquery.js"></script>

<script> 
    $(document).ready(function(){
        $("#hotarea").click(function(){
                $("#guidemessage").fadeOut("slow",function(){
                    $("#guidemessage").attr("style","display:none");
                });
        });

        showmessageguide(300,200,200,200,500,500,"I am a text oh yeah!~");
    });
    function showmessageguide(centerx,centery,width,height,textx,texty,textcontent){
        //宽度尽量大于50以保证小圆圈正常显示
        var top=centery-(height/2);
        var left=centerx-(width/2);
        var right=centerx+(width/2);
        var bottom=centery+(height/2);
        $("#top").animate({height:top+"px"},0);
        $("#left").animate({top:top+"px",width:left+"px",height:height+"px"},0);
        $("#right").animate({top:top+"px",left:right+"px",height:height+"px"},0);
        $("#bottom").animate({height:"100%",top:bottom+"px"},0);
        $("#pointer").animate({left:centerx+"px",top:centery+"px"},0);
        $("#hotarea").animate({left:left+"px",top:top+"px",width:width+"px",height:height+"px"},0);
        $("#guideinfo").text(textcontent).animate({left:textx+"px",top:texty+"px"},0);
        $("#guidemessage").attr("style","display:inherit");
        $("#guidemessage").fadeIn("slow");
    }
</script>   

</head>  
<body style="margin:0">
<div id="guidemessage" style="display:none;position:fixed;z-index:6000">
    <div id="top" class="fourblackdiv" ></div>
    <div id="left" class="fourblackdiv" ></div>
    <div id="right" class="fourblackdiv" ></div>
    <div id="bottom" class="fourblackdiv" ></div>
    <div id="pointer" style="position:fixed">
        <img src="img/point.png" style="position:relative;left:-28px;top:-75px"/>
        <img src="img/hand.png" style="height:100px;position:relative;left:-68px;"/>
    </div>
    <div id="guideinfo" style="position:fixed;font-size:22px;font-family:Georgia;font-weight:bold;color:white"></div>
    <div id="hotarea" style="position:fixed;opacity:0"></div>
</div>

</body>  
</html>  
  

<style>
.fourblackdiv{
    background-color: black;
    opacity: 0.4;
    position: fixed;
    margin: 0;
    width:100%;
}
</style> -->




<?php
$date1=strtotime("2015-02-27 20:20:44");
$today=time();

echo ($today-$date1)/(24*60*60);
?>