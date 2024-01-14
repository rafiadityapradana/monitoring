<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">
                    <div class="col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Data Server</h5>

                                   <div class="card-header-right">

                                        <button class="btn btn-primary btn-sm" data-toggle="modal"
                                             data-target="#modalServer">Add New Data</button>
                                   </div>
                              </div>
                              <div class="card-block">
                                   <div class="table-responsive">
                                        <table id="data_server" class="display" style="width:100%">
                                             <thead>
                                                  <tr>
                                                       <th>SERVER ID</th>
                                                       <th>SERVER NAME</th>
                                                       <th>SERVER ADDRESS</th>
                                                       <th>CREATED AT</th>
                                                       <th>UPDATED AT</th>

                                                  </tr>
                                             </thead>
                                             <tfoot>
                                                  <tr>
                                                       <th>SERVER ID</th>
                                                       <th>SERVER NAME</th>
                                                       <th>SERVER ADDRESS</th>
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

<form id="SERVER_FORM">
     <div class="modal fade" id="modalServer" data-backdrop="static" data-keyboard="false" tabindex="-1"
          aria-labelledby="modalServerLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
               <div class="modal-content">

                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="server_name">Server Name</label>
                                        <input type="text" class="form-control" id="server_name">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                             with
                                             anyone else.</small>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="server_address">Server address</label>
                                        <input type="text" class="form-control" id="server_address">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                             with
                                             anyone else.</small>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/data_server.js"></script>