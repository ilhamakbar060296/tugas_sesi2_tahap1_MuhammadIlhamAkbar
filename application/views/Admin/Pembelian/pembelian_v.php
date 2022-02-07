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
                    <center><h2> Pembelian Obat</h2></center>
                    <a href="<?php echo base_url().'admin/tambah_pembelian/'?>" class="btn btn-md btn-success"> Tambah Nota Pembelian </a>
                    <hr>
                    <div class="container">
                        <?php echo $this->session->flashdata('notif') ?>                          
                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered table-hover" style="width: 89%;">
                                <thead>
                                <tr>
                                    <th>No.</th>                                    
                                    <th>NAMA OBAT</th>
                                    <th>HARGA BELI</th>
                                    <th>JUMLAH BELI</th>
                                    <th>TOTAL BELI</th>
                                    <th>TANGGAL BELI</th>
                                    <th>AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $no = 1;
                                    $total = 0;
                                    foreach ($list as $hasil) {
                                ?> 
                                <tr>
                                    <td><?php echo $no++ ?></td>                                    
                                    <td><?php echo $hasil->nama_obat ?></td>
                                    <td><?php echo $hasil->harga_beli ?></td>
                                    <td><?php echo $hasil->jumlah_beli ?></td>
                                    <td><?php echo $hasil->total_beli ?></td>
                                    <td><?php echo $hasil->tgl_beli ?></td>
                                    <td>
                                    <a href="<?php echo base_url().'admin/edit_pembelian/'?><?php echo $hasil->no?>" class="btn btn-sm btn-success"> Edit </a>              
                                    <a href="<?php echo base_url().'admin/hapus_pembelian/'?><?php echo $hasil->no?>" class="btn btn-sm btn-danger"> Hapus </a>
                                    </td>
                                </tr>
                                <?php 
                                    $total += $hasil->total_beli;
                                } ?>
                                </tbody>                
                            </table>                                                            
                        </div>
                        <h3><strong><?php echo "Total Pembelian anda : Rp.".number_format($total , 0, ',', '.')?></strong></h3>
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
