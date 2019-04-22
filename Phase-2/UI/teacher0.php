<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style type = "text/css">
  /*
    div.s{
      position:relative;
      top:50px;
      height:50px;
      color:;
      width:100%;
      textalign:centre;
      font-size:30px;
      padding:17px;
      padding-left:70px;
    }
    div.cPanels{
      position:relative;
      top:50px;
      height:50px;
      color:;
      width:100%;
      textalign:centre;
      font-size:15px;
      padding:37px;
      padding-left:50;
    }
    .student{
        position:relative;
        top:10px;
        height:30px;
        color:;
        width:100%;
        textalign:centre;
        font-size:15px;
        padding:10px;
        line-height: 1.6;
    }
    input[type=text] {
    padding: 0;
    height: 30px;
    position: relative;
    left: 0;
    outline: none;
    border: 1px solid #cdcdcd;
    border-color: rgba(0,0,0,.15);
    background-color: white;
    font-size: 16px;
}
.advancedSearchTextbox {
    width: 526px;
    margin-right: -4px;
}
    #save{
    background-color: #067c74;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
  }
  .Panels{
    position: absolute;
    right: 50px;
    top:100px;
  }

*/

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
    margin-left:40%;
    text-align:center;
  }

  .Panels{
    position: absolute;
    margin-top: 25%;
    margin-left:40%;
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
  <div class = "link to coordinator">
    <?php
    $user = "tejvi";
    $pswd = "tejvi";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);


    $query = pg_fetch_row(pg_query($db_connection, " SELECT COUNT(*) FROM part_of where teacherid = '".$_GET['tid']."' and mem_type = 'Coordinator'; "))[0];

    if($query > 0){
      echo "link to  <a href= \"coordinator.php\">coordinator page</a>";
    }

    ?>
  </div>
  <div class = "Teams">
    <?php

    $query = pg_query($db_connection, "SELECT * FROM works_on where teacherid='".$_GET['tid']."';");

    while ($row = pg_fetch_row($query)) {
      $teamid = $row[0];
      $panelid = pg_fetch_row(pg_query("SELECT panelid from team where id='".$teamid."';"))[0];
      // echo $panelid;
      $size = pg_fetch_row(pg_query("SELECT size from panel where id='".$panelid."'"))[0];

      echo "<div class = \"team\">TeamID:$row[0]<br>Project Title:$row[2]<br><br>";
      echo "$size";
      if($size == 1){
        echo "<a href=\".\createPanels.php?tid=".$_GET['tid']."&panelid=".$panelid."\">form panel</a>";
      }
      echo"</div>";
      }
     ?>
  </br>
  </div>
  </br>
  <div class = "Panels">
    <?php
    //display all panels a teacher is a part of.
     $query = pg_query("SELECT panelid from part_of where teacherid='".$_GET['tid']."';");
    // echo "SELECT panelid from part_of where teacherid='';";
     while ($row = pg_fetch_row($query)) {
      echo "Panel ID: $row[0]<br>";
      $result = pg_fetch_row(pg_query("SELECT id from team where panelid = '".$row[0]."';"))[0];
      $result = pg_fetch_row(pg_query("SELECT ptitle from works_on where teamid = '".$result."';"))[0];
      echo "Project Title: $result";
      echo "<br><br>";
       }

     ?>
  </br>
  </div>
</body>
</html>
