"use strict";
$(document).ready(function () {
  var dataTable;
  initializeDataTable(
    $("#rowLimitDropdown").val(),
    $("#serverIdDropdown").val(),
    $("#mechineIdDropdown").val()
  );

  $("#serverIdDropdown").on("change", function () {
    var selectedRows = $(this).val();
    dataTable.destroy();
    initializeDataTable(
      $("#rowLimitDropdown").val(),
      selectedRows,
      $("#mechineIdDropdown").val()
    );
  });
  $("#mechineIdDropdown").on("change", function () {
    var selectedRows = $(this).val();
    dataTable.destroy();
    initializeDataTable(
      $("#rowLimitDropdown").val(),
      $("#serverIdDropdown").val(),
      selectedRows
    );
  });

  $("#rowLimitDropdown").on("change", function () {
    var selectedRows = $(this).val();
    dataTable.destroy();
    // console.log($("#serverIdDropdown").val());
    initializeDataTable(
      selectedRows,
      $("#serverIdDropdown").val(),
      $("#mechineIdDropdown").val()
    );
  });
  function initializeDataTable(rows, SERVER_ID, MECHINE_ID) {
    dataTable = $("#example").DataTable({
      pageLength: rows,
      ajax:
        $("#BODY").attr("URL") +
        "api/monitoring?serverId=" +
        (SERVER_ID === undefined ? "" : SERVER_ID) +
        "&mechineId=" +
        (MECHINE_ID === undefined ? "" : MECHINE_ID),
      order: [[0, "desc"]],
      searching: false,
      lengthChange: false,
      columns: [
        {
          data: "SERVER_NAME",
          orderable: false,
        },
        {
          data: "MECHINE_NAME",
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
        // {
        //   data: "VAR",
        //   orderable: false,
        // },
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
  }
});
