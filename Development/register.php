<?php
require 'database.php';
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
            <form action="register.php" method="post"> <!-- Ensure action points to the script -->
                <div class="grid-container">
                    <div class="grid-item">
                        <div >
                            <input type="text" name="firstname" id="firstname" placeholder="First Name" class="input-field" required />
                        </div>
                    </div>
                    <div class="grid-item">
                        <div>
                            <input type="text" name="middlename" placeholder="Middle Name" id="middlename" class="input-field" required />
                        </div>
                    </div>
                    <div class="grid-item">
                        <div>
                            <input type="text" name="lastname" placeholder="Last Name" id="lastname" class="input-field" required />
                        </div>
                    </div>
                    <div class="grid-item">
                        <label for="sex">Sex</label>
                        <div class="dropdown">
                            <select id="sex" class="input-field" name="sex" required>
                                <option value="" disabled selected>Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid-item">
                        <label for="birthdate">Birth Date:</label>
                        <div class="input-field">
                            <input type="date" name="birthdate" id="birth" required />
                        </div>
                    </div>
                    <div class="grid-item">
                        <label for="suffix">Suffix</label>
                        <div class="dropdown">
                            <select id="suffix" class="input-field" name="suffix" required>
                                <option value="None">None</option>
                                <option value="Sr.">Sr.</option>
                                <option value="Jr.">Jr.</option>   
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="account">
                <div class="grid-item">
                            <select id="barangayposition" class="input-field" name="barangayposition" required>
                                <option value="" disabled selected>Barangay Position</option>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Barangay Treasurer">Barangay Treasurer</option>
                                <option value="Barangay Personnel">Barangay Personnel</option>
                                <option value="Barangay Health Worker">Barangay Health Worker</option>
                            </select>
                        </div>
                    
                    <div class="input-field">
                        <i class='bx bxs-user icon'></i>
                        <input type="text" placeholder="Username" name="username" id="username" required />
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock icon'></i>
                        <input type="password" placeholder="Password" name="password" id="password" required />
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt icon'></i>
                        <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required />
                    </div>
                </div>
                <button type="submit" name="submit" class="btn log">Register</button>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Fetch POST data
                    $lastname = $_POST["lastname"] ?? '';
                    $middlename = $_POST["middlename"] ?? '';
                    $firstname = $_POST["firstname"] ?? '';
                    $sex = $_POST["sex"] ?? '';
                    $suffix = $_POST["suffix"] ?? '';
                    $birthdate = $_POST["birthdate"] ?? '';
                    $barangayposition = $_POST["barangayposition"] ?? '';
                    $username = $_POST["username"] ?? '';
                    $password = $_POST["password"] ?? '';
                    $confirmpassword = $_POST["confirmPassword"] ?? ''; // Correct field name

                    if (!empty($lastname) && !empty($middlename) && !empty($firstname) && !empty($sex) && !empty($birthdate) && !empty($barangayposition) && !empty($username) && !empty($password) && !empty($confirmpassword)) {
                        
                        // Check if the selected position already exists in the database
                        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE barangayposition = ?");
                        if ($stmt === false) {
                            die("MySQL error: " . $conn->error);
                        }
                        
                        $stmt->bind_param("s", $barangayposition);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        // Count existing positions
                        $existing_positions = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($row['barangayposition'] == 'Barangay Captain' || 
                                $row['barangayposition'] == 'Barangay Secretary' || 
                                $row['barangayposition'] == 'Barangay Treasurer') {
                                $existing_positions++;
                            }
                        }
                        
                        // Close the previous statement to execute another
                        $stmt->close();
                        
                        // Check if position limit exceeded for Barangay Captain, Secretary or Treasurer
                        if ($barangayposition == 'Barangay Captain' && $existing_positions >= 1)  {
                            echo "<div class='alert alert-danger'>There can only be one Barangay Captain.</div>";
                        }        
                        elseif ($barangayposition == 'Barangay Secretary' && $existing_positions >= 1) {
                        echo "<div class='alert alert-danger'>There can only be one Barangay Secretary.</div>";
                        }         
                        elseif ($barangayposition == 'Barangay Treasurer' && $existing_positions >= 1) {
                        echo "<div class='alert alert-danger'>There can only be one Barangay Treasurer.</div>";
                        }  else {
                            // Proceed with password validation and registration
                            if ($password == $confirmpassword && strlen($password) < 8) {
                                // Password is too short
                                echo "<div class='alert alert-danger'>Password should be at least 8 characters long</div>";
                            } elseif ($password == $confirmpassword) {
                                // Passwords match and are of sufficient length, proceed with registration
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                $stmt = $conn->prepare("INSERT INTO tb_user (lastname, middlename, firstname, sex, suffix, birthdate, barangayposition, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                if ($stmt === false) {
                                    die("MySQL error: " . $conn->error);
                                }

                                $stmt->bind_param("sssssssss", $lastname, $middlename, $firstname, $sex, $suffix, $birthdate, $barangayposition, $username, $hashed_password);

                                if ($stmt->execute()) {
                                    echo "<script>alert('Registration Successful'); window.location.href='login.php';</script>";
                                    exit();
                                } else {
                                    echo "<script>alert('Registration Failed');</script>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Passwords Do Not Match</div>";
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
