// background-worker.js
self.addEventListener("message", function (e) {
  // This function will be called when the worker receives a message

  // Perform some background task with the data
  // Send the result back to the main thread
  var data_arg = [];
  e.data?.data.forEach((element) => {
    data_arg.push(element);
  });
  var i = 0;
  this.setInterval(() => {
    if (i < data_arg.length) {
      self.postMessage(data_arg[i]);
      i++;
    }
  }, 1400);
});
