<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Firmstep Test</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<script src="javascript.js"></script>
<body onload="buttonToggle(0);">
<h1>Queue App</h1>
<div id="form" class="col left">
    <div class="col-head">
        <h2>New Customer</h2>
    </div>
    <div class="col-content">
        <form action="new-customer.php" method="post" onsubmit="return(validateForm());">
        <span class="label">Services</span>
        <ul class="services">
            <li><input type="radio" name="type-service" value="0" id="housing" checked /><label for="housing">Housing</label></li>
            <li><input type="radio" name="type-service" value="1" id="benefits" /><label for="benefits">Benefits</label></li>
            <li><input type="radio" name="type-service" value="2" id="council-tax" /><label for="council-tax">Council Tax</label></li>
            <li><input type="radio" name="type-service" value="3" id="fly-tipping" /><label for="fly-tipping">Fly-tipping</label></li>
            <li><input type="radio" name="type-service" value="4" id="missed-bin" /><label for="missed-bin">Missed Bin</label></li>
        </ul>
        <div class="links">
            <div id="but0" class="type"><a href="#" onclick="buttonToggle(0);">Citizen</a></div>
            <div id="but1" class="type"><a href="#" onclick="buttonToggle(1);">Organisation</a></div>
            <div id="but2" class="type"><a href="#" onclick="buttonToggle(2);">Anonymous</a></div>
        </div>
        
        <div id="citizen">
            <span class="label">Title</span>
            <select name="title">
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
            </select>
            <span class="label">First Name</span>
            <input type="text" id="fname" name="fname" placeholder="First Name" />
            <span class="label">Last Name</span>
            <input type="text" id="lname" name="lname" placeholder="Last Name" />
        </div>
        
        <div id="organisation">
            <span class="label">Organisation Name</span>
            <input type="text" id="oname" name="oname" placeholder="Organisation Name" />
        </div>
        <input type="hidden" name="ctype" id="ctype" value="0" />
        <input type="submit" name="submit" value="Submit" />
    
        </form>
    </div>
</div>
<div id="queue" class="col right">
    <div class="col-head"> 
        <h2>Queue</h2>
    </div>
    <div class="col-content">     
<?php
include '_dbconn.inc';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT q_id, q_type, q_name, q_service, q_queued FROM queue";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
    <table class="queue">
        <tr class="row">
            <th>#</th>
            <th>Type</th>
            <th>Name</th>
            <th>Service</th>
            <th>Queued at</th>
        </tr>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
        switch ($row["q_type"]) {
            case 0 :
                $type = 'Citizen';
                break;
            case 1:
                $type = 'Organisation';
                break;
            case 2:
                $type = 'Anonymous';
                break;
        }
        switch ($row["q_service"]) {
            case 0 :
                $service = 'Housing';
                break;
            case 1:
                $service = 'Benefits';
                break;
            case 2:
                $service = 'Council Tax';
                break;
            case 3:
                $service = 'Fly-tipping';
                break;
            case $service:
                $service = 'Missed Bin';
                break;
        }
        $time = strtotime($row["q_queued"]);
        
        echo '        <tr class="row">' . PHP_EOL;
        echo '            <td>' . $row["q_id"]. '</td>' . PHP_EOL;
        echo '            <td>' . $type . ' </td>' . PHP_EOL;
        echo '            <td>' . $row["q_name"]. '</td>' . PHP_EOL;
        echo '            <td>' . $service . ' </td>' . PHP_EOL;
        echo '            <td>' . date("H:i", $time) . '</td>' . PHP_EOL;
        echo '        </tr>' . PHP_EOL;
    }
    echo '    </table>';
} else {
    echo '<p>Empty Queue</p>';
}
$conn->close();
?>
    </div>
</div>
</body>
</html>