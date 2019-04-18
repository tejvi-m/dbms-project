<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
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
  select {

  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;

  padding: 12px 16px;
  z-index: 1;
}

    </style>
  </head>
  <body>
    <form action ="process.php" method = "post">
      <div class = cPanels>
      Select team size:
      <input type ="radio" name = "size" id="size2" value="2"/>2
      <input type ="radio" name = "size" id="size3" value="3"/>3</br>

      Project type:
      <input type ="radio" name = "ptype" id="MajorP" value="Major"/>Major
      <input type ="radio" name = "ptype" id="MinorP" value="Minor"/>Minor</br>
      Project Title: <input type = "text" name = "Ptitle"/></br></br>
      Domain: <input type = "text" name = "Domain"/></br></br>
      Guide: <select name="guide">

        <?php

        $user = "tejvi";
        $pswd = "tejvi";
        $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
        $result = pg_query($db_connection, "SELECT * FROM teacher;");
        echo pg_last_error($dbconn);
        echo $result;
        while ($row = pg_fetch_row($result)) {
          echo "<option value=\"$row[1]\">$row[0]</option>";
          }
          ?>
      <br>
      <br>
      </select>
      <div id="fortext"></div>
    </br></br>
      <input type="submit" id = "save" name="submit" value="save" />
      <script>
      var el1 = document.getElementById("fortext");
      var newEL = document.createElement("p");

      var el2 = document.getElementById("MinorP");
      var el3 = document.getElementById("MajorP");

      function addText(x){
        newEL.innerHTML = "";
        for(var i = 1; i <= x; i++){
          newEL.innerHTML += "<div class = student>";
          newEL.innerHTML += "Teammate " + i + " details</br>";
          newEL.innerHTML += "Name: <input type =\"text\" name=\"name" + i + "\"/>";
          newEL.innerHTML += "</br>SRN: <input type=\"text\" name = \"SRN" + i + "\"/></br>";
          newEL.innerHTML += "CGPA: <input type=\"text\" name = \"CGPA" + i + "\"/></br>";
          newEL.innerHTML += "<p id=\"internship"+i+"\"></p></div>";
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

      function removeInternship(e){
        var size = 2;
        var ell = document.getElementById("internship3");
        if (ell !== null){
          size = 3;
        }

        for (var i = 1; i <= size; i++){
          var ell = document.getElementById("internship"+i);
          ell.innerHTML ="";
        }
      }
      function addInternship(e){
        var size = 2;
        var ell = document.getElementById("internship3");
        if (ell !== null){
          size = 3;
        }

        for (var i = 1; i <= size; i++){
          var ell = document.getElementById("internship"+i);
          ell.innerHTML ="Internship Company: <input type=\"text\" name = \"internship" + i +"\" />";
        }
      }

      var element1 = document.getElementById("size2");
      element1.addEventListener("click", make2);
      var element2 = document.getElementById("size3");
      element2.addEventListener("click", make3);

      el2.addEventListener("click", addInternship);
      el3.addEventListener("click", removeInternship);
      </script>

</div>
  </body>
</html>
