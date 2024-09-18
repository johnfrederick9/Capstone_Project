<?php
require 'database.php';

$lastname = $_POST["lastname"] ?? '';
$middlename = $_POST["middlename"] ?? '';
$firstname = $_POST["firstname"] ?? '';
$sex = $_POST["sex"] ?? '';
$suffix = $_POST["suffix"] ?? '';
$birthdate = $_POST["birthdate"] ?? '';
$barangayposition = $_POST["barangayposition"] ?? '';
$username = $_POST["username"] ?? '';
$password = '';
$confirmpassword = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css" />
    <title>Barangay Mantalogon Information System</title>
    <link rel="icon" href="assets/image/Logo.png">
</head>
<body>
    <!-- register start -->
    <section class="register">
        <div class="register-wrapper">
            <a href="index.php">
            <img src="assets/image/Logo.png" alt="Logo">
            </a>
            <h2>Sign Up</h2><br>
            <form action="" method="post">
                <div class="grid-container">
                    <div class="grid-item">
                        <div>
                            <input type="text" name="firstname" id="firstname" placeholder="First Name" class="input-field" required value="<?php echo htmlspecialchars($firstname); ?>" />
                        </div>
                    </div>
                    <div class="grid-item">
                        <div>
                            <input type="text" name="middlename" placeholder="Middle Name" id="middlename" class="input-field" required value="<?php echo htmlspecialchars($middlename); ?>" />
                        </div>
                    </div>
                    <div class="grid-item">
                        <div>
                            <input type="text" name="lastname" placeholder="Last Name" id="lastname" class="input-field" required value="<?php echo htmlspecialchars($lastname); ?>" />
                        </div>
                    </div>
                    <div class="grid-item">
                        <label for="sex">Sex</label>
                        <div class="dropdown">
                            <select id="sex" class="input-field" name="sex" required>
                                <option value="" disabled <?php echo empty($sex) ? 'selected' : ''; ?>>Sex</option>
                                <option value="Male" <?php echo $sex === 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo $sex === 'Female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid-item">
                        <label for="birthdate">Birth Date:</label>
                        <div class="input-field">
                            <input type="date" name="birthdate" id="birth" required value="<?php echo htmlspecialchars($birthdate); ?>" />
                        </div>
                    </div>
                    <div class="grid-item">
                        <label for="suffix">Suffix</label>
                        <div class="dropdown">
                            <select id="suffix" class="input-field" name="suffix" required>
                                <option value="None" <?php echo $suffix === 'None' ? 'selected' : ''; ?>>None</option>
                                <option value="Sr." <?php echo $suffix === 'Sr.' ? 'selected' : ''; ?>>Sr.</option>
                                <option value="Jr." <?php echo $suffix === 'Jr.' ? 'selected' : ''; ?>>Jr.</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="account">
                    <div class="grid-item">
                        <select id="barangayposition" class="input-field" name="barangayposition" required>
                            <option value="" disabled <?php echo empty($barangayposition) ? 'selected' : ''; ?>>Barangay Position</option>
                            <option value="Barangay Captain" <?php echo $barangayposition === 'Barangay Captain' ? 'selected' : ''; ?>>Barangay Captain</option>
                            <option value="Barangay Secretary" <?php echo $barangayposition === 'Barangay Secretary' ? 'selected' : ''; ?>>Barangay Secretary</option>
                            <option value="Barangay Treasurer" <?php echo $barangayposition === 'Barangay Treasurer' ? 'selected' : ''; ?>>Barangay Treasurer</option>
                            <option value="Barangay Personnel" <?php echo $barangayposition === 'Barangay Personnel' ? 'selected' : ''; ?>>Barangay Personnel</option>
                            <option value="Barangay Health Worker" <?php echo $barangayposition === 'Barangay Health Worker' ? 'selected' : ''; ?>>Barangay Health Worker</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <i class='bx bxs-user icon'></i>
                        <input type="text" placeholder="Username" name="username" id="username" required value="<?php echo htmlspecialchars($username); ?>" />
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock icon'></i>
                        <input type="password" placeholder="Password" name="password" id="password" />
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt icon'></i>
                        <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" />
                    </div>
                </div>

                <button type="submit" name="submit" class="btn log">Register</button>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"] ?? '';
                    $password = $_POST["password"] ?? '';
                    $confirmpassword = $_POST["confirmPassword"] ?? '';

                    if (!empty($lastname) && !empty($middlename) && !empty($firstname) && !empty($sex) && !empty($birthdate) && !empty($barangayposition) && !empty($username) && !empty($password) && !empty($confirmpassword)) {

                        // Check if username already exists
                        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ?");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Query the database to check the number of existing positions
                        $position_stmt = $conn->prepare("SELECT COUNT(*) as position_count FROM tb_user WHERE barangayposition = ?");
                        $position_stmt->bind_param("s", $barangayposition);
                        $position_stmt->execute();
                        $position_result = $position_stmt->get_result();
                        $row = $position_result->fetch_assoc();
                        $existing_positions = $row['position_count'];

                        if ($barangayposition == 'Barangay Captain' && $existing_positions >= 1) {
                            echo "<div class='alert alert-danger'>There can only be one Barangay Captain.</div>";
                        } elseif ($barangayposition == 'Barangay Secretary' && $existing_positions >= 1) {
                            echo "<div class='alert alert-danger'>There can only be one Barangay Secretary.</div>";
                        } elseif ($barangayposition == 'Barangay Treasurer' && $existing_positions >= 1) {
                            echo "<div class='alert alert-danger'>There can only be one Barangay Treasurer.</div>";
                        } else {
                            if ($result->num_rows > 0) {
                                echo "<div class='alert alert-danger'>Username already exists</div>";
                            } else {
                                // Check for password matching and length
                                if ($password == $confirmpassword && strlen($password) < 8) {
                                    echo "<div class='alert alert-danger'>Password should be at least 8 characters long</div>";
                                } elseif ($password == $confirmpassword) {
                                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                    $stmt = $conn->prepare("INSERT INTO tb_user (lastname, middlename, firstname, sex, suffix, birthdate, barangayposition, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        
                                    $stmt->bind_param("sssssssss", $lastname, $middlename, $firstname, $sex, $suffix, $birthdate, $barangayposition, $username, $hashed_password);
                                    if ($stmt->execute()) {
                                        // Clear the account fields after submission
                                        echo "<script>
                                            document.getElementById('username').value = '';
                                            document.getElementById('password').value = '';
                                            document.getElementById('confirmPassword').value = '';
                                            alert('Registration Successful'); window.location.href='login.php';
                                            </script>";
                                    } else {
                                        echo "<script>alert('Registration Failed');</script>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Passwords Do Not Match</div>";
                                }
                            }
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                    }
                    $conn->close();
                }
                ?>
            </form>
            <p>Already have an account? <a href="login.php">Sign in</a></p>
        </div>
    </section>
    <!-- register end -->
</body>
</html>
