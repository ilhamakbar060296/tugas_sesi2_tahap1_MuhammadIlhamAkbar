<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?=base_url('assets/css/bootstrap.css');?>" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?=base_url('assets/css/font-awesome.css');?>" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php         
        foreach ($profile as $hasil) {
            $no = $hasil->id_pasien;
        }
    ?> 
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url('pasien'); ?>">Binary pasien</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="<?= site_url('pasien/logout'); ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                <img src="<?php echo base_url().'assets/img/find_user.png'?>" class="user-image img-responsive"/>
					</li>
					<!--Menu-->
                    <li>
                        <a class="active-menu"  href="<?= site_url('pasien/dokter');?>"><i class="fa fa-user-md fa-4x"></i> DOCTOR</a>
                    </li>
                     <li>
                        <a  href="<?= site_url('pasien/profile'); ?>"><i class="fa fa-wheelchair fa-4x"></i> PROFILE</a>
                    </li>
                    <li>
                        <a  href="<?= site_url('pasien/riwayat/'.$no); ?>"><i class="fa fa-heartbeat fa-4x"></i> HISTORY </a>
                    </li>						     	
                </ul>               
            </div>            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>pasien Dashboard</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
                <a href="<?= site_url('pasien/dokter'); ?>"><div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-user-md"></i>
                </span>
                <div class="text-box" >                     
                    <p class="main-text">Doctor</p>
                    <!--<p class="text-muted">Doctor</p>-->
                </div>
             </div></a>
		     </div>
                <div class="col-md-3 col-sm-6 col-xs-6">           
                <a href="<?= site_url('pasien/profile'); ?>"><div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-wheelchair"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Profile</p>
                </div>
             </div></a>
		     </div>
                <div class="col-md-3 col-sm-6 col-xs-6">           
                <a href="<?= site_url('pasien/riwayat'); ?>"><div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="	fa fa-heartbeat"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">History</p>
                </div>
             </div></a>
		     </div>                            
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
