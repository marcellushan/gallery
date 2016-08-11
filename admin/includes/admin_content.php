  <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Page
                            <small>Subheading</small>
                        </h1>
<?php

// 			$user = new User();
			
//  			$user->username = "Example_username";
//  			$user->password = "Example_password";
//  			$user->first_name = "Example_first";
//  			$user->last_name = "Example_last";
// 				$user = User::find_user_by_id(5);
				$users = User::find_all();
				foreach ($users as $user) {
					echo $user->username;
				}
// 				$user->username;
//  			$user->save();

			//echo $user->username;

			//echo $user->username;
// 			$user->delete();
			
			//$user->last_name = "Hannah";
			
			//$user->update();
			
			
                        ?>
                      
            <!-- /.container-fluid -->

        </div>