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
     <div class="full_page_photo" style="background-image: url(images/about_us.jpg);">
          <div class="hgroup">
               <div class="hgroup_title animated bounceInUp">
                    <div class="container">
                         <h1 class="">About us</h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp skincolored">
                    <div class="container">
                         <p>We are a <strong>team of </strong>enthusiasts and aim at providing full support towards the digitization of education. </p>
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

          <!-- HORIZONTAL TEASER -->

          <section class="horizontal_teaser">
               <div class="container">
                    <div class="row">
                         <div class="col-sm-12 col-md-4 horizontal_teaser_left">
                              <h3>We care for our work</h3>
                              <p>According to studies, India and China will lead the growth in project management roles, generating about 4 million and 8.1 million roles, respectively, by 2020. Hence, the business looks to grow from now on.</p>
                              <p>The education sector in India is no longer bound to just classrooms. Thanks to new start-ups and higher internet and smartphone penetration, the online learning space in India is growing manifold.</p>
                         </div>
                         <div class="col-sm-12 col-md-8 horizontal_teaser_right">
                              <iframe width="680" height="315" src="https://www.youtube.com/embed/bZ0JJmTBpcc" frameborder="0" allowfullscreen></iframe>
                         </div>
                    </div>
               </div>
          </section>

          <!-- /HORIZONTAL TEASER -->

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
     <!--The Theme Required Js -->
     <script type="text/javascript" src="js/cleanstart_theme.js"></script>
     <!--To collapse the menu -->
     <script type="text/javascript" src="js/collapser.js"></script>
     <!--Twitter Feed API -->
     <script type="text/javascript" src="js/tweetie/tweetie.min.js"></script>
     <!--Style Switcher, You propably want to remove this!-->
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
     <!--END Style Switcher-->
</div>
</body>
</html>