"use strict";
$(document).ready(function () {
  new DataTable("#data_user", {
    ajax: $("#BODY").attr("URL") + "api/data-roles",
    // order: [[2, "desc"]],
    columns: [
      {
        data: "ROLE_NAME",
        orderable: false,
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
});
