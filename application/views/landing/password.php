                    
                    <section class="bg-white py-15"> 
                        <div class="container">
                         <div class="text-center mb-5" data-aos="fade-down"><h1 style="font-size: 40px">Ganti Password</h1></div>
                            <form action="<?=base_url('profil/simpanpass')?>" method="POST" data-aos="fade-up" id="formadd2">
                          <div class="row justify-content-center">
                            <div class="col-xs-12 col-sm-4">
                            <?= $this->session->flashdata('msg') ?> 
                                  <div class="form-group">
                                    <label>Password Lama</label>
                                    <div class="input-group" id="show_hide_password">
                                      <input class="form-control" type="password" id="pass_lama" name="password_lama"   required>
                                      <div class="input-group-addon" >
                                        <a onclick="show3()" class="form-control" id="icon3" ><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                      </div>
                                    </div> 
                                    <div class="help-info" id="pesan1_pgw"></div>
                                  </div>   
                                  <div class="form-group">
                                    <label>Password Baru</label>
                                    <div class="input-group" id="show_hide_password">
                                      <input class="form-control" type="password" id="pass1_pgw" name="password"   required>
                                      <div class="input-group-addon" >
                                        <a onclick="show()" class="form-control" id="icon" ><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                      </div>
                                    </div>
                                    <div class="help-info" id="pesan2_pgw"></div>
                                  </div> 

                                  <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <div class="input-group" id="show_hide_password">
                                      <input class="form-control" type="password" id="pass2_pgw" name="password2"  required>
                                      <div class="input-group-addon" >
                                        <a onclick="show2()" class="form-control" id="icon2" ><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                      </div>
                                    </div>
                                    <div class="help-info" id="pesan3_pgw"></div>
                                  </div> 
                                  
                                  <center>
                                      <input type="submit" name="simpan" class="btn btn-block btn-primary btn-marketing rounded-pill lift lift-sm my-3" value="Simpan">
                                  </center> 

                                  <hr class="my-5" />
                                  <div class="text-center"><a class="btn btn-transparent-dark btn-marketing rounded-pill" href="<?=base_url('profil')?>">Kembali</a></div>
                            </div>
                          </div>
                            </form>
                        </div>
                    </section>
    

   
 <script type="text/javascript">
        function show() {
          var x = document.getElementById("pass1_pgw");
          if (x.type === "password") {
            x.type = "text";
 
             $('#icon').html('<i class="fa fa-eye" aria-hidden="true"></i>');
          } else {
            x.type = "password";
             $('#icon').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
          }
        }

        function show2() {
          var x = document.getElementById("pass2_pgw");
          if (x.type === "password") {
            x.type = "text";
 
             $('#icon2').html('<i class="fa fa-eye" aria-hidden="true"></i>');
          } else {
            x.type = "password";
             $('#icon2').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
          }
        }

        function show3() {
          var x = document.getElementById("pass_lama");
          if (x.type === "password") {
            x.type = "text";
 
             $('#icon3').html('<i class="fa fa-eye" aria-hidden="true"></i>');
          } else {
            x.type = "password";
             $('#icon3').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
          }
        }
    </script> 