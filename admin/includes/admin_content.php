  <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Page
                            <small>Subheading</small>
                        </h1>
<?php
                        $user = new User();
                        $user->find_all_users();
                        print_r($user);
                        ?>
                      
            <!-- /.container-fluid -->

        </div>