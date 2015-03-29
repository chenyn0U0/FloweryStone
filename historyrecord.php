<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<?php
    require "getvisualisationdata2.php";
    

    $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

    $con = getconnection();

    $stmt=runsql($con,"SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
         where datediff(curdate(),STR_TO_DATE(feedhistory.finishtime,'%Y-%m-%d %H:%i:%s')) <7 and feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
            and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");
    $stmt->bind_result($finishtime);
    // $finisharray;
    while($stmt->fetch()){
        // if(isset($finisharray)) $datastring+=$finishtime;
        // $datastring+=","+$finishtime;
        $data[floor(date("H",strtotime($finishtime))/2)]++;
    }
    $stmt->close();
    $con->close();
    // print_r($data);
    echo "<script>var weekdays=['0:00','2:00','4:00','6:00','8:00','10:00','12:00','14:00','16:00','18:00','20:00','22:00'];var visualdata=[";

    $firsttime=true;
    foreach ($data as $key=>$value) {
        if($firsttime){$firsttime=false; echo "[weekdays[".$key."],".($value*0.5).",".$value."]";}
        else echo ",[weekdays[".$key."],'".($value*0.5)."h',".$value."]";
    }

    echo "];</script>";

?>
<style type="text/css" >







</style>
<link href="stylesheets/historyrecord.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="data_redmon" > 
    <img src="datavisualisation/redmon.png" width="150" height="150" alt=""/>
    <div class="textbox">
    <p class="text"><b>5</b> projects are created</p>
    </div>
    </div>
    
    <div class="data_piechart">
    <img src="datavisualisation/piechart1.png" width="450" height="380" alt=""/></div>
    <div class="data_greenmon">
    <img src="datavisualisation/greenmon.png" width="150" height="150" alt=""/> 
    <div class="textbox">
      <p class="text"><strong>19</strong> tasks are finished</p>
    </div>
    </div>
    
	<div class="data_yellowpie">
    <img src="datavisualisation/yellowpie.png" width="150" height="150" alt=""/>
     <div class="textbox">
    <p class="text"><b>113</b> pies are consumed</p>
    </div>
    </div>
    
	<div class="data_bluegiveup">
    <img src="datavisualisation/bluegiveup.png" width="150" height="150" alt=""/> <div class="textbox">
    <p class="text"><b>12</b> times dropping tasks</p>
    </div>
    </div>





<div class="nav">

    <div class="nav_m fl">
    
    <ul>
        <li><a href=""><img src="datavisualisation/homeicon.png" width="50" height="50" alt=""/></a></li>
        <li><a href=""><img src="datavisualisation/badgeicon.png" width="50" height="50" alt=""/></a>
    
            <ul>
                <li>
                    <div class="badge">
                        <img src="datavisualisation/clock.png" width="50" height="50" alt=""/>
                    </div>
                    <div>
                        <p class="badge_explain"> <b>time badge</b> You have worked more than 60 hours during the last month</p>
                    </div>
                </li>

                <li>
                    <div class="badge">
                        <img src="datavisualisation/earlybird.png" width="50" height="50" alt=""/>
                     </div>
                    <div>
                        <p class="badge_explain"> <b>early bird badge</b> You spend more time on working in the daytime</p>
                    </div>
                </li>

    
                <li>
                    <div class="badge">
                        <img src="datavisualisation/nightowl.png"  width="50" height="50" alt=""/>
                     </div>
                    <div>
                        <p class="badge_explain"> <b>night owl badge</b> You spend more time on working at night</p>
                    </div>
                </li>

                
                <li>
                    <div class="badge">
                        <img src="datavisualisation/champion.png"  width="50" height="50" alt=""/>
                    </div>
                    <div>
                        <p class="badge_explain"> <b>award badge</b> You have finished three big projects in one month</p></div>
                </li>
            </ul>  
        </li>   
    </ul>
    </div>
</div>






</body>
</html>
