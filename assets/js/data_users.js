"use strict";
$(document).ready(function () {
  var LoadData = new DataTable("#data_user", {
    ajax: $("#BODY").attr("URL") + "api/data-users",
    // order: [[2, "desc"]],
    columns: [
      {
        data: "USERNAME",
        orderable: false,
      },
      {
        data: "ROLE_NAME",
      },
      {
        data: "CREATED_AT",
      },
      {
        data: "UPDATED_AT",
      },
    ],
    processing: true,
    serverSide: true,
  });
  $("#input_machine").hide();

  $("#role").on("change", function () {
    var selectedRows = $(this).val().split("|")[0];
    console.log("selectedRows " + selectedRows);
    selectedRows != "" && selectedRows.toString() > "1"
      ? $("#input_machine").show()
      : $("#input_machine").hide();
  });

  $("#USER_FORM").on("submit", function (event) {
    //     alert("Handler for `submit` called.");
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: $("#BODY").attr("URL") + "api/data-users",
      //  contentType: "application/json",
      data: {
        userName: $("#user_name").val(),
        password: $("#password").val(),
        roleId: $("#role").val().split("|")[1],
        machineId: $("#machine").val(),
      },
      success: function (response) {
        LoadData.ajax.reload();
        $("#USER_FORM").trigger("reset");
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
