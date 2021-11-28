<!DOCTYPE html>
<html>
    <head>
        <style>
            .center{
                text-align: center;
            }
            table{
            border: 1px solid black;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            }
            .classSchedule{
                width: auto;
            }
            .gapSchedule{
                width: 5%;
                border: 2px solid black;
                line-height: 30px;
            }
            .tdBorder1{
                border: 1px solid black;
                width: 10%;
                line-height: 30px;
                 margin: 0;
                padding: 0;
            }
            th{
                border: 2px solid black;
            }
            td{
                width: auto;
            }
            .num{
                width: 2%;
                border: 1px solid black;
            }
            .BoldRoom{
                border: 1px solid black;
                width: 5%;
                line-height: 30px;
                 margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .blankNum{
                width: 2%;
            }
            .blankRoom{
                width: 5%;
                line-height: 30px;
                 margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .groupClass{
                border-top: 2px solid black;
            }
            .Controller{
                position: fixed;
                bottom: 20px;
                right: 30px;
            }
        </style>
    </head>
    <body>
        <div>
            <form method="post" class="center">
                <input type= "submit" name="showMondayDAV2" value="Show Davis Monday">
                <input type= "submit" name="showTuesdayDAV2" value="Show Davis Tuesday">
                <input type ="submit" name="showWednesdayDAV2" value="show Davis Wednesday">
                <input type ="submit" name="showThursdayDAV2" value="show Davis Thursday">
                <input type ="submit" name="showFridayDAV2" value="show Davis Friday">
                <input type ="submit" name="showSaturdayDAV2" value="show Davis Saturday">
                <input type ="submit" name="showSundayDAV2" value="show Davis Sunday">
                
            </form>  
                <?php 
                class Classroom {
                    public $facility_id;
                    public $start_time;
                    public $end_time;
                    public $room_description ;
                    
                    function set_facility_id($name){
                        $this->facility_id = $name;
                    }
                    function get_facility_id(){
                        return $this->facility_id;
                    }
                    function set_start_time($time){
                        $this->start_time = $time;
                    }
                    function get_start_time(){
                        return $this->start_time;
                    }
                    function set_end_time($time){
                        $this->end_time = $time;
                    }
                    function get_end_time(){
                        return $this->end_time;
                    }           
                    function set_room_description($description){
                        $this->room_description = $description;
                    }
                    function get_room_description(){
                        return $this->room_description;
                    }
                }
                class Gap{
                    public $timeGapStart;
                    public $timeGapEnd;
                    public $timeClassGap;
                    
                    function set_timeGapStart($time){
                        $this->timeGapStart = $time;
                    }
                    function get_timeGapStart(){
                        return $this->timeGapStart;
                    }
                    function set_timeGapEnd($time){
                        $this->timeGapEnd = $time;
                    }
                    function get_timeGapEnd(){
                        return $this->timeGapEnd;
                    }
                    function set_timeClassGap($class){
                        $this->$timeClassGap = $class;
                    }
                    function get_timeClassGap(){
                        return $this->$timeClassGap;
                    }
                }
                $opening_time = 8;
                $closing_time = 23;
                try{
                    $dbh = new PDO("mysql:host=localhost;dbname=vuongv_Sheridanv2Prototype","vuongv","Q3sLpnT@3E!&M");
                    }catch (Exception $ex){
                        die("<tr><td>($e->getMessage()}</td></tr></body></table>");
                    }
                //DAV_MONDAY 
                if(isset($_POST['showMondayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_MONDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS MONDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_MONDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` DESC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            echo "<p>TOAST</p>";
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_Tuesday Prime - print class 
                if(isset($_POST['showTuesdayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS TUESDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                        
                        $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                          $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }   
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_WEDNESDAY
                if(isset($_POST['showWednesdayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_WEDNESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS WEDNESDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_THURSDAY
                if(isset($_POST['showThursdayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_THURSDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS THURSDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_FRIDAY
                if(isset($_POST['showFridayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_FRIDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS FRIDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` DESC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_SATURDAY
                if(isset($_POST['showSaturdayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_SATURDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS SATURDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                //DAV_SUNDAY
                if(isset($_POST['showSundayDAV2'])){
                        $command = "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_SUNDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        $num = 1;
                        echo 
                            "<form method=\"post\" id=\"GapSelection\">";
                        echo
                            "<h1>DAVIS SUNDAY</h1>";
                        echo 
                            "<table>";
                        echo 
                            "<tr class=\"header1\">
                                <th class=\"num\">#</th> 
                                <th class=\"BoldRoom\">Room</th> 
                                <th class=\"classSchedule\">Class 1</th> 
                                <th class=\"classSchedule\">Class 2</th>
                                <th class=\"classSchedule\">Class 3</th>
                                <th class=\"classSchedule\">Class 4</th>
                                <th class=\"classSchedule\">Class 5</th>
                                <th class=\"classSchedule\">Class 6</th>
                                <th class=\"gapSchedule\"> Gap 1</th>
                                <th class=\"gapSchedule\"> Gap 2</th>
                                <th class=\"gapSchedule\"> Gap 3</th>
                                <th class=\"gapSchedule\"> Gap 4</th>
                                <th class=\"gapSchedule\"> Gap 5</th>
                                <th class=\"gapSchedule\"> Gap 6</th>  
                            </tr>";
                        $classTemp = new Classroom();
                        $class1 = new Classroom();
                        $class2 = new Classroom();
                        $class3 = new Classroom();
                        $class4 = new Classroom();
                        $class5 = new Classroom();
                        $class6 = new Classroom();
                        $class7 = new Classroom();
                        
                        $classTemp->set_facility_id("none");
                        $class1->set_facility_id("none");
                        $class2->set_facility_id("none");
                        $class3->set_facility_id("none");
                        $class4->set_facility_id("none");
                        $class5->set_facility_id("none");
                        $class6->set_facility_id("none");
                        $class7->set_facility_id("none");
                        
                        $gap1 = FALSE;
                        $gap2 = FALSE;
                        $gap3 = FALSE;
                        $gap4 = FALSE;
                        $gap5 = FALSE;
                        $gap6 = FALSE;
                        $first = FALSE;
                        
                        while($row = $stmt->fetch()){
                            $temp1;
                            $temp2;
                                
                                if(($class1->get_facility_id()) != $row["Facility_ID"]  ){
                                        $class1->set_facility_id($row["Facility_ID"]); 
                                        
                                        if ($classTemp->get_facility_id() != $class1->get_facility_id() && $first==TRUE){
                                            $timeGapC = new Gap();
                                            $timeGapC->set_timeGapStart($classTemp->get_end_time());
                                            $timeGapC->set_timeGapEnd($closing_time);
                                            $timeGapC->set_timeClassGap($classTemp->get_facility_id());
                                            echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$timeGapC->get_timeClassGap()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}');\" name=\"{$timeGapC->get_timeClassGap()}\" value=\"{$classTemp->get_facility_id()},{$timeGapC->get_timeGapStart()},{$timeGapC->get_timeGapEnd()}\"><label>{$timeGapC->get_timeGapStart()}:00 - {$timeGapC->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                                        }
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class1->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class1->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class1->get_end_time());
                                        $classTemp->set_facility_id($class1->get_facility_id());
                                        $class1->set_room_description(["Room_Description"]);
                                        $first = TRUE;
                                        echo 
                                            "<tr>";
                                        echo
                                           "
                                            <td class=\"num\">{$num}</td>
                                            <td class=\"BoldRoom\">{$class1->get_facility_id()}</td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if( (($class1->get_start_time() - $opening_time) > 0) && $gap1 == FALSE ){
                                            $timeGap1 = new Gap();
                                            $timeGap1->set_timeClassGap($class1->get_facility_id());
                                            $timeGap1->set_timeGapStart($opening_time);
                                            $timeGap1->set_timeGapEnd($class1->get_start_time());
                                            echo 
                                                "
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}');\" name=\"{$class1->get_facility_id()}\" value=\"{$timeGap1->get_timeClassGap()},{$timeGap1->get_timeGapStart()},{$timeGap1->get_timeGapEnd()}\"><label>{$timeGap1->get_timeGapStart()}:00-{$timeGap1->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                ";
                                            $gap1 = TRUE;
                                    }
                                        echo 
                                            "</tr>";
                                        $num ++; 
                                } elseif (($class2->get_facility_id()) != $row["Facility_ID"] ){
                                        $class2->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class2->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class2->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class2->get_end_time());
                                    
                                        $class2->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]} </td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class2->get_start_time() - $class1->get_end_time()) > 0 ) && $gap2 == FALSE){
                                        $timeGap2 = new Gap();
                                        $timeGap2->set_timeClassGap($class2->get_facility_id());
                                        $timeGap2->set_timeGapStart($class1->get_end_time());
                                        $timeGap2->set_timeGapEnd($class2->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}');\" name=\"{$class2->get_facility_id()}\" value=\"{$timeGap2->get_timeClassGap()},{$timeGap2->get_timeGapStart()},{$timeGap2->get_timeGapEnd()}\"><label>{$timeGap2->get_timeGapStart()}:00-{$timeGap2->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap2 = TRUE;
                                    } 
                                    echo 
                                        "</tr>";
                                } elseif( ($class3->get_facility_id()) != $row["Facility_ID"]){
                                        $class3->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class3->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class3->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class3->get_end_time());    
                                    
                                        $class3->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class3->get_start_time() - $class2->get_end_time()) > 0 ) && $gap3 == FALSE){
                                        $timeGap3 = new Gap();
                                        $timeGap3->set_timeClassGap($class3->get_facility_id());
                                        $timeGap3->set_timeGapStart($class2->get_end_time());
                                        $timeGap3->set_timeGapEnd($class3->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}');\" name=\"{$class3->get_facility_id()}\" value=\"{$timeGap3->get_timeClassGap()},{$timeGap3->get_timeGapStart()},{$timeGap3->get_timeGapEnd()}\"><label>{$timeGap3->get_timeGapStart()}:00-{$timeGap3->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap3 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif(($class4->get_facility_id()) != $row["Facility_ID"] ){
                                        $class4->set_facility_id($row["Facility_ID"]);
                                    
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class4->set_start_time($temp1);
                                    
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class4->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class4->get_end_time());
                                        
                                        $class4->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo
                                        "   <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                    if ( (($class4->get_start_time() - $class3->get_end_time()) > 0 ) && $gap4 == FALSE ){
                                        $timeGap4 = new Gap();
                                        $timeGap4->set_timeClassGap($class4->get_facility_id());
                                        $timeGap4->set_timeGapStart($class3->get_end_time());
                                        $timeGap4->set_timeGapEnd($class4->get_start_time());
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}');\" name=\"{$class4->get_facility_id()}\" value=\"{$timeGap4->get_timeClassGap()},{$timeGap4->get_timeGapStart()},{$timeGap4->get_timeGapEnd()}\"><label>{$timeGap4->get_timeGapStart()}:00-{$timeGap4->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            <td></td>
                                            ";
                                        $gap4 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                } elseif (($class5->get_facility_id()) != $row["Facility_ID"]){
                                        $class5->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class5->set_start_time($temp1);
                                
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class5->set_end_time($temp2);
                                    
                                        $classTemp->set_end_time($class5->get_end_time());
                                    
                                        $class5->set_room_description(["Room_Description"]);    
                                        echo 
                                            "<tr>";
                                        echo
                                        "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                            <td class=\"tdBorder1\"></td>
                                        ";
                                        if ( (($class5->get_start_time() - $class4->get_end_time()) > 0 ) && $gap5 == FALSE ){
                                            $timeGap5 = new Gap();
                                            $timeGap5->set_timeClassGap($class5->get_facility_id());
                                            $timeGap5->set_timeGapStart($class4->get_end_time());
                                            $timeGap5->set_timeGapEnd($class5->get_start_time());
                                            echo 
                                                "
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}');\" name=\"{$class5->get_facility_id()}\" value=\"{$timeGap5->get_timeClassGap()},{$timeGap5->get_timeGapStart()},{$timeGap5->get_timeGapEnd()}\"><label>{$timeGap5->get_timeGapStart()}:00-{$timeGap5->get_timeGapEnd()}:00</label></td>
                                                <td></td>
                                                ";
                                            $gap5 = TRUE;
                                    }
                                        echo 
                                        "</tr>";
                                } elseif (($class6->get_facility_id()) != $row["Facility_ID"]){
                                        
                                        $class6->set_facility_id($row["Facility_ID"]);
                                        
                                        $temp1 = $row["start_time"];
                                        $temp1 = substr($temp1,0,2);
                                        $temp1 = intval($temp1);
                                        $class6->set_start_time($temp1);
                                        
                                        $temp2 = $row["end_time"];
                                        $temp2 = substr($temp2,0,2);
                                        $temp2 = intval($temp2);
                                        $class6->set_end_time($temp2);
                                        
                                        $classTemp->set_end_time($class6->get_end_time());
                                    
                                        $class6->set_room_description(["Room_Description"]);
                                        echo 
                                            "<tr>";
                                        echo "
                                            <td class=\"num\"></td>
                                            <td class=\"BoldRoom\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\"></td>
                                            <td class=\"tdBorder1\">{$row["start_time"]} - {$row["end_time"]}<br> {$row["Room_Description"]}</td>
                                        ";
                                    if ($class6->get_end_time() < $closing_time && $gap6 == FALSE ){
                                        $timeGap6 = new Gap();
                                        $timeGap6->set_timeClassGap($class6->get_facility_id());
                                        $timeGap6->set_timeGapStart($class5->get_end_time());
                                        $timeGap6->set_timeGapEnd($$closing_time);
                                        echo 
                                            "
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class=\"gapSchedule\"><input type=\"radio\" onclick=\"GrabGapData('{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}');\" name=\"{$class6->get_facility_id()}\" value=\"{$timeGap6->get_timeClassGap()},{$timeGap6->get_timeGapStart()},{$timeGap6->get_timeGapEnd()}\"><label>{$timeGap6->get_timeGapStart()}:00-{$timeGap6->get_timeGapEnd()}:00</label></td>
                                            <td></td>
                                            ";
                                        $gap6 = TRUE;
                                    }
                                    echo 
                                        "</tr>";
                                }
                                $gap1 = FALSE;
                                $gap2 = FALSE;
                                $gap3 = FALSE;
                                $gap4 = FALSE;
                                $gap5 = FALSE;
                                $gap6 = FALSE;
                                
                                $lastClass1 = FALSE;
                                $lastClass2 = FALSE;
                                $lastClass3 = FALSE;
                                $lastClass4 = FALSE;
                                $lastClass5 = FALSE;
                                $lastClass6 = FALSE;
    
                        }
                     $lastCommand= "SELECT `Facility_ID`, time_format(`mtg_start`,\"%H:%i:%s\") as start_time, time_format(`mtg_end`,\"%H:%i:%s\") as end_time, `Room Description` as `Room_Description` , COUNT(*) FROM `DAV_TUESDAY` GROUP BY `Facility_ID`, start_time, end_time, Room_Description HAVING COUNT(*) > 0 order by `Facility_ID` ASC, start_time DESC LIMIT 1;";
                        $stmt1 = $dbh->prepare($lastCommand);
                        $stmt1->execute();
                        $lastGap = new Gap();
                        while ($row1 = $stmt1->fetch()){
                            $lastGap->set_timeClassGap($row1["Facility_ID"]);
                            $lastGap->set_timeGapStart($row1["end_time"]);
                            $lastGap->set_timeGapEnd($closing_time);
                            
                             echo 
                                                "<tr>
                                                <td class=\"num\"></td>
                                                <td class=\"BoldRoom\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td class=\"tdBorder1\"></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class=\"gapSchedule\">
                                                <input type=\"radio\" onclick=\"GrabGapData('{$lastGap->get_timeClassGap()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}');\" name=\"{$lastGap->get_timeClassGap()}\" value=\"{$lastGap->get_facility_id()},{$lastGap->get_timeGapStart()},{$lastGap->get_timeGapEnd()}\"><label>{$lastGap->get_timeGapStart()}:00 - {$lastGap->get_timeGapEnd()}:00</label></td>
                                                </tr>
                                                <tr>
                                                <td class=\"blankNum\">    </td>
                                                <td class=\"blankRoom\">    </td>
                                                <tbody class=\"groupClass\">
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                <td>    </td>
                                                </tbody>
                                                </tr>

                                                ";
                        }
                        echo 
                            "</table>";
                        echo 
                            "
                            <div class=\"Controller\">
                            <input type=\"button\" id=\"ClassVisible\" onclick=\"ClassVisi()\" value=\"HIDE\"> 
                            <input type=\"button\" onclick=\"ClearAll()\" value=\"CLEAR ALL\">
                            <input type=\"button\" value=\"Create Path\" onclick=\"\">
                            <input type=\"button\" value=\"Test\" onclick=\"Test();\">
                            <input type=\"button\" value=\"Remove row in Path Table\" onclick=\"clearTable();\">
                            </div>
                            ";
                        echo "</form>";
                }
                ?>

            <table id = "PathTable">
                <tr>
                    <th>GapID</th>
                    <th>Class</th>
                    <th>Gap Time</th>
                    <th>Gap End</th>
                </tr>
                
            </table>
        </div>
            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" > </script>
            <script>
                class GapData{
                    constructor(className,gapStart,gapEnd){
                        this.className = className;
                        this.gapStart = gapStart;
                        this.gapEnd = gapEnd;
                    }
                }
                var test1 = 1;
                let object1 = new GapData("B52",12,14);
                
                let array1 = [object1];
                console.log(test1);
               
                var num=1;
                var Test = "beginning";
                var none=false;
                
                function ClassVisi (){
                    var ClassVisiButton = document.getElementById("ClassVisible").value;
                    if (ClassVisiButton == "HIDE"){
                         document.getElementById("ClassVisible").value = "HIDE";
                    }
                    if (ClassVisiButton == "SHOW") {
                        document.getElementById("ClassVisible").value = "SHOW";
                    }
                }
                function ClearAll(){
                    document.getElementsByName([name^="DAV"]).checked = false;
                }
                
                function GrabGapData(classSelected){
                    var input = classSelected;
                    var first = false;
                    var second = false;
                    var third = false;
                    var temp = input.split(',');
                    var className = temp[0];
                    var gapStart = temp[1];
                    var gapEnd = temp[2];
                    
                    var inputClass = new GapData(className, gapStart, gapEnd);
                    PathDisplay(inputClass);
                 }
                
                function Test(){
                    alert("Test");
                }
                
                function PathDisplay(inputClass){
                    var tablePath = document.getElementById("PathTable");
                    var tds = null;
                   
                    if(tablePath.rows.length < 2){
                        var row = tablePath.insertRow();
                        var cell0 = row.insertCell();
                        var cell1 = row.insertCell();
                        var cell2 = row.insertCell();
                        var cell3 = row.insertCell();
                        
                        cell0.innerHTML = num;
                        cell1.innerHTML = inputClass.className;
                        cell2.innerHTML = inputClass.gapStart;
                        cell3.innerHTML = inputClass.gapEnd;
                        num++;
                    }else {
                        for(var i=1; i <  tablePath.rows.length; i++){
                            tds = tablePath.rows[i].cells[1].innerHTML;
                            if (tds == inputClass.className){
                                document.getElementById("PathTable").deleteRow(i);
                            }else {
                            }
                        }
                        var row = tablePath.insertRow();
                        var cell0 = row.insertCell();
                        var cell1 = row.insertCell();
                        var cell2 = row.insertCell();
                        var cell3 = row.insertCell();
                                
                        cell0.innerHTML = num;
                        cell1.innerHTML = inputClass.className;
                        cell2.innerHTML = inputClass.gapStart;
                        cell3.innerHTML = inputClass.gapEnd;    
                        num++;
                    }
                    
                }
                function CreatePath(){
                    
                }
                function clearTable(){
                    document.getElementsByTagName("tr")[2].remove();
                }
                   
            </script>
    </body>
</html>