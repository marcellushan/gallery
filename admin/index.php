<?php include("includes/header.php"); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Visit Home Page</a>
            </div>
            
            
 <?php include 'includes/top_nav.php';?>
 
 <?php include 'includes/side_nav.php';?>
            
            
         
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

<?php include 'includes/admin_content.php';?>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>