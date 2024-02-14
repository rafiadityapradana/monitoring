<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">
                    <div class="col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Data User</h5>

                                   <div class="card-header-right">
                                        <!-- Button Action -->
                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                             data-target="#modalServer">Add New Data</button>
                                   </div>
                              </div>
                              <div class="card-block">
                                   <div class="table-responsive">
                                        <table id="data_user" class="display" style="width:100%">
                                             <thead>
                                                  <tr>
                                                       <th>USERNAME</th>
                                                       <th>ROLE_NAME</th>
                                                       <th>CREATED AT</th>
                                                       <th>UPDATED AT</th>
                                                  </tr>
                                             </thead>
                                             <tfoot>
                                                  <tr>
                                                       <th>USERNAME</th>
                                                       <th>ROLE_NAME</th>
                                                       <th>CREATED AT</th>
                                                       <th>UPDATED AT</th>
                                                  </tr>
                                             </tfoot>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </div>
</div>



<form id="USER_FORM">
     <div class="modal fade" id="modalServer" data-backdrop="static" data-keyboard="false" tabindex="-1"
          aria-labelledby="modalServerLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
               <div class="modal-content">

                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="user_name">User Name</label>
                                        <input type="text" class="form-control" id="user_name">

                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" id="password">

                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="role">Role</label>
                                        <select id="role" class="form-control">
                                             <option value="">Select One Value Only</option>
                                             <?php foreach ($roles as $role): ?>
                                             <option value="<?= $role->LEVEL .
                                                 '|' .
                                                 $role->ROLE_ID ?>"><?= $role->ROLE_NAME ?>
                                             </option>
                                             <?php endforeach; ?>
                                        </select>

                                   </div>
                              </div>
                              <div class="col-md-6" id="input_machine">
                                   <div class="form-group">
                                        <label for="machine">Machine</label>
                                        <select id="machine" class="form-control">
                                             <option value="">Select One Value Only</option>
                                             <?php foreach (
                                                 $mechine
                                                 as $mec
                                             ): ?>
                                             <option value="<?= $mec->MECHINE_ID ?>"><?= $mec->MECHINE_NAME ?>
                                             </option>
                                             <?php endforeach; ?>
                                        </select>

                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
               </div>
          </div>
     </div>
</form>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/data_users.js"></script>