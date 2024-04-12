/**reportinc.js */
document.addEventListener("DOMContentLoaded", function () {
  let selectedDriver = "";

  $("#error").html("");
  $("#success").html("");

  $("#driverSelect").change(function () {
    selectedDriver = $(this).val();
  });

  $("#submit").click(function (event) {
    event.preventDefault();
    var incidentDate = $("#incidentDate").val();

    var selectedDate = new Date(incidentDate);
    var currentDate = new Date();
    var minDate = new Date("2010-01-01");
    if (selectedDate > currentDate || selectedDate < minDate) {
      $("#error").html("Please select a date between 1999-01-01 and today.");
      return false;
    }
    var incidentDescription = $("#incidentDescription").val();

    if (selectedDriver == null || selectedDriver.trim() === "") {
      $("#error").html("Selected Driver can't be blank");
      return false;
    }

    if (incidentDate == null || incidentDate.trim() === "") {
      $("#error").html("Incident Date can't be blank");
      return false;
    }
    if (incidentDescription == null || incidentDescription.trim() === "") {
      $("#error").html("Incident Description can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/reportinc_action.php",
      method: "post",
      data: JSON.stringify({
        selectedDriver: selectedDriver,
        incidentDescription: incidentDescription,
        incidentDate: incidentDate,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          response = data;

          var message = data.message;
          var messageElement = '<div class="alert">' + message + "</div>";
          $("#success").append(messageElement);
          setTimeout(function () {
            $(".alert").remove();
          }, 20000);
        }
        window.location.href = "../view/viewreports.php";
      },
      error: (error) => {
        $("#error").html(error.error);
      },
    });
  });
});
