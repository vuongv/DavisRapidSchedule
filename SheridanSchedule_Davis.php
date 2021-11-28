<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        @media screen and (max-width: 350px){
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
                width: 200%;
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
            .center2{
                width: 100%;
                text-align: center;
            }
            div{
                display: flex;
            }
        }
         @media screen and (min-width: 351px){
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
            .center2{
                width: 100%;
                text-align: center;
            }
        }
            </style>
        
    </head>
    <body>
        <div class="center2">
            <h1>Sheridan Campus Class Schedule</h1>
        </div>
        <div class="center2">
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
               
            </form>
            <div class="center">
            <?php
            //connect to database
                try{
                    $dbh = new PDO("mysql:host=localhost;dbname=vuongv_SHERIDAN_DAVIS_EXC","vuongv","Q3sLpnT@3E!&M");
                    }catch (Exception $ex){
                        die("<tr><td>($e->getMessage()}</td></tr></body></table>");
                    }
                    
                //DAVIS CAMPUS
                //DAV_MONDAY PHP
                if(isset($_POST['showMondayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_MONDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Monday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckMonday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckMonday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_MONDAY` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_TUESDAY PHP
                if(isset($_POST['showTuesdayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_TUESDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Tuesday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckTuesday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckTuesday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_TUESDAY` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_WEDNESDAY PHP
                if(isset($_POST['showWednesdayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_WEDNESDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Wednesday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckWednesday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckWednesday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_WEDNESDAY` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_THURSDAY PHP
                if(isset($_POST['showThursdayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_THURSDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Thursday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckThursday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckThursday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_THURSDAY` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_FRIDAY PHP
                if(isset($_POST['showFridayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_FRIDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Friday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckFriday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckFriday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_FRIDAY` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_SATURDAY PHP
                if(isset($_POST['showSaturdayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_SATURDAY`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Saturday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckSaturday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckSaturday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_Saturday` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
                //DAV_SUNDAY PHP
                if(isset($_POST['showSundayDAV'])) {
                        $command = "select Facility_ID, max(mtg_start) as start_time, max(mtg_end) as end_time,Room_Description, IT, `CHECK` from `DAV_Sunday`
                                    group by Facility_ID order by end_time ASC;";
                        $stmt = $dbh->prepare($command);
                        $stmt->execute();
                        echo "<h1>Davis Campus Sunday</h1>";
                        echo "<form method=\"post\" class=\"center\" >";
                        echo "<table id = \"myTable\">";
                        echo "<tr><th>#</th><th>Room</th><th>Start Time</th><th>End Time</th><th>Room Description</th><th>IT Equipment</th><th>Finished</th></tr>";
                        $num = 1;
                        $ITnum = 0;
                        while($row = $stmt->fetch()){
                            if ($row["IT"] == "Y"){
                                if ($row["CHECK"] == "N"){
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" name=\"DAVIS[]\" value=\"{$row["Facility_ID"]}\"></td></tr>";
                                }else{
                                    echo "<tr class=\"IT\"><td>{$num}</td><td class=\"ITEquipment\">{$row["Facility_ID"]}</td><td class=\"ITEquipment\">{$row["start_time"]}</td><td class=\"ITEquipment\">{$row["end_time"]}</td><td class=\"ITEquipment\">{$row["Room_Description"]}</td><td class=\"center\">{$row["IT"]}</td><td class=\"center\"> <input type=\"checkbox\" checked></td></tr>";
                                }
                                $ITnum ++;
                            }else{
                                echo "<tr><td>{$num}</td><td>{$row["Facility_ID"]}</td><td>{$row["start_time"]}</td><td>{$row["end_time"]}</td><td>{$row["Room_Description"]}</td></tr>";
                                $num++;
                            }  
                        }
                        echo "<br>";
                        echo "<p>Total Classroom Check:{$ITnum}</p>";
                            echo "<p><button type= \"button\" onclick=\"sortTable(1)\">sort by Room</button><button type= \"button\"  onclick=\"sortTable(2)\">sort by Start Time</button><button type= \"button\"  onclick=\"sortTable(3)\">sort by End Time</button><button type= \"button\" onclick=\"sortTable(4)\">sort by Room Description</button></p>";
                            echo "</table>";
                            echo "<input type=\"submit\" name = \"DavisCheckSunday\" value=\"Submit\">";
                            echo "</form>";
                }
                if(isset($_POST['DavisCheckSunday'])){
                        $checkbox = $_POST['DAVIS'];
                        foreach ($checkbox as $chk1){
                            $command = "UPDATE `DAV_Sunday` SET `CHECK` = \"Y\" WHERE `Facility_ID` = \"$chk1\";";
                            $stmt = $dbh->prepare($command);
                            $stmt->execute();
                        }
                    }
              ?>
           </div>
           <div>
               <br>
               <br>
               <br>
               <br>
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