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
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url('admin'); ?>">Binary admin</a> 
            </div>
<div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="<?= site_url('admin/logout'); ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
                        <a class="active-menu"  href="<?= site_url('admin/dokter');?>"><i class="fa fa-user-md fa-4x"></i> DOCTOR</a>
                    </li>
                     <li>
                        <a  href="<?= site_url('admin/pasien'); ?>"><i class="fa fa-wheelchair fa-4x"></i> PATIENT</a>
                    </li>
                    <li>
                        <a  href="<?= site_url('admin/penyakit'); ?>"><i class="fa fa-heartbeat fa-4x"></i> DISEASE </a>
                    </li>
						   <li  >
                        <a   href="<?= site_url('admin/obat'); ?>"><i class="fa fa-plus-square fa-4x"></i> MEDIC </a>
                    </li>		
                    <li  >
                        <a href="#"><i class="fa fa-hospital-o fa-4x"></i> POLICLINIC<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?= site_url('admin/beli'); ?>">Buy Medicine</a>
                            </li>
                            <li>
                                <a href="<?= site_url('admin/jual'); ?>">Sell Medicine</a>
                            </li>                            
                        </ul>
                      </li>  	
                </ul>               
            </div>            
        </nav> 
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">                 
                    <center><h2> Ubah Data Penyakit </h2></center>                    
                    <hr>
                    <div class="container">
                        <div class="col-mid-12">
                            <?php echo form_open('admin/update_penyakit');?>								
                            
                            <table id="table" class="table table-striped table-bordered table-hover" style="width: 89%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>						
                                    </tr>
                                </thead>
                                <tbody>					
                                    <tr>
                                        <div class="form-group">
                                        <td><label for="text">Nama penyakit :</label></td>
                                        <td><input type="text" name="nama" value="<?php echo $get->nama_penyakit ?>" class="form_control">
                                        <td><input type="hidden" value="<?php echo $get->id_penyakit ?>" name="id"></td>
                                        </td>
                                        </div>												
                                    </tr>
                                    <tr>
                                        <div class="form-group">
                                        <td><label for="text">Daerah Penyakit :</label></td>
                                        <td><input type="text" name="tipe" value="<?php echo $get->daerah_penyakit ?>" class="form_control" placeholder="Kepala, Hidung, Telinga, Tenggorokan">
                                        </td>
                                        </div>												
                                    </tr>
                                    <tr>
                                        <div class="form-group">
                                        <td><label for="text">Gejala :</label></td>
                                        <td><input type="text" name="gejala" value="<?php echo $get->gejala ?>" class="form_control" placeholder="Ringan, Sedang, Berat">
                                        </div>												
                                    </tr>                                    
                                    <tr>
                                        <td><button type="submit" class="btn btn-md btn-success">Simpan</button></td>
                                        <td><button type="reset" class="btn btn-md btn-warning"> Reset</button></td>
                                    </tr>                                    
                                </tbody>
                            </table>
                            <form>
                            <input type="button" value="Go back!" onclick="history.back()">
                            </form>
                            <?php echo form_close()?>
                        </div>
                    </div>
                <!--/row -->
                </div>
            <!--/page-inner -->
            </div>
        <!--/page-wrapper -->
        </div>

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
