<?php
session_start();
$nav=3;
$flag=1;
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
        <div class="page-header">
            <h1>Manage student</h1>

            <?php
            $api=new API();
            $data=array('institute'=>$_SESSION['client']['institute']);
            $student=$api->retrieveStudent($data);
            if($student->count()){

            echo "<br><div class='row'>
                              <div class='col-lg-12'></div>
                              <div class='form col-lg-12'>
                                <center>
                              <button class='btn-info btn-sm' data-toggle='modal' data-target='#addstudent'>Add Student</button>
                              <br>
                              <br>
                                 </center>
                                 <br>
                                     <table id='tablaDatos' class='table' style='text-align:center;background: #7eb0db;'>
                                      <thead>
                                        <tr>
                                          <th style='text-align:center;'>Student ID</th>
                                          <th style='text-align:center;'>Student Name</th>
                                          <th style='text-align:center;'>Class</th>
                                          <th style='text-align:center;' colspan='2'>Action</th>
                                        </tr>
                                     </thead>
                                      <tbody>";?>
                    <?php
                $i=0;
                $id='#';
                $identifier="";
                foreach ($student as $document) {
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

                        <td><?php echo $document['id'];?></td>
                        <td><?php echo $document['name'];?></td>
                        <td><?php echo $document['class']?></td>
                        <td><?php echo "<a href='$id' id='edit' data-item='$identifier' data-toggle='modal' data-target='#editstudent' onclick='editStudent(this)'>";?>Edit</a></td>
                        <td><?php   echo "<a href='$id' id='delete' data-item='$identifier' data-toggle='modal' data-target='#deletestudent' onclick='deleteStudent(this)'>";?>Delete</a></td>
                    </tr>
                    <?php
                $i++;
               }?>
                </tbody>
                </table>
        <?php
}else{
    echo "<br><center><h3><i class='fa fa-3x fa-graduation-cap'></i><br><br>Seems like you have not added any Student</h3><br><h5><input type='submit' class='form-control' value='Add Student' style='background:rgb(63,138,202);color:#fff;' data-toggle='modal' data-target='#addstudent'></h5></center>";
}
            ?>
    </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!--Modal content DeleteStudent-->
<div class="modal fade" id="deletestudent" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Student</h4>
            </div>
            <div class="modal-body">

                <form method='post'>

                    <?php
                    if (isset($_GET['id'])) {

                        $id=$_GET['id'];
                        $api=new API();
                        if (isset($_POST['deletestud'])) {

                            $data = array('id' => $id );

                            $delete=$api->removeStudent($data);
                            if ($delete) {
                                echo "
                                                <script>
                                                  alert('Student removed!');
                                                  window.location.href='./manageStudent.php';
                                                </script>";
                            }else {
                                echo "<script>alert('Class record could not be removed!');</script>";
                            }
                        }
                        ?>
                        <h4>Are you sure you want to delete this record? </h4>
                        <br>
                        <input type='submit' name='deletestud' class="btn btn-info btn-block" value="Delete">
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
<!--DeleteTeacher modal ended-->

<!--Modal content AddStudent-->
<div class="modal fade" id="addstudent" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Student</h4>
            </div>
            <div class="modal-body">

                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#home">Add Student</a></li>
                    <li><a data-toggle="pill" href="#multipstudents">Add Multiple Students</a></li>
                </ul>
                <br>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>Add a student</h3>
                        <p>If you want to add a single student then just fill out this simple form</p>
                        <br>
                        <form method="post" data-toggle='validator'>
                            <input type='text' placeholder='ID' name='id' class='form-control' required><br>
                            <input type='text' placeholder='Name' name='name' class='form-control' required><br>

                            <?php
                            if(isset($_POST['addstudent'])){

                                $id=$_POST['id'];
                                $name=$_POST['name'];
                                $class=$_POST['class'];
                                $mobile=$_POST['mobile'];
                                $address=$_POST['address'];
                                $email=$_POST['email'];
                                $teacher_id=$_SESSION['client']['id'];
                                $password=sha1($_POST['studpassword']);
                                $institute=$_SESSION['client']['institute'];
                                $role='student';
                                if($id=='' or $name=='' or $class=='' or $mobile=='' or $address=='' or $password=='' or $email==''){
                                    echo "<script>alert('Please fill in all the credentials!');</script>";
                                }else if($class=='other'){
                                    echo "<script>alert('Please select a class');</script>";
                                }else{
                                    $data=array('id'=>$id,'name'=>$name,'email'=>$email,'password'=>$password,'class'=>$class,'mobile'=>$mobile,'address'=>$address,'institute'=>$institute,'role'=>$role,'teacher_id'=>$teacher_id);
                                    $api=new API();
                                    $addstudent=$api->addStudent($data);
                                    if($addstudent){
                                        echo "<script>alert('Student added successfully!');window.location.href='manageStudent.php';</script>";
                                    }else{
                                        echo "<script>alert('Student could not be added!');</script>";
                                    }
                                }
                            }
                            ?>

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
                            <input type="email" placeholder="Email" class="form-control" name="email" required><br>
                            <input type="password" placeholder="Password" class="form-control" name="studpassword" required><br>
                            <input type='number' placeholder='Mobile' class="form-control" name='mobile' required><br>
                            <textarea  class='form-control' name='address' placeholder='Address' style='max-width: 100%;'  required></textarea>

                            <br>
                            <input type='submit' name='addstudent' class="btn btn-info btn-block" value="Add Student">
                        </form>

                    </div>
                    <div id="multipstudents" class="tab-pane fade">
                        <h3>Add Multiple Students</h3>
                        <p>To add multiple students you need to enter the data in the JSON format.Here is a demo format of how the data is to be entered. <br> <a href='demo.txt' download>Download format</a></a></p>
                        <?php

                        function isJson($string) {
                            return ((is_string($string) &&
                                (is_object(json_decode($string)) ||
                                    is_array(json_decode($string))))) ? true : false;
                        }

                            if(isset($_POST['multipstudents'])){
                                $multipstudents=$_POST['students_data'];
                                $i=0;
                                $flag=0;
                                if(isJson($multipstudents)){
                                    //good job
                                }else{
                                    echo "<script>alert('Invalid Json');</script>";
                                }
                                $decoded=json_decode($multipstudents,true);
                                $length=count($decoded['Students']);
                                while($i<$length){
                                    $data=$decoded['Students'][$i];
                                    $api=new API();
                                    $data['institute']=$_SESSION['client']['institute'];
                                    $data['role']='student';

                                    $addstudent=$api->addStudent($data);

                                    if($addstudent){
                                        $flag=1;
                                    }else{
                                        $flag=0;
                                    }
                                    $i++;
                                }
                                if($flag==1){
                                    echo "<script>alert('Students Added Successfully!');</script>";
                                }else{
                                    echo "<script>alert('Students already exist!');</script>";
                                }

                            }
                        ?>
                        <form method='post'>
                            <br>
                            <textarea placeholder='Add the structured data' id='jsonout' class='form-control' name='students_data' style='max-width: 100%;min-height: 100px;'></textarea>
                            <br>
                            <input type='submit'  name='multipstudents' value='Add Students' class='form-control'  style='background:rgb(63,138,202);color:#fff;'>
                        </form>
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Edit Student modal ended-->

<!--Modal content EditStudent-->
<div class="modal fade" id="editstudent" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Student</h4>
            </div>
            <div class="modal-body">
                <form method="post">
                    <?php
                        if(isset($_GET['sid'])){

                            $id=$_GET['sid'];
                            $name='';
                            $email='';
                            $mobile='';
                            $department='';

                            $api=new API();

                            $data=array('id'=>$id);
                            $editstudent=$api->retrieveOneStudent($data);

                            $_id=$editstudent['_id'];
                            $id=$editstudent['id'];
                            $name=$editstudent['name'];
                            $class=$editstudent['class'];
                            $email=$editstudent['email'];
                            $mobile=$editstudent['mobile'];
                            $password=$editstudent['password'];
                            $address=$editstudent['address'];
                            $institute=$_SESSION['client']['institute'];

                            if (isset($_POST['edit'])) {

                                $password=$editteacher['password'];

                                $id=$_GET['sid'];
                                $name=$_POST['name'];
                                $class=$_POST['class'];
                                $email=$_POST['email'];
                                $mobile=$_POST['mobile'];
                                $address=$_POST['address'];
                                $institute=$_SESSION['client']['institute'];
                                if ($_POST['password']!='oldpassword') {
                                    $password=$_POST['password'];
                                    $password=sha1($password);
                                }
                                if($class=='other'){
                                    echo "<script>alert('Please select a class!');window.location.href='manageStudent.php';</script>";
                                    return 0;
                                }
                                $edit=array('_id'=>$_id,'id'=>$id,'name'=>$name,'email'=>$email,'password'=>$password,'mobile'=>$mobile,'class'=>$class,'role'=>'student','institute'=>$institute);

                                $editresponse=$api->editStudent($edit);
                                if ($editresponse) {
                                    echo "
                                                    <script>
                                                      alert('Data updated!');
                                                      window.location.href='manageStudent.php';
                                                    </script>";
                                }else{
                                    echo "<script>alert('Data did not get updated!');</script>";

                                }
                            }
                            ?>
                            <br>
                            <input type='number' name='somaiyaid' value=<?php echo $id;?> placeholder='Unique ID' class='form-control'>
                            <br>
                            <input type='text' name='name' placeholder='Name' class='form-control' value=<?php echo $name;?>>
                            <br>
                            <input type='email' name='email' placeholder='Email' class='form-control' value=<?php echo $email;?>>
                            <br>
                            <input type='password' name='password' placeholder='Reset Password' class='form-control' value='oldpassword'>
                            <br>
                            <select class='form-control' name='class' title="class" value='<?php echo $class?>' required>
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
                            </select>
                            <br>
                            <input type='number' name='mobile' placeholder='Mobile Number' class='form-control' value=<?php echo $mobile;?>>
                            <br>
                            <textarea name="address" placeholder="Address" class="form-control" style="max-width: 100%;"><?php echo $address?></textarea>
                            <br>
                            <input type='submit' name='edit' class="btn btn-info btn-block" >
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
<!--EditStudent modal ended-->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/pbtable.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

<script type="text/javascript">


    function editStudent(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageStudent.php?sid=" +id;
    }

    function deleteStudent(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageStudent.php?id=" +id;
    }

</script>

<?php
if (isset($_GET['sid'])) {
    echo "<script type='text/javascript'>

                $('#editstudent').modal('show');

                  </script>";
}else if(isset($_GET['id'])){
    echo "<script type='text/javascript'>

                $('#deletestudent').modal('show');

                  </script>";
}
?>
</body>

</html>

