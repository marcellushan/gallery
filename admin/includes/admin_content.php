  <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Page
                            <small>Subheading</small>
                        </h1>
<?php

                       
//                        $result_set = User::find_user_by_id(3);
//                        while ($row = $result_set->fetch(PDO::FETCH_ASSOC))
//                        {
//                        	echo $row['username'];
//                        }

// 						$users = User::find_all_users();
// 						foreach ($users as $user) {
// 							echo $user->password;
// 						}
						$found_user = User::find_user_by_id(3);
						echo $found_user->username;
                        ?>
                      
            <!-- /.container-fluid -->

        </div>