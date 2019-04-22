<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  <style type ="text/css">
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
  </style>
  </head>
  <body>
  <?php
    $user = "postgres";
    $pswd = "Fries123";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $name1 = explode(" ", $_POST['name1']);
    $name2 = explode(" ", $_POST['name2']);
    //we could have used serials instead, but this is one way to ensure that the new team id and panel id are unique
    $teamID = strval(intval(pg_fetch_row(pg_query($db_connection, "SELECT MAX(ID) FROM team;"))[0]) + 1);
    $panelID = "P".strval(intval(substr(pg_fetch_row(pg_query($db_connection, "SELECT MAX(ID) FROM PANEL;"))[0], 1)) + 1);
    //the post array
    // foreach ($_POST as $key => $value) {
    // echo $key.":".$value."<br>";
    // }
    //////////////////////////////////////////////////////////////
    ////IMPORTANT////////////////////////////////////////////////
    ////need to add exception handling when srns are repeated///
    ///////////////////////////////////////////////////////////
    $ptitle = $_POST['Ptitle'];
    $dom = $_POST['Domain'];
    $size = $_POST['size'];
    //right now the only person in the panel is the guide
    $result = pg_query($db_connection, "INSERT INTO panel VALUES('".$panelID."', 1);");
    //adding to project and team tables with the unique id's generated
    $result = pg_query($db_connection, "INSERT INTO project VALUES('".$ptitle."', '".$dom."', '".$_POST['ptype']."');");
    $result = pg_query($db_connection, "INSERT INTO team VALUES('".$teamID."', ".$_POST['size'].", '".$panelID."');");
     //inserting student details
     $result = pg_query($db_connection, "INSERT INTO Student VALUES('".$name1[0]."', '".$name1[1]."', '".$name1[2]."','".$_POST['SRN1']."',  ".$_POST['CGPA1'].", '".$teamID."');");
     $result = pg_query($db_connection, "INSERT INTO Student VALUES('".$name2[0]."', '".$name2[1]."', '".$name2[2]."','".$_POST['SRN2']."',  ".$_POST['CGPA2'].", '".$teamID."');");
     if($_POST['size'] == 3){
       $name3 = explode(" ", $_POST['name3']);
      // echo "INSERT INTO Student VALUES('".$name3[0]."', '".$name3[1]."', '".$name3[2]."', '".$_POST['SRN3']."', ".$_POST['CGPA3'].", '".$teamID."');";
       $result = pg_query($db_connection, "INSERT INTO Student VALUES( '".$name3[0]."', '".$name3[1]."', '".$name3[2]."', '".$_POST['SRN3']."', ".$_POST['CGPA3'].", '".$teamID."');");
     }
    //insert internship details if necessary
    if ($_POST['ptype'] == "Minor"){
       //insert for each student
      // echo "INSERT INTO internship VALUES('".$_POST['SRN1']."', '".$_POST['internship1']."');";       $result = pg_query($db_connection, "INSERT INTO internship VALUES('".$_POST['SRN1']."', '".$_POST['internship1']."');");
       $result = pg_query($db_connection, "INSERT INTO internship VALUES('".$_POST['SRN2']."', '".$_POST['internship2']."');");
       if($size > 2){
         $result = pg_query($db_connection, "INSERT INTO internship VALUES('".$_POST['SRN3']."', '".$_POST['internship3']."');");
      //   echo "INSERT INTO internship VALUES('".$_POST['SRN3']."', '".$_POST['internship3']."');";
       }
     }
     //add to works on table - team, teacher, Ptitle
     //guide returns teacher id
     $result = pg_query($db_connection, "INSERT INTO works_on VALUES('".$teamID."', '".$_POST['guide']."', '".$ptitle."');");
     //autocommit doesnt seem to work, so committing the changes to the db automatically.
     $result = pg_query($db_connection, "COMMIT;");
     ?>

     
  </body>
</html>