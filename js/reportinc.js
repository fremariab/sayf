/**reportinc.js */
document.addEventListener("DOMContentLoaded", function () {
  let selectedCompany = "";
  let selectedDriver = "";

  $("#companySelect").change(function () {
    selectedCompany = $(this).val();
  });

  $("#driverSelect").change(function () {
    selectedDriver = $(this).val();
  });

  $("#submit").click(function (event) {
    event.preventDefault();

    var incidentDate = $("#incidentDate").val();
    var incidentDescription = $("#incidentDescription").val();

    if (selectedDriver == null || selectedDriver.trim() === "") {
      alert("Selected Driver can't be blank");
      return false;
    }
    if (selectedCompany == null || selectedCompany.trim() === "") {
      alert("Selected Company can't be blank");
      return false;
    }
    if (incidentDate == null || incidentDate.trim() === "") {
      alert("Car Plate Number can't be blank");
      return false;
    }
    if (incidentDescription == null || incidentDescription.trim() === "") {
      alert("Review Description can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/reportinc_action.php",
      method: "post",
      data: JSON.stringify({
        selectedDriver: selectedDriver,
        selectedCompany: selectedCompany,
        incidentDescription: incidentDescription,
        incidentDate: incidentDate,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          window.location.href = "../view/driverdetails.php";
        }
      },
      error: (error) => {
        console.log(error);
        var responseData = JSON.stringify(error.responseText);
        document.getElementById("error").innerHTML = responseData.message;
      },
    });
  });
});
