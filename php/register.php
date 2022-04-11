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
    function validateRegNo(string $regno) : bool
    {
        return preg_match($regno, "/BL\.EN\.U4\.(CSE|AIE|EAC|ECE|EEE|MEE)(19|20)[0-9]{3}/");
    }

    function validateName(string $name) : bool
    {
        return preg_match($name, "[a-zA-Z]+( [a-zA-Z]+)?( [a-zA-Z]+)?");
    }

    function validateEmail(string $email) : bool
    {
        return preg_match($email, "/[a-z0-9]\+\@[a-z]\+\.[a-z]{2,3}/");
    }

    function validPhNo(string $phno) : bool
    {
        return preg_match($phno, "/[0-9]{10}/");
    }
    
    function Init() : void
    {
        require_once "connect_to_db.php";
        require_once "query_capsule.php";

        $selected_tables = new Table_Field_Rel(
            "registration",
                "regno",
                "name",
                "email",
                "phno"
        );

        $query = new MySQL_Query_Capsule($selected_tables);
        
        unset($_POST['login']);

        consoleBug("validation of regno: " . validateRegNo($_POST['regno']));
        consoleBug("validation of name: " . validateRegNo($_POST['name']));
        consoleBug("validation of email: " . validateRegNo($_POST['email']));
        consoleBug("validation of phno: " . validateRegNo($_POST['phno']));

        if (
            validateRegNo($_POST['regno']) &&
            validateRegNo($_POST['name']) &&
            validateRegNo($_POST['email']) &&
            validateName($_POST['phno']) || true
            ) {
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
        }

        foreach ($_POST as $k=>$v) {
            unset($_POST[$k]);
        }
        foreach ($_POST as $k=>$v) {
            consoleBug($k . " : " . $v);
        }

        //header("Location: http://127.0.0.1:58932/FrontEnd/index.html");
    }
Init();