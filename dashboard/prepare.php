<!--  --><?php
session_start();
$nav=4;
$flag=1;
require_once('../apis/classes.php');

if ($_SESSION['client']['role']=='teacher') {
    $role='teacher';
    $api=new API();
    if($api->retrieveExamStatus(array('id'=>$_GET['id']))==1){
        echo "<script>alert('Exam already prepared!');</script>";
        header('Location:manageExam.php');
    }
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
                    Prepare Exam
                </h1>
                <div class="well">
                    <p>
                        <?php

                            $api=new API();
                            $data=array('id'=>$_GET['id']);
                            $document=$api->retrieveOneExam($data);
                        ?>
                        EXAM ID: <?php echo $document['id']?><br>
                        EXAM NAME: <?php echo $document['name']?><br>
                        EXAM SUBJECT: <?php echo $document['subject']?><br>
                        EXAM DATE: <?php echo $document['date']."(YYYY-MM-DD)";?><br>
                    </p>
                </div>
                <a href='#' id='addquestion' class="btn-primary btn-sm" onclick="addquestion()">Add Question</a>
                <br>
                <br>

                <?php

                    $a=0;
                    if(isset($_POST['submitpaper'])){

                        $i=0;
                        $marker=0;
                        $data=[];
                        $api=new API();
                        $length=sizeof($_POST)/7;
                        for($i=0;$i<=$length;$i++){

                        $data['_id']=time().rand(1,1000);
                        $data['id']=$_GET['id'];
                        $data['question']=$_POST['question']['question'.$i];
                        $data['option1']=$_POST['option1']['option1'.$i];
                        $data['option2']=$_POST['option2']['option2'.$i];
                        $data['option3']=$_POST['option3']['option3'.$i];
                        $data['option4']=$_POST['option4']['option4'.$i];
                        $data['answer']=$_POST['answer']['answer'.$i];

                        $question=$api->addQuestion($data);

                        if($question){
                            $marker=1;
                        }else{
                            $marker=0;
                        }

                    }
                    if($marker==1){
                        $api->updateExamStatus(array('id'=>$_GET['id']));
                        echo "<script>alert('Question Bank added successfully!');window.location('./manageExam.php');</script>";
                        header('Location:./manageExam.php');
                    }else{
                        echo "<script>alert('Question already exists!');</script>";
                    }

                    }
                ?>
                    <form method="post">
                        <div id='questionWrapper'>
                            <form method="post" data-toggle='validator'>
                            <div id="dynamicQuestion" class='dynamicQuestion'>
                                <input name='question[question0]' type='text' placeholder="Question" class="form-control" required><br>
                                <div id='addoption'>
                                    <input name='option1[option10]' type='text' placeholder='Answer Option 1'  class='form-control' required><br>
                                    <input name='option2[option20]' type='text' placeholder='Answer Option 2'  class='form-control' required><br>
                                    <input name='option3[option30]' type='text' placeholder='Answer Option 3'  class='form-control' required><br>
                                    <input name='option4[option40]' type='text' placeholder='Answer Option 4'  class='form-control' required><br>
                                </div>
                                <input name="answer[answer0]" type="text" placeholder="Answer" class="form-control" required><br>
                                <input name='removequestion' data-item='dynamicQuestion' onclick='removefunc(this)' type='button' class='btn-danger btn-small' value='Remove question'>

                            </div>
                        </div>
                        <br>
                        <input type="submit"  value="Submit paper" name="submitpaper" class="form-control" style="background: #2a6496;color: #fff;">
                            </form>


        </div>

    </div>
</div>
<?php
    if(isset($_POST['submitpaper'])){
        $question=$_POST['question'];

    }
?>
<script>

    var id= 1,count= 0,option=0;

    function addquestion(){

        var newcontent = document.createElement('div');

        newcontent.innerHTML="<div id='dynamicQuestion' class='dynamicQuestion-"+id+"'><input name='question[question"+id+"]' type='text' placeholder='Question' class='form-control' required><br>"+
            " <div id='addoption'>"+
            "<input name='option1[option1"+id+"]' type='text' placeholder='Answer Option 1'  class='form-control' required><br>"+
            "<input name='option2[option2"+id+"]' type='text' placeholder='Answer Option 2'  class='form-control' required><br>"+
            "<input name='option3[option3"+id+"]' type='text' placeholder='Answer Option 3'  class='form-control' required><br>"+
            "<input name='option4[option4"+id+"]' type='text' placeholder='Answer Option 4'  class='form-control' required><br>"+
            "</div>"+
            "<input name='answer[answer"+id+"]' type='text' placeholder='Answer' class='form-control'><br>"+
            "<input name='removequestion' data-item='dynamicQuestion-"+id+"' type='button' onclick='removefunc(this)' class='btn-danger btn-small' value='Remove question'>"+
            "</div><br></div>";

        document.getElementById('questionWrapper').appendChild(newcontent);

        id+=1;
    }

    function removefunc(el){
        var id=$(el).attr('data-item');
        $("."+id+"").remove();
    }

        function alertuser(){
            if(count<1)
            alert('Closing or reloading away from the tab might result in loss of data!');

            count+=1;
        }

</script>

<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../twitter-bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

