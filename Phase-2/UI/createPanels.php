<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
        <style type="text/css">

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

      .cPanels{
        position:absolute;
        top:200px;
        left: 50px;
      }

      p,caption {
        font-size: 22px;
        color: darkblue;
        font-style: bold;
      }


        .reference{
          position: absolute;
          right:90px;
          top:200px;

        }

        .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: darkgrey;
      border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
     	top: 9px;
    	left: 9px;
    	width: 8px;
    	height: 8px;
    	border-radius: 50%;
    	background: white;
    }

    input[type=text] {
      width: 100%;
      padding: 20px 70px;
      margin-top: 6%;
      box-sizing: border-box;
      border: 2px solid rgb(0, 153, 255);
      border-radius: 4px;
    }

    input[type=submit] {

      padding: 20px 80px;
      margin-top: 3%;

      box-sizing: border-box;
      border: none;
      background-color: darkblue;

      color: white;
    }

    table,th,td {
      border: 2px darkblue solid;
      border-collapse: collapse;
      color : rgb(0, 153, 255);

    }

    th, td {
      padding: 10px;
    }

    }
    </style>
  </head>
  <body>
    <div class="topbar">
     <img src="logo.png" alt="logo" height="80px"/>
  </div>
  <div class="DescBar">
     PANEL FORMATION
  </div>


    <div class = "cPanels">

    <form action ="<?php echo "./teacher.php?tid=".$_GET['tid']."&panelid=".$_GET['panelid']?>" method = "post">
         <p>Select Panel Size (Number Of Copanelists):</p>
         <label class="container">2
         <input type="radio" name="size" id="size2" value="2">
          <span class="checkmark"></span>
       </label>
       <label class="container">3
         <input type="radio" name="size" id="size3" value="3">
         <span class="checkmark"></span>
       </label>

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

    $user = "teacher";
    $pswd = "teacher";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
    $result = pg_query($db_connection, "SELECT * FROM teacher;");
    echo "<table border='1'>
    <caption>List Of Teachers</caption>
    <tr>
    <th>Id</th>
    <th>Name</th>
    </tr>";
    while ($row = pg_fetch_row($result)) {
      echo "<tr>";
      echo "<td>" . $row[1] . "</td>";
      echo "<td>" . $row[0] . "</td>";
      echo "</tr>";
      }
      echo "</table>";

     ?>
  </div>
  </body>
</html>
