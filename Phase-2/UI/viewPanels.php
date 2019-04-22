<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
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

    .container{
     position:absolute;
    top:200px;
    left: 50px;
    }

    p {
    font-size: 22px;
    color: darkblue;
    font-style: bold;

    }

    .inphp{
    color : rgb(0, 153, 255);
    font-size:18px;
    margin-left:60px;
   }

    </style>

  </head>
  <body>
    <div class="topbar">
      <img src="./logo.png" alt="logo" height="80px"/>
    </div>
    <div class="DescBar">
       Team Details
    </div>
    <div class="container">
    <?php
    $user = "tejvi";
    $pswd = "tejvi";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $ssn = $_GET['ssn'];

    $teamid = pg_fetch_row(pg_query($db_connection, "Select teamid from student where ssn = '".$ssn."';"))[0];
    $teammates = pg_query($db_connection, "select ssn,fname,lname from student where teamid = '".$teamid."';");
    echo "<p>Your team: </p>";
    while ($row = pg_fetch_row($teammates)) {
      echo '<div class="inphp">'."$row[1] $row[2] ($row[0])<br/></div>";
      }
    $panelid = pg_fetch_row(pg_query($db_connection, "SELECT panelid FROM team where id='".$teamid."';"))[0];
    $guide = pg_fetch_row(pg_query($db_connection, "SELECT t.tname from works_on w, teacher t where w.teamid = '".$teamid."' and w.teacherid = t.tid;"))[0];
    echo "<br/><p>Your panel ID is:</p>".'<div class="inphp">'.$panelid."</div>";
    echo "<p>Your team ID is:</p>".'<div class="inphp">'.$teamid."</div>";
    echo "<p>Your team guide is:</p>".'<div class="inphp">'.$guide."</div>";
      ?>
    </div>
  </body>
</html>
