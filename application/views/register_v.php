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

</head>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2>Patient Registration</h2>
                <h5>( Register yourself to get access )</h5>
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  New User ? Register Yourself </strong>
                        <?php echo validation_errors(); ?>
                        <?php echo form_open_multipart('Auth/simpan')?>   
                            </div>
                            <div class="panel-body">
                                <form role="form">
                                    <br/><?php echo $this->session->flashdata('notif') ?>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" name="nama" class="form-control" placeholder="Your Name" required/>
                                        </div>                                     
                                        <div class="form-group input-group">                                        
                                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            <input type="date" name="tanggal" class="form-control" required/>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">#</span>
                                            <input type="radio" name="kelamin" value="Laki-Laki" required/>Laki-Laki
                                            <input type="radio" name="kelamin" value="Perempuan" required/>Perempuan
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <input type="text" name="alamat" class="form-control" placeholder="Your Address" required />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" name="telp" class="form-control" placeholder="Your Telp" required />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>
                                            <input type="text" name="email" class="form-control" placeholder="Your Email" required/>
                                        </div>                                        
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="pass" class="form-control" placeholder="Enter Password" required/>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="pass2" class="form-control" placeholder="Retype Password" required/>
                                        </div>
                                     <button type="submit" class="btn btn-success ">Register Me</button>
                                    <hr />
                                    Already Registered ?  <a href="<?= site_url() ?>Auth/index" >Login here</a>
                                    </form>
                                    <?php echo form_close()?>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
