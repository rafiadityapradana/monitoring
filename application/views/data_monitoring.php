<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">

                    <div class="col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Data Monitoring</h5>

                                   <div class="card-header-right">
                                        <!-- Button Action -->
                                   </div>
                              </div>


                              <div class="card-block">
                                   <div class="row mb-3">
                                        <div class="col-8">

                                             <div class="form-group row">
                                                  <div class="col-sm-3">
                                                       <select name="select" class="form-control" id="serverIdDropdown">
                                                            <option value="">SERVER ID</option>
                                                            <?php foreach (
                                                                $server
                                                                as $sr
                                                            ): ?>
                                                            <option value=<?= $sr->SERVER_ID ?>><?= $sr->SERVER_NAME ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                       </select>
                                                  </div>
                                                  <div class="col-sm-3">
                                                       <select name="select" class="form-control"
                                                            id="mechineIdDropdown">
                                                            <option value="">MECHINE ID</option>
                                                            <?php foreach (
                                                                $mechine
                                                                as $me
                                                            ): ?>
                                                            <option value=<?= $me->MECHINE_ID ?>>
                                                                 <?= $me->MECHINE_NAME ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                       </select>
                                                  </div>
                                                  <div class="col-sm-3">
                                                       <select name="select" id="rowLimitDropdown" class="form-control">
                                                            <option value="10">10</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="500">500</option>
                                                            <option value="1000">1000</option>

                                                       </select>
                                                  </div>


                                             </div>

                                        </div>
                                   </div>
                                   <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                             <thead>
                                                  <tr>
                                                       <th>SERVER NAME</th>
                                                       <th>MECHINE NAME</th>
                                                       <th>VOLTAGE</th>
                                                       <th>CURRENT</th>
                                                       <th>POWER</th>
                                                       <th>FACTOR</th>
                                                       <th>VA</th>
                                                       <!-- <th>VAR</th> -->
                                                       <!-- <th>FREKUENSI</th> -->

                                                       <th>ENERGI</th>
                                                       <th>CREATED AT</th>
                                                  </tr>
                                             </thead>
                                             <tfoot>
                                                  <tr>
                                                       <th>SERVER NAME</th>
                                                       <th>MECHINE NAME</th>
                                                       <th>VOLTAGE</th>
                                                       <th>CURRENT</th>
                                                       <th>POWER</th>
                                                       <th>FACTOR</th>
                                                       <th>VA</th>
                                                       <!-- <th>VAR</th> -->
                                                       <!-- <th>FREKUENSI</th> -->

                                                       <th>ENERGI</th>
                                                       <th>CREATED AT</th>
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
<script type="text/javascript" src="<?= base_url() ?>assets/js/data_monitoring.js"></script>