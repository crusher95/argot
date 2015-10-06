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
                         <h1>Welcome <?php if($role=='institute'){echo $_SESSION['client']['username'];}else if($role=='teacher'){echo $_SESSION['client']['name'];}?></h1>
                    </div>
               </div>
               <div class="hgroup_subtitle animated bounceInUp">
                    <div class="container">
                         <p><?php if($role=='institute'){echo "Manage your teachers and keep track of your results";}else if($role=='teacher'){echo "Conduct Examinations and recieve reports";}?></p>
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
<?php
          require_once('footer.php');
     ?>
     </div>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script src="twitter-bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     <script src="dashboard/js/bootstrap.min.js"></script>

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

     <!--Style Switcher, You propably want to remove this!-->
     <script type="text/javascript" src="js/style_switcher.js"></script>
     <div class="style_switcher">
          <div class="gear"><i class="fa fa-user"></i></div>
          <div class="styles">
               <h6>Information</h6>
               <ul>
                    <li class="style-classic"><i class="fa fa-circle"></i> <?php if($role=='institute'){echo "Username:".$_SESSION['client']['username'];}else if($role=='teacher'){echo "Name:".$_SESSION['client']['name'];}?></li>
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