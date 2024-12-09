<?php
require 'database.php';

$username = $_SESSION['valid_username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step = $_POST['step'] ?? 'username';

    if ($step === 'username') {
        $inputUsername = trim($_POST['username'] ?? '');
        $query = $pdo->prepare("SELECT * FROM tb_user WHERE username = ?");
        $query->execute([$inputUsername]);

        if ($query->rowCount() > 0) {
            $_SESSION['valid_username'] = $inputUsername;
            echo json_encode(['success' => true, 'nextStep' => 'verification']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username.']);
        }
    } elseif ($step === 'verification') {
        $verificationCode = trim($_POST['verification_code'] ?? '');
        $query = $pdo->prepare("SELECT * FROM tb_user WHERE username = ? AND verification_code = ?");
        $query->execute([$_SESSION['valid_username'], $verificationCode]);

        if ($query->rowCount() > 0) {
            echo json_encode(['success' => true, 'nextStep' => 'password']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } elseif ($step === 'password') {
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirmpassword'] ?? '');

        if ($password !== $confirmPassword) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
            exit;
        }

        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters long.']);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the new password matches the current password
        $query = $pdo->prepare("SELECT password FROM tb_user WHERE username = ?");
        $query->execute([$_SESSION['valid_username']]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the current password.']);
            exit;
        }

        // Update the password
        $query = $pdo->prepare("UPDATE tb_user SET password = ? WHERE username = ?");
        $query->execute([$hashedPassword, $_SESSION['valid_username']]);

        // Clear session after updating
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Password changed successfully. Redirecting...']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Mantalogon Information System</title>
    <link rel="icon" href="assets/image/logo_head.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="forgot-password">
        <div class="slider-container">
            <div class="logo">
                <a href="login.php">
                    <img src="assets/image/Logo.png" alt="Logo"><br><br>
                </a>
            </div>
            <!-- Step 1: Username -->
            <div class="slide active" id="step-username">
                <h2>Forgot Password</h2>
                <form id="usernameForm">
                    <label for="username">Enter Username:</label>
                    <input type="text" id="username" name="username" required>
                    <button type="submit">Proceed</button>
                </form>
            </div>

            <!-- Step 2: Verification -->
            <div class="slide" id="step-verification">
                <h2>Password Verification</h2>
                <p>Enter your six-digit verification code.</p>
                <div class="code-container">
                    <input type="number" class="code" maxlength="1" data-index="0" placeholder="0" min="0" max="9" required />
                    <input type="number" class="code" maxlength="1" data-index="1" placeholder="0" min="0" max="9" required />
                    <input type="number" class="code" maxlength="1" data-index="2" placeholder="0" min="0" max="9" required />
                    <input type="number" class="code" maxlength="1" data-index="3" placeholder="0" min="0" max="9" required />
                    <input type="number" class="code" maxlength="1" data-index="4" placeholder="0" min="0" max="9" required />
                    <input type="number" class="code" maxlength="1" data-index="5" placeholder="0" min="0" max="9" required />
                </div>
            </div>

            <!-- Step 3: Reset Password -->
            <div class="slide" id="step-password">
                <h2>Reset Password</h2>
                <form id="passwordForm">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" required>
                    <button type="submit">Change Password</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Function to show alert
        function showAlert(message, alertClass) {
            var alertDiv = $('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            alertDiv.css({
                "position": "fixed",
                "top": "10px",
                "right": "10px",
                "z-index": "9999",
                "background-color": alertClass === "alert-danger" ? "#f8d7da" : "#d4edda",
                "border-color": alertClass === "alert-danger" ? "#f5c6cb" : "#c3e6cb"
            });
            $("body").append(alertDiv);
            setTimeout(function () { alertDiv.alert('close'); }, 500);
        }

        const sliderSteps = {
            username: document.getElementById('step-username'),
            verification: document.getElementById('step-verification'),
            password: document.getElementById('step-password')
        };

        const showStep = (step) => {
            Object.values(sliderSteps).forEach(s => s.classList.remove('active'));
            sliderSteps[step].classList.add('active');
        };

        document.getElementById('usernameForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('step', 'username');

            const response = await fetch('', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success){
                showAlert('Username is correct.', 'alert-success');
                showStep('verification');
            } 
            else showAlert(result.message, 'alert-danger');
        });

        const codes = document.querySelectorAll('.code');
        codes.forEach((code, idx) => {
            code.addEventListener('input', async () => {
                const verificationCode = Array.from(codes)
                    .map((input) => input.value)
                    .join('');

                if (verificationCode.length === 6) {
                    const formData = new FormData();
                    formData.append('step', 'verification');
                    formData.append('verification_code', verificationCode);

                    const response = await fetch('', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    if (result.success) {
                        showAlert('Verification code is correct.', 'alert-success');
                        showStep('password');
                    } else {
                        showAlert(result.message, 'alert-danger');
                    }
                }
            });
        });
          // Automatically focus the next input field
            codes[0].focus()

            codes.forEach((code, idx) => {
                code.addEventListener('keydown', (e) => {
                    if(e.key >= 0 && e.key <=9) {
                        codes[idx].value = ''
                        setTimeout(() => codes[idx + 1].focus(), 10)
                    } else if(e.key === 'Backspace') {
                        setTimeout(() => codes[idx - 1].focus(), 10)
                    }
                })
            })

        document.getElementById('passwordForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append('step', 'password');

            const response = await fetch('', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                showAlert(result.message, 'alert-success');
                setTimeout(() => window.location.href = 'login.php', 1000);
            } else {
                showAlert(result.message, 'alert-danger');
            }
        });
    </script>
</body>
</html>
