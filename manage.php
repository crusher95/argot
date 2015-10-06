<?php
     session_start();
     $nav=2;
     require_once('header.php');
     require_once('apis/classes.php');
     if (!isset($_SESSION['client']['username'])) {
          header('Location:./register.php');
     }
?>
               <div class="triangle-up-left"></div>
               <div class="triangle-up-right"></div>
          </div>
     </header>
     <div class="full_page_photo no_photo">
          <div class="hgroup">
               <div class="hgroup_title animated bounceInUp skincolored">
                    <div class="container">
                         <h1>Manage teachers</h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp">
                    <div class="container">
                         <p>Manage your teachers and keep track of your results</p>
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
                                
                                  <h3>Teachers</h3>
                                   <?php

                                        $api=new API();
                                        $institute=$_SESSION['client']['institute'];
                                        $data=array('institute'=>$institute);
                                        $retrieve=$api->retrieveAllTeacher($data);
                                        if ($retrieve->count('0')) {
                                        echo "<div class='row'>
                                             <div class='col-lg-2'></div>
                                             <div class='form col-lg-8'>
                                             <button class='btn-info btn-sm' data-toggle='modal' data-target='#addteacher'>Add teacher</button>
                                                <table class='table' style='text-align:center;'>
                                                 <thead>
                                                   <tr>
                                                     <th style='text-align:center;'>Name</th>
                                                     <th style='text-align:center;'>Email</th>
                                                     <th style='text-align:center;'>Department</th>
                                                     <th style='text-align:center;' colspan='2'>Action</th>
                                                   </tr>
                                                 </thead>
                                                 <tbody>";?>
                                                  <?php
                                                    $id='#';
                                                    $i=0;
                                                    $identifier="";
                                                    foreach ($retrieve as $document) {
                                                      $identifier=$document['id'];
                                                  ?>
                                                   <tr class=<?php switch ($i%2) {
                                                     case 0:
                                                       echo "info";
                                                       break;
                                                     
                                                     default:
                                                       echo "danger";
                                                       break;
                                                   }   ?>>
                                                       <td><?php echo $document['name'];?></td>
                                                       <td><?php echo $document['email'];?></td>
                                                       <td><?php echo $document['department']?></td>
                                                       <td><?php echo "<a href='$id' id='edit' data-item='$identifier' data-toggle='modal' data-target='#editteacher' onclick='editID(this)'>";?>Edit</a></td>
                                                       <td><?php echo "<a href='$id' id='delete' data-item='$identifier' data-toggle='modal' data-target='#deleteteacher' onclick='deleteID(this)'>";?>Delete</a></td>
                                                   </tr>
                                            <?php
                                            $i++;
                                        }?>
                                             </tbody>
                                               </table>
                                        </div>
                                        <?php
                                          }else{
                                            echo "<h4><i class='fa fa-3x fa-frown-o'></i><br>Seems like you have not added any teacher</h4><br><h5><input type='submit' class='form-control' value='Add teacher' style='background:rgb(63,138,202);color:#fff;' data-toggle='modal' data-target='#addteacher'></h5>";
                                          }
                                   ?> 

                                   <!--Modal content AddTeacher-->
                                   <div class="modal fade" id="editteacher" role="dialog">
                                      <div class="modal-dialog modal-lg" style=''>
                                      
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit Teacher</h4>
                                          </div>
                                          <div class="modal-body">

                                            <form method='post'>

                                            <?php
                                              if (isset($_GET['id'])) {

                                                $id=$_GET['id'];
                                                $name='';
                                                $email='';
                                                $mobile='';
                                                $department='';
                                                $api=new API();
                                                $data=array('id'=>$id);
                                                $editteacher=$api->retrieveTeacher($data);
                                                $_id=$editteacher['_id'];
                                                $id=$editteacher['id'];
                                                $name=$editteacher['name'];
                                                $department=$editteacher['department'];
                                                $email=$editteacher['email'];
                                                $mobile=$editteacher['mobile'];
                                                $password=$editteacher['password'];
                                                $institute=$_SESSION['client']['institute'];
                                                
                                                if (isset($_POST['edit'])) {

                                                $password=$editteacher['password'];

                                                $id=$_GET['id'];
                                                $name=$_POST['name'];
                                                $department=$_POST['department'];
                                                $email=$_POST['email'];
                                                $mobile=$_POST['mobile'];
                                                $institute=$_SESSION['client']['institute'];
                                                if ($_POST['password']!='oldpassword') {
                                                  $password=$_POST['password'];
                                                  $password=sha1($password);
                                                }
                                                  $edit=array('_id'=>$_id,'id'=>$id,'name'=>$name,'email'=>$email,'password'=>$password,'mobile'=>$mobile,'department'=>$department,'role'=>'teacher','institute'=>$institute);
                                                  $editresponse=$api->editTeacher($edit);
                                                  if ($editresponse) {
                                                    echo "
                                                    <script>
                                                      alert('Data updated!');
                                                      window.location.href='manage.php';
                                                    </script>";
                                                  }else{
                                                    echo "<script>alert('Data did not get updated!');</script>";

                                                  }
                                                }
                                            ?>
                                              <input type='number' name='somaiyaid' value=<?php echo $id;?> placeholder='Unique ID' class='form-control'>
                                              <input type='text' name='name' placeholder='Name' class='form-control' value=<?php echo $name;?>> 
                                              <input type='email' name='email' placeholder='Email' class='form-control' value=<?php echo $email;?>>
                                              <input type='password' name='password' placeholder='Reset Password' class='form-control' value='oldpassword'>
                                              <input type='number' name='mobile' placeholder='Mobile Number' class='form-control' value=<?php echo $mobile;?>>    
                                              <select class='form-control' name='department'>
                                                <option value='none'>Department</option>
                                                <option value='computer'>Computer Engineering</option>
                                                <option value='extc'>EXTC Engineering</option>
                                                <option value='electronics'>Electronics Engineering</option>
                                                <option value='it'>Information Technology</option>
                                              </select>       
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
                                    <!--AddTeacher modal ended-->

                                   <!--Modal content DeleteTeacher-->
                                   <div class="modal fade" id="deleteteacher" role="dialog">
                                      <div class="modal-dialog modal-lg" style=''>
                                      
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete Teacher</h4>
                                          </div>
                                          <div class="modal-body">

                                            <form method='post'>

                                            <?php
                                              if (isset($_GET['did'])) {

                                                $id=$_GET['did'];
                                                $api=new API();
                                                if (isset($_POST['delete'])) {
                                                  $data = array('id' => $id );

                                                  $delete=$api->removeTeacher($data);
                                                  if ($delete) {
                                                    echo "
                                                    <script>
                                                      alert('Teacher record removed!');
                                                      window.location.href='manage.php';
                                                    </script>";
                                                  }else {
                                                    echo "<script>alert('Teacher record could not be removed!');</script>";
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
                                    <!--DeleteTeacher modal ended-->

                                   <!--Modal content AddTeacher-->
                                   <div class="modal fade" id="addteacher" role="dialog">
                                      <div class="modal-dialog modal-lg" style=''>

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add Teacher</h4>
                                          </div>
                                          <div class="modal-body">
                                            <?php
                                              if (isset($_POST['submit'])) {
                                                $id=$_POST['somaiyaid'];
                                                $name=$_POST['name'];
                                                $password=$_POST['password'];
                                                $cpassword=$_POST['cpassword'];
                                                if ($password!=$cpassword) {
                                                 echo "Password does not match";
                                                }
                                                $encrypt=sha1($password);
                                                $email=$_POST['email'];
                                                $mobile=$_POST['mobile'];
                                                $institute=$_SESSION['client']['institute'];
                                                $department=$_POST['department'];
                                                $api=new API();
                                                $data=array('id'=>$id,'name'=>$name,'email'=>$email,'password'=>$encrypt,'mobile'=>$mobile,'department'=>$department,'role'=>'teacher','institute'=>$institute);

                                                $addteacher=$api->addTeacher($data);

                                                if (!$addteacher) {
                                                 echo "
                                                 <script>
                                                  alert('Teacher added successfully!');
                                                  window.location.href='manage.php';
                                                 </script>";

                                                }
                                              }
                                            ?>
                                            <form method='post' data-toggle='validator'>
                                              <input type='number' name='somaiyaid' placeholder='Unique ID' class='form-control' data-error='Please fill out this field' required>
                                              <input type='text' name='name' placeholder='Name' class='form-control' data-error='Please fill out this field' required>
                                              <input type='email' name='email' placeholder='Email' class='form-control' data-error='Please fill out this field' required>
                                              <input type='password' name='password' placeholder='Password' class='form-control' data-error='Please fill out this field' required>
                                              <input type='password' name='cpassword' placeholder='Re-type Password' class='form-control' data-error='Please fill out this field' required>
                                              <input type='number' name='mobile' placeholder='Mobile Number' class='form-control' data-error='Please fill out this field' required>
                                              <select class='form-control' name='department'>
                                                <option value='none'>Department</option>
                                                <option value='computer'>Computer Engineering</option>
                                                <option value='extc'>EXTC Engineering</option>
                                                <option value='electronics'>Electronics Engineering</option>
                                                <option value='it'>Information Technology</option>
                                              </select>
                                              <br>
                                              <input type='submit' name='submit' class="btn btn-info btn-block" >
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>

                                      </div>
                                    </div>
                                    <!--AddTeacher modal ended-->
                                        <div class='col-lg-2'></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>

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

     <script type="text/javascript" src="js/style_switcher.js"></script>
     <script type="text/javascript" src="js/validator.js"></script>
     
     <script type="text/javascript">
      
      function editID(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manage.php?id=" +id;
      }

      function deleteID(el){
        var id=$(el).attr('data-item');
        //alert(id);
        window.location.href = "manage.php?did=" +id;
      }
     </script>
     
     <?php
      if (isset($_GET['id'])) {
        echo "<script type='text/javascript'>
                  $('#editteacher').modal('show');
             </script>";
      } else if (isset($_GET['did'])) {
          echo "<script type='text/javascript'>
            
            $('#deleteteacher').modal('show');
            
              </script>";
      }
      ?>

     <div class="style_switcher">
          <div class="gear"><i class="fa fa-user"></i></div>
          <div class="styles">
               <h6>Information</h6>
               <ul>
                    <li class="style-classic"><i class="fa fa-circle"></i> <?php echo "Username: ".strtoupper($_SESSION['client']['username']);?></li>
                    <li class="style-purple"><i class="fa fa-circle"></i> <?php echo "Institute: ".strtoupper($_SESSION['client']['institute']);?></li>
                    <li class="style-golden"><i class="fa fa-circle"></i> <?php echo "Role: ".strtoupper($_SESSION['client']['role']);?></li>
               </ul>
               <p></p>
               <ul>
                    <li class="style-onepage"><a href="settings.php"><i class="fa fa-cogs"></i> Edit details</a></li>
               </ul>
          </div>
     </div>
     <!--END Style Switcher-->
</div>
</body>
</html>