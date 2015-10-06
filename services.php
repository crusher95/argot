<?php
     session_start();
     $nav=0;
     if (isset($_SESSION['client']['username'])) {
          $nav=1;
     }elseif(isset($_SESSION['client']['name'])){
          $nav=5;
     }
     require_once('header.php'); 
?>
               <div class="triangle-up-left"></div>
               <div class="triangle-up-right"></div>
          </div>
     </header>
     <div class="full_page_photo" style="background-image: url(images/services.jpg);">
          <div class="hgroup">
               <div class="hgroup_title animated bounceInUp">
                    <div class="container">
                         <h1>Services</h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp skincolored">
                    <div class="container">
                         <p>What we <strong>provide</strong> and how we go about it.</p>
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


          <!-- PRICING PLANS SECTION -->

          <section class="pricing_wrapper">
               <div class="container triangles-of-section">
                    <div class="triangle-up-left"></div>
                    <div class="square-left"></div>
                    <div class="triangle-up-right"></div>
                    <div class="square-right"></div>
               </div>
               <div class="container">
                    <h2 class="section_header fancy centered">Price Plans for services<small>there is always one that fits you</small></h2>
                    <div class="row">
                         <div class="col-sm-4 col-md-4">
                              <div class="pricing_plan wow fadeInUp">
                                   <h3>Lite<strong>Plan</strong> <small>this is where you start</small></h3>
                                   <div class="the_price"><span>$</span>60<small>/year</small></div>
                                   <div class="the_offerings">
                                        <p> <strong>10</strong> series examinations</p>
                                        <p> <strong>6</strong> months support </p>
                                   </div>
                                   <?php
                                        if ($nav!=0) {
                                             echo "<a href='services.html#' class='btn btn-primary'>Get it Now!</a>"; 
                                        }else{
                                             echo "<a href='register.php' class='btn btn-primary'>Get it Now!</a>"; 
                                        }
                                   ?>
                              </div>
                         </div>
                         <div class="col-sm-4 col-md-4">
                              <div class="pricing_plan special wow fadeInUp">
                                   <h3>Medium<strong>Plan</strong> <small>this is what you should choose</small></h3>
                                   <div class="the_price"><span>$</span>100<small>/year</small></div>
                                   <div class="the_offerings">
                                        <p> <strong>20</strong> series examinations</p>
                                        <p> <strong>1</strong> year support </p>
                                   </div>
                                   <?php
                                        if ($nav!=0) {
                                             echo "<a href='services.html#' class='btn btn-primary'>Get it Now!</a>"; 
                                        }else{
                                             echo "<a href='register.php' class='btn btn-primary'>Get it Now!</a>"; 
                                        }
                                   ?>

                              </div>
                         </div>
                         <div class="col-sm-4 col-md-4">
                              <div class="pricing_plan wow fadeInUp">
                                   <h3>Pro<strong>Plan</strong> <small>this is what you really need</small></h3>
                                   <div class="the_price"><span>$</span>350<small>/year</small></div>
                                   <div class="the_offerings">
                                        <p> <strong>unlimited</strong> series examinations</p>
                                        <p> <strong>1</strong> year support </p>
                                   </div>
                                   <?php
                                        if ($nav!=0) {
                                             echo "<a href='services.html#' class='btn btn-primary'>Get it Now!</a>"; 
                                        }else{
                                             echo "<a href='register.php' class='btn btn-primary'>Get it Now!</a>"; 
                                        }
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
          </section>

          <!-- /PRICING PLANS SECTION -->

          <?php
               require_once('footer.php');
          ?>

     </div>

     <!-- SCRIPTS -->

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
     <script type="text/javascript" src="js/twentytwenty/js/jquery.event.move.min.js"></script>
     <script type="text/javascript" src="js/twentytwenty/js/jquery.twentytwenty.min.js"></script>
     <!--The Theme Required Js -->
     <script type="text/javascript" src="js/cleanstart_theme.js"></script>
     <!--To collapse the menu -->
     <script type="text/javascript" src="js/collapser.js"></script>

     <!-- /SCRIPTS -->

     <!-- STYLE SWITCHER: You propably want to remove this!-->

     <script type="text/javascript" src="js/style_switcher.js"></script>
     <div class="style_switcher">
          <div class="gear"><i class="fa fa-gear"></i></div>
          <div class="styles">
               <h6>Style Switcher</h6>
               <ul>
                    <li class="style-classic"><i class="fa fa-circle"></i> Blue Default</li>
                    <li class="style-golden"><i class="fa fa-circle"></i> Golden</li>
                    <li class="style-purple"><i class="fa fa-circle"></i> Purple</li>
               </ul>
               <p></p>
               <ul>
                    <li class="style-onepage"><a href="onepage.html"><i class="fa fa-desktop"></i> One-Pager</a></li>
               </ul>
               <p></p>
               <ul>
                    <li><a href="documentation/index.html"><i class="fa fa-flag"></i> Documentation</a></li>
               </ul>
          </div>
     </div>

     <!-- /STYLE SWITCHER -->

</div>
</body>
</html>