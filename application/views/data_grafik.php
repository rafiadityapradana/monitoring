<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/morris.js/css/morris.css">

<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">

                    <div class="col-sm-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Data Grafik</h5>

                                   <div class="card-header-right">
                                        <!-- Button Action -->
                                   </div>
                              </div>


                              <div class="card-block">
                                   <div class="row mb-3">
                                        <div class="col-12">

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
                                                       <select name="select" class="form-control" id="dataDropdown">

                                                            <option value="">All</option>
                                                            <option value="volt">Volt</option>
                                                            <option value="ampere">Ampere</option>

                                                            <option value="frekuensi">Frekuensi</option>
                                                            <option value="watt">Watt</option>
                                                            <option value="kwh">Kwh</option>
                                                            <option value="va">Va</option>
                                                            <!-- <option value="var">Var</option> -->
                                                            <option value="powerFactor">Power</option>

                                                       </select>
                                                  </div>
                                                  <div class="col-sm-3">
                                                       <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">From</label>
                                                            <div class="col-sm-8">
                                                                 <input id='from' type="date" class="form-control">
                                                            </div>
                                                       </div>
                                                       <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">To</label>
                                                            <div class="col-sm-8">
                                                                 <input id='to' type="date" class="form-control">
                                                            </div>
                                                       </div>
                                                  </div>



                                             </div>

                                        </div>
                                   </div>
                                   <div class="card-block">
                                        <div width='100%' id="line-example"></div>
                                   </div>
                              </div>
                         </div>
                    </div>




               </div>
          </div>
     </div>
</div>

<!-- Main-body end -->
<script src="<?= base_url() ?>assets/js/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/js/morris.js/morris.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
// main.js

var worker = new Worker('<?= base_url('assets/js/') ?>background-worker.js');

var key = ["volt", "ampere", "frekuensi", "powerFactor", "kwh", "va", "var", "watt"]
FindData(
     $("#dataDropdown").val(),
     $("#serverIdDropdown").val(),
     $("#mechineIdDropdown").val(),
     $("#from").val(),
     $("#to").val()
)

$("#dataDropdown").on("change", function() {
     var selectedRows = $(this).val();
     FindData(
          selectedRows,
          $("#serverIdDropdown").val(),
          $("#mechineIdDropdown").val(),
          $("#from").val(),
          $("#to").val()
     )
});

$("#serverIdDropdown").on("change", function() {
     var selectedRows = $(this).val();
     FindData(
          $("#dataDropdown").val(),
          selectedRows,
          $("#mechineIdDropdown").val(),
          $("#from").val(),
          $("#to").val()
     );
});
$("#mechineIdDropdown").on("change", function() {
     var selectedRows = $(this).val();
     FindData(
          $("#dataDropdown").val(),
          $("#serverIdDropdown").val(),
          selectedRows,
          $("#from").val(),
          $("#to").val()
     );
});

$("#from").on("change", function() {
     var selectedRows = $(this).val();
     FindData($("#dataDropdown").val(),
          $("#serverIdDropdown").val(),
          $("#mechineIdDropdown").val(),
          selectedRows,
          $("#to").val()
     )
});
$("#to").on("change", function() {
     var selectedRows = $(this).val();
     FindData($("#dataDropdown").val(),
          $("#serverIdDropdown").val(),
          $("#mechineIdDropdown").val(),
          $("#from").val(),
          selectedRows
     )

});


var morrisLine = Morris.Line({
     element: "line-example",
     xkey: "xKeys",
     redraw: true,
     // pointSize: 0,
     parseTime: false,
     ykeys: key,
     hideHover: "auto",
     labels: [
          'volt',
          'ampere',
          'frekuensi',
          'watt',
          'kwh',
          'va',
          // 'var',
          'power factor',
     ],
     lineColors: [
          '#04BFDA',
          '#FFA84A',
          '#41E308',
          '#4EEAFF',
          '#FF4A4A',
          '#4E95FF',
          '#FB4EFF',
          '#EBEF14',
     ],
});
// Send a message to the worker

function FindData(type, SERVER_ID, MECHINE_ID, FROM, TO) {

     fetch($("#BODY").attr("URL") + "/api/monitoring/grafikline?type=" +
               type +
               "&serverId=" +
               (SERVER_ID === undefined ? "" : SERVER_ID) +
               "&mechineId=" +
               (MECHINE_ID === undefined ? "" : MECHINE_ID) +
               "&from=" +
               (FROM === undefined ? "" : FROM) +
               "&to=" +
               (TO === undefined ? "" : TO),
          )
          .then(response => response.json()) // Parse the response as JSON
          .then(result => {
               console.log(result)
               data = result.data
               morrisLine.setData(result.data)
               // worker.postMessage(data);
          })
          .catch(error => {
               // Handle any errors that occurred during the fetch
               console.log('Fetch error:', error);
          });
}
</script>