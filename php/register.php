<?php
    function Init()
    {
        require_once "connect_to_db.php";
        require_once "query_capsule.php";

        $selected_tables = new Table_Field_Rel(
            "user",
                "reg-no",
                "name",
                "email",
                "ph-no"
        );

        $query = new MySQL_Query_Capsule($selected_tables);
      
        $dbc -> PushQuery(
            $query -> InsertValuesQuery(
                implode(",", $_POST)
            )
        );
        
        if( empty( $dbc -> FlushStack()) ) {
            echo "registered failed: re-registeration is not allowed";
            return;
        }

        echo "registeration successful";
        //header("Location: http://127.0.0.1:58932/FrontEnd/index.html");
    }
Init();
?>