"use strict";
$(document).ready(function () {
  var LoadData = new DataTable("#data_server", {
    ajax: $("#BODY").attr("URL") + "/api/data-server",
    // order: [[3, "desc"]],

    columns: [
      {
        data: "SERVER_ID",
        orderable: false,
      },
      {
        data: "SERVER_NAME",
        orderable: false,
      },
      {
        data: "SERVER_ADDRESS",
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

  $("#SERVER_FORM").on("submit", function (event) {
    //     alert("Handler for `submit` called.");
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#BODY").attr("URL") + "/api/data-server",
      //  contentType: "application/json",
      data: {
        serverName: $("#server_name").val(),
        serverAddrss: $("#server_address").val(),
      },
      success: function (response) {
        LoadData.ajax.reload();
        $("#SERVER_FORM").trigger("reset");
        $("#modalServer").modal("hide");
        Swal.fire({
          icon: "success",
          title: "Good job!...",
          text: response.message,
        });
      },
      error: function (e) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: e.responseJSON.message,
        });
      },
    });
  });

  LoadData.on("click", "tbody tr", function () {
    let data = LoadData.row(this).data();
    // $(this).css("background", "blue");
    console.log(data);
  });
});
