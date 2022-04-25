document.querySelector(".delete-profile-popup").addEventListener("click", e => {
    console.log("👍");

    Swal.fire({
        title: 'Are you sure you want to delete your profile?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#F04C25',
        cancelButtonColor: '#CDCEC9',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            window.location = "delete_profile.php"
          )
        }
      })
});