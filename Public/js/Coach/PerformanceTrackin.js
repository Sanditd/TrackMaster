function navigateTo(page) {
    window.location.href = page;
  }
  
  function validateSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput.value.trim() === "") {
      alert("Please enter a player's name.");
      return false; // Prevent form submission
    }
    return true; // Allow form submission
  }
  