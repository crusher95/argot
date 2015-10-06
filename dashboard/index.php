<?php
session_start();
$nav=1;
$flag=0;
require_once('../apis/classes.php');

    if(isset($_SESSION['exam']['sessionId'])){

        $id=$_SESSION['exam']['id'];
        $api=new API();
        $question=$api->firstQuestion(array('id'=>$_SESSION['exam']['id']));
        header("Location:./exam.php?id=".$id."&question=".$question['_id']);

    }
    if ($_SESSION['client']['role']=='teacher') {
        $role='teacher';
    }else{
        header('Location:./register.php');
    }
    require_once('./header.php');
?>

    <div id="page-wrapper">

        <div class="container-fluid">


            <div class="page-header">
                <h1>Faculty Dashboard</h1>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                </div>
                                <?php
                                $api=new API();
                                $data=array('institute'=>$_SESSION['client']['institute']);
                                $student=$api->retrieveStudent($data);
                                $class=$api->retrieveClass($data);
                                $pendingExams=$api->retrievePendingExams();
                                ?>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $student->count();?></div>
                                    <div>Student(s)</div>
                                </div>
                            </div>

                        </div>
                        <a href="./manageStudent.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $pendingExams;?></div>
                                    <div>Exam Pending</div>
                                </div>
                            </div>
                        </div>
                        <a href="./manageExam.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-building fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $class->count();?></div>
                                    <div>Classes added</div>
                                </div>
                            </div>
                        </div>
                        <a href="./manageClass.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="well">
                <h4>Key Advantages-</h4>
                <ul>
                    <li>Cost Effective- No expenses on printing question papers as well as providing answer sheets.</li>
                    <li>Secured- ARGOT will randomize sequence of questions for each examinee: No two examinees will see the same question at the same time.</li>
                    <li>Automated Report- Auto calculation of marks and auto generation of report is one of the characteristics of ARGOT.</li>
                    <li>Easy Analysis- Totaling and grouping of marks of different modules into one will be done by ARGOT.</li>
                    <li>Go Green- You will be saving a substantial amount of paper by using ARGOT. Prevent the use of paper and save the planet.</li>
                </ul>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

