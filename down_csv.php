<?php
$sql = $_GET['sql'];
include "connection.php";
$result = $conn->query($sql);

$num_column = mysqli_num_fields($result);

$csv_header = '';


while ($fieldinfo=mysqli_fetch_field($result)){

    $csv_header .= '"' . $fieldinfo->name . '",';
}
$csv_header .= "\n";

$csv_row ='';
while($row = mysqli_fetch_row($result)) {
  for($i=0;$i<$num_column;$i++) {
    $csv_row .= '"' . $row[$i] . '",';
  }
  $csv_row .= "\n";
}

/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=info_csv.csv');
echo $csv_header . $csv_row;
exit;
?>