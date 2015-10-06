<?php
session_start();
$nav=4;
$flag=0;
require_once('../apis/classes.php');
if ($_SESSION['client']['role']=='teacher') {
    $role='teacher';
}else{
    header('Location:./register.php');
}
require_once('./header.php');
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Manage Exam
                    <small>Assign &amp; prepare exams</small>
                </h1>
                <?php
                $api=new API();
                $data=array('institute'=>$_SESSION['client']['institute'],'id'=>$_SESSION['client']['id']);
                $exams=$api->retrieveExams($data);
                if($exams->count(0)){
                echo "<br><div class='row'>
                              <div class='col-lg-12'></div>
                              <div class='form col-lg-12'>
                                <center>
                              <button class='btn-info btn-sm' data-toggle='modal' data-target='#examteacher'>Add Exam</button>
                              <br>
                              <br>
                                 </center>
                                 <br>
                                     <table id='tablaDatos' class='table' style='text-align:center;background: #7eb0db;'>
                                      <thead>
                                        <tr>
                                          <th style='text-align:center;'></th>
                                          <th style='text-align:center;'>Exam ID</th>
                                          <th style='text-align:center;'>Exam Name</th>
                                          <th style='text-align:center;'>Class</th>
                                          <th style='text-align:center;'>Subject</th>
                                          <th style='text-align:center;' colspan='3'>Action</th>
                                        </tr>
                                     </thead>
                                      <tbody>";?>
                <?php
                $i=0;
                $id='#';
                $identifier="";
                foreach ($exams as $document) {
                    $identifier=$document['id'];

                    ?>
                    <tr class=<?php switch ($i%2) {
                        case 0:
                            echo "'info'";
                            break;

                        default:
                            echo "'danger'";
                            break;
                    }   ?>>
                        <?php if($document['status']=='0'){echo "<td><a href='prepare.php?id=$identifier' class='btn-success btn-sm'>Prepare Exam</a></td>";}else{echo "<td><a href='#' class='btn-danger btn-sm'>Prepared</a></td>";} ?>
                        <td><?php echo $document['id'];?></td>
                        <td><?php echo $document['name'];?></td>
                        <td><?php echo $document['class']?></td>
                        <td><?php echo $document['subject']?></td>
                        <td><?php if($document['notify']!='yes'){echo "<a href='$id' id='notify' class='btn-primary btn-sm' data-item='$identifier' data-toggle='modal' data-target='#notifystudent' onclick='notifyStudent(this)'>Notify <i class='fa fa-user'></i></a>";}else{echo "<a class='btn-danger btn-sm' href='$id'>Notified</a>";}?></td>
                        <td><?php   echo "<a href='$id' id='delete' data-item='$identifier' data-toggle='modal' data-target='#deleteexam' onclick='deleteExam(this)'>";?>Delete</a></td>
                    </tr>
                    <?php
                    $i++;
                }?>
                </tbody>
                </table>
            <?php
                }else{

                    echo "<br><center><h4><i class='fa fa-2x fa-paper-plane-o'></i><br><br>Seems like you have not conducted any exams yet</h4></center><br><button class='form-control' style='background:rgb(63,138,202);color:#fff;' data-toggle='modal' data-target='#examteacher'>Conduct Exam</button>";
                }
                ?>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!--Modal content notifyStudent-->
<div class="modal fade" id="notifystudent" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notify Students</h4>
            </div>
            <div class="modal-body">
                <form method='post'>

                    <?php
                    if (isset($_GET['nid'])) {

                        $id=$_GET['nid'];
                        $api=new API();
                        if (isset($_POST['notify'])) {

                            $data=array('id'=>$id);
                            $exams=$api->retrieveOneExam($data);

                            $title=$exams['subject']." ".$exams['name']." on ".$exams['date'];
                            $message='Your teacher '.$_SESSION['client']['name'].' has scheduled a test of '.$exams['subject'].' on '.$exams['date'];
                            $data=array('title'=>$title,'message'=>$message,'class'=>$exams['class'],'url'=>"exam.php?id=".$exams['_id'],'date'=>$exams['date'],'institute'=>$_SESSION['client']['institute']);

                            $notify=$api->sendNotification($data,'student');
                            $idData=array('id'=>$exams['_id']);
                            $update=$api->classNotify($idData);
                            if ($notify) {
                                echo "
                                    <script>
                                      alert('Students notified!');
                                      window.location.href='./manageExam.php';
                                    </script>";
                            }else {
                                echo "<script>alert('Students could not be notified!');</script>";
                            }
                        }
                        ?>
                        <h4>Are you sure you want to notify students? </h4>
                        <br>
                        <input type='submit' name='notify' class="btn btn-info btn-block" value="Send Notification">
                        <?php
                    }
                    ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--notifyStudent modal ended-->

<!--Modal content ConductExam-->
<div class="modal fade" id="examteacher" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Exam</h4>
            </div>
            <div class="modal-body">

                <?php
                    if(isset($_POST['conduct'])){
                        $examid=$_POST['examid'];
                        $examname=$_POST['name'];
                        $subject=$_POST['subject'];
                        $class=$_POST['class'];
                        $date=$_POST['date'];
                        $notify=$_POST['notify'];
                        if($examid=='' or $examname=='' or $subject=='' or $class=='' or $date=='' or $notify==''){
                            echo "<div style='background:#D12538;color:#fff; padding:10px;'>Please fill in all the details</div>";
                            echo "<script>alert('Please fill in all the details!');</script>";
                        }else{

                        if($class!='other'){

                            $api=new API();
                            $data=array('_id'=>$examid,'id'=>$examid,'name'=>$examname,'subject'=>$subject,'class'=>$class,'date'=>$date,'institute'=>$_SESSION['client']['institute'],'teacher_id'=>$_SESSION['client']['id'],'status'=>'0','notify'=>$notify);
                            $addExam=$api->addExam($data);

                            if($addExam){
                                echo "<script>alert('Exams added successfully!');window.location.href='manageExam.php';</script>";
                            }else{
                                echo "<script>alert('Exams could not be added!');</script>";
                            }

                            if($notify=='yes'){
                                $title=$subject." ".$examname." on ".$date;
                                $message='Your teacher '.$_SESSION['client']['name'].' has scheduled a test of '.$subject.' on '.$date;
                                $data=array('title'=>$title,'message'=>$message,'class'=>$exams['class'],'url'=>"exam.php?id=".$exams['_id'],'date'=>$exams['date'],'institute'=>$_SESSION['client']['institute']);
                                $api=new API();
                                $result=$api->sendNotification($data,'student');

                                if(!$result){
                                    echo "<script>alert('Notification could not be send!');</script>";
                                }
                            }else{
                                //it's our little secret
                            }



                        }else{
                            echo "<script>alert('Please select a valid class!');</script>";
                        }

                        }
                    }
                ?>
                <form method='post'>
                        <input type='text' name='examid'  placeholder='Exam ID' class='form-control' required><br>
                        <input type='text' name='name' placeholder='Exam Name' class='form-control' required><br>
                        <input type='text' name='subject' placeholder='Subject' class='form-control' required><br>
                        <select class='form-control' name='class' title="class" required>
                            <?php
                            $api=new API();
                            $data=array('institute'=>$_SESSION['client']['institute']);
                            $retrieve=$api->retrieveClass($data);
                            if($retrieve->count()){
                                foreach($retrieve as $document){

                                    echo "<option value='".$document['class']."'>".$document['class']."</option>";

                                }
                            }
                            ?>
                            <option value='other'>Other Class</option>
                        </select><br>
                        <input type='date' name="date" class='form-control' placeholder="Date of Examination" required><br>
                        <b style='color: red;'>*You can notify students later as well</b>
                        <select class='form-control' name='notify' title='notify' required>
                            <option value='yes'>Notify all students</option>
                            <option value='yes'>Yes</option>
                            <option value='no'>No</option>
                        </select><br>

                        <input type='submit' name='conduct' class="btn btn-info btn-block" >

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--conductexam modal ended-->

</div>
<!-- /#wrapper -->

<script src="../js/jquery-1.10.2.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">



    function notifyStudent(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageExam.php?nid=" +id;
    }
    function deleteStudent(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageStudent.php?id=" +id;
    }
</script>

<?php
if (isset($_GET['nid'])) {
    echo "<script type='text/javascript'>
                $('#notifystudent').modal('show');
          </script>";
}else if(isset($_GET['id'])){
    echo "<script type='text/javascript'>

                $('#deletestudent').modal('show');

                  </script>";
}
?>


</body>

</html>

