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

  form {
    position:absolute;
    top:200px;
    left: 50px;
  }

  p {
    font-size: 22px;
    color: darkblue;
    font-style: bold;

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
  margin-left:60px;

}

th, td {
  padding: 10px;
}
.inphp{
    color : rgb(0, 153, 255);
    font-size:18px;
    margin-left:60px;
}

</style>
  </head>
  <body id = "bod">
  <div class="topbar">
     <img src="logo.png" alt="logo" height="80px"/>
  </div>
  <div class="DescBar">
     CO-ORDINATOR
  </div>


    <form action="coordinator.php" method = "POST">
      <p>Which student do you want to check upon:</p>
       <input type="text" name = "username" placeholder="Enter SSN"/>
       <br/><br/>
     <p> See Queries?</p>

      <label class="container">YES
      <input type="radio"  name="cq" value="y"/>
       <span class="checkmark"></span>
    </label>
    <label class="container">NO
      <input type="radio" name="cq" value="n"/>
      <span class="checkmark"></span>
    </label>
    <br/>
      <input type="submit" name = "submit" value ="GO?"/>


    </form>

    <?php
    ///////////////////////////////////////////////// processing part ////////////////////////////////////////////////

 if(isset($_POST['submit'])){
     echo '<p class="con">';
    echo "<script> var b = document.getElementById(\"bod\") ;b.innerHTML=\"\";</script>";
    $user = "coordinator";
    $pswd = "coordinator";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
   $uname = $_POST['username'];


   if(strlen($uname) > 2 and substr($_POST['username'], 0, 3) == "PES"){
       $query = " SELECT panelid from student,team where teamid = id and ssn = '".$uname."';";
       $result = pg_query($db_connection, $query);

       while($row = pg_fetch_assoc($result)){

           $result1 = pg_query($db_connection, "SELECT tname from part_of pa,teacher t where t.tid = pa.teacherid and pa.panelid = '".$row['panelid']."';");

           echo "<p>The panelists of your project with  Panel ID &nbsp".$row['panelid']." are: </p>";
           echo "<table border='1'>
        <caption></caption>
        <tr>
        <th>Name</th>
        </tr>";
           while($row = pg_fetch_assoc($result1)){
            echo "<tr>";
            echo "<td>" . $row['tname'] . "</td>";
            echo "</tr>";
           }
           echo "<table />";


       }


       $result = pg_query($db_connection, " SELECT w.ptitle from student s,works_on w,team t where s.teamid = t.id and w.teamid = t.id and s.ssn = '".$uname."';");

       while($row = pg_fetch_assoc($result)){
           echo "<p> Your Project:</p>".'<p class="inphp">  '.$row['ptitle']."</p>";
       }

       $result = pg_query($db_connection, "SELECT distinct s.ssn,s.fname from student s,(SELECT w.ptitle,w.teamid from student s,works_on w,team t where s.teamid = t.id and w.teamid = t.id and s.ssn = '".$uname."')foo where foo.teamid = s.teamid;");
       echo "<p>Team mates:<p/>";
       while($row = pg_fetch_assoc($result)){
           echo '<div class="inphp">'. $row['ssn']." : ".$row['fname']."</div>";
       }

       echo "<br/><a href =\"coordinator.php\" /> Once More </a>";
   }

   echo '</p>';

   if($_POST['cq'] == "y"){

   //complex queries:
   // teachers who are not working on any projects but part of a panel
        echo "<p>1. Teachers who are not working on any projects but part of a panel</p>";

       $c_query1 = "SELECT distinct teacherid, tname from teacher tc, part_of p,(select t.tid from teacher t where not exists( select * from works_on where teacherid = t.tid ))foo where foo.tid = teacherid and tc.tid = teacherid ;";
       $result = pg_query($db_connection, $c_query1);

       echo "<table>";
       echo "<tr><th>teacherid</th><th>tname</th></tr>";
       while($row=pg_fetch_assoc($result)){echo "<tr>";


           //echo pg_field_name($result, 0)."<br />";

       /*    foreach ($row as $key => $value) {
               print "<th>{$value}</th>";
           } */


           echo "<td align='center' width='200'>" . $row['teacherid'] . "</td>";
           echo "<td align='center' width='200'>" . $row['tname'] . "</td>";


       echo "</tr>";}
       echo "</table>";
       echo "<p>2. Companies with max cryptography interns</p>";

        $query = "SELECT foo.company, foo.count
                from (select i.company, count(*)
                        from internship i, student s, team t, works_on w, project p
                        where i.ssn = s.ssn and s.teamid = t.id and t.id = w.teamid and w.ptitle = p.pname and p.domain = 'Cryptography'
                        group by i.company) foo
                where foo.count = (select max(bar.count)
                                    from (select i.company, count(*)
                                            from internship i, student s, team t, works_on w, project p
                                            where i.ssn = s.ssn and s.teamid = t.id and t.id = w.teamid and w.ptitle = p.pname and p.domain = 'Cryptography'
                                        group by i.company) bar
                                    );
                ";
        $result = pg_query($db_connection, $query);
        echo "<table>";
        echo "<tr><th>company</th><th>total number of cryp interns</th></tr>";
        while($row=pg_fetch_assoc($result)){echo "<tr>";


            //echo pg_field_name($result, 0)."<br />";

        /*    foreach ($row as $key => $value) {
                print "<th>{$value}</th>";
            } */


            echo "<td align='center' width='200'>" . $row['company'] . "</td>";
            echo "<td align='center' width='200'>" . $row['count'] . "</td>";


        echo "</tr>";}
        echo "</table>";
        echo "<p>3. Project domain having the maximum number of minor projects.</p>";

        $query = "  SELECT t1.domain,
                    t1.count
                    from (select domain,count(*)
                                from project
                                where ptype = 'Minor'
                                group by domain )t1
                    where t1.count = (select max(t2.count)
                                    from (select domain,count(*)
                                            from project
                                            where ptype = 'Minor'
                                            group by domain) t2
                                    );";
        $result = pg_query($db_connection, $query);
        echo "<table>";
        echo "<tr><th>domain</th><th>number of minor proj</th></tr>";
        while($row=pg_fetch_assoc($result)){echo "<tr>";


            //echo pg_field_name($result, 0)."<br />";

        /*    foreach ($row as $key => $value) {
                print "<th>{$value}</th>";
            } */


            echo "<td align='center' width='200'>" . $row['domain'] . "</td>";
            echo "<td align='center' width='200'>" . $row['count'] . "</td>";


        echo "</tr>";}
        echo "</table>";

        echo "<p>4. Teachers part of more atleast two panels</p>";
        $query = "SELECT distinct tname
                    from teacher
                    where tid in
                    (SELECT teacherid
                    from part_of
                    group by teacherid
                    having count(*) > 2
        );";
        $result = pg_query($db_connection, $query);
        echo "<table>";
        echo "<tr><th>tname</th></tr>";
        while($row=pg_fetch_assoc($result)){echo "<tr>";
            echo "<td align='center' width='200'>" . $row['tname'] . "</td>";
        echo "</tr>";}
        echo "</table>";

        echo "<p>5. Name of the teacher who is handling the highest gpa average team.</p>";
        $query1 = "SELECT tc.tname
                    from teacher tc,works_on w,(select teamid, avg(CGPA)
                                from student
                                group by teamid) bar
                    where tc.tid = w.teacherid and w.teamid = bar.teamid and bar.avg = (select max(t1.avg)
                                                                                        from (select s.teamid, avg(CGPA)
                                                                                                from student s
                                                                                                group by s.teamid)t1
                                                                                        );";

        $result = pg_query($db_connection, $query1);
        echo "<table>";
        echo "<tr><th>tname</th></tr>";
        while($row=pg_fetch_assoc($result)){echo "<tr>";

            echo "<td align='center' width='200'>" . $row['tname'] . "</td>";


        echo "</tr>";}
        echo "</table>";


       echo "<a href =\"coordinator.php\" /> Once More </a>";
   }

 }

?>




      </body>
</html>
