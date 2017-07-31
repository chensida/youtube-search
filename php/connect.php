<?php
$dbcon = mysqli_connect("130.211.236.143:3306", "root", "p@ssw0rd", "video");
if (!$dbcon) {
    echo "<script type='text/javascript'>alert('not connected');</script>";
}
echo "<script type='text/javascript'>alert('connected');</script>";
?>