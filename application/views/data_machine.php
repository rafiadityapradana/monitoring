<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">
                    <div class="col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Data Machine</h5>

                                   <div class="card-header-right">
                                        <!-- Button Action -->
                                   </div>
                              </div>
                              <div class="card-block">
                                   <div class="table-responsive">
                                        <table id="data_mechine" class="display" style="width:100%">
                                             <thead>
                                                  <tr>

                                                       <th>MECHINE ID</th>
                                                       <th>MECHINE NAME</th>
                                                       <th>CREATED AT</th>
                                                       <th>UPDATED AT</th>
                                                  </tr>
                                             </thead>
                                             <tfoot>
                                                  <tr>
                                                       <th>MECHINE ID</th>
                                                       <th>MECHINE NAME</th>
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


<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/data_machine.js"></script>