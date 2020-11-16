$(document).ready(function () {
  // Send Search Text to the server
    let searchText = "";
    $.ajax({
          url: "./php/danhsachthuoc.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-tenthuoc").html(response);
          },
    });
    $("#timkiem").keyup(function () {
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "./php/danhsachthuoc.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-tenthuoc").html(response);
          },
        });
      } else {
        $("#show-tenthuoc").html("");
      }
      if (searchText == ""){
        $.ajax({
          url: "./php/danhsachthuoc.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-tenthuoc").html(response);
          },
        });
      }
    });

});