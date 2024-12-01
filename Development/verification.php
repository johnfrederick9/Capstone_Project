<section class="verification">
  <div class="modal overlay" id="verificationModal" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="container">
          <h2>Enter your Password Verification</h2>
          <p>
            This six-digit code is for your password verification.<br />
            Enter the code below to confirm and reset your password.
          </p>
          <div class="code-container">
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
          </div>
          <button type="button" class="btn" onclick="submitVerificationCode()">Verify</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Function to show the modal if verification_code is empty
  function checkVerificationCode() {
    fetch("check_verification_code.php") // Check verification code existence
      .then((response) => {
        if (!response.ok) throw new Error("Network response was not ok");
        return response.json();
      })
      .then((data) => {
        if (!data.success || !data.verification_code) {
          // Show modal if verification code is missing
          showVerificationPopup();
        }
      })
      .catch((error) => {
        console.error("Error checking verification code:", error);
      });
  }

  function showVerificationPopup() {
    document.getElementById("verificationModal").style.display = "flex"; // Show modal
  }

  // Handle the verification code input fields
  const codes = document.querySelectorAll(".code");
  if (codes.length > 0) codes[0].focus(); // Set focus to the first field

  codes.forEach((code, idx) => {
    code.addEventListener("keydown", (e) => {
      if (e.key >= 0 && e.key <= 9) {
        codes[idx].value = ""; // Clear the field
        setTimeout(() => codes[idx + 1]?.focus(), 10); // Focus the next field
      } else if (e.key === "Backspace") {
        setTimeout(() => codes[idx - 1]?.focus(), 10); // Focus the previous field
      }
    });
  });

  function submitVerificationCode() {
    let verificationCode = "";
    codes.forEach((code) => {
      verificationCode += code.value.trim(); // Collect and trim spaces
    });

    if (/^\d{6}$/.test(verificationCode)) { // Ensure it's a valid 6-digit code
      const confirmCode = confirm("You entered: " + verificationCode + "\nDo you want to confirm?");
      if (confirmCode) {
        fetch("check_verification_code.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json", // Ensure proper Content-Type
          },
          body: JSON.stringify({ code: verificationCode }), // Send code as JSON
        })
          .then((response) => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.json();
          })
          .then((data) => {
            if (data.success) {
              alert("Verification code saved successfully!");
              location.reload();
            } else {
              alert("Error: " + data.message);
            }
          })
          .catch((error) => {
            console.error("Error submitting verification code:", error);
            alert("An error occurred while submitting the code. Please try again.");
          });
      }
    } else {
      alert("Please enter a valid 6-digit numeric code.");
    }
  }

  // Check if the verification code is empty on page load
  document.addEventListener("DOMContentLoaded", checkVerificationCode);
</script>


