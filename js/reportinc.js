/**reportinc.js */
document.addEventListener("DOMContentLoaded", function () {
  let selectedDriver = "";

  $("#driverSelect").change(function () {
    selectedDriver = $(this).val();
  });

  $("#submit").click(function (event) {
    event.preventDefault();
    var incidentDate = $("#incidentDate").val();

    var selectedDate = new Date(incidentDate);
    var currentDate = new Date();
    var minDate = new Date("1999-01-01");
    if (selectedDate > currentDate || selectedDate < minDate) {
      alert("Please select a date between 1999-01-01 and today.");
    }
    var incidentDescription = $("#incidentDescription").val();

    if (selectedDriver == null || selectedDriver.trim() === "") {
      alert("Selected Driver can't be blank");
      return false;
    }

    if (incidentDate == null || incidentDate.trim() === "") {
      alert("IncidentDate can't be blank");
      return false;
    }
    if (incidentDescription == null || incidentDescription.trim() === "") {
      alert("Incident Description can't be blank");
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

          let result = "";
        }
        window.location.href = "../view/viewreports.php";
      },
      error: (error) => {
        console.log(error);
        var responseData = JSON.stringify(error.responseText);
        document.getElementById("error").innerHTML = responseData.message;
      },
    });
  });
});
