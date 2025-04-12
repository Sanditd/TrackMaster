document.querySelectorAll('.progress-circle').forEach(circle => {
    const value = circle.getAttribute('data-value');
    circle.style.setProperty('--value', value);
});