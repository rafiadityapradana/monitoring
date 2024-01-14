<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/morris.js/css/morris.css">

<!-- Main-body start -->
<div class="main-body">
     <div class="page-wrapper">
          <div class="page-body">
               <div class="row">


                    <div class="col-md-12 col-lg-12">
                         <div class="card">
                              <div class="card-header">
                                   <h5>Live Chart</h5>

                                   <!-- <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                             <li>
                                                  <i class="fa fa fa-wrench open-card-option"></i>
                                             </li>
                                             <li>
                                                  <i class="fa fa-window-maximize full-card"></i>
                                             </li>
                                             <li>
                                                  <i class="fa fa-minus minimize-card"></i>
                                             </li>
                                             <li>
                                                  <i class="fa fa-refresh reload-card"></i>
                                             </li>

                                        </ul>
                                   </div> -->
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
<!-- Main-body end -->
<script src="<?= base_url() ?>assets/js/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/js/morris.js/morris.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
// main.js

var worker = new Worker('<?= base_url('assets/js/') ?>background-worker.js');

/*Line chart*/
// Receive messages from the worker


var morrisLine = Morris.Line({
     element: "line-example",
     xkey: "xKeys",
     redraw: true,
     // pointSize: 0,
     parseTime: false,
     ykeys: ["volt", "ampere", "frekuensi", "watt", "kwh", "va", "var", "powerFactor"],
     hideHover: "auto",
     labels: [
          'volt',
          'ampere',
          'frekuensi',
          'watt',
          'kwh',
          'va',
          'var',
          'power factor',
     ],
     lineColors: [
          '#04BFDA',
          '#FFA84A',
          '#41E308',
          '#EBEF14',
          '#FF4A4A',
          '#4E95FF',
          '#FB4EFF',
          '#4EEAFF',
     ],
});

// 
var data = [];
// Send a message to the worker
fetch($("#BODY").attr("URL") + "api/monitoring/grafik")
     .then(response => response.json()) // Parse the response as JSON
     .then(result => {
          data = result.data
          morrisLine.setData(result.data)
          // worker.postMessage(data);
     })
     .catch(error => {
          // Handle any errors that occurred during the fetch
          console.log('Fetch error:', error);
     });



worker.addEventListener('message', function(e) {

     if (data.length < 9) {
          data.push(e.data)
     } else {
          for (var i = 0, l = 8; i < l; i++) {
               data[i] = data[i + 1]
          }
          data[8] = e.data
     }

     morrisLine.setData(data)

});
Pusher.logToConsole = true;

var pusher = new Pusher('353ffd743a6c256848cc', {
     cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('server-event', function(data) {
     worker.postMessage(data);
});
</script>