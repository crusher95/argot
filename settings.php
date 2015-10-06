<?php
    session_start();
    $nav=2;
    $flag=0;
    require_once('apis/classes.php');
    if ($_SESSION['client']['role']=='teacher') {
        $role='teacher';
    }elseif($_SESSION['client']['role']=='student'){
        $role='student';
    }elseif($_SESSION['client']['institute']=='institute'){
        $role='institute';
    }else{
        header('Location:./register.php');
    }
    echo $role;

?>

