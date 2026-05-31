<?php
if (isset($_POST ['r3']));
{
    $User=$_POST['r1'];
    $Pass=$_POST['r2'];
    if(!preg_match('/^[A-Za-z0-9]{8,16}$/', $User))
    {
        echo "Your User Name must be strong with Character and Number ";
    }
    if(!preg_match('/^[A-Za-z0-9]{1,8}+\@ #\ +[A-Z]{1,3}$/', $Pass))
    {
        echo "Invalid Password";
    }
}
?>
