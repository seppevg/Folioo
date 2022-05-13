window.onload = function () {
  var variable = document.getElementById("alert").value;
  console.log(variable);
  if (variable == "1") {
    Swal.fire({
      icon: 'error',
      title: 'Warning',
      text: 'A moderator has send you a warning. Click confirm button to see your warning',
      confirmButtonText: "Show warning",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = `warn_user.php`;
      }
    });
  }
}


