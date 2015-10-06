
               <div id='mainmenu' class='menu_container'>
                    <label class='mobile_collapser'>MENU</label>
                    <!-- Mobile menu title -->
                    <ul>
                         <?php

                         if(!isset($_SESSION)){

                             session_start();

                         }

                         if ($nav==2) {
                              echo "
                              <li><a href='client.php'>Home</a></li>
                              <li><a href='manage.php'>Manage Teachers</a></li>
                              <li><a href='reports.php'>Reports</a></li>
                              <li>";
                                   
                                        if ($nav==0) {
                                             echo"<a href='register.php'>Login/Register</a>";
                                         } else{
                                             echo "<a href='logout.php'>Logout</a></li>";
                                         }                         
                         }else if($nav==3){

                          echo "
                              <li><a href='client.php'>Home</a></li>
                              <li><a href='dashboard/index.php'>Dashboard</a></li>
                              <li><a href='reports.php'>Reports</a></li>
                              <li>";
                                   
                                        if ($nav==0) {
                                             echo"<a href='register.php'>Login/Register</a>";
                                         } else{
                                             echo "<a href='logout.php'>Logout</a></li>";
                                         }

                             $listBackground='#eee';
                             $api=new API();
                             $notification=$api->retrieveTeacherNotification(array('id'=>$_SESSION['client']['id'],'institute'=>$_SESSION['client']['institute']));
                             if($notification->count()){

                                 $button_color='btn-danger';
                                 echo "<li class='dropdown'>

                                          <button class='btn ".$button_color." dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-bell'></i></button>
                                          <ul class='dropdown-menu dropdown-menu-right'>";
                             }else{
                                 $button_color='btn-primary';

                                 echo "<li class='dropdown'>

                                          <button class='btn ".$button_color." dropdown-toggle' type='button' data-toggle='dropdown'><i class='fa fa-bell'></i></button>
                                          <ul class='dropdown-menu dropdown-menu-right'>
                                          <li style='background:".$listBackground."'><a href='#'>No new notication</a></li>";
                             }

                             foreach($notification as $document){
                                 if($document['status']=='unread'){
                                     $listBackground='#eee';
                                 }else{
                                     $listBackground='#fff';
                                 }
                                 echo "<li style='background:".$listBackground."'><a href='#'>".$document['title']."</a></li>";

                             }

                             echo "     </ul>

                                    </li>";


                         }else{                                   
                              echo "
                              <li><a href='index.php'>Home</a></li>
                              <li><a href='about.php'>About Us</a></li>
                              <li><a href='services.php'>Services</a></li>
                              <li>";
                                   
                                        if ($nav==0) {
                                             echo"<a href='register.php'>Login/Register</a>";
                                         } else{
                                             echo "<a href='client.php'>Account</a></li><li><a href='logout.php'>Logout</a></li>";
                                         }
                         }
                              
                         
                         ?>
                    </ul>
               </div>