// Simulating real-time data for performance comparison
const ctx = document.getElementById('performanceChart').getContext('2d');
const performanceChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
    datasets: [
      {
        label: 'Your Performance',
        data: [10, 15, 13, 20, 25],
        borderColor: 'rgba(75, 192, 192, 1)',
        fill: false,
      },
      {
        label: 'Average Performance',
        data: [12, 14, 18, 22, 20],
        borderColor: 'rgba(153, 102, 255, 1)',
        fill: false,
      },
      {
        label: 'Highest Performance',
        data: [16, 20, 22, 24, 28],
        borderColor: 'rgba(255, 99, 132, 1)',
        fill: false,
      }
    ]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Performance Comparison'
    }
  }
});

// Handling sport history submission
document.getElementById('historyForm').addEventListener('submit', function(e) {
  e.preventDefault();
  alert("Sport history submitted for coach approval.");
  // You can implement logic to send data to a server here
});

// Uploading certificates and medals
document.getElementById('certificateUpload').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = document.createElement('img');
      img.src = e.target.result;
      document.getElementById('certificatesGallery').appendChild(img);
    };
    reader.readAsDataURL(file);
  }
});

// Displaying weakness notes
document.getElementById('weaknessNotes').addEventListener('change', function() {
  alert("Weakness notes updated.");
  // Implement logic to save weakness notes
});
