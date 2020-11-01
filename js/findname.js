
$(document).ready(function () {
  // Send Search Text to the server
    $("#tenbenhnhan").keyup(function () {
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "./php/timbenhnhan.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-ten").html(response);
          },
        });
      } else {
        $("#show-ten").html("");
      }
    });

});