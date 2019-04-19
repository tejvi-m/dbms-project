<?php 




if(0){
$user = "postgres";
$pswd = "alike#1";

$db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);

$panel_size = $_POST['size'];
$teamid = $_POST['teamid'];

//$name1 = explode(" ", $_POST['name1']);
//$name2 = explode(" ", $_POST['name2']);

$panelID = "P".strval(intval(substr(pg_fetch_row(pg_query($db_connection, "SELECT MAX(ID) FROM PANEL;"))[0], 1)) + 1);


$query = "INSERT INTO panel VALUES('".$panelID."', '".$panel_size."');";

$result = pg_query($db_connection, $query);

$query1 = "INSERT INTO  TEACHER VALUES('".$_POST['name1']."', '".$_POST['tid1']."');";

$result = pg_query($db_connection, $query1);

$query2 = "INSERT INTO  TEACHER VALUES('".$_POST['name2']."', '".$_POST['tid2']."');";

$result = pg_query($db_connection, $query2);

if ($panel_size == 3) {
    $query3 = "INSERT INTO  TEACHER VALUES('".$_POST['name3']."', '".$_POST['tid3']."');";

    $result = pg_query($db_connection, $query3);
}

$result = pg_query($db_connection, "INSERT INTO  PART_OF VALUES('".$panelID."', '".$_POST['tid1']."' , NULL);");

$result = pg_query($db_connection, "INSERT INTO  PART_OF VALUES('".$panelID."', '".$_POST['tid2']."' , NULL);");

if ($panel_size == 3) {
    $result = pg_query($db_connection, "INSERT INTO  PART_OF VALUES('".$panelID."', '".$_POST['tid3']."' , NULL);");

}

echo "recorded";

}

else{

    $user = "postgres";
    $pswd = "alike#1";
    
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    
    $ssn = "T0148";// use $_POST['ssn'] from the login page 

    $query4 = "SELECT panelid from part_of where teacherid = '".$ssn."';";
    $result = pg_query($db_connection, $query4);
    echo "your panels are";
    while ($row = pg_fetch_assoc($result)) {
        echo $row['panelid']."<br />";
      }
    $query5 = "SELECT distinct tname from teacher,part_of where panelid in (select panelid from part_of where teacherid = '".$ssn."') and tid = teacherid;";
    $result = pg_query($db_connection, $query5); 
    echo "your co-panelists are"; 
    while ($row = pg_fetch_assoc($result)) {
        echo $row['tname']."<br />";
      }
      $query6 = " SELECT teamid from works_on where teacherid = '".$ssn."';";
      $result = pg_query($db_connection, $query6); 
      echo "your project teams <br />"; 
      if(!$result){
          echo "currently you are not working on any projects with a team of students. ";
      }
      else{
      while ($row = pg_fetch_assoc($result)) {
          echo $row['teamid']."<br />";
        }
    }




    echo "viewed";
    


}

?>