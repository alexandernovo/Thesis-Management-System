
//add and remove specialization
$(document).ready(function () {
  var index = 2;
  $("#add").on('click', function () {
    var row = $("#row-of-form").clone();
    $(".special", row).attr("id", "special" + index);
    $(".remove", row)
      .attr("id", "remove" + index)
      .show();
    $("#row-cloned").append(row);
    index++;
    //count the number of form
    $("body").on("click", ".remove", function () {
      $(this).closest("#row-of-form").remove();
    });
  });
})

$(document).ready(function () {
  $('#conf-password').on('keyup', function () {
    var password = $('#password').val();
    var confirmPassword = $('#conf-password').val();
    if (password !== confirmPassword) {
      $('#conf-password').addClass('is-invalid');
      $('#conf-password-error').addClass('text-danger').removeClass("text-success");
      $('#conf-password-error').html('Password does not match.');
    } else {
      $('#conf-password').removeClass('is-invalid');
      $('#conf-password-error').addClass('text-success').removeClass("text-danger");
      $('#conf-password-error').html('Password match');
    }
  });

  // Check for password match on form submission
  $('#my-form').submit(function () {
    var password = $('#password').val();
    var confirmPassword = $('#conf-password').val();
    if (password !== confirmPassword) {
      $('#conf-password').addClass('is-invalid');
      $('#conf-password-error').addClass('text-danger').removeClass("text-success");
      $('#conf-password-error').html('Password does not match.');
      return false; // prevent form submission
    }
    return true; // allow form submission
  });
});



$(document).ready(function () {
  var activeLink = localStorage.getItem("activeLink");
  if (activeLink) {
    if (activeLink == "Profile") {
      $(".Links").removeClass("active");
    }
    $("#" + activeLink).addClass("active");
  }
});

$(document).ready(function () {
  $(".Links").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");
    var activeLink = $(this).attr("id");
    localStorage.setItem("activeLink", activeLink);
    document.location.href = href;
  });
});

var win = navigator.platform.indexOf("Win") > -1;
if (win && document.querySelector("#sidenav-scrollbar")) {
  var options = {
    damping: "0.5",
  };
  Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
}

var ctx = document.getElementById("chart-bars").getContext("2d");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [
      {
        label: "Request",
        tension: 0.4,
        borderWidth: 0,
        borderRadius: 4,
        borderSkipped: false,
        backgroundColor: "#fff",
        data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
        maxBarThickness: 6,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    interaction: {
      intersect: false,
      mode: "index",
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
        },
        ticks: {
          suggestedMin: 0,
          suggestedMax: 500,
          beginAtZero: true,
          padding: 15,
          font: {
            size: 14,
            family: "Open Sans",
            style: "normal",
            lineHeight: 2,
          },
          color: "#fff",
        },
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
        },
        ticks: {
          display: false,
        },
      },
    },
  },
});

var ctx2 = document.getElementById("chart-line").getContext("2d");

var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke2.addColorStop(1, "rgba(20,23,39,0.2)");
gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0.0)");
gradientStroke2.addColorStop(0, "rgba(20,23,39,0)"); //purple colors

new Chart(ctx2, {
  type: "line",
  data: {
    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [
      {
        label: "Rejected",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#cb0c9f",
        borderWidth: 3,
        backgroundColor: gradientStroke1,
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6,
      },
      {
        label: "Accepted",
        tension: 0.4,
        borderWidth: 0,
        pointRadius: 0,
        borderColor: "#3A416F",
        borderWidth: 3,
        backgroundColor: gradientStroke2,
        fill: true,
        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
        maxBarThickness: 6,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      },
    },
    interaction: {
      intersect: false,
      mode: "index",
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5],
        },
        ticks: {
          display: true,
          padding: 10,
          color: "#b2b9bf",
          font: {
            size: 11,
            family: "Open Sans",
            style: "normal",
            lineHeight: 2,
          },
        },
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: false,
          drawTicks: false,
          borderDash: [5, 5],
        },
        ticks: {
          display: true,
          color: "#b2b9bf",
          padding: 20,
          font: {
            size: 11,
            family: "Open Sans",
            style: "normal",
            lineHeight: 2,
          },
        },
      },
    },
  },
});

$(document).ready(function () {
  $("#example").DataTable();
});


$(document).ready(function () {
  var college_id = $("#college").val();
  console.log(college_id);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("department").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/Research Management System/ajax/getDepartment.php", true);
  xhttp.send();
});



