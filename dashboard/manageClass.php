<?php
session_start();
$nav=2;
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


            <div class="page-header">
                <h1>Manage class</h1>
                <?php
                $api=new API();
                $data=array('institute'=>$_SESSION['client']['institute']);
                $class=$api->retrieveClass($data);
                if($class->count(0)){
                echo "<br><div class='row'>
                                             <div class='col-lg-11'></div>
                                             <div class='form col-lg-12'>
                                             <center>
                                                <button class='btn-info btn-sm' data-toggle='modal' data-target='#addclass' >Add Class</button>
                                              </center><br>
                                                <table class='table' style='text-align:center; background: #7eb0db;'>
                                                 <thead>
                                                   <tr>
                                                     <th style='text-align:center;'>Class Name</th>
                                                     <th style='text-align:center;'>Institute</th>
                                                     <th style='text-align:center;' colspan='1'>Action</th>
                                                   </tr>
                                                 </thead>
                                                 <tbody>";?>
                <?php
                $i=0;
                $id='#';
                $identifier="";
                foreach ($class as $document) {
                    $identifier=$document['class'];
                    ?>
                    <tr class=<?php switch ($i%2) {
                        case 0:
                            echo "info";
                            break;

                        default:
                            echo "danger";
                            break;
                    }   ?>>
                        <td><?php echo $document['class'];?></td>
                        <td><?php echo $document['institute']?></td>
                        <td><?php echo "<a href='$id' id='delete' data-item='$identifier' data-toggle='modal' data-target='#deleteclass' onclick='deleteID(this)'>";?>Delete</a></td>
                    </tr>
                    <?php
                    $i++;
                }?>
                </tbody>
                </table>
            </div>
            <?php
            }else{

                echo "<br><center><h3><i class='fa fa-3x fa-frown-o'></i><br><br>Seems like you have not added any class</h3><br><h5><input type='submit' class='form-control' value='Add Class' style='background:rgb(63,138,202);color:#fff;' data-toggle='modal' data-target='#addclass'></h5></center>";
            }
            ?>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!--Modal content AddClass-->
<div class="modal fade" id="addclass" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Class</h4>
            </div>
            <div class="modal-body">

                <form method='post'>
                    <?php
                    if (isset($_POST['addclass'])){

                        $class=$_POST['class'];
                        $institute=$_SESSION['client']['institute'];

                        if($class==''){
                            echo "
                                                      <script>
                                                        alert('Please add a valid field entry!');
                                                        window.location.href='./manageClass.php';
                                                      </script>";
                            return 0;
                        }
                        $data=array('class'=>$class,'institute'=>$institute);
                        $api=new API();
                        $addclass=$api->addClass($data);

                        if($addclass){
                            echo "
                                                      <script>
                                                          alert('Classes added successfully!');
                                                          window.location.href='./manageClass.php';
                                                      </script>";
                        }else{
                            echo "<script>alert('Classes could not be added.');</script>";
                        }
                    }
                    ?>

                    <input type='text' placeholder='Class Name' name='class' class='form-control'>
                    <br>
                    <input type='submit' name='addclass' class="btn btn-info btn-block" value="Add Class">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--AddClass modal ended-->

<!--Modal content DeleteClass-->
<div class="modal fade" id="deleteclass" role="dialog">
    <div class="modal-dialog modal-lg" style=''>

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Class</h4>
            </div>
            <div class="modal-body">

                <form method='post'>

                    <?php
                    if (isset($_GET['did'])) {

                        $id=$_GET['did'];
                        $api=new API();
                        if (isset($_POST['delete'])) {
                            $data = array('class' => $id );

                            $delete=$api->removeClass($data);
                            if ($delete) {
                                echo "
                                                <script>
                                                  alert('Class removed!');
                                                  window.location.href='./manageClass.php';
                                                </script>";
                            }else {
                                echo "<script>alert('Class record could not be removed!');</script>";
                            }
                        }
                        ?>
                        <h4>Are you sure you want to delete this record? </h4>
                        <br>
                        <input type='submit' name='delete' class="btn btn-info btn-block" value="Delete">
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
<!--DeleteClass modal ended-->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

<script type="text/javascript">



    function deleteID(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageClass.php?did=" +id;
    }
    function deleteStudent(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manageStudent.php?id=" +id;
    }
</script>

<?php
if (isset($_GET['did'])) {
    echo "<script type='text/javascript'>

                $('#deleteclass').modal('show');

                  </script>";
}else if(isset($_GET['id'])){
    echo "<script type='text/javascript'>

                $('#deletestudent').modal('show');

                  </script>";
}
?>
</body>

</html>

