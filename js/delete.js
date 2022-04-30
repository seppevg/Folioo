document.querySelector(".delete-profile-popup").addEventListener("click", e => {
  Swal.fire({
    title: 'Are you sure you want to delete your profile?',
    text: "You won't be able to revert this!",
    color: '#000000',
    icon: 'warning',
    iconColor: '#0600ff',
    showCancelButton: true,
    confirmButtonColor: '#F04C25',
    cancelButtonColor: '#CDCEC9',
    confirmButtonText: 'Yes, delete it!',
    width: '92%'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "delete_profile.php"
    }
  })
});