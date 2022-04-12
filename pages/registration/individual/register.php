<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login Form | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Register</h1>
      <form method="post">
      <div class="txt_field">
          <input type="text" name='name' required>
          <span></span>
          <label>Name</label>
        </div>
      <div class="txt_field">
          <input type="text" name='regno' required>
          <span></span>
          <label>Reg</label>
        </div>
        <div class="txt_field">
          <input type="text" name='sem' required>
          <span></span>
          <label>Sem</label>
        </div>
        <div class="txt_field">
          <input type="text" name='branch' required>
          <span></span>
          <label>Branch</label>
        </div>
        <div class="txt_field">
          <input type="text" name='phno' required>
          <span></span>
          <label>phno</label>
        </div>
        <div class="txt_field">
          <input type="text" name='email' required>
          <span></span>
          <label>Email</label>
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
      $valid = preg_match("/^BL\.EN\.U4\.(CSE|AIE|EAC|ECE|EEE|MEE)(19|20)[0-9]{3}$/", $regno);

      if (! $valid)
        consoleBug("invalid registeration number");
      
        return $valid;
  }

  function validateName(string $name) : bool
  {
    $valid = preg_match("/^[a-zA-Z]+( [a-zA-Z]+)?( [a-zA-Z]+)?$/", $name);
    
    if (! $valid)
      consoleBug("invalid name");

    return $valid;
  }

  function validateSem(string $sem) : bool
  {
    $valid = preg_match("/^4|6$/", $sem);

    if (! $valid)
      consoleBug("invalid semester");

    return $valid;
  }

  function validateBranch(string $branch) : bool
  {
    $valid = preg_match("/^CSE|AIE|EAC|ECE|EEE|MEE$/", $branch);

    if (! $valid)
      consoleBug("invalid branch");

    return $valid;
  }

  function validateEmail(string $email) : bool
  {
    $valid = preg_match("/^([a-zA-Z_][a-zA-Z0-9_]*\.)*([a-zA-Z_][a-zA-Z0-9_]*)\@([a-zA-Z_][a-zA-Z0-9_]*\.)*[a-z]{2,3}$/", $email);
    
    if (! $valid)
    consoleBug("invalid email");

    return $valid;
  }

  function validatePhNo(string $phno) : bool
  {
    $valid = preg_match("/^[0-9]{10}$/", $phno);

    if (! $valid)
    consoleBug("invalid phone number");

    return $valid;
  }
    
  function Init() : void
  {
    require_once "connect_to_db.php";
    require_once "query_capsule.php";   

    if (count($_POST) > 0) {
      $selected_tables = new Table_Field_Rel(
          "register",
                
              "name",
              "regno",
              "sem",
              "branch",
              "phno",
              "email"
              
      );

      $query = new MySQL_Query_Capsule($selected_tables);
      
      unset($_POST['login']);
        
      if (
          validateRegNo($_POST['regno']) &&
          validateName($_POST['name']) &&
          validateEmail($_POST['email']) &&
          validatePhNo($_POST['phno'])
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
      
  
      //header("Location: http://127.0.0.1:58932/FrontEnd/index.html");
      
      
    }
    
  }
Init();