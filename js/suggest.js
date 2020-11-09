$(document).ready(function () {
  // Send Search Text to the server
  var tabCurrent = 1;
  $(".tab-current").on("click", function () {
    switch (this.id) {
      case 'type1':
        tabCurrent = 1;
        break;
      case 'type2':
        tabCurrent = 2;
        break;
      case 'type3':
        tabCurrent = 3;
        break;
      case 'type4':
        tabCurrent = 4;
        break;
      case 'type5':
        tabCurrent = 5;
        break;
      case 'type6':
        tabCurrent = 6;
        break;
    }
  });

  function callAjax(thuocId) {
    let cutString = thuocId.substr(thuocId.length - 1);
    let searchText = $('#' + thuocId).val();
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
    }
    else {
      $("#show-list").html("");
    }

    $(document).on("click", "a", function () {
      if (tabCurrent == cutString) {
        $('#' + thuocId).val($(this).text());
        $("#show-list").html("");
      }
      else {
        $("#show-list").html("");
      }
    });
  }


  $("#thuoc1").keyup(function () {
    callAjax('thuoc1');
  });
  $("#thuoc2").keyup(function () {
    callAjax('thuoc2');
  });
  $("#thuoc3").keyup(function () {
    callAjax('thuoc3');
  });
  $("#thuoc4").keyup(function () {
    callAjax('thuoc4');
  });
  $("#thuoc5").keyup(function () {
    callAjax('thuoc5');
  });
  $("#thuoc6").keyup(function () {
    callAjax('thuoc6');
  });

});