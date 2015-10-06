<?php
     session_start();
     $nav=0;
     if (isset($_SESSION['client']['username'])) {
          $nav=5;
     }elseif(isset($_SESSION['client']['name'])){
          $nav=5;
     }
     require_once('header.php'); 
?>
     <section id='slider_wrapper' class='slider_wrapper full_page_photo'>
          <div id='main_flexslider' class='flexslider'>
               <ul class='slides'>
                    <li class='item' style='background-image: url(images/1.jpg)'>
                         <div class='container'>
                              <div class='carousel-caption animated bounceInUp'>
                                   <h1>A <strong>friendly</strong> interface<br>
                                        you can trust &amp; build upon!</h1>
                                   <p class='lead skincolored'>A.R.G.O.T. is quite flexible when it comes to interface.You can easily conduct exams using our refined system.</p>
                              </div>
                         </div>
                    </li>
                    <li class='item' style='background-image: url(images/2.jpg)'>
                         <div class='container'>
                              <div class='carousel-caption animated bounceInUp'>
                                   <h1>Free Service<br>
                                        for <strong>all the Esteemed Institutes</strong></h1>
                                   <p class='lead skincolored'>As a promotional offer we are providing free service to all the first few registering Institutes.</p>
                              </div>
                         </div>
                    </li>

               </ul>
          </div>
     </section>
     <div class='main'>
          <div class='container triangles-of-section'>
               <div class='triangle-up-left'></div>
               <div class='square-left'></div>
               <div class='triangle-up-right'></div>
               <div class='square-right'></div>
          </div>
          <section class='features_teasers_wrapper'>
               <div class='container'>
                    <div class='row'>
                         <div class='feature_teaser col-sm-4 col-md-4'> <img alt='responsive' src='images/phone-v2.png'>
                              <h3>Mobile Compatibility</h3>
                              <p>The awesome responsive design helps in maintaining the beauty of the site even on small mobile phones</p>
                         </div>
                         <div class='feature_teaser col-sm-4 col-md-4'> <img alt='responsive' src='images/lib-v2.png'>
                              <h3>Advanced Reports</h3>
                              <p>Our advanced report generation system tracks and co-ordinates with both the teacher and students to produce useful reports.</p>
                         </div>
                         <div class='feature_teaser col-sm-4 col-md-4'> <img alt='responsive' src='images/rocket_trans-v2.png'>
                              <h3>#KickStart</h3>
                              <p>Our motto is to kickstart the trend of Online Examination.Show some support <b>#kickstart</b> and save paper.</p>
                         </div>
                    </div>
               </div>
          </section>

          <!-- CALL TO ACTION SECTION -->

          <section class='call_to_action dark_section'>
               <div class='container'>
                    <h3>We make your work <strong><span class='rotate'>safer, easier, organized</span></strong></h3>
                    <h4>Register to be the part of the community</h4>
                    <a class='btn btn-primary' href='register.php'>Register</a> </div>
          </section>

          <!-- /CALL TO ACTION SECTION -->
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

     
</div>
</body>
</html>
