    var svgW=350,svgH =300;
    var visualradius=250,firstradius=120,maxradiusminus=50,circlenum=5;
    var circlecolor=["#efefee","#e2e2e1","#c6c6c6","#b7b7b7","#a9a8a8"];
    var polygonfill="rgba(0,0,0,0.4)",polygonline="rgba(0,0,0,0.9)",polygonlineweight=1;
    var textlength=10;
    var basicshaperadius=10;
    var defaultpolyline=svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2+" "+svgW/2+","+svgH/2;
    var fullpoints=5;
    //data结构：0-圈外注释名（星期/时间）；1-折线内容；2-折线反应数值(满分fullpoints);



$(document).ready(function(){
    
    var visualdata=binddata("create");

    var svg=d3.select("#visualsvgdiv")
        .append("svg")
        .attr("width", svgW)
        .attr("height", svgH)
        .attr('id','weekdaysvisualisation');


    var circleg=svg.append("g")
        .attr("id","circleg");


    for(var i=0;i<circlenum;i++){
        circleg.append('circle')
            .attr("cx",svgW/2)
            .attr("cy",svgH/2)
            .attr("r",(firstradius/2)+((visualradius-firstradius)/2/(circlenum-1)*(5-i-1)))
            .attr("fill",circlecolor[i]);
    }


    

//#####################################################CREAT FIRST VISULISATION↓####################################################

        var infog=svg.append("g")
            .attr("id","infomationg");


        var polygon=svg.append("polygon")
            .attr("fill",polygonfill)
            .attr("stroke-width",polygonlineweight)
            .attr("stroke",polygonline)
            .attr("id","polygon")
            .attr("points",defaultpolyline);

        var polygonpoints="";
        
        var everyelementg=infog.selectAll("g")
            .data(visualdata)
            .enter()
            .append('g').attr('id',function(d,i){
                var showd=d[2];
                if(parseInt(d[2])>fullpoints) showd=fullpoints;
                var x=Math.cos(Math.PI*2/visualdata.length*i)*(showd*((visualradius-maxradiusminus)/fullpoints/2)+basicshaperadius)+svgW/2;
                var y=Math.sin(Math.PI*2/visualdata.length*i)*(showd*((visualradius-maxradiusminus)/fullpoints/2)+basicshaperadius)+svgH/2;
                if(polygonpoints=="") polygonpoints+=x+","+y;
                else polygonpoints+=" "+x+","+y;
                return d[0];
            });

        var everyline=everyelementg.append("line")
            .attr("x1",svgW/2)
            .attr("y1",svgH/2)
            .attr("x2",function(d,i){return Math.cos(Math.PI*2/visualdata.length*i)*(visualradius/2+basicshaperadius)+svgW/2;})
            .attr("y2",function(d,i){return Math.sin(Math.PI*2/visualdata.length*i)*(visualradius/2+basicshaperadius)+svgH/2;})
            .attr("stroke-width","1")
            .attr("stroke","#ffffff");

        var everyouttext=everyelementg.append("text")
            .style("font-size","3px")
            .style("font-family","Verdana")
            .attr("x",function(d,i){return Math.cos(Math.PI*2/visualdata.length*i)*(visualradius/2+textlength)+svgW/2-12;})
            .attr("y",function(d,i){return Math.sin(Math.PI*2/visualdata.length*i)*(visualradius/2+textlength)+svgH/2+5;})
            .text(function(d){return d[0];});

        var everyinnertext=everyelementg.append("text")
            .style("font-size","3px")
            .style("font-family","Arial")
            .attr("x",function(d,i){
                var showd=d[2];
                if(parseInt(d[2])>fullpoints) showd=fullpoints;
                return Math.cos(Math.PI*2/visualdata.length*i)*(showd*((visualradius-maxradiusminus)/fullpoints/2)+textlength+basicshaperadius)+svgW/2-12;
            })
            .attr("y",function(d,i){
                var showd=d[2];
                if(parseInt(d[2])>fullpoints) showd=fullpoints;
                return Math.sin(Math.PI*2/visualdata.length*i)*(showd*((visualradius-maxradiusminus)/fullpoints/2)+textlength+basicshaperadius)+svgH/2+5;
            })
            .text(function(d){if(d[2]>0) return d[1];});

        polygon.transition()
            .delay(100)
            .attr("points",polygonpoints);


});
    
//#####################################################CREAT FIRST VISULISATION↑####################################################





//===========update svg======================
    function updatesvg(visualdata){

        var polygonpoints="";
        
        $("#infomationg").animate({opacity:0.5},"fast",function(){$("#infomationg").text("");


        $("#polygon").animate({opacity:0.9},50);

        var everyelementg=d3.select("#infomationg")
            .selectAll("g")
            .data(visualdata)
            .enter()
            .append('g').attr('id',function(d,i){
                var showd2=d[2];
                if(parseInt(d[2])>fullpoints) showd2=fullpoints;
                var x=Math.cos(Math.PI*2/visualdata.length*i)*(showd2*((visualradius-maxradiusminus)/fullpoints/2)+basicshaperadius)+svgW/2;
                var y=Math.sin(Math.PI*2/visualdata.length*i)*(showd2*((visualradius-maxradiusminus)/fullpoints/2)+basicshaperadius)+svgH/2;
                if(polygonpoints=="") polygonpoints+=x+","+y;
                else polygonpoints+=" "+x+","+y;
                return d[0];
            });

        var everyline=everyelementg.append("line")
            .attr("x1",svgW/2)
            .attr("y1",svgH/2)
            .attr("x2",function(d,i){
                return Math.cos(Math.PI*2/visualdata.length*i)*(visualradius/2+basicshaperadius)+svgW/2;
            })
            .attr("y2",function(d,i){
                return Math.sin(Math.PI*2/visualdata.length*i)*(visualradius/2+basicshaperadius)+svgH/2;
            })
            .attr("stroke-width","1")
            .attr("stroke","#ffffff");

        var everyouttext=everyelementg.append("text")
            .style("font-size","3px")
            .style("font-family","Verdana")
            .attr("x",function(d,i){
                return Math.cos(Math.PI*2/visualdata.length*i)*(visualradius/2+textlength)+svgW/2-12;
            })
            .attr("y",function(d,i){
                return Math.sin(Math.PI*2/visualdata.length*i)*(visualradius/2+textlength)+svgH/2+5;
            })
            .text(function(d){return d[0];});

        var everyinnertext=everyelementg.append("text")
            .style("font-size","3px")
            .style("font-family","Arial")
            .attr("x",function(d,i){
                var showd2=d[2];
                if(d[2]>fullpoints) showd2=fullpoints;
                return Math.cos(Math.PI*2/visualdata.length*i)*(showd2*((visualradius-maxradiusminus)/fullpoints/2)+textlength+basicshaperadius)+svgW/2-5;
            })
            .attr("y",function(d,i){
                var showd2=d[2];
                if(d[2]>fullpoints) showd2=fullpoints;
                return Math.sin(Math.PI*2/visualdata.length*i)*(showd2*((visualradius-maxradiusminus)/fullpoints/2)+textlength+basicshaperadius)+svgH/2+5;
            })
            .text(function(d){if(d[2]>0) return d[1];});

        
        d3.select("#polygon").transition()
            .delay(50)
            .attr("points",polygonpoints);


        $("#polygon").animate({opacity:1},50);

        });

        $("#infomationg").animate({opacity:1},"slow");



    }



//
function binddata(mode){
    var dataarray;
    var days=parseInt(withindays.value);
    var multinum=1;
    var string="";

    if(ouputcontent.value=="taskfinished"){
        dataarray=alldata.taskfinished;
        multinum=1;
        string="";
    }
    if(ouputcontent.value=="pieconsumption"){
        dataarray=alldata.pieconsumption;
        multinum=0.5;
        string="h";
    }
    if(ouputcontent.value=="projectcreated"){
        dataarray=alldata.projectcreated;
        multinum=1;
        string="";
    }
    if(ouputcontent.value=="piedroped"){
        dataarray=alldata.piedroped;
        multinum=1;
        string="";
    }

    var totalnum=0;
    var visualdata=new Array();
    if(timemode.value=="weekdays"){
        var weekdays=['SUN','MON','TUE','WED','THU','FRI','SAT'];
        for(var i=0;i<weekdays.length;i++){
            visualdata[i]=[weekdays[i],"",0];
        }

        var now=new Date();
        for(var i=0;i<dataarray.length;i++){
            var date=new Date(dataarray[i]);
            if((now-date)/1000/60/60/24<=days){
                visualdata[date.getDay()][2]++;
                visualdata[date.getDay()][1]=visualdata[date.getDay()][2]*multinum+string;
                totalnum++;
            }
        }
    }

    if(timemode.value=="hours"){

        var hours=['0:00','2:00','4:00','6:00','8:00','10:00','12:00','14:00','16:00','18:00','20:00','22:00'];

        for(var i=0;i<hours.length;i++){
            visualdata[i]=[hours[i],"",0];
        }

        var now=new Date();
        for(var i=0;i<dataarray.length;i++){
            var date=new Date(dataarray[i]);
            if((now-date)/1000/60/60/24<=days){
                visualdata[parseInt(date.getHours()/2)][2]++;
                visualdata[parseInt(date.getHours()/2)][1]=visualdata[parseInt(date.getHours()/2)][2]*multinum+string;
                totalnum++;
            }
        }  
    }
    updateouputcontenttext(totalnum);
    if(mode=="create") return visualdata;
    if(mode=="update") updatesvg(visualdata);
}


function clickonoutputcontent(mode){
    ouputcontent.value=mode;
    binddata("update");
}

function clickontimemode(mode){
    timemode.value=mode;
    binddata("update");
}

function clickonchangeday(num){
    var days=parseInt(withindays.value);
    if(days+num<=1) withindays.value=1;
    else withindays.value=days+num;
    binddata("update");
}

function updateouputcontenttext(totalnum){
    var daytext="";
    if (withindays.value>1) daytext=withindays.value+" DAYS";
    else daytext=withindays.value+" DAY";

    if(ouputcontent.value=="taskfinished"){
        $("#ouputcontenttext").text(totalnum+" tasks are accomplished during recent");
        $("#showhowmanydays").text(daytext);
    }
    if(ouputcontent.value=="pieconsumption"){
        $("#ouputcontenttext").text(totalnum+" pies are consumed during recent");
        $("#showhowmanydays").text(daytext);
    }
    if(ouputcontent.value=="projectcreated"){
        $("#ouputcontenttext").text(totalnum+" projects are created during recent");
        $("#showhowmanydays").text(daytext);
    }
    if(ouputcontent.value=="piedroped"){
        $("#ouputcontenttext").text(totalnum+" times dropping tasks during recent");
        $("#showhowmanydays").text(daytext);
    }
}
