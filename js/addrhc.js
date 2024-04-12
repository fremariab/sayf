/**addrhc.js */
$("#submit").click(function (event) {
  event.preventDefault();
  var compname = $("#compname").val();
  var comploc = $("#comploc").val();
  var contactNum = $("#contactNum").val();
  var compemail = $("#compemail").val();

  if (compname == null || compname == "") {
    $("#error").html("Company Name can't be blank");
    return false;
  } else if (comploc == null || comploc == "") {
    $("#error").html("Company Location can't be blank");
    return false;
  } else if (contactNum == null || contactNum == "") {
    $("#error").html("Company Conatact Number can't be blank");
    return false;
  } else if (compemail == null || compemail == "") {
    $("#error").html("Company Email can't be blank");
    return false;
  }

  $("#error").html("");
  $("#success").html("");

  $.ajax({
    url: "../actions/addrhc_action.php",
    method: "post",
    data: JSON.stringify({
      compname: compname,
      comploc: comploc,
      contactNum: contactNum,
      compemail: compemail,
    }),
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 201) {
        var message = data.message;
        var messageElement = '<div class="alert">' + message + "</div>";
        $("#success").append(messageElement);
        setTimeout(function () {
          $(".alert").remove();
        }, 10000);
        window.location.href = "../admin/rhcdisplay.php";
      } else {
        $("#error").html(data.error);
      }
    },
    error: (error) => {
      $("#error").html(error.error);
    },
  });
});
