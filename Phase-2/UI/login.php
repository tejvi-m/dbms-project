<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>

      .container {
        z-index: -1;
        position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: auto;
    opacity: 0.4;
}
 

  

.topbar{
    position: fixed;
    z-index: 1;
    margin-top: -1%;
    margin-left: -1%;
  
    height: 1%;
  }

.DescBar{
    font-size: 45px;
    color: rgb(0, 153, 255);
    
    width: 100%;
      padding-top: 11%;
    margin-left: 10%;
    
    z-index: 2;
    font-weight: 600;
  }

  input[type=text],input[type="password"] {
  width: 30%;
  padding: 12px 20px;
  margin-top: 3%;
  margin-left: 8%;
  box-sizing: border-box;
  border: 2px solid rgb(0, 153, 255);
  border-radius: 4px;
}

input[type=submit] {
  width: 30%;
  padding: 12px 20px;
  margin-top: 3%;
  margin-left: 8%;
  box-sizing: border-box;
  border: none;
  background-color: darkblue;

  color: white;
}

    </style>
  </head>
  
  <body>
  <div class="container">
     <img src="/pes.jpg" alt="logo"/>
  </div> 

  <div class="topbar">
     <img src="/logo.png" alt="logo" height="100px"/>
  </div> 
  <div class="DescBar">
     LOGIN 

  </div>
    <form action="loginprocess.php" method = "POST">
      <input type="text" name = "username" placeholder="ID"/>
      <br>
      <input type="password" name = "password" placeholder="Password"/>
      <br>
      <input type="submit" value ="Login"/>
    </form>

    
      </body>
</html>