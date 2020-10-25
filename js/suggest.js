
$(document).ready(function () {
  // Send Search Text to the server
    $("#thuoc1").keyup(function () {

      // if($("#thuoc1").parent().is("#tab1")){
      //   first++;
      // }
      let searchText = $(this).val();
      if (searchText != "") {
        $.ajax({
          url: "./php/suggest.php",
          method: "post",
          data: {
            query: searchText,
          },
          success: function (response) {
            $("#show-list").html(response);
          },
        });
      } else {
        $("#show-list").html("");
      }
      $(document).on("click", "a", function () {
        //if(first != 0 && secnd == 0){
          $("#thuoc1").val($(this).text());
          $("#show-list").html("");
          //first--;         
        // }
        // else{
        //   $("#show-list").html(""); 
        //}
      });
    }); 
});