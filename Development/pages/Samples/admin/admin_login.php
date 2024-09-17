
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--======== CSS ========-->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!--===== Boxicons CSS =====-->
    <link rel="stylesheet" href="../../assets/css/boxicons.min.css">

    <title>Barangay Mantalongon Information System</title>
    <link rel="icon" href="../../assets/image/Logo.png">
</head>
<body>
    <!-- login start -->
    <section class="admin">
        <div class="login-wrapper">
            <a href="../../index.php">
                <img src="../../assets/image/Logo.png" alt="Logo">
            </a>
            <h2>Welcome Admin</h2>
            <form action="" method="post">

                <label for="username">Username</label>
                <div class="input-field">
                    <i class='bx bxs-user icon'></i>
                    <input type="text" name="admin_username" required />
                </div>

                <label for="password">Password</label>
                <div class="input-field">
                    <i class='bx bxs-lock icon'></i>
                    <input type="password" name="admin_password" required />
                </div>

                <button type="submit" name="submit" class="btn log">Login</button>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Fetch POST data
                    $admin_username = $_POST["admin_username"] ?? '';
                    $admin_password = $_POST["admin_password"] ?? '';

                    // Hardcoded credentials
                    $correct_username = "administrator";
                    $correct_password = "mantalongon2024";

                    if ($admin_username === $correct_username && $admin_password === $correct_password) {
                        // Start session and set session variable
                        $_SESSION['admin_username'] = $admin_username;

                        // Redirect to the landing page (e.g., dashboard)
                        echo " 
                        <div id='toast' class='toast'>   
                            <div class='toast-content'>
                              <i class='bx bxs-check-circle icon'></i>
                              <div class='message'>
                                <span class='text'>Login Sucessful</span>
                                <p>Redirecting to the Admin Dashboard...</p>
                              </div>
                            </div>
                          </div>
        
                          <script>
                            const toast = document.getElementById('toast');
                            toast.classList.add('show');
        
                            setTimeout(() => {
                              toast.classList.remove('show');
                              window.location.href = 'table.php';
                            }, 800);
                          </script>
                          ";  
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Invalid Username or Password</div>";
                    }
                }
                ?>
            </form>
        </div>
    </section>
    <!-- login end -->
</body>
</html>
