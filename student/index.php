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
    if ($_SESSION['client']['role']=='student') {
        $role='student';
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
                        Dashboard
                    </h1>
                    <?php
                        $api=new API();
                        $detect=$api->detectExam();
                        if($detect->count()){

                            echo "<br><div class='row'>
                                                     <div class='col-lg-11'></div>
                                                     <div class='form col-lg-12'>
                                                     <center><h2>Exams Today</h2></center>
                                                        <table class='table' style='text-align:center; background: #7eb0db;'>
                                                         <thead>
                                                           <tr>
                                                             <th style='text-align:center;'>Exam Name</th>
                                                             <th style='text-align:center;'>Subject</th>
                                                             <th style='text-align:center;' colspan='1'>Action</th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>";?>
                            <?php
                            $i=0;
                            $id='#';
                            $identifier="";
                            foreach ($detect as $document) {
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
                                    <td style='line-height: 200%; font-size: 16px;'><?php echo $document['name'];?></td>
                                    <td style='line-height: 200%; font-size: 16px;'><?php echo $document['subject']?></td>
                                    <td><?php
                                        $api=new API();
                                        if(!$api->displayAppeared(array('id'=>$document['id'],'student'=>$_SESSION['client']['id']))){
                                            echo "<a class='btn btn-sn btn-success' onclick='startTest()' href='exam.php?id=".$document['id']."'>
                                        Appear</a>";
                                        }else{
                                            echo "<a class='btn btn-sn btn-danger' href='#'>
                                        Appeared</a>";
                                        }
                                        ?></td>
                                </tr>
                                <?php
                                $i++;
                            }?>
                            </tbody>
                            </table>
                        </div>

                    <?php
                        }else{
                            echo "<br><center><h2><i class='fa fa-3x fa-thumbs-up'></i><br>Hooray no exam today!</h2><br></center>";
                        }
                    ?>
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
