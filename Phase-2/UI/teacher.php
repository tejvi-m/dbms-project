<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style type = "text/css">

  body{
    background-color: rgb(235, 235, 235);
    z-index: -1;
}
  .topbar{
    position: absolute;
    z-index: 1;
    margin-top: -1.5%;
    margin-left: -1%;
    margin-bottom: 3%;
    width: 100%;
    height: 12%;
    background-color: white;
  }
  .DescBar{
    position: absolute;
    font-size: 22px;
    color: rgb(0, 153, 255);
    background-color: white;
    width: 97.5%;
    text-align: center;
    padding: 1.3%;
    margin-left: -1%;
    margin-top: 6%;
    border: 1px lightgrey solid;
    font-weight: 600;
  }
  .Teams{
    position: absolute;
    margin-top: 14%;
    margin-left:10%;
    text-align:center;
  }
  .Panels{
    position: absolute;
    margin-top: 14%;
    margin-left:70%;
    text-align:center;
  }

  p {
    font-size: 22px;
    color: darkblue;
    font-style: bold;
  }
  .team,.Panels{
    font-size: 18px;
    color: rgb(0, 153, 255);
  }
  </style>
</head>
<body>

<div class="topbar">
     <img src="logo.png" alt="logo" height="80px"/>
  </div>
  <div class="DescBar">
     TEACHER
  </div>
<div class="container">
  <div class = "Teams">
    <?php
    $user = "teacher";
    $pswd = "teacher";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $query = pg_query($db_connection, "SELECT * FROM works_on where teacherid='".$_GET['tid']."';");
    echo "<p> You work on the following projects</p><hr/>";
    while ($row = pg_fetch_row($query)) {
      $teamid = $row[0];
      $panelid = pg_fetch_row(pg_query("SELECT panelid from team where id='".$teamid."';"))[0];
      // echo $panelid;
      $size = pg_fetch_row(pg_query("SELECT size from panel where id='".$panelid."'"))[0];
      echo "<div class = \"team\">TeamID:$row[0]<br>Project Title:$row[2]<br>";
      //echo "$size";
      if($size == 1){
        echo "<a href=\".\createPanels.php?tid=".$_GET['tid']."&panelid=".$panelid."\">form panel</a>";

      }
      echo "<hr/>";
      echo"</div>";
      }
     ?>

  </div>

  <div class = "Panels">
    <?php
    //display all panels a teacher is a part of.
     $query = pg_query("SELECT panelid from part_of where teacherid='".$_GET['tid']."';");
    // echo "SELECT panelid from part_of where teacherid='';";
    echo "<p>You are part of the following panels </p><hr/>";
     while ($row = pg_fetch_row($query)) {
      echo "Panel ID: $row[0]<br>";
      $result = pg_fetch_row(pg_query("SELECT id from team where panelid = '".$row[0]."';"))[0];
      $result = pg_fetch_row(pg_query("SELECT ptitle from works_on where teamid = '".$result."';"))[0];
      echo "Project Title: $result";
      echo "<br><hr/>";
       }
     ?>

  </div>
      </div>
</body>
</html>
