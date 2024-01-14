"use strict";
$(document).ready(function () {
  new DataTable("#data_user", {
    ajax: $("#BODY").attr("URL") + "/api/monitoring",
    order: [[10, "desc"]],
    columns: [
      {
        data: "SERVER_ID",
        orderable: false,
      },
      {
        data: "MECHINE_ID",
        orderable: false,
      },
      {
        data: "VOLTAGE",
        orderable: false,
      },
      {
        data: "CURRENT",
        orderable: false,
      },
      {
        data: "POWER",
        orderable: false,
      },
      {
        data: "FACTOR",
        orderable: false,
      },
      {
        data: "VA",
        orderable: false,
      },
      {
        data: "VAR",
        orderable: false,
      },
      {
        data: "FREKUENSI",
        orderable: false,
      },
      {
        data: "ENERGI",
        orderable: false,
      },
      {
        data: "CREATED_AT",
      },
    ],
    processing: true,
    serverSide: true,
  });
});
