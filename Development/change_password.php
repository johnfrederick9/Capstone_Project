<?php
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step = trim($_POST['step'] ?? '');

    if ($step === 'verification') {
        $verificationCode = trim($_POST['verification_code'] ?? '');
        $query = $pdo->prepare("SELECT * FROM tb_user WHERE verification_code = ?");
        $query->execute([$verificationCode]);

        if ($query->rowCount() > 0) {
            echo json_encode(['success' => true, 'nextStep' => 'password']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } elseif ($step === 'password') {
        $verificationCode = trim($_POST['verification_code'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirmpassword'] ?? '');

        if ($password === $confirmPassword && strlen($password) >= 6) {
            $query = $pdo->prepare("SELECT password FROM tb_user WHERE verification_code = ?");
            $query->execute([$verificationCode]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the current password.']);
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $updateQuery = $pdo->prepare("UPDATE tb_user SET password = ? WHERE verification_code = ?");
                $updateQuery->execute([$hashedPassword, $verificationCode]);

                echo json_encode(['success' => true, 'message' => 'Password changed successfully. Redirecting...']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match or are too short.']);
        }
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="forgot-password">
        <div class="slider-container">
            <!-- Step 2: Verification -->
            <div class="slide active" id="step-verification">
                <h2>Password Verification</h2>
                <p>Enter the six-digit verification code sent to your email.</p>
                <div class="code-container">
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                    <input type="number" class="code" maxlength="1" min="0" max="9" required>
                </div>
            </div>

            <!-- Step 3: Reset Password -->
            <div class="slide" id="step-password">
                <h2>Reset Password</h2>
                <form id="passwordForm">
                    <input type="hidden" id="verification_code" name="verification_code" />
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
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        alertDiv.style.position = "fixed";
        alertDiv.style.top = "10px";
        alertDiv.style.right = "10px";
        alertDiv.style.zIndex = "9999";

        document.body.appendChild(alertDiv);
        setTimeout(() => alertDiv.remove(), 5000);
    }

    const sliderSteps = {
        verification: document.getElementById('step-verification'),
        password: document.getElementById('step-password')
    };

    const showStep = (step) => {
        Object.values(sliderSteps).forEach(s => s.classList.remove('active'));
        sliderSteps[step].classList.add('active');
    };

    const codes = document.querySelectorAll('.code');
    codes.forEach((code, idx) => {
        code.addEventListener('input', async () => {
            const verificationCode = Array.from(codes)
                .map(input => input.value)
                .join('');

            if (verificationCode.length === 6) {
                const formData = new FormData();
                formData.append('step', 'verification');
                formData.append('verification_code', verificationCode);

                try {
                    const response = await fetch('', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    if (result.success) {
                        showAlert('Verification code is correct.', 'alert-success');
                        showStep('password'); // Automatically transition to password step
                    } else {
                        showAlert(result.message, 'alert-danger');
                    }
                } catch (error) {
                    showAlert('An error occurred. Please try again.', 'alert-danger');
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

        try {
            const response = await fetch('', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                showAlert(result.message, 'alert-success');
                setTimeout(() => window.location.href = 'dashboard/dashboard.php', 2000);
            } else {
                showAlert(result.message, 'alert-danger');
            }
        } catch (error) {
            showAlert('An error occurred. Please try again.', 'alert-danger');
        }
    });
</script>

</body>
</html>
