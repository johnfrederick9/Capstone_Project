<?php
require 'database.php';

// Retain valid username if found in the database and submitted
$username = $_SESSION['valid_username'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- ======== CSS ======== -->
      <link rel="stylesheet" href="assets/css/style.css">

      <!-- ===== Boxicons CSS ===== -->
      <link rel="stylesheet" href="assets/css/boxicons.min.css" />

      <title>Barangay Mantalogon Information System</title>
      <link rel="icon" href="assets/image/logo_head.png">
  </head>
  <body>
    <!-- Login start -->
    <section class="login">
      <div class="login-wrapper">
        <a href="index.php">
          <img src="assets/image/Logo.png" alt="Logo">
        </a>
        <h2>Sign In</h2>
        <form action="#" method="post" id="loginForm">

          <label for="username">Username</label>
          <div class="input-field">
              <i class='bx bxs-user icon'></i>
              <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" />
          </div>

          <label for="password">Password</label>
          <div class="input-field">
              <i class='bx bxs-lock icon'></i>
              <input type="password" name="password" />
          </div>

          <button type="submit" name="submit" class="btn log">Login</button>

          <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $usernameInput = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    if (!empty($usernameInput) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
        if ($stmt === false) {
            die("MySQL error: " . $conn->error);
        }

        $stmt->bind_param("s", $usernameInput);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            echo "<script>document.getElementById('username').value = '$usernameInput';</script>";

            // Check if the account is pending approval
            if ($user['isApproved'] == 0) {
                echo "<div class='alert alert-danger'>Your account is pending approval.</div>";
            } 
            // Check if the account is disapproved
            elseif ($user['isApproved'] == 3) {
                // Notify user of disapproval
                echo "<div class='alert alert-danger'>Your account has been disapproved by the Barangay Captain.<br> Reason: {$user['disapprovalReason']}</div>";

                // Delete the disapproved account after showing the message
                $deleteStmt = $conn->prepare("DELETE FROM tb_user WHERE user_id = ?");
                $deleteStmt->bind_param("i", $user['user_id']);
                $deleteStmt->execute();
                $deleteStmt->close();
            } 
            // If approved, check password and login
            elseif ($user['isApproved'] == 1) {
                if (password_verify($password, $user['password'])) {
                    unset($_SESSION['valid_username']); // Clear on success

                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['barangayposition'] = $user['barangayposition'];

                    // Determine where to redirect based on the user's position
                    $redirectUrl = match ($user['barangayposition']) {
                        'Barangay Captain' => 'barangay_captain/dashboard/dashboard.php',
                        'Barangay Secretary' => 'barangay_secretary/dashboard/dashboard.php',
                        'Barangay Treasurer' => 'barangay_treasurer/dashboard/dashboard.php',
                        'Barangay Personnel' => 'barangay_personnel/dashboard/dashboard.php',
                        'Barangay Health Worker' => 'barangay_health_worker/dashboard/dashboard.php',
                        default => 'pages/dashboard/dashboard.php',
                    };

                    echo "
                        <div id='toast' class='toast'>
                            <div class='toast-content'>
                                <i class='bx bxs-check-circle icon'></i>
                                <div class='message'>
                                    <span class='text'>Login Successful</span>
                                </div>
                            </div>
                        </div>

                        <script>
                            const toast = document.getElementById('toast');
                            toast.classList.add('show');
                            setTimeout(() => {
                                toast.classList.remove('show');
                                window.location.href = '$redirectUrl';
                            }, 2000);
                        </script>
                    ";
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Invalid Password</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Unknown approval status.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Username Not Found</div>";
            unset($_SESSION['valid_username']); // Clear if not found
        }
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Please fill in all fields</div>";
    }
}
?>
        </form>
        <p>Forgot Password? <a href="forgot_password.php">Change Here</a></p>
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
      </div>
    </section>  
    <!-- Login end -->
  </body>
</html>
