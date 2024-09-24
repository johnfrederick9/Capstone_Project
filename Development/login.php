<?php
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!----======== CSS ======== -->
      <link rel="stylesheet" href="assets/css/style.css">

      <!----===== Boxicons CSS ===== -->
      <link rel="stylesheet" href="assets/css/boxicons.min.css" />

      <!--<title>Barangay Mantalongon Information System</title>-->
        <title>Barangay Mantalogon Information System</title>
        <link rel="icon" href="assets/image/Logo.png">

  </head>
  <body>
    <!-- login start -->
    <section class="login">
      <div class="login-wrapper">
        <a href="index.php">
          <img src="assets/image/Logo.png" alt="Logo">
        </a>
          <h2>Sign In</h2>
          <form action="#" method="post">

          <label for="username">Username</label>
          <div class="input-field">
              <i class='bx bxs-user icon'></i>
              <input type="text" name="username" />
            </div>

            <label for="password">Password</label>
            <div class="input-field">
              <i class='bx bxs-lock icon'></i>
              <input type="password" name="password" />
            </div>

              <button type= "submit" name="submit" class= "btn log">Login</button>

              <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    $username = $_POST["username"] ?? '';
                    $password = $_POST["password"] ?? '';

                    if (!empty($username) && !empty($password)) {
                        // Check if the user exists
                        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
                        if ($stmt === false) {
                            die("MySQL error: " . $conn->error);
                        }

                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows === 1) {
                            $user = $result->fetch_assoc();
                            if (password_verify($password, $user['password'])) {
                                // Password matches, start a session
                                $_SESSION['username'] = $user['username'];
                                $_SESSION['user_id'] = $user['user_id']; 
                                $_SESSION['barangayposition'] = $user['barangayposition']; // Store the barangay position in the session

                                // Determine where to redirect based on barangay position
                                $redirectUrl = '';
                                switch ($user['barangayposition']) {
                                    case 'Barangay Captain':
                                        $redirectUrl = 'barangay_captain/dashboard/dashboard.php';
                                        break;
                                    case 'Barangay Secretary':
                                        $redirectUrl = 'barangay_secretary/dashboard/dashboard.php';
                                        break;
                                    case 'Barangay Treasurer':
                                        $redirectUrl = 'barangay_treasurer/dashboard/dashboard.php';
                                        break;
                                    case 'Barangay Personnel':
                                        $redirectUrl = 'barangay_personnel/dashboard/dashboard.php';
                                        break;
                                    case 'Barangay Health Worker':
                                        $redirectUrl = 'barangay_health_worker/dashboard/dashboard.php';
                                        break;
                                    default:
                                        $redirectUrl = 'pages/dashboard/dashboard.php'; // Default fallback page
                                        break;
                                }

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
                                        }, 3000);
                                    </script>
                                ";                              
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'>Invalid Password</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Username Not Found</div>";
                        }
                        $stmt->close();
                    } else {
                        echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                    }
                }
                ?>

          </form>
          <p>Don't have an account? <a href="register.php">Sign up</a></p>
      </div>
    </section>  
    <!-- login end -->
  </body>
</html>