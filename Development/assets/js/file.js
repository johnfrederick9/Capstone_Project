// <script src="../../assets/js/file.js"></script>
function handleFileChange() {
    const fileInput = document.getElementById('fileInput');
    const fileNameSpan = document.getElementById('fileName');
    const fileLabel = document.getElementById('fileLabel');
  
    if (fileInput.files.length > 0) {
      // Update the span text with the selected file name
      fileNameSpan.textContent = fileInput.files[0].name;
      
      // Change background color to green if a file is selected
      fileLabel.style.backgroundColor = '#27c707';
    } else {
      // Reset to default text and background color if no file is selected
      fileNameSpan.textContent = 'Document File';
      fileLabel.style.backgroundColor = '#c70707';
    }
  }
  
  // Automatically check file input on page load to set the correct color
  window.onload = function() {
    handleFileChange();
  };
  

