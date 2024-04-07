/**login.js */
$("#submit").click(function (event) {
  event.preventDefault();
  var compname = $("#compname").val();
  var comploc = $("#comploc").val();
  var contactNum = $("#contactNum").val();
  var compemail = $("#compemail").val();

  if (compname == null || compname == "") {
    alert("Company Name can't be blank");
    return false;
  } else if (comploc == null || comploc == "") {
    alert("Company Location can't be blank");
    return false;
  } else if (contactNum == null || contactNum == "") {
    alert("Company Conatact Number can't be blank");
    return false;
  } else if (compemail == null || compemail == "") {
    alert("Company Email can't be blank");
    return false;
  }

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
        response = data;

        let result = "";

        response.data.forEach((element) => {
          result += "<tr>";
          result += "<td class='rhcname'>" + element.company_name + "</td>";
          result +=
            "<td class='contactnum'>" + element.contact_number + "</td>";
          result += "<td class='email'>" + element.email + "</td>";
          result += "<td class='location'>" + element.location + "</td>";
          result += "</tr>";
        });
        document.getElementById("display_rhc_data").innerHTML += result;
        window.location.href = "../admin/rhsdisplay.php";
      }
    },
    error: (error) => {
      var responseData = JSON.parse(error.responseText);
      document.getElementById("error").innerHTML = responseData.message;
    },
  });
});
