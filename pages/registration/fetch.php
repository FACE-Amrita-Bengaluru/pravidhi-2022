<?php

$_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';
require_once $_INCLUDE_DIR . 'dependencies.php';

echo("<h1>Individual event table</h1>");
?>

    <table style=" border: 1px solid black;">
        <tr>
            <th>clubname</th>
            <th>eventname</th>
            <th>regno</th>
            <th>name</th>
            <th>sem</th>
            <th>branch</th>
            <th>email</th>
            <th>phno</th>
            
        </tr>

<?php
$select = new Table_Field_Rel(
    "individualregistered",

    "clubname", //0
    "eventname", //1
    "regno", //2
    "name", //3
    "sem", //4
    "branch", //5
    "email", //6
    "phno" //7
);

$query = new MySQL_Query_Capsule($select);
consoleBug($query);

try {
    $out = $dbc->RelayQuery($query);
} catch (Exception $e) {
    consoleBug($e->getMessage());
}

$indTuples = array();

foreach ($out as $_trivial => $eventTuple) {
    $indTuple = array();

    consoleBug(">>");
    foreach ($eventTuple as $_trivial1 => $eventAttr) {
        consoleBug("attr: $eventAttr");
        array_push($indTuple, $eventAttr);
    }

    array_push($indTuples, $indTuple);
}


        if (isset($indTuples))
            foreach ($indTuples as $indTuple){
                echo('<tr style=" border: 1px solid black;">');
            
                if (isset($indTuple))
                    foreach($indTuple as $data)
                        echo(' <td style=" border: 1px solid black;">' . $data . '</td>');
                    
                    echo('</tr>');
                }

?>
</table>

<br>
<h1>Group events table</h1>
<table style=" border: 1px solid black;">
  <tr>
    <th>clubname</th>
    <th>eventname</th>
    <th>regno</th>
    <th>name</th>
    <th>teamname</th>
    <th>sem</th>
    <th>branch</th>
    <th>email</th>
    <th>phno</th>
    
  </tr>
<?php
$select = new Table_Field_Rel(
    "groupreg",
    
    "clubname", //0
    "eventname", //1
    "regno",
    //2
    "name",
    "teamname", //3
    "sem", //4
    "branch", //5
    "email", //6
    "phno"
);

$query = new MySQL_Query_Capsule($select);
consoleBug($query);
$out = $dbc->RelayQuery($query);

$grpTuples = array();

foreach ($out as $_trivial => $eventTuple) {
    $grpTuple = array();

    consoleBug(">>");
    foreach ($eventTuple as $_trivial1 => $eventAttr) {
        consoleBug("attr: $eventAttr");
        array_push($grpTuple, $eventAttr);
    }

    array_push($grpTuples, $grpTuple);
}

    if (isset($grpTuples))
        foreach ($grpTuples as $k => $grpTuple){
            echo('<tr style=" border: 1px solid black;">');
            
            if (isset($grpTuple))
                foreach($grpTuple as $k1 => $grpdata){
                    echo(' <td style=" border: 1px solid black;">' . $grpdata . '</td>');
            }

            echo('</tr>');
        }
    
  ?>


</table>

