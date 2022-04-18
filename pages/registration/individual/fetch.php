<?php
 $_INCLUDE_DIR = $_SERVER['DOCUMENT_ROOT'] . '/pravidhi-2022/includes/';
 require_once $_INCLUDE_DIR . 'dependencies.php';

 $select = new Table_Field_Rel(
    "individualregistered",
    "clubname", //0
    "eventname", //1
    "regno", //2
    "name", //3
    "sem", //4
    "branch", //5
    "email", //6
    "phno"
);

$query = new MySQL_Query_Capsule($select);
consoleBug($query);
$out = $dbc->RelayQuery($query);

$a = array();

foreach ($out as $_trivial => $eventTuple) {
    $b = array();

    consoleBug(">>");
    foreach ($eventTuple     as $_trivial1 => $eventAttr) {
        consoleBug("attr: $eventAttr");
        array_push($b, $eventAttr);
    }

    array_push($a, $b);
}

consoleBug($a[0][0]);
echo("<h1>Individual event table</h1>")
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
  foreach ($a as $v){
      echo('<tr style=" border: 1px solid black;">');
      foreach($v as $value){
          echo(' <td style=" border: 1px solid black;">'.$value.'</td>');
      }
      echo('</tr>');
  }
  
  ?>
<?php
$select = new Table_Field_Rel(
    "groupregister",
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

$a = array();

foreach ($out as $_trivial => $eventTuple) {
    $b = array();

    consoleBug(">>");
    foreach ($eventTuple     as $_trivial1 => $eventAttr) {
        consoleBug("attr: $eventAttr");
        array_push($b, $eventAttr);
    }

    array_push($a, $b);
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
  foreach ($a as $v){
      echo('<tr style=" border: 1px solid black;">');
      foreach($v as $value){
          echo(' <td style=" border: 1px solid black;">'.$value.'</td>');
      }
      echo('</tr>');
  }
  
  ?>


</table>

