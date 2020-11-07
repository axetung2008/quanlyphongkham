var tab = [0,0,0,0,0,0];
$(document).ready(function () {
  // Send Search Text to the server
      $("#thuoc1").keyup(function () {

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
          if(tab[0] == 0 ){
            $("#thuoc1").val($(this).text());
            $("#show-list").html(""); 
            tab[0]++;       
          }
          else{
            $("#show-list").html(""); 
          }
        tab[0]++;
        });
      });

      $("#thuoc2").keyup(function () {

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
          if(tab[1] == 0){
            $("#thuoc2").val($(this).text());
            $("#show-list").html("");
            tab[1]++;
          }else{
            $("#show-list").html("");
          }
        });
      });

      $("#thuoc3").keyup(function () {

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
            if(tab[2] == 0){
              $("#thuoc3").val($(this).text());
              $("#show-list").html("");
              tab[2]++;       
            }else{
              $("#show-list").html("");
            }
          });
      });

 

    $("#thuoc4").keyup(function () {

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
        if(tab[3] == 0 ){
          $("#thuoc4").val($(this).text());
          $("#show-list").html("");
          tab[3]++;         
        }
        else{
          $("#show-list").html(""); 
        }
      });
    });

    $("#thuoc5").keyup(function () {

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
        if(tab[4] == 0 ){
          $("#thuoc5").val($(this).text());
          $("#show-list").html("");
          tab[4]++;         
        }
        else{
          $("#show-list").html(""); 
        }
      });
    });

    $("#thuoc6").keyup(function () {

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
        if(tab[5] == 0 ){
          $("#thuoc6").val($(this).text());
          $("#show-list").html("");
          tab[5]++;         
        }
        else{
          $("#show-list").html(""); 
        }
      });
    }); 
});