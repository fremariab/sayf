/**profile.js */
document.addEventListener("DOMContentLoaded", function () {
  var driverId = getUrlParameter("did");

  $.ajax({
    url: "../actions/driverdetail_action.php",
    method: "get",
    data: { driverId: driverId },
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;
        console.log("working");

        document.getElementById("drivername").innerHTML =
          response.data.driver_fname + "" + response.data.driver_lname;
        document.getElementById("carplate").innerHTML =
          response.data.plate_number;
        document.getElementById("contact").innerHTML = response.data.driver_tel;
        document.getElementById("numreviews").innerHTML =
          response.data.review_count;
        document.getElementById("rhcomp").innerHTML =
          response.data.company_name;
        document.getElementById("avgrating").innerHTML =
          response.data.average_rating;
        document.getElementById("gender").innerHTML = response.data.gender;
        document.getElementById("cardetails").innerHTML =
          response.data.car_color +
          "" +
          response.data.car_make +
          "" +
          response.data.car_model;
      }
    },
    error: (error) => {
      //   var responseData = JSON.parse(error.responseText);
      //   document.getElementById("error").innerHTML = responseData.message;
      console.log(error);
    },
  });
});
