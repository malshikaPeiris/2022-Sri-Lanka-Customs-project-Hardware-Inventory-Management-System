<?php
$con  = mysqli_connect('localhost','root','','inventory');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
}
