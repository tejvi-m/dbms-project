
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body id = "bod">
    <form action="coordinator.php" method = "POST">
      Which student do you want to check upon: <input type="text" name = "username"/>
      <br>
      c queries?: 
      <input type ="radio" name = "cq" value="y"/>yeah
      <input type ="radio" name = "cq" value="n"/>nope
      <br>
      <input type="submit" name = "submit" value ="GO?"/>
    </form>
    
    <?php
    ///////////////////////////////////////////////// processing part //////////////////////////////////////////////// 
 
 if(isset($_POST['submit'])){
    echo "<script> var b = document.getElementById(\"bod\") ;b.innerHTML=\"\";</script>";
    $user = "postgres";
    $pswd = "alike#1";
    $db_connection = pg_connect("host=localhost dbname=register user=".$user." password=".$pswd);
   $uname = $_POST['username'];
   
   
   if(strlen($uname) > 2 and substr($_POST['username'], 0, 3) == "PES"){
       $query = " SELECT panelid from student,team where teamid = id and ssn = '".$uname."';";
       $result = pg_query($db_connection, $query);
       
       while($row = pg_fetch_assoc($result)){
       
           $result1 = pg_query($db_connection, "SELECT tname from part_of pa,teacher t where t.tid = pa.teacherid and pa.panelid = '".$row['panelid']."';");
       
           echo "The panelists of<b> &nbsp".$row['panelid']."<b /><br />";
           echo "<table>";
           echo "<tr><th>tname</th></tr>";
           while($row = pg_fetch_assoc($result1)){echo "<tr>";
               echo "<td align='center' width='200'>" . $row['tname'] . "</td>";
               echo "<tr />";
           }
           echo "<table />";
           
       
       }
       
       
       $result = pg_query($db_connection, " SELECT w.ptitle from student s,works_on w,team t where s.teamid = t.id and w.teamid = t.id and s.ssn = '".$uname."';");
       
       while($row = pg_fetch_assoc($result)){
           echo "your project:".$row['ptitle']."<br />";
       }
       
       $result = pg_query($db_connection, "SELECT distinct s.ssn,s.fname from student s,(SELECT w.ptitle,w.teamid from student s,works_on w,team t where s.teamid = t.id and w.teamid = t.id and s.ssn = '".$uname."')foo where foo.teamid = s.teamid;");
       echo "teammates<br />";
       while($row = pg_fetch_assoc($result)){
           echo $row['ssn'].":".$row['fname']."<br />";
       }
       
       echo "<a href =\"coordinator.php\" /> Once More </a>";
   }
   
   
   if($_POST['cq'] == 'y'){
   
   //complex queries:
   // teachers who are not working on any projects but part of a panel
        echo "1. teachers who are not working on any projects but part of a panel";
   
       $c_query1 = "SELECT distinct teacherid, tname from teacher tc, part_of p,(select t.tid from teacher t where not exists( select * from works_on where teacherid = t.tid ))foo where foo.tid = teacherid and tc.tid = teacherid ;";
       $result = pg_query($db_connection, $c_query1);
       
       echo "<table>";
       echo "<tr><th>teahcerid</th><th>tname</th></tr>";
       while($row=pg_fetch_assoc($result)){echo "<tr>";
       
           
           //echo pg_field_name($result, 0)."<br />";
        
       /*    foreach ($row as $key => $value) {
               print "<th>{$value}</th>";
           } */
       
       
           echo "<td align='center' width='200'>" . $row['teacherid'] . "</td>";
           echo "<td align='center' width='200'>" . $row['tname'] . "</td>";
          
       
       echo "</tr>";}
       echo "</table>";

       echo "2. companies with max cryptography interns";
       
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

        echo "3. project domain having the maximum number of minor projects."; 
        
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

         
        echo "4. teachers part of more atleast two panels";
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


    





       echo "<a href =\"coordinator.php\" /> Once More </a>";
   }
  

 }
 
?>




      </body>
</html>











