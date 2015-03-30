
<?php


    $taskfinished=getfinishedtimearray("SELECT smallmonsters.finishedtime FROM s1425535.bigmonsters,s1425535.smallmonsters
             where smallmonsters.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID and bigmonsters.ownerNum='".$_SESSION['username']."'");
    $pieconsumption=getfinishedtimearray("SELECT feedhistory.finishtime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
             where feedhistory.finished=1 and bigmonsters.id=smallmonsters.bigmonsterID
                and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");
    $projectcreated=getfinishedtimearray("SELECT bigmonsters.adopttime FROM s1425535.bigmonsters
             where bigmonsters.ownerNum='".$_SESSION['username']."'");
    $piedroped=getfinishedtimearray("SELECT feedhistory.starttime FROM s1425535.feedhistory,s1425535.bigmonsters,s1425535.smallmonsters
             where feedhistory.finished=0 and bigmonsters.id=smallmonsters.bigmonsterID
                and smallmonsters.id=feedhistory.smallmonsterid and bigmonsters.ownerNum='".$_SESSION['username']."'");


    $dataarray= array('taskfinished' => $taskfinished,'pieconsumption'=>$pieconsumption,'projectcreated'=>$projectcreated,'piedroped'=>$piedroped);
    echo "<script>alldata=".json_encode($dataarray)."</script>";



    function getfinishedtimearray($sql){
        $finishtimearray=array();
        $con = getconnection();

        $stmt=runsql($con,$sql);
        $stmt->bind_result($finishtime);

        while($stmt->fetch()){
            $finishtimearray[count($finishtimearray)]=$finishtime;
        }
        $stmt->close();
        $con->close();
        return $finishtimearray;
    }
?>

<script src="js/visualisation.js"></script>

<div id="visulisationdiv">
    <div id="visualsvgdiv"></div>

    <div>
        <div class="data_redmon" > 
            <a href="javascript:clickonoutputcontent('projectcreated')">
                <img src="datavisualisation/redmon.png" class="imgsetting" alt=""/>
                <div class="textbox">
                    <p class="text"><b><?php echo count($dataarray["projectcreated"]) ?></b> projects <br/> are created</p>
                </div>
            </a>
        </div>
        
        <div class="data_greenmon">
            <a href="javascript:clickonoutputcontent('taskfinished')">
                <img src="datavisualisation/greenmon.png" class="imgsetting" alt=""/> 
                <div class="textbox">
                    <p class="text"><strong><?php echo count($dataarray["taskfinished"]) ?></strong> tasks <br/>are finished</p>
                </div>
            </a>
        </div>
        
        <div class="data_yellowpie">
            <a href="javascript:clickonoutputcontent('pieconsumption')">
                <img src="datavisualisation/yellowpie.png" class="imgsetting" alt=""/>
                <div class="textbox">
                        <p class="text"><b><?php echo count($dataarray["pieconsumption"]) ?></b> pies are<br/> consumed</p>
                </div>
            </a>
        </div>
        
        <div class="data_bluegiveup">
            <a href="javascript:clickonoutputcontent('piedroped')">
                <img src="datavisualisation/bluegiveup.png" class="imgsetting" alt=""/> 
                <div class="textbox">
                    <p class="text"><b><?php echo count($dataarray["piedroped"]) ?></b> times<br/> dropping <br/>tasks</p>
                </div>
            </a>
        </div>
    </div>

    <div id="controlplace">
        <h3 style="font-family:Arial;font-weight:normal" id="ouputcontenttext">Pies you fed during recent</h3>
        <a href="javascript:clickonchangeday(-1)"><img id="arrowleft" src="img/arrow-l.png" class="arrow"/></a>
        <span id="showhowmanydays" style="font-size:25px;font-family:Arial">30 DAYS</span>
        <input id="withindays" type="hidden" value="30"/>
        <a href="javascript:clickonchangeday(1)"><img src="img/arrow-r.png" class="arrow"/></a>
        <input id="ouputcontent" type="hidden" value="pieconsumption"/>
        <input id="timemode" type="hidden" value="hours"/>
        <br/>
        <div style="margin-top:10px">
        <a class="text" href="javascript:clickontimemode('weekdays')" style="margin-right:20px">SHOW AS WEEKDAYS</a> 
        <a class="text" href="javascript:clickontimemode('hours')">SHOW AS HOURS</a>
        </div>
    </div>
</div>
</div>