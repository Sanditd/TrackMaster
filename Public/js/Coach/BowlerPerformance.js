// Manually set the new strength value
const newStrength = 85; // Change this value to update the circle
const maxStrength = 100; // Maximum strength value for calculation
const strengthValueElement = document.getElementById("strengthValue");
const strengthCircle = document.getElementById("strengthCircle");

// Update the text value
strengthValueElement.textContent = newStrength;

// Calculate the percentage for the circle
const percentage = (newStrength / maxStrength) * 100;

// Update the circle background with conic-gradient
strengthCircle.style.background = `conic-gradient(
  #0047FF 0%,
  #0047FF ${percentage}%,
  #f0f0f3 ${percentage}%
)`;

// Manually set the new strength value
const newattendance = 60; // Change this value to update the circle
const maxattendance = 100; // Maximum strength value for calculation
const attendanceValueElement = document.getElementById("attendanceValue");
const attendanceCircle = document.getElementById("attendanceCircle");

// Update the text value
attendanceValueElement.textContent = newattendance;

// Calculate the percentage for the circle
const percentage1 = (newattendance / maxattendance) * 100;

// Update the circle background with conic-gradient
attendanceCircle.style.background = `conic-gradient(
  #0047FF 0%,
  #0047FF ${percentage1}%,
  #f0f0f3 ${percentage1}%
)`;

// Simulate the last 20 averages
const averages = [45, 50, 48, 55, 60, 45, 50, 48, 55, 60, 45, 50, 48, 55, 60, 45, 50, 48, 55, 60];

// Get canvas and context
const canvas = document.getElementById('lineChart');
const ctx = canvas.getContext('2d');

// Chart dimensions and padding
const chartWidth = canvas.width;
const chartHeight = canvas.height;
const padding = 50; // Padding for axes

// Calculate drawing area
const chartAreaWidth = chartWidth - 2 * padding;
const chartAreaHeight = chartHeight - 2 * padding;

// Set fixed Y-axis range (0 to 100)
const maxAverage = 100;  // Fixed max for Y-axis
const minAverage = 0;    // Fixed min for Y-axis

// Draw axes
function drawAxes() {
  ctx.beginPath();
  ctx.moveTo(padding, padding);
  ctx.lineTo(padding, chartHeight - padding); // Y-axis
  ctx.lineTo(chartWidth - padding, chartHeight - padding); // X-axis
  ctx.strokeStyle = '#333';
  ctx.lineWidth = 2;
  ctx.stroke();
}

// Plot averages with points and lines
function plotAverages() {
  const stepX = chartAreaWidth / (averages.length - 1); // Horizontal step
  const scaleY = chartAreaHeight / (maxAverage - minAverage); // Vertical scale

  // Start drawing the line and plot points
  const points = []; // To store the coordinates of the points

  // Calculate the points
  for (let i = 0; i < averages.length; i++) {
    const x = padding + i * stepX;
    const y = chartHeight - padding - (averages[i] - minAverage) * scaleY;
    points.push({ x, y }); // Store each point's coordinates
  }

  // Draw the lines connecting the points
  ctx.beginPath();
  ctx.strokeStyle = '#007acc'; // Line color
  ctx.lineWidth = 2;

  ctx.moveTo(points[0].x, points[0].y); // Start from the first point

  // Connect the points with a line
  for (let i = 1; i < points.length; i++) {
    ctx.lineTo(points[i].x, points[i].y);
  }

  ctx.stroke(); // Finalize the line drawing

  // Mark the points with circles
  ctx.fillStyle = '#007acc';
  points.forEach(point => {
    ctx.beginPath();
    ctx.arc(point.x, point.y, 4, 0, Math.PI * 2); // Draw circle at each data point
    ctx.fill();
  });
}

// Add labels
function drawLabels() {
  ctx.fillStyle = '#333';
  ctx.font = '12px Arial';

  // Y-axis labels (average scores from 0 to 100)
  for (let i = 0; i <= 5; i++) {
    const value = minAverage + ((maxAverage - minAverage) / 5) * i;
    const y = chartHeight - padding - (value - minAverage) * (chartAreaHeight / (maxAverage - minAverage));
    ctx.fillText(value.toFixed(1), padding - 40, y + 3);
  }

  // X-axis labels (Match indices are not needed, so we omit them)
  // Just draw generic label for X-axis if desired, or leave it empty
  // For example, we can add a label "Matches"
  ctx.fillText("Matches", chartWidth / 2 - 30, chartHeight - padding + 30);
}

// Render chart
drawAxes();
plotAverages();
drawLabels();

function drawPieChart() {
  // Get the canvas element and context
  const canvas = document.getElementById("pieChart");
  const ctx = canvas.getContext("2d");

  // Pie chart data (batting, bowling, fielding contributions)
  const pieChartData = {
    labels: ["Batting", "Bowling", "Fielding"],
    data: [90.36, 3.61, 6.02]
  };

  // Calculate total of data
  const total = pieChartData.data.reduce((acc, value) => acc + value, 0);

  // Angle variables
  let startAngle = 0;
  const radius = 100; // Radius of the pie chart
  const centerX = canvas.width / 2;
  const centerY = canvas.height / 2;

  // Loop through the data and draw each section of the pie chart
  pieChartData.data.forEach((slice, index) => {
    const sliceAngle = (slice / total) * 2 * Math.PI; // Angle for each slice

    // Draw each slice (segment)
    ctx.beginPath();
    ctx.moveTo(centerX, centerY); // Move to center of the pie
    ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle); // Draw arc
    ctx.fillStyle = getColorForSlice(index); // Set color for each slice
    ctx.fill();

    // Update the start angle for the next slice
    startAngle += sliceAngle;
  });

  // Function to assign a color to each slice
  function getColorForSlice(index) {
    const colors = ["#FF5733", "#33FF57", "#3357FF"]; // Batting (red), Bowling (green), Fielding (blue)
    return colors[index];
  }
}

function drawPieChart() {
  // Get the canvas element and context
  const canvas = document.getElementById("pieChart");
  const ctx = canvas.getContext("2d");

  // Set canvas width and height to make it bigger
  canvas.width = 400; // Increase canvas width
  canvas.height = 400; // Increase canvas height

  // Pie chart data (batting, bowling, fielding contributions)
  const pieChartData = {
    labels: ["Batting", "Bowling", "Fielding"],
    data: [90.36, 45, 70]
  };

  // Calculate total of data
  const total = pieChartData.data.reduce((acc, value) => acc + value, 0);

  // Angle variables
  let startAngle = 0;
  const radius = 120; // Increased radius to make the pie chart bigger
  const centerX = canvas.width / 2;
  const centerY = canvas.height / 2;

  // Loop through the data and draw each section of the pie chart
  pieChartData.data.forEach((slice, index) => {
    const sliceAngle = (slice / total) * 2 * Math.PI; // Angle for each slice

    // Draw each slice (segment)
    ctx.beginPath();
    ctx.moveTo(centerX, centerY); // Move to center of the pie
    ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle); // Draw arc
    ctx.fillStyle = getColorForSlice(index); // Set color for each slice
    ctx.fill();

    // Draw percentage in the slice
    const percentage = ((slice / total) * 100).toFixed(2); // Calculate percentage for the slice
    const textAngle = startAngle + sliceAngle / 2; // Angle for text position
    const textX = centerX + Math.cos(textAngle) * radius / 1.5; // X position for text
    const textY = centerY + Math.sin(textAngle) * radius / 1.5; // Y position for text

    ctx.fillStyle = "#FFFFFF"; // White color for the text
    ctx.font = "16px Arial"; // Larger font for the percentage text
    ctx.textAlign = "center"; // Align text to the center
    ctx.textBaseline = "middle"; // Vertically align text
    ctx.fillText(percentage + "%", textX, textY); // Draw the percentage text

    // Update the start angle for the next slice
    startAngle += sliceAngle;
  });

  // Function to assign a color to each slice (blue shades)
  function getColorForSlice(index) {
    const colors = ["#3498db", "#5dade2", "#85c1ae"]; // Different shades of blue
    return colors[index];
  }

  // Draw the labels and color boxes on the top-right of the canvas
  const labelStartX = canvas.width - 70; // X position to start the label box (right side of canvas)
  let labelStartY = 30;  // Starting Y position at the top of the canvas
  const boxSize = 10; // Size of the color box
  const labelSpacing = 20; // Space between each label item

  pieChartData.data.forEach((slice, index) => {
    // Draw the colored box for each label
    ctx.fillStyle = getColorForSlice(index); // Color for the box
    ctx.fillRect(labelStartX, labelStartY + labelSpacing * index, boxSize, boxSize);

    // Draw the label text next to the colored box
    ctx.fillStyle = "#000"; // Color for label text (black)
    ctx.font = "12px Arial"; // Font size for the label
    ctx.textAlign = "left"; // Align text to the left
    ctx.textBaseline = "middle"; // Align text vertically
    ctx.fillText(pieChartData.labels[index], labelStartX + boxSize + 5, labelStartY + labelSpacing * index + boxSize / 2);
  });
}

window.onload = function() {
  drawPieChart();
};


