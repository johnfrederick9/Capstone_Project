<section class="verification">
  <div class="modal overlay" id="verificationModal" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <h2>Enter your Password Verification</h2>
          <p>
            This six-digit code is for your password verification.<br />
            Enter the code below to confirm and reset your password.
            <strong></br>NOTE: DO NOT FORGET THIS VERIFICATION CODE</strong>
          </p>
          <div class="code-container">
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
            <input type="number" class="code" placeholder="0" min="0" max="9" required />
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal overlay" id="confirmationModal" tabindex="-1" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <h2>Confirm Verification Code</h2>
          <p>Are you sure you want to submit the entered verification code?</p>
          <button class="btn btn-success" id="confirmSubmit">Yes</button>
          <button class="btn btn-danger" id="cancelSubmit">No</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Show the verification modal
  function showVerificationPopup() {
    document.getElementById("verificationModal").style.display = "flex";
  }

  // Show the confirmation modal
  function showConfirmationPopup() {
    document.getElementById("confirmationModal").style.display = "flex";
  }

  // Hide all modals
  function hideAllModals() {
    document.getElementById("verificationModal").style.display = "none";
    document.getElementById("confirmationModal").style.display = "none";
  }

  // Hide only the confirmation modal
  function hideConfirmationModal() {
    document.getElementById("confirmationModal").style.display = "none";
  }

  // Function to show alert
  function showAlert(message, alertClass) {
    var alertDiv = $(
      '<div class="alert ' +
        alertClass +
        ' alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
    );
    alertDiv.css({
      position: "fixed",
      top: "10px",
      right: "10px",
      "z-index": "9999",
      "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
      "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb",
    });
    $("body").append(alertDiv);
    setTimeout(function () {
      alertDiv.alert("close");
    }, 900);
  }

  // Automatically check verification code on page load
  function checkVerificationCode() {
    fetch("check_verification_code.php")
      .then((response) => response.json())
      .then((data) => {
        if (!data.success || !data.verification_code) {
          showVerificationPopup();
        }
      })
      .catch((error) => {
        console.error("Error checking verification code:", error);
      });
  }

  // Handle verification code input
  const codes = document.querySelectorAll(".code");
  if (codes.length > 0) codes[0].focus();

  let verificationCode = "";

  codes.forEach((code, idx) => {
    code.addEventListener("input", (e) => {
      const value = e.target.value;
      if (value >= 0 && value <= 9) {
        verificationCode += value;
        if (verificationCode.length === 6) {
          showConfirmationPopup();
        } else {
          codes[idx + 1]?.focus();
        }
      } else {
        e.target.value = "";
      }
    });

    code.addEventListener("keydown", (e) => {
      if (e.key === "Backspace") {
        verificationCode = verificationCode.slice(0, -1);
        codes[idx - 1]?.focus();
      }
    });
  });

  // Handle confirmation modal actions
  document.getElementById("confirmSubmit").addEventListener("click", () => {
    submitVerificationCode();
  });

  document.getElementById("cancelSubmit").addEventListener("click", () => {
    hideConfirmationModal(); // Only hide the confirmation modal
  });

  // Submit the verification code without page reload
  function submitVerificationCode() {
    fetch("check_verification_code.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ code: verificationCode }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          showAlert("Verification code saved successfully!", "alert-success");
          hideAllModals();
        } else {
          showAlert("Error: " + data.message, "alert-danger");
          verificationCode = "";
          codes.forEach((code) => (code.value = ""));
          codes[0].focus();
        }
      })
      .catch((error) => {
        console.error("Error submitting verification code:", error);
        showAlert("An error occurred. Please try again.", "alert-danger");
      });
  }

  // Initialize on page load
  document.addEventListener("DOMContentLoaded", checkVerificationCode);

</script>
