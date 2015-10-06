<?php
session_start();
$nav=9;
$flag=0;
require_once('../apis/classes.php');
if ($_SESSION['client']['role']=='student') {
    $role='teacher';
}else{
    header('Location:../register.php');
}

require_once 'header.php';
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Notifications
                </h1>
                <div class="panel-group" id="accordion">
                    <?php

                    $api=new API();
                    $notification=$api->retrieveAllStudentNotification(array('class'=>$_SESSION['client']['class'],'institute'=>$_SESSION['client']['institute']));

                    if($notification->count()) {

                        $id=1;
                        foreach($notification as $document){

                            $id++;

                        echo "<div class='panel panel-default'>
                            <div class='panel-heading'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$id."' style='text-decoration: none; color: #222222;'><h4 class='panel-title'>
                                    ".$document['title']."
                                </h4></a>
                            </div>
                            <div id='collapse".$id."' class='panel-collapse collapse'>
                                <div class='panel-body'>
                                    <p>".$document['message'].".<a href='".$document['url']."' target='_blank' class='btn btn-primary pull-right'><i class='fa fa-link' style='color:#fff;'></i></a></p>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
require_once 'footer.php';
?>

</body>

</html>
