<?php
  require_once("pengaturan/pengaturan.php");
  $judul = "Contoh";
?>
<html>
  
  <!-- Bagian head -->
  <?php include("template/head.php") ?>
  
  <body>
    <div class="wrapper">
      
      <!-- Bagian sidebar -->
      <?php include("template/header.php") ?>
      
      <!-- Bagian sidebar -->
      <?php include("template/sidebar.php") ?>
      
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            
            <!-- AWAL DARI BAGIAN KONTEN -->  
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Base Form Control</div>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group form-inline">
                      <label for="inlineinput" class="col-md-3 col-form-label">Inline Input</label>
                      <div class="col-md-9 p-0">
                        <input type="text" class="form-control input-full" id="inlineinput" placeholder="Enter Input">
                      </div>
                    </div>
                    <div class="form-group has-success">
                      <label for="successInput">Success Input</label>
                      <input type="text" id="successInput" value="Success" class="form-control">
                    </div>
                    <div class="form-group has-error has-feedback">
                      <label for="errorInput">Error Input</label>
                      <input type="text" id="errorInput" value="Error" class="form-control">
                      <small id="emailHelp" class="form-text text-muted">Please provide a valid informations.</small>
                    </div>
                    <div class="form-group">
                      <label for="disableinput">Disable Input</label>
                      <input type="text" class="form-control" id="disableinput" placeholder="Enter Input" disabled="">
                    </div>
                    <div class="form-check">
                      <label>Gender</label><br>
                      <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="optionsRadios" value="" checked="">
                      <span class="form-radio-sign">Male</span>
                      </label>
                      <label class="form-radio-label ml-3">
                      <input class="form-radio-input" type="radio" name="optionsRadios" value="">
                      <span class="form-radio-sign">Female</span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label class="control-label">
                      Static
                      </label> <!----> 
                      <p class="form-control-static">hello@themekita.com</p>
                      <!---->  <!---->
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Example select</label>
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect2">Example multiple select</label>
                      <select multiple="" class="form-control" id="exampleFormControlSelect2">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Example file input</label>
                      <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                      <label for="comment">Comment</label>
                      <textarea class="form-control" id="comment" rows="5">
                      </textarea>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" value="">
                      <span class="form-check-sign">Agree with terms and conditions</span>
                      </label>
                    </div>
                  </div>
                  <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                  </div>
                </div>
                
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Tabel</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
											<table class="table table-bordered table-head-bg-primary mt-4">
												<thead>
													<tr>
														<th>#</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th>1</th>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
													</tr>
												</tbody>
											</table>
										</div>
                  </div>
                </div>
          <!-- AKHIR DARI BAGIAN KONTEN -->  
          
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("template/script.php") ?>
    
  </body>
</html>
