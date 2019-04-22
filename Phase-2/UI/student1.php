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

  form {
    position: absolute;
    margin-top: 14%;
    margin-left: 5%;
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
*/

  p {
  font-size: 20px;
  color: darkblue;
  
}

input[type=text] {
  width: 100%;
  padding: 20px 70px;
  margin-top: 6%;
  box-sizing: border-box;
  border: 2px solid rgb(0, 153, 255);
  border-radius: 4px;
}


select{
  border: 2px solid rgb(0, 153, 255);
  padding:13px 70px;
  margin-bottom: 4px;
}

input[type=submit] {
  
  padding: 20px 80px;
  margin-top: 3%;
  
  box-sizing: border-box;
  border: none;
  background-color: darkblue;

  color: white;
} 
    </style>
  </head>




  <body>
  <div class="topbar">
     <img src="/logo.png" alt="logo" height="80px"/>
  </div> 
  <div class="DescBar">
     TEAM FORMATION 
  </div>

    <form action ="process.php?ssn=<?php echo $_GET['ssn']?>" method = "post">
    <p>Select Team Size: </p>
    <label class="container">2
      <input type="radio" checked="checked" name="size" value="size2">  
       <span class="checkmark"></span>
    </label>
    <label class="container">3
      <input type="radio" name="size" value="size3" >
      <span class="checkmark"></span>
    </label>
<br/>
     <p> Project type: </p>
     <label class="container">Major
      <input type="radio" checked="checked" name = "ptype" id="MajorP" value="Major">  
       <span class="checkmark"></span>
    </label>
    <label class="container">Minor
      <input type="radio" name = "ptype" id="MinorP" value="Minor" >
      <span class="checkmark"></span>
    </label>
<br/>

       <input type = "text" name = "Ptitle" placeholder="Project Title"/><br/><br/>
      <input type = "text" name = "Domain" placeholder="Domain"/><br/><br/>
      <p> Guide: </p>
       <select name="guide">
       

        <?php
        $user = "postgres";
        $pswd = "Fries123";
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
      <br/><br/><br/>
      <div id="fortext"></div>
    
      <input type="submit" id = "Save" name="submit" value="Save" />
      <script>
      var el1 = document.getElementById("fortext");
      var newEL = document.createElement("p");
      var el2 = document.getElementById("MinorP");
      var el3 = document.getElementById("MajorP");
      function addText(x){
        newEL.innerHTML = "";
        Name="Name";
        for(var i = 1; i <= x; i++){
          newEL.innerHTML += "<div class = student>";
          newEL.innerHTML += "Teammate " + i + " details</br></br>";
          newEL.innerHTML += "Name: <input type =\"text\" name=\"name" + i + "\" />";
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