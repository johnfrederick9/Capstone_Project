<?php
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $step = trim($_POST['step'] ?? '');

    if ($step === 'verification') {
        $verificationCode = trim($_POST['verification_code'] ?? '');

        $query = $pdo->prepare("SELECT user_id FROM tb_user WHERE verification_code = ?");
        $query->execute([$verificationCode]);

        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'nextStep' => 'password', 'user_id' => $user['user_id']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } elseif ($step === 'password') {
        $userId = trim($_POST['user_id'] ?? '');
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

        $query = $pdo->prepare("SELECT password FROM tb_user WHERE user_id = ?");
        $query->execute([$userId]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
            exit;
        }

        if (password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the current password.']);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updateQuery = $pdo->prepare("UPDATE tb_user SET password = ? WHERE user_id = ?");
        $updateQuery->execute([$hashedPassword, $userId]);

        echo json_encode(['success' => true, 'message' => 'Password changed successfully. Redirecting to the dashboard...']);
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
    <link rel="icon" href="../assets/image/logo_head.png">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/boxicons.min.css">
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
<section class="forgot-password">
    <div class="slider-container">
    <div class="logo">
                <a href="dashboard/dashboard.php">
                    <img src="../assets/image/Logo.png" alt="Logo"><br><br>
                </a>
            </div>
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

        <div class="slide" id="step-password">
            <h2>Reset Password</h2>
            <form id="passwordForm">
                <input type="hidden" id="user_id" name="user_id" />
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
const sliderSteps = {
    verification: document.getElementById('step-verification'),
    password: document.getElementById('step-password')
};

const showStep = (step) => {
    Object.values(sliderSteps).forEach(s => s.classList.remove('active'));
    sliderSteps[step].classList.add('active');
};

// Function to show alert
function showAlert(message, alertClass) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert ${alertClass} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    Object.assign(alertDiv.style, {
        position: 'fixed',
        top: '10px',
        right: '10px',
        zIndex: '9999',
        backgroundColor: alertClass === 'alert-danger' ? '#f8d7da' : '#d4edda',
        borderColor: alertClass === 'alert-danger' ? '#f5c6cb' : '#c3e6cb'
    });
    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000); // Alert will disappear after 3 seconds
}

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
                const response = await fetch('', { method: 'POST', body: formData });
                const result = await response.json();

                if (result.success) {
                    document.getElementById('user_id').value = result.user_id;
                    showAlert('Verification successful!', 'alert-success');
                    showStep('password');
                } else {
                    showAlert(result.message, 'alert-danger');
                }
            } catch (error) {
                showAlert('An error occurred. Please try again.', 'alert-danger');
            }
        }
    });

    code.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && e.target.value === '') {
            const prev = codes[idx - 1];
            if (prev) prev.focus();
        }
    });
});

// Automatically focus the next input field
codes.forEach((code, idx) => {
    code.addEventListener('input', (e) => {
        if (e.target.value.length === 1) {
            const next = codes[idx + 1];
            if (next) next.focus();
        }
    });

    code.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && e.target.value === '') {
            const prev = codes[idx - 1];
            if (prev) prev.focus();
        }
    });
});

document.getElementById('passwordForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    formData.append('step', 'password');

    try {
        const response = await fetch('', { method: 'POST', body: formData });
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