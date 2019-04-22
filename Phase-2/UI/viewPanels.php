<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $user = "student";
    $pswd = "student";
    
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $ssn = $_GET['ssn'];

    echo "Team Details:<br>";
    $teamid = pg_fetch_row(pg_query($db_connection, "Select teamid from student where ssn = '".$ssn."';"))[0];
    $teammates = pg_query($db_connection, "select ssn,fname,lname from student where teamid = '".$teamid."';");

    echo "Your team: ";
    while ($row = pg_fetch_row($teammates)) {
      echo " $row[1] $row[2] ($row[0])<br>";
      }

    $panelid = pg_fetch_row(pg_query($db_connection, "SELECT panelid FROM team where id='".$teamid."';"))[0];
    $guide = pg_fetch_row(pg_query($db_connection, "SELECT t.tname from works_on w, teacher t where w.teamid = '".$teamid."' and w.teacherid = t.tid;"))[0];


    echo "<br><br>Your panel ID is: ".$panelid."<br>";
    echo "Your team ID is: ".$teamid."<br>";
    echo "Your team guide is: ".$guide;

      ?>
  </body>
</html>
