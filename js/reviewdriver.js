/**reviewdriver.js */
document.addEventListener("DOMContentLoaded", function () {
  const stars = document.querySelectorAll(".stars i");

  let selectedStar = 0;
  let selectedCompany = "";

  stars.forEach((star, index1) => {
    star.addEventListener("click", () => {
      selectedStar = index1 + 1;
      stars.forEach((star, index2) => {
        index1 >= index2
          ? star.classList.add("active")
          : star.classList.remove("active");
      });
    });
  });

  $("#rideHailingCompany").change(function () {
    selectedCompany = $(this).val();
  });
  $("#submit").click(function (event) {
    event.preventDefault();
    var dfname = $("#firstName").val();
    var dlname = $("#lastName").val();
    var contactNum = $("#phone_number").val();
    var starrating = selectedStar;
    selectedCompany = selectedCompany;
    var gender = $("input[name='gender']:checked").val();
    var carMake = $("#carMake").val();
    var carModel = $("#carModel").val();
    var carColor = $("#carColor").val();
    var plateNumber = $("#plateNumber").val();
    var reviewDescription = $("#ReviewDescription").val();

    if (dfname == null || dfname.trim() === "") {
      alert("Driver First Name can't be blank");
      return false;
    }
    if (dlname == null || dlname.trim() === "") {
      alert("Driver Last Name can't be blank");
      return false;
    }
    if (contactNum == null || contactNum.trim() === "") {
      alert("Phone Number can't be blank");
      return false;
    }
    if (selectedCompany == null || selectedCompany.trim() === "") {
      alert("Selected Company can't be blank");
      return false;
    }
    if (gender == null || gender.trim() === "") {
      alert("Gender can't be blank");
      return false;
    }
    if (carMake == null || carMake.trim() === "") {
      alert("Car Make can't be blank");
      return false;
    }
    if (carModel == null || carModel.trim() === "") {
      alert("Car Model can't be blank");
      return false;
    }
    if (carColor == null || carColor.trim() === "") {
      alert("Car Color can't be blank");
      return false;
    }
    if (plateNumber == null || plateNumber.trim() === "") {
      alert("Car Plate Number can't be blank");
      return false;
    }
    if (reviewDescription == null || reviewDescription.trim() === "") {
      alert("Review Description can't be blank");
      return false;
    }

    $.ajax({
      url: "../actions/addrhc_action.php",
      method: "post",
      data: JSON.stringify({
        dfname: dfname,
        dlname: dlname,
        contactNum: contactNum,
        gender: gender,
        rating: starrating,
        rhcomp: selectedCompany,
        carMake: carMake,
        carModel: carModel,
        carColor: carColor,
        plateNumber: plateNumber,
        reviewDescription: reviewDescription,
      }),
      dataType: "json",
      success: (data, status) => {
        console.log(data, status);
        if (data.status == 201) {
          // response = data;

          // let result = "";

          // response.data.forEach((element) => {
          //   result += "<tr>";
          //   result += "<td class='rhcname'>" + element.company_name + "</td>";
          //   result +=
          //     "<td class='contactnum'>" + element.contact_number + "</td>";
          //   result += "<td class='email'>" + element.email + "</td>";
          //   result += "<td class='location'>" + element.location + "</td>";
          //   result += "</tr>";
          // });
          window.location.href =
            "../view/driverdetail.php?data=" + encodeURIComponent(result);
        }
      },
      error: (error) => {
        console.log(error);
        var responseData = JSON.parse(error.responseText);
        document.getElementById("error").innerHTML = responseData.message;
      },
    });
  });
});
