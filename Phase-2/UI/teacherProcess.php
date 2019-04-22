<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $user = "teacher";
    $pswd = "teacher";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $panel_size = intval($_POST['size']) + 1;
    $result = pg_query($db_connection, "LOCK TABLE panel;");
    $query = "UPDATE panel SET Size=".$panel_size." where ID='".$_GET['panelid']."';";
    print($query);
    $result = pg_query($db_connection, $query);
    $result = pg_query($db_connection, "LOCK TABLE part_of;");
    $query1 = "INSERT INTO part_of VALUES('".$_GET['panelid']."', '".$_POST['tid1']."', NULL);";
    $result = pg_query($db_connection, $query1);
    echo $query1;
    $query2 = "INSERT INTO  part_of VALUES('".$_GET['panelid']."', '".$_POST['tid2']."', NULL);";
    $result = pg_query($db_connection, $query2);
    echo $query2;
    if ($panel_size == 4) {
        $query3 = "INSERT INTO  part_of VALUES('".$GET['panelid']."', '".$_POST['tid3']."', NULL);";
        $result = pg_query($db_connection, $query3);
        echo $query3;
    }
    $query = pg_query($db_connection, "COMMIT;");

    echo "added";
    header("Location: ./teacher.php?tid=".$_GET['tid']);

    ?>

  </body>
</html>
