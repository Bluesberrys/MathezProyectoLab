document.addEventListener("DOMContentLoaded", function () {
  const userDropdownToggle = document.getElementById("userDropdownToggle");
  const userDropdown = document.getElementById("userDropdown");

  userDropdownToggle.addEventListener("click", function (e) {
    e.stopPropagation();
    userDropdown.classList.toggle("active");
  });

  // Close the dropdown when clicking outside of it
  document.addEventListener("click", function (e) {
    if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
      userDropdown.classList.remove("active");
    }
  });
});
