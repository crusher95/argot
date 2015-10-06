<?php

     session_start();
     $nav=0;
     require_once('header.php');
     require_once('apis/classes.php');

    if(isset($_SESSION['exam']['sessionId'])){

         $id=$_SESSION['exam']['id'];
         $api=new API();
         $question=$api->firstQuestion(array('id'=>$_SESSION['exam']['id']));
         header("Location:./exam.php?id=".$id."&question=".$question['_id']);

    }
     if (isset($_SESSION['client']['role'])) {
         $role=$_SESSION['client']['role'];
         if($role=='teacher'){
             header('Location:./client.php');
         }elseif($role=='institute'){
             header('Location:./client.php');
         }else{
             header('Location:./student');
         }
     }
?>
               <div class='triangle-up-left'></div>
               <div class='triangle-up-right'></div>
          </div>
     </header>
     <div class='full_page_photo no_photo'>
          <div class='container'>
               <div class='hgroup'>
                    <div class='hgroup_title animated bounceInUp skincolored'>
                         <div class='container'>
                              <h1>Register or Sign in</h1>
                         </div>
                    </div>
                    <div class='hgroup_subtitle animated bounceInUp'></div>
               </div>
          </div>
     </div>
     <div class='main'>
          <div class='container triangles-of-section'>
               <div class='triangle-up-left'></div>
               <div class='square-left'></div>
               <div class='triangle-up-right'></div>
               <div class='square-right'></div>
          </div>
          <section>
               <div class='container'>
                    <div class='row'>
                         <div class='col-sm-6 col-md-6'>
                              <div class='signin'>

                                             <?php
                                                  if (isset($_POST['signin'])) {
                                                       if (array_key_exists('remember', $_POST)) {
                                                            //when remember me is checked
                                                       }else{
                                                            //when remember me is unchecked
                                                       }

                                                       $api=new API();

                                                       $email=$_POST['email'];
                                                       $password=$_POST['password'];
                                                       $encrypt=sha1($password);

                                                       if (empty($email) or empty($password)) {
                                                           echo "<div style='background:#D12538;color:#fff; padding:10px;'>Please enter your credentials</div>";
                                                       }else{
                                                        
                                                            $data=array('email' => $email,'password'=>$encrypt);
                                                            $login=$api->login($data);
                                                            if ($login) {
                                                                 $_SESSION['client']=$login;
                                                                 header('Location:./client.php');
                                                            }else{
                                                                 $studentLogin=$api->StudentLogin($data);
                                                                if($studentLogin){
                                                                    $_SESSION['client']=$studentLogin;
                                                                    header('Location:./student/');
                                                                }else{
                                                                    echo "<div style='background:#D12538;color:#fff; padding:10px;'>Incorrect login credentials</div>";
                                                                }
                                                            }
                                                       
                                                       }
                                                  }
                                             ?>
                                   <div class='social_sign'>
                                        <h3>Log in with your site account</h3>
                                   </div>
                                   <div class='row'>
                                        <div class='col-lg-2'></div>
                                        <div class='form col-lg-8'>
                                             <form method='post'>
                                                  <input placeholder='Email' name='email' class='form-control' type='email'>
                                                  <input placeholder='Password' name='password' class='form-control' type='password'>
                                                  <div class='forgot'>

                                                       <a href='register.php#'>Forgot password?</a> </div>
                                                  <button type='submit' class='btn btn-primary' name='signin'>Sign in</button>
                                             </form>
                                        </div>
                                        <div class='col-lg-2'></div>
                                   </div>
                              </div>
                         </div>
                         <div class='col-sm-6 col-md-6'>
                              <div class='signup'>
                                       <?php
                                                  if (isset($_POST['register'])) {
                                                       
                                                       if (array_key_exists('terms', $_POST)) {

                                                            $api=new API();
                                                            $username=$_POST['username'];
                                                            $email=$_POST['email'];
                                                            $password=$_POST['password'];
                                                            $institute=$_POST['institute_name'];
                                                            $address=$_POST['address'];
                                                            $encrypt=sha1($password);
                                                            
                                                            $data=array('username'=>$username,'email' => $email,'password'=>$encrypt,'institute'=>$institute,'address'=>$address,'role'=>'institute');
                                                            $register=$api->register($data);
                                                            if ($register) {
                                                              
                                                                 echo "<div style='background:#4caf50;color:#fff; padding:10px;'>You have sucessfully registered with A.R.G.O.T</div>";
                                                                 
                                                            }else{
                                                                 echo "<div style='background:#D12538;color:#fff; padding:10px;'>Institute already exists.</div>";
                                                            }
                                                                                                                       
                                                       }else{
                                                            
                                                            echo "<div style='background:#D12538;color:#fff; padding:10px;'>You have to agree to the terms and conditions to register.</div>";
                                                       }

                                                  }
                                             ?>
                                   <form method='post'>
                                        <fieldset>
                                             <div class='social_sign'>
                                                  <h3>Don't have a site account yet?</h3>
                                                  <a><i class='fa fa-2x fa-user'></i></a> </div>
                                             <p class='sign_title'>Register your institute with us for free</p>
                                             <div class='row'>
                                                  <div class='col-lg-2'></div>
                                                  <div class='col-lg-8'>
                                                       <input id='Username' name='username' placeholder='Username' class='form-control' required='' type='text'>
                                                       <input id='Emailaddress' name='email' placeholder='Email address' class='form-control' required='' type='email'>
                                                       <input id='Password' name='password' placeholder='Password' class='form-control' required='' type='password'>
                                                       <input id='InstituteName' name='institute_name' placeholder='Name of institute' class='form-control' required='' type='text'>
                                                       <textarea class='form-control' name='address' placeholder='Address of Institute' required=''></textarea>
                                                       <div class='checkbox'>
                                                            <label class=''>
                                                                 <input value='terms' type='checkbox' name='terms'>
                                                                 I agree to the <a href='register.php#'>terms and conditions</a> </label>
                                                       </div>
                                                  </div>
                                                  <div class='col-lg-2'></div>
                                             </div>
                                             <button type='submit' class='btn btn-success' name='register'>Create your account</button>
                                        </fieldset>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
     <?php
          require_once('footer.php');
     ?>
     </div>
     <script src='js/jquery-1.10.2.min.js'></script>
     <script src='twitter-bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
     
     <!--FlexSlider -->
     <script src='js/woothemes-FlexSlider-06b12f8/jquery.flexslider-min.js'></script>
     <!--Isotope Plugin -->
     <script src='js/isotope/jquery.isotope.min.js' type='text/javascript'></script>
     <!--To-Top Button Plugin -->
     <script type='text/javascript' src='js/jquery.ui.totop.js'></script>
     <!--Easing animations Plugin -->
     <script type='text/javascript' src='js/easing.js'></script>
     <!--WOW Reveal on scroll Plugin -->
     <script type='text/javascript' src='js/wow.min.js'></script>
     <!--Simple Text Rotator -->
     <script type='text/javascript' src='js/jquery.simple-text-rotator.js'></script>
     <!--The Theme Required Js -->
     <script type='text/javascript' src='js/cleanstart_theme.js'></script>
     <!--To collapse the menu -->
     <script type='text/javascript' src='js/collapser.js'></script>
     <!--Twitter Feed API -->
     <script type='text/javascript' src='js/tweetie/tweetie.min.js'></script>
     <!--Style Switcher, You propably want to remove this!-->
     <script type='text/javascript' src='js/style_switcher.js'></script>
    
</body>
</html>