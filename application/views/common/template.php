<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="SSJ Dashboard" />
        <meta name="author" content="Acinonyx Technologies" />
        <title><?php echo COPYRIGHTS_NAME; ?></title>
        <link href="<?php echo base_url(); ?>assets/css/styles.css?updated=<?php echo UPDATED_ON;?>" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>codebase/alerts/bootstrap/css/bootstrap-msg.css?updated=<?php echo UPDATED_ON;?>" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>codebase/datatables/dataTables.bootstrap4.css?updated=<?php echo UPDATED_ON;?>" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>codebase/atLib/core.css?updated=<?php echo UPDATED_ON;?>" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <?php require "topbar.php"; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php require "sidebar.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <?php
                    if(isset($content)){
                        $this->load->view($content);
                    }
                ?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"></div>
                            <div><? echo COPYRIGHTS; ?></div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            var baseUrl = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url(); ?>codebase/jQuery/JQuery-V3.4.1.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/bootstrap/4.5.3/js/bootstrap.bundle.min.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/font-awesome/5.15.1/js/all.min.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/alerts/bootstrap/js/bootstrap-msg.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/datatables/jquery.dataTables.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/datatables/dataTables.bootstrap4.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>codebase/atLib/core.js?updated=<?php echo UPDATED_ON;?>"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js?updated=<?php echo UPDATED_ON;?>"></script>
    </body>
</html>