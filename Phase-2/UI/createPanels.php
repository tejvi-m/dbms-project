<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
    .reference{
      position: absolute;
      right:60px;
      top:50px;

    }
    </style>
  </head>
  <body>

    <div class = "cPanels">
    Form Panels:

    <form action ="<?php echo "./teacher.php?tid=".$_GET['tid']."&panelid=".$_GET['panelid']?>" method = "post">
      Select panel size (number of copanelists):
      <input type ="radio" name = "size" id="size2" value="2"/>2

      <input type ="radio" name = "size" id="size3" value="3"/>3</br>

      <div id="fortext"></div>
      <input type="submit" name="submit" id="save" value="save" />
      <script>
      var el1 = document.getElementById("fortext");
      var newEL = document.createElement("p");

      function addText(x){
        newEL.innerHTML = "";
        for(var i = 1; i <= x; i++){
          newEL.innerHTML += "<div class = student>";
          newEL.innerHTML += "Copanelist " + i +"</br>";
          newEL.innerHTML += "</br>ID: <input type=\"text\" name = \"tid" + i + "\"/></br>";
          newEL.innerHTML += "</div>";
        }

        el1.appendChild(newEL);

      }

      function make2(e){
        console.log("team size is 2");
        addText(2);
      };

      function make3(e){
        console.log("team size is 3");
        addText(3);
      };

      var element1 = document.getElementById("size2");
      element1.addEventListener("click", make2);
      var element2 = document.getElementById("size3");
      element2.addEventListener("click", make3);

      </script>

  </div>

  <div class = "reference">
    <?php
    $user = "tejvi";
    $pswd = "tejvi";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);

    $result = pg_query($db_connection, "SELECT * FROM teacher;");

    while ($row = pg_fetch_row($result)) {
      echo "ID:$row[1], Name:$row[0]<br>";
      }

     ?>
  </div>
  </body>
</html>
