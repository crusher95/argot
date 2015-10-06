<?php
/**
 * Created by PhpStorm.
 * User: crusher
 * Date: 5/10/15
 * Time: 1:30 AM
 */

    session_start();
    $nav='exam';
    $flag=0;
    $id=$_GET['id'];
    require_once('../apis/classes.php');
    $api=new API();
    $detect=$api->validateExam(array('id'=>$id));
    $questionBank=$api->retrieveQuestionBank(array('id'=>$id));
    if($api->displayAppeared(array('id'=>$id,'student'=>$_SESSION['client']['id']))){
        header('Location:./index.php');
    }
    if(isset($_SESSION['exam']['sessionId'])){

        $id=$_SESSION['exam']['id'];
        $api=new API();
        $question=$api->firstQuestion(array('id'=>$_SESSION['exam']['id']));
        if(!isset($_GET['question'])){
            header("Location:./exam.php?id=".$id."&question=".$question['_id']);
        }
    }

    if(isset($_GET['question'])){

        $question=$api->retrieveQuestion(array('id'=>$_GET['question']));

    }
    if ($_SESSION['client']['role']=='student' and $detect) {
        $role='student';
    }else{
        header('Location:../register.php');
    }
    if(isset($_GET['question'])){
        require_once 'header.php';
    }

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <?php
                if(isset($_POST['answer'])){

                    $option='';
                    if(isset($_POST['optradio'])){
                        $option=$_POST['optradio'];
                    }

                    if($option==''){
                        echo "<script>alert('Question Necessary!');</script>";

                    }else{



                        $answer=$api->ifAnswered(array('id'=>$_GET['id'],'student_id'=>$_SESSION['client']['id'],'question_id'=>$_GET['question']));
                        if($answer){
                            $answerResponse=false;
                            $data=array('id'=>$_GET['id'],'student_id'=>$_SESSION['client']['id'],'answer'=>$option,'question_id'=>$_GET['question']);
                            $update=$api->updateAnswer($data);
                        }else{

                            $question=$api->retrieveQuestion(array('id'=>$_GET['question']));

                            $data=array('_id'=>time().rand(1,1001),'id'=>$_GET['id'],'question_id'=>$_GET['question'],'question'=>$question['question'],'student_answer'=>$option,'answer'=>$question['answer'],'student_id'=>$_SESSION['client']['id'],'institute'=>$_SESSION['client']['institute']);

                            $answerResponse=$api->addAnswer($data);
                        }

                        if($answerResponse){
                            echo "<script>alert('Question answered successfully!');</script>";
                        }
                    }
                }
            ?>
            <?php
                if(isset($_GET['question'])){
                $answer=$api->ifAnswered(array('id'=>$_GET['id'],'student_id'=>$_SESSION['client']['id'],'question_id'=>$_GET['question']));
                    if($answer){

                        echo "<div style='background:#4caf50;color:#fff; padding:10px; text-align: center;'>You have answered this question as ".$answer['student_answer']."</div>";
                    }
                }


            ?>
            <div class="col-lg-12">
                <h3 class="page-header">
                    <?php
                        if(isset($_GET['question']) and isset($question['question'])){
                            echo $question['question']."


                </h3>

                <form role='form' class='col-lg-12' method='post'>
                   <center>
                    <div class='radio'>
                     <label style='margin:10px;margin-right:100px;'><input type='radio' name='optradio' value='".$question['option1']."'>".$question['option1']."</label><label style='margin:10px;'><input type='radio' name='optradio' value='".$question['option2']."'>".$question['option2']."</label>
</label>
                    </div>
                    <div class='radio'>
                      <label style='margin:10px;margin-right:100px;'><input type='radio' name='optradio' value='".$question['option3']."'>".$question['option3']."</label><label style='margin:10px;'><input type='radio' name='optradio' value='".$question['option4']."'>".$question['option4']."</label>
                    </div>
                    <input type='submit' name='answer' class='form-control'>
                    </center>
                </form>";
                }else{
                      ?>
                       <head>
                           <title>Exam Confirmation Page</title>

                       </head>
                            <?php

                                if(isset($_POST['startExam'])){

                                    $subject=$api->retrieveSubject(array('id'=>$_GET['id']));
                                    $api=new API();
                                    $data=array('id'=>$_GET['id'],'student'=>$_SESSION['client']['id'],'subject'=>$subject['subject']);
                                    $exam=$api->startExam($data);

                                    if($exam==0){
                                        echo "<script>alert('Exam could not be started! Try again later!');</script>";
                                    }else{
                                        ini_set('session.gc_maxlifetime', 3600);
                                        $_SESSION['exam']=$exam;
                                        header('Location:../manage.php');
                                    }

                                }
                            ?>
                       <div style='position:absolute;top:30%;width:100%; height:30%;background: #216AA5;left: 0px;right: 0px;text-align:center;'>
                            <h1 style='color: #f9f9f9;font-family: Arial, sans-serif;'>
                                Clicking on the button below would start your exam
                            </h1>
                           <h5 style='color: #222222;font-family: Arial, sans-serif;'>Duration:1 hour<br>*Attempting All Questions Necessary</h5>
                               <form method="post">
                                   <input type="submit" name="startExam" value="Start Exam" style="padding: 10px;cursor:pointer;'">
                               </form>
                        </div>
                            <?php
                        }
                    ?>

            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
<script>
    function alertuser(){
        alert('You are not allowed to change the page!');
    }
</script>