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
$password = $_POST["password"] ?? '';
$confirmpassword = $_POST["confirmPassword"] ?? '';
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
    <link rel="icon" href="assets/image/logo_head.png">
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
                            <input type="text" name="middlename" placeholder="Middle Name" id="middlename" class="input-field"  value="<?php echo htmlspecialchars($middlename); ?>" />
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
                                <option value=" " <?php echo $suffix === 'None' ? 'selected' : ''; ?>>None</option>
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
                        <input type="password" placeholder="Password" name="password" id="password" required value="<?php echo htmlspecialchars($password); ?>" />
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt icon'></i>
                        <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required value="<?php echo htmlspecialchars($confirmpassword); ?>"/>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn log">Register</button>
                <p>Already have an account? <a href="login.php">Sign in</a></p>
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
                $password = $_POST["password"] ?? '';
                $confirmpassword = $_POST["confirmPassword"] ?? '';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $birthdate = $_POST["birthdate"] ?? '';
                    $username = $_POST["username"] ?? '';
                    $password = $_POST["password"] ?? '';
                    $confirmpassword = $_POST["confirmPassword"] ?? '';
                    $lastname = $_POST["lastname"] ?? '';
                    $middlename = $_POST["middlename"] ?? '';
                    $firstname = $_POST["firstname"] ?? '';
                    $sex = $_POST["sex"] ?? '';
                    $suffix = $_POST["suffix"] ?? '';
                    $barangayposition = $_POST["barangayposition"] ?? '';

                    $year2005 = new DateTime('2005-12-31');
                    $enteredDate = new DateTime($birthdate);

                    if ($enteredDate > $year2005) {
                        echo "<div class='alert alert-danger'>Please put the exact Birthdate.</div>";
                        echo "<script>
                            document.getElementsByName('birthdate')[0].value = '';
                        </script>";
                    } else {
                        if (!empty($lastname) && !empty($firstname) && !empty($sex) && !empty($birthdate) && !empty($barangayposition) && !empty($username) && !empty($password) && !empty($confirmpassword)) {
                            // Check if username already exists
                            $stmt = $conn->prepare("SELECT * FROM tb_user WHERE username = ? AND isApproved != 3 ");
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                echo "<div class='alert alert-danger'>Username already exists</div>";
                            } else {
                                // Check if full name already exists
                                $name_stmt = $conn->prepare("SELECT * FROM tb_user WHERE lastname = ? AND middlename = ? AND firstname = ?");
                                $name_stmt->bind_param("sss", $lastname, $middlename, $firstname);
                                $name_stmt->execute();
                                $name_result = $name_stmt->get_result();

                                if ($name_result->num_rows > 0) {
                                    echo "<div class='alert alert-danger'>A record with the same name already exists.</div>";
                                } else {
                                    // Check barangay position limits
                                    $position_stmt = $conn->prepare("SELECT COUNT(*) as position_count FROM tb_user WHERE barangayposition = ?");
                                    $position_stmt->bind_param("s", $barangayposition);
                                    $position_stmt->execute();
                                    $position_result = $position_stmt->get_result();
                                    $row = $position_result->fetch_assoc();
                                    $existing_positions = $row['position_count'];

                                    if ($barangayposition == 'Barangay Captain' && $existing_positions >= 2) {
                                        echo "<div class='alert alert-danger'>There can only be one Barangay Captain.</div>";
                                    } elseif ($barangayposition == 'Barangay Secretary' && $existing_positions >= 1) {
                                        echo "<div class='alert alert-danger'>There can only be one Barangay Secretary.</div>";
                                    } elseif ($barangayposition == 'Barangay Treasurer' && $existing_positions >= 1) {
                                        echo "<div class='alert alert-danger'>There can only be one Barangay Treasurer.</div>";
                                    } else {
                                        if ($password === $confirmpassword) {
                                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                            // Set approval status based on barangay position
                                            $isApproved = ($barangayposition === 'Barangay Captain') ? 1 : 0;

                                            $stmt = $conn->prepare("INSERT INTO tb_user (lastname, middlename, firstname, sex, suffix, birthdate, barangayposition, username, password, isApproved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                            $stmt->bind_param("sssssssssi", $lastname, $middlename, $firstname, $sex, $suffix, $birthdate, $barangayposition, $username, $hashed_password, $isApproved);

                                            if ($stmt->execute()) {
                                                $toastMessage = ($barangayposition === 'Barangay Captain') 
                                                    ? 'Registration Successful! As Barangay Captain' 
                                                    : 'Registration Successful! Awaiting approval.';
                                                $redirectUrl = 'login.php';
                                                echo " 
                                                    <div id='toast' class='toast'>   
                                                        <div class='toast-content'>
                                                            <i class='bx bxs-check-circle icon'></i>
                                                            <div class='message'>
                                                                <span class='text'>$toastMessage</span>
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
                                                echo "<div class='alert alert-danger'>Registration Failed</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-danger'>Passwords do not match</div>";
                                            echo "<script>
                                                document.getElementsByName('password')[0].value = '';
                                                document.getElementsByName('confirmPassword')[0].value = '';
                                            </script>";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Please fill in all fields</div>";
                        }
                    }
                }
                ?>
            </form>
        </div>
    </section>
    <!-- register end -->
</body>
</html>
