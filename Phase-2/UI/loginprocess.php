<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    echo "hello";
    $user = "tejvi";
    $pswd = "tejvi";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    echo $_POST['username'];
    $query = pg_query($db_connection, "SELECT * FROM teacher where tid='".$_POST['username']."';");
    echo "youre in";
    $sz =strlen(pg_fetch_row($query)[0]);
    echo $sz;
    if ($sz != 0){
      echo "letting you into teacher";
      header ("Location: teacher0.php?tid=".$_POST['username']);
    }
    else{
      $query = pg_query($db_connection, "SELECT * FROM student where ssn='".$_POST['username']."';");
      $sz =strlen(pg_fetch_row($query)[0]);
      echo $sz;
      if ($sz != 0){
        echo "letting you into teacher";
        header ("Location: viewPanels.php?ssn=".$_POST['username']);
      }
      else{
        header("Location: student1.php?ssn=".$_POST['username']);
      }
    }
     ?>
     hello

  </body>
</html>
