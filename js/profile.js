/**profile.js */
document.addEventListener("DOMContentLoaded", function () {
  $.ajax({
    url: "../actions/profile_action.php",
    method: "get",
    dataType: "json",
    success: (data, status) => {
      console.log(data, status);
      if (data.status == 200) {
        response = data;
        console.log("working");

        document.getElementById("usernameh1").innerHTML =
          response.data.username;
        document.getElementById("email").innerHTML = response.data.email;
        document.getElementById("contact").innerHTML = response.data.tel;
        document.getElementById("numreviews").innerHTML =
          response.data.reviewcount;
        document.getElementById("numposts").innerHTML = response.data.postcount;
      }
    },
    error: (error) => {
      //   var responseData = JSON.parse(error.responseText);
      //   document.getElementById("error").innerHTML = responseData.message;
      console.log(error);
    },
  });
});
