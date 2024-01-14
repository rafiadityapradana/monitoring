"use strict";
$(document).ready(function () {
  var LoadData = new DataTable("#data_mechine", {
    ajax: $("#BODY").attr("URL") + "/api/data-mechine",
    order: [[2, "desc"]],
    columns: [
      {
        data: "MECHINE_ID",
        orderable: false,
      },
      {
        data: "MECHINE_NAME",
        orderable: false,
      },
      {
        data: "CREATED_AT",
      },
      {
        data: "UPDATED_AT",
        orderable: false,
      },
    ],
    processing: true,
    serverSide: true,
  });
});
