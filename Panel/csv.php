<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
$name=["GPS","District","District Code","Traditional Authority","Traditional Authority Code","Village Cluster","Village Cluster Code","Village Name","Village Code","Household Id","Household Head","Name Wearing GPS","Mobile Wearing WG", "Gender Wearing GPS","Age Wearing GPS"];
fputcsv($output, $name);

// fetch the data
mysql_connect('localhost', 'root', 'L4n4s3!-Db');
mysql_select_db('malawiTest');
$rows = mysql_query('SELECT * FROM identification');

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>
