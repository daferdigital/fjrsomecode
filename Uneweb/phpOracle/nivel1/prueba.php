<?php
# note to the parser that we have php code coming next
# Here's how we connect:
$dbh = oci_connect("uneweb", "uneweb1006", "localhost:1521/xe");
# Here's how we pass an sql statement:
$stmt = oci_parse ($dbh, 'select fname, lname from accounts');
# Here we execute the statement:
oci_execute ($stmt);
$cnt = 1;
# Then we fetch rows in a loop until we're done
while ($result = oci_fetch_array($stmt)) {
   echo "user: " . $cnt . " " . $result['fname'] . " " . $result['lname'] . "<br>";
   $cnt = $cnt +1;
}
# last we close the database handle
oci_close($dbh);
# and note to the parser that this is the end of the php code section
?>