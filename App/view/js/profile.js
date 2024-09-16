// Updating player status
document.getElementById('status').addEventListener('change', function(e) {
    const status = e.target.value;
    alert(`Player status updated to: ${status}`);
    // You can implement logic to update the status in a database or backend here
  });