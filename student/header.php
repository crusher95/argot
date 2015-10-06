<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <style type="text/css">
        input{

        }
    </style>
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Fav and touch icons -->
    <link rel='shortcut icon' href='../images/favicon.png'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#fff;" <?php if($flag=='exam'){echo "onblur='alertuser()'";}?>>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php if($nav=='exam'){echo $detect['subject']." Exam";}else{ echo "Student Dashboard";} ?></a>

        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

        <?php
            if(isset($_POST['finish'])){
                $api=new API();
                $finish=$api->finishExam();
                if($finish){
                    header('Location:../student/index.php');
                }else{
                    header('../student/exam.php');
                }
            }
            if(isset($_SESSION['exam']['id'])){
                echo "<form method='post'><input name='finish' class='btn btn-primary' type='submit' value='Finish Exam' style='margin-right: 10px; margin-top: 10px;'></form>";
            }
        ?>
        <?php if($nav!='exam'){
            echo "<li class='dropdown'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-user'> </i>  ".strtoupper($_SESSION['client']['name'])." <b class='caret'></b></a>
            <ul class='dropdown-menu'>
                <li>
                    <a href='../settings.php'><i class='fa fa-fw fa-gear'></i> Settings</a>
                </li>
                <li class='divider'></li>
                <li>
                    <a href='../logout.php'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
                </li>
            </ul>
            </li>";

            $listBackground='#eee';
            $api=new API();
            $notification=$api->retrieveStudentNotification(array('class'=>$_SESSION['client']['class'],'institute'=>$_SESSION['client']['institute']));
            if($notification->count()){

                $button_color='btn-danger';
                echo "<li class='dropdown' style='margin:10px;'>

                <button class='btn ".$button_color." dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-bell'></i></button>
                <ul class='dropdown-menu dropdown-menu-right'>";
            }else{
                $button_color='btn-primary';

                echo "<li class='dropdown' style='margin:10px;'>

                        <button class='btn ".$button_color." dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-bell'></i></button>
                        <ul class='dropdown-menu dropdown-menu-right'>
                            <li style='background:".$listBackground."'><a href='#'>No new notication</a></li>";
            }

            foreach($notification as $document){
                if($document['status']=='unread'){
                    echo "<li><a href='".$document['url']."'>".$document['title']."</a></li>";
                }

            }

            echo " <li class='dropdown-header'>See all</li>
                   <li><a href='notifications.php'>All Notifications</a></li>
                    </ul>

                    </li>";}
            ?>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <?php
                    if($nav!='exam'){
                 ?>
                <li <?php  echo $nav==1? "class='active'":""; ?>>
                    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <?php
                 }
                    else{
                            foreach($questionBank as $document){
                 ?>

                   <?php echo "<a href='exam.php?id=".$document['id']."&question=".$document['_id']."'>"; ?> <li <?php  echo $nav==1? "class='active'":""; ?> >
                        <i class="fa fa-fw fa-question-circle"></i> <?php echo $document['question']; ?> </a>
                    </li>

                <?php }}?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
