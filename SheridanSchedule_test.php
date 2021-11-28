<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            button, input{
                width: 200px;
                height: 30px;
            }
            table, td, th {
            border: 1px solid black;
            margin-left: auto;
                margin-right: auto;
            }
            .collapsible {
                background-color: #013766;
                color: white;
                cursor: pointer;
                padding: 18px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
                text-align: center;
            }
            .active, .collapsible:hover {
                background-color: #75bee9;
            }
            .schedule {
                padding: 0 18px;
                display: none;
                overflow: hidden;
                background-color: #f1f1f1;
            }
            .center{
                text-align: center;
                
            }
            .IT{
                background-color:  #013766;
            }
            .ITEquipment{
                color: white;
            }
            </style>
        
    </head>
    <body>
        <div class="center">
            <h1>Sheridan Campus Class Schedule</h1>
        </div>
        <div>
            
            <form method="post" class ="center">
                <button type="button" class="collapsible">Davis</button>
                <div class="schedule"> 
                    <input type ="submit" name="showMondayDAV" value="show Davis Monday">
                    <input type ="submit" name="showTuesdayDAV" value="show Davis Tuesday">
                    <input type ="submit" name="showWednesdayDAV" value="show Davis Wednesday">
                    <input type ="submit" name="showThursdayDAV" value="show Davis Thursday">
                    <input type ="submit" name="showFridayDAV" value="show Davis Friday">
                    <input type ="submit" name="showSaturdayDAV" value="show Davis Saturday">
                    <input type ="submit" name="showSundayDAV" value="show Davis Sunday">
                </div>
                <button type="button" class="collapsible">Hazel McCallion</button>
                <div class="schedule"> 
                    <input type ="submit" name="showMondayHMC" value="show HMC Monday">
                    <input type ="submit" name="showTuesdayHMC" value="show HMC Tuesday">
                    <input type ="submit" name="showWednesdayHMC" value="show HMC Wednesday">
                    <input type ="submit" name="showThursdayHMC" value="show HMC Thursday">
                    <input type ="submit" name="showFridayHMC" value="show HMC Friday">
                    <input type ="submit" name="showSaturdayHMC" value="show HMC Saturday">
                    <input type ="submit" name="showSundayHMC" value="show HMC Sunday">
                </div>
                <button type="button" class="collapsible">Trafalgar</button>
                <div class="schedule"> 
                    <input type ="submit" name="showMondayTRAF" value="show Trafalgar Monday">
                    <input type ="submit" name="showTuesdayTRAF" value="show Trafalgar Tuesday">
                    <input type ="submit" name="showWednesdayTRAF" value="show Trafalgar Wednesday">
                    <input type ="submit" name="showThursdayTRAF" value="show Trafalgar Thursday">
                    <input type ="submit" name="showFridayTRAF" value="show Trafalgar Friday">
                    <input type ="submit" name="showSaturdayTRAF" value="show Trafalgar Saturday">
                    <input type ="submit" name="showSundayTRAF" value="show Trafalgar Sunday">
                </div>
            </form>
            <div class="center">
            <?php
            //connect to database
                try{
                    $dbh = new PDO("mysql:host=localhost;dbname=vuongv_SHERIDAN_test","vuongv","Q3sLpnT@3E!&M");
                    }catch (Exception $ex){
                        die("<tr><td>($e->getMessage()}</td></tr></body></table>");
                    }
                //DAVIS CAMPUS
                //DAV_MONDAY PHP
                if(isset($_POST['showMondayDAV'])) { 
                        $command = "select Facility_ID, time_format(max(mtg_start),\"%h-%i-%s-%p\") as start_time, max(mtg_end) as end_time,Room_Description, IT from `DAV_MONDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Monday</h1>";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //DAV_TUESDAY PHP
                if(isset($_POST['showTuesdayDAV'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `DAV_TUESDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Tuesday</h1>";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //DAV_WEDNESDAY PHP
                if(isset($_POST['showWednesdayDAV'])) {  
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description  , IT from `DAV_WEDNESDAY`
                                    group by Facility_ID order by end_time ASC";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Wednesday</h1>";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //DAV_THURSDAY PHP
                if(isset($_POST['showThursdayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `DAV_THURSDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Thursday</h1>";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //DAV_FRIDAY PHP
                if(isset($_POST['showFridayDAV'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `DAV_FRIDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Friday</h1>";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //DAV_SATURDAY PHP
                if(isset($_POST['showSaturdayDAV'])) { 
                    $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `DAV_SATURDAY`
                                group by Facility_ID order by end_time ASC;";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                    echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                    }   
                //DAV_SUNDAY PHP
                if(isset($_POST['showSundayDAV'])) { 
                    $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `DAV_Sunday`
                                group by Facility_ID order by end_time ASC;";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                    echo "<h1>Davis Campus Sunday</h1>";
                    echo "<table id = \"myTable\">";
                    echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                    $num = 1;
                    $ITnum = 0;
                    while($row = $stmt->fetch()){
                        if ($row["IT"] == "Y"){
                            echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                            $ITnum ++;
                        }else{
                            echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                            }
                            $num++;
                        }   echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                        echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                        echo "</table>";
                    }
                //TRAFALGAR CAMPUS
                //TRAF_MONDAY PHP
                if(isset($_POST['showMondayTRAF'])) { 
                    $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `TRAF_MONDAY`
                                group by Facility_ID order by end_time ASC;";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                    echo "<h1>Trafalgar Campus Monday</h1>";
                    echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                }
                                $num++;
                            }   echo "<br>";
                            echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                            echo "</table>";
                }
                //TRAF_TUESDAY PHP
                if(isset($_POST['showTuesdayTRAF'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description , IT from `TRAF_TUESDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Trafalgar Campus Tuesday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //TRAF_WEDNESDAY PHP
                if(isset($_POST['showWednesdayTRAF'])) {  
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `TRAF_WEDNESDAY`
                                    group by Facility_ID order by end_time ASC";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Trafalgar Campus Wednesday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //TRAF_THURSDAY PHP
                if(isset($_POST['showThursdayTRAF'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `TRAF_THURSDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Trafalgar Campus Thursday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //TRAF_FRIDAY PHP
                if(isset($_POST['showFridayTRAF'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `TRAF_FRIDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Trafalgar Campus Friday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //TRAF_SATURDAY PHP
                if(isset($_POST['showSaturdayTRAF'])) { 
                    $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `TRAF_SATURDAY`
                                group by Facility_ID order by end_time ASC;";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                    echo "<h1>Trafalgar Campus Saturday</h1>";
                    echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                    }   
                //TRAF_SUNDAY PHP
                if(isset($_POST['showSundayTRAF'])) { 
                    $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `DAV_Sunday`
                                group by Facility_ID order by end_time ASC;";
                    $stmt = $dbh->prepare($command);
                    $stmt->execute();
                    echo "<h1>Trafalgar Campus Sunday</h1>";
                    echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                    }
                    //Hazel McCallion CAMPUS
                    //HMC_MONDAY PHP
                    if(isset($_POST['showMondayHMC'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `HMC_MONDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>HMC Campus Monday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //HMC_TUESDAY PHP
                if(isset($_POST['showTuesdayHMC'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `HMC_TUESDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>HMC Campus Tuesday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //HMC_WEDNESDAY PHP
                if(isset($_POST['showWednesdayHMC'])) {  
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `HMC_WEDNESDAY`
                                    group by Facility_ID order by end_time ASC";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>HMC Campus Wednesday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //HMC_THURSDAY PHP
                if(isset($_POST['showThursdayHMC'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `HMC_THURSDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>HMC Campus Thursday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }
                //HMC_FRIDAY PHP
                if(isset($_POST['showFridayHMC'])) { 
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT from `HMC_FRIDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>HMC Campus Friday</h1>";
                        echo "<table id = \"myTable\">";
                            echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th></tr>";
                            $num = 1;
                            $ITnum = 0;
                            while($row = $stmt->fetch()){
                                if ($row["IT"] == "Y"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td></tr>";
                                    $ITnum ++;
                                }else{
                                    echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                    }
                                    $num++;
                                }   echo "<br>";
                                echo "<p>Total Classroom Check:{$ITnum}</p>";
                                echo "<p><button onclick=\"sortTable(0)\">sort by Room</button><button onclick=\"sortTable(1)\">sort by Start Time</button><button onclick=\"sortTable(2)\">sort by End Time</button><button onclick=\"sortTable(3)\">sort by Room Description</button></p>";
                                echo "</table>";
                }      
              ?>
           </div>
        </div>
        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
                });
            }

            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("myTable");
                switching = true;
           
                dir = "asc"; 
            
            
                while (switching) {
                   
                    switching = false;
                    rows = table.rows;
              
                    for (i = 1; i < (rows.length - 1); i++) {
                
                    shouldSwitch = false;
              
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

                        shouldSwitch= true;
                        break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {

                        shouldSwitch = true;
                        break;
                        }
                    }
                    }
                    if (shouldSwitch) {

                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;

                    switchcount ++;      
                    } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                    }
                }
                }
        </script>
    </body>
</html>