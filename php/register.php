<?php
    function Init()
    {
        require_once "connect_to_db.php";
        require_once "query_capsule.php";

        $selected_tables = new Table_Field_Rel(
            "user",
                "name",
                "email"
        );

        $query = new MySQL_Query_Capsule($selected_tables);
        
        $query
        ->SetWhere("$0.0 = '$0_' or $0.1 = '$0_'", $_POST["uname"]);
      
        $dbc
        ->PushQuery($query);
        
        if(empty($dbc->FlushStack())){
            echo "Username or Email was incorrect";
            return;
        }

        $selected_tables = new Table_Field_Rel(
            "user",
                "name",
                "email",
                "password"
        );

        $query = new MySQL_Query_Capsule($selected_tables);

        $query
        ->SetWhere("($0.0 = '$0_' or $0.1 = '$0_') and $0.2 = '$1_'", $_POST["uname"], $_POST["pass"]);

        $dbc
        ->PushQuery($query);

        if(empty($dbc->FlushStack())){
            echo "Password was incorrect";
            return;
        }

        echo "Successful Login";
        //header("Location: http://127.0.0.1:58932/FrontEnd/index.html");
    }
Init();
?>