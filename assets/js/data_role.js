"use strict"; // Define table variable outside of document.ready function
$(document).ready(function () {
  new DataTable("#example", {
    ajax: $("#BODY").attr("URL") + "api/data-roles",
    // order: [[2, "desc"]],
    columns: [
      {
        class: "dt-control",
        orderable: false,
        data: null,
        defaultContent: "",
      },
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
