<?php
     session_start();
     $nav=2;
     require_once('apis/classes.php');
     if (isset($_SESSION['client']['username'])) {
         $role='institute';
     }else if ($_SESSION['client']['role']=='teacher') {
          $role='teacher';
          $nav=3;
     }else{
          header('Location:./register.php');
     }
     require_once('header.php');
     
?>
               <div class="triangle-up-left"></div>
               <div class="triangle-up-right"></div>
          </div>
     </header>
     <div class="full_page_photo no_photo">
          <div class="hgroup">
               <div class="hgroup_title animated bounceInUp skincolored">
                    <div class="container">
                         <h1>Generate reports</h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp">
                    <div class="container">
                         <p>All class-wise results just one-click away</p>
                    </div>
               </div>
          </div>
     </div>
     <div class="main">
          <div class="container triangles-of-section">
               <div class="triangle-up-left"></div>
               <div class="square-left"></div>
               <div class="triangle-up-right"></div>
               <div class="square-right"></div>
          </div>
                    <section>
               <div class='container'>
                    <div class='row'>
                         <div class='col-sm-12 col-md-12'>
                              <div class='signin'>
                                   <div class='social_sign'>
                                
                                  <h3>Reports</h3>
                                   <?php
                                        $api=new API();
                                        $data=array('institute'=>$_SESSION['client']['institute']);
                                        $retrieve=$api->hasAttended();
                                        if ($retrieve->count()) {
                                        echo "<br><div class='row'>
                                                     <div class='col-lg-11'></div>
                                                     <div class='form col-lg-12'>
                                                        <table class='table' style='text-align:center; background: #7eb0db;'>
                                                         <thead>
                                                           <tr>
                                                             <th style='text-align:center;'>Student ID</th>
                                                             <th style='text-align:center;'>Subject</th>
                                                             <th style='text-align:center;' colspan='1'>Action</th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>";?>
                                       <?php
                                       $i=0;
                                       $id='#';
                                       $identifier="";
                                       foreach ($retrieve as $document) {
                                           $identifier=$document['student'];
                                           ?>
                                           <tr class=<?php switch ($i%2) {
                                               case 0:
                                                   echo "info";
                                                   break;

                                               default:
                                                   echo "danger";
                                                   break;
                                           }   ?>>
                                               <td style='line-height: 200%; font-size: 16px;'><?php echo $document['student'];?></td>
                                               <td style='line-height: 200%; font-size: 16px;'><?php echo $document['subject']?></td>
                                               <td><?php echo "<a href='generateReport.php?id=".$document['id']."&student_id=".$document['student']."' class='btn btn-primary btn-sm' style='color: #f9f2f4;'>Generate Reports</a>";?></td>
                                           </tr>
                                           <?php
                                           $i++;
                                       }?>
                                       </tbody>
                                       </table>
                                   </div>

                                  <?php

                                  ?>

                                  <?php

                                        }else{
                                          if ($_SESSION['client']['role']=='institute') {

                                            echo "<h4><i class='fa fa-2x fa-paper-plane'></i><br>Seems like you have not conducted any exams yet</h4><br><h5><button class='form-control' style='background:rgb(63,138,202);color:#fff;'data-toggle='modal' data-target='#examinstitute'>Conduct Exam</button></h5>";
                                          }else{

                                             
                                            echo "<h4><i class='fa fa-2x fa-paper-plane'></i><br>Seems like you have not conducted any exams yet</h4><br><button class='form-control' style='background:rgb(63,138,202);color:#fff;'data-toggle='modal' data-target='#examteacher'>Conduct Exam</button>";                                          }
                                             
                                        }
                                   ?>

                                        <div class='col-lg-2'></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>

                                   <!--Modal content conductteacher-->
                                   <div class="modal fade" id="examteacher" role="dialog">
                                      <div class="modal-dialog modal-lg" style=''>
                                      
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Conduct Exam</h4>
                                          </div>
                                          <?php
                                            if (isset($_POST['conductteacher'])) {
                                              $id=$_POST['id'];
                                              $name=$_POST['name'];
                                              $subject=$_POST['subject'];
                                              $syllabus=$_POST['syllabus'];
                                              $examiner=$_SESSION['client']['id'];
                                              $examiner_name=$_SESSION['client']['name'];
                                              $data=array('id'=>$id,'name'=>$name,'subject'=>$subject,'syllabus'=>$syllabus,'examiner'=>$examiner,'examiner_name'=>$examiner_name);
                                              $api=new API();
                                              $assignexam=$api->assignexam($data);
                                              if ($assignexam) {
                                                echo "<script>alert('Exam assigned!');</script>";
                                                header('Location:dashboard/');
                                              }else{
                                                echo "<script>alert('Could not assign exam.Try again later!');</script>";
                                              }
                                            }
                                          ?>
                                          <div class="modal-body">
                                            <form method='post' >
                                              <input type='text' class='form-control' name='id' Placeholder='Exam Id' style='margin-bottom:10px;'>
                                              <input type='text' class='form-control' name='name' Placeholder='Exam Name' style='margin-bottom:10px;'>
                                              <input type='text' class='form-control' name='subject' Placeholder='Subject' style='margin-bottom:10px;'>
                                              <textarea Placeholder='Syllabus' class='form-control' style='margin-bottom:10px;' name='syllabus'></textarea>
                                              <input type='submit' class='form-control' name='conductteacher' style='margin-bottom:10px;background:rgb(63,138,202);color:#fff;' value='Assign Exam'>
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <!--conductteacher modal ended--> 
<?php
          require_once('footer.php');
     ?>
     </div>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script src="twitter-bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     
     <!--FlexSlider -->
     <script src="js/woothemes-FlexSlider-06b12f8/jquery.flexslider-min.js"></script>
     <!--Isotope Plugin -->
     <script src="js/isotope/jquery.isotope.min.js" type="text/javascript"></script>
     <!--To-Top Button Plugin -->
     <script type="text/javascript" src="js/jquery.ui.totop.js"></script>
     <!--Easing animations Plugin -->
     <script type="text/javascript" src="js/easing.js"></script>
     <!--WOW Reveal on scroll Plugin -->
     <script type="text/javascript" src="js/wow.min.js"></script>
     <!--Simple Text Rotator -->
     <script type="text/javascript" src="js/jquery.simple-text-rotator.js"></script>
     <!--Twenty Twenty Plugin -->
     <script type="text/javascript" src="js/twentytwenty/js/jquery.event.move.js"></script>
     <script type="text/javascript" src="js/twentytwenty/js/jquery.twentytwenty.js"></script>
     <!--The Theme Required Js -->
     <script type="text/javascript" src="js/cleanstart_theme.js"></script>
     <!--To collapse the menu -->
     <script type="text/javascript" src="js/collapser.js"></script>
     <!--Twitter Feed API -->
     <script type="text/javascript" src="js/tweetie/tweetie.min.js"></script>
     <!--Style Switcher, You propably want to remove this!-->
     <script type="text/javascript" src="js/style_switcher.js"></script>

</div>
</body>
</html>