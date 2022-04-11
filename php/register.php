<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login Form | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>User Login</h1>
      <form method="post">
      <div class="txt_field">
          <input type="text" name='regno' required>
          <span></span>
          <label>Reg</label>
        </div>
        <div class="txt_field">
          <input type="text" name='name' required>
          <span></span>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name='email' required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="text" name='phno' required>
          <span></span>
          <label>phno</label>
        </div>
        <div class="pass">Forgot Password?</div>
        <input type="submit" name='login' value="Login">
        <div class="signup_link">
          Not a member? <a href="#">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>

<?php
    function Init()
    {
        require_once "connect_to_db.php";
        require_once "query_capsule.php";
        // $pdo = new PDO('mysql:host=localhost;dbname=pravidhi','root','root');
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // if ($pdo) {
        //     consoleBug 'connected';
        //   } else {
        //     consoleBug 'not connected';
        //   }

        $selected_tables = new Table_Field_Rel(
            "registration",
                "regno",
                "name",
                "email",
                "phno"
        );

        $query = new MySQL_Query_Capsule($selected_tables);
        
        unset($_POST['login']);

        

        foreach ($_POST as $k => $v) {
            $_POST[$k] = "'" . $v . "'";
            consoleBug($_POST[$k]);
        }

        $insertion = $query -> InsertValuesQuery(
            implode(",", $_POST)
        );

        consoleBug($insertion);
        
        $dbc -> PushQuery(
            $insertion  
        );
        
        $return = $dbc -> FlushStack();
        consoleBug($return);
        
        if( empty($return) ) {
            consoleBug("registered failed: re-registeration is not allowed");
            return;
        }

        consoleBug("registeration successful");

        foreach ($_POST as $k=>$v) {
            unset($_POST[$k]);
        }
        foreach ($_POST as $k=>$v) {
            consoleBug($k . " : " . $v);
        }

        //header("Location: http://127.0.0.1:58932/FrontEnd/index.html");
    }
Init();