<?php

include_once'../notify/connecation.php';

{

$delete_id=$_GET['id'];
$sql_delete =mysqli_query($con,"DELETE FROM message WHERE id = '$delete_id'");
if ($sql_delete)
{
    header('location:notifications.php');

}
else{
    echo mysqli_error($con);
}
}

?>