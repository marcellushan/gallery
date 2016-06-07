  <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Page
                            <small>Subheading</small>
                        </h1>
<?php
                        $users = new User();
                        $result_set = $users->find_all_users();
                        //print_r($users);
                        //$row = $result_set->fetch(PDO::FETCH_ASSOC);
                        //foreach($result_set as $user)
                       while ($row = $result_set->fetch(PDO::FETCH_ASSOC))
                       {
                       	echo $row['username'];
                       }
                        ?>
                      
            <!-- /.container-fluid -->

        </div>