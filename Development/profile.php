<?php
require 'database.php';

session_start(); // Ensure session is started

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = intval($_SESSION["user_id"]); // Sanitize user_id

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['profile_update'])) {
        // Retrieve form data
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
        $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        // Handle profile picture upload
        if (!empty($_FILES['profile_picture']['name'])) {
            $target_dir = "../../uploads/profile_pictures/";
            $profile_picture = basename($_FILES['profile_picture']['name']);
            $target_file = $target_dir . $profile_picture;

            // Validate file type
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($file_type, $allowed_types)) {
                echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and GIF are allowed.</div>";
            } else {
                // Move the uploaded file
                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                    // Update profile picture in the database
                    $sql = "UPDATE tb_user SET profile_picture = '$profile_picture' WHERE user_id = $user_id";
                    mysqli_query($conn, $sql);
                } else {
                    echo "<div class='alert alert-danger'>Error uploading profile picture.</div>";
                }
            }
        }

        // Update user details in the database
        $sql = "UPDATE tb_user SET 
                    lastname = '$lastname',
                    firstname = '$firstname',
                    middlename = '$middlename',
                    suffix = '$suffix',
                    sex = '$sex',
                    birthdate = '$birthdate',
                    username = '$username'
                WHERE user_id = $user_id";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Profile updated successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . mysqli_error($conn) . "</div>";
        }
    }

    // Handle profile picture deletion
    if (isset($_POST['delete_profile_picture'])) {
        $sql = "UPDATE tb_user SET profile_picture = 'profile_default.png' WHERE user_id = $user_id";
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success'>Profile picture removed successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error removing profile picture: " . mysqli_error($conn) . "</div>";
        }
    }
}

// Fetch user details
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = $user_id");
$row = mysqli_fetch_assoc($result);
?>

<!-- Profile Section -->
<section class="profile">
    <div class="modal fade" id="UpdateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabelProfile" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProfile">Profile Update</h5>
                    <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="container">
                            <div class="profile-section">
                                <div class="profile-picture">
                                    <?php
                                    $profile_picture = !empty($row['profile_picture']) ? $row['profile_picture'] : 'profile_default.png';
                                    ?>
                                    <img src="<?php echo '../../uploads/profile_pictures/' . $profile_picture; ?>" alt="Profile Picture" id="profile_picture_preview">

                                    <div class="button-group" style="display: flex; gap: 5px;">
                                        <button type="button" class="btn" title="Choose File Image" style="background: none; border: none;" onclick="document.getElementById('profile_picture_input').click()">
                                            <i class='bx bx-image' style="font-size: 20px;"></i>
                                        </button>
                                        <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*" style="display: none;" onchange="previewProfilePicture(event)">
                                        
                                        <button type="submit" name="delete_profile_picture" title="Delete Image" class="btn" style="background: none; border: none;" onclick="return confirm('Are you sure you want to delete your profile picture?')">
                                            <i class='bx bx-trash' style="font-size: 20px;"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="profile-info">
                                    <p><strong><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></strong></p>
                                    <p><?php echo htmlspecialchars($row['barangayposition']); ?></p>
                                    <p>Sex: <?php echo htmlspecialchars($row['sex']); ?></p>
                                    <p>Birth Date: <?php echo date("F j, Y", strtotime($row["birthdate"])); ?></p>
                                     <!-- Change Password Button -->
                                <button><a href="../change_password.php?user_id=<?php echo $row['user_id']; ?>" class="cpbtn">Change Password</a></button>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-grid">
                                    <!-- Form Fields -->
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($row['middlename']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select id="suffix" name="suffix">
                                            <option value="" <?php echo empty($row['suffix']) ? 'selected' : ''; ?>>None</option>
                                            <option value="Sr." <?php echo $row['suffix'] === 'Sr.' ? 'selected' : ''; ?>>Sr.</option>
                                            <option value="Jr." <?php echo $row['suffix'] === 'Jr.' ? 'selected' : ''; ?>>Jr.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select id="sex" name="sex">
                                            <option value="Male" <?php echo $row['sex'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo $row['sex'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                                            <option value="LGBTQ" <?php echo $row['sex'] === 'LGBTQ' ? 'selected' : ''; ?>>LGBTQ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">Birth Date</label>
                                        <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($row['birthdate']); ?>">
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>">
                                </div>

                                <button type="submit" name="profile_update" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function previewProfilePicture(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('profile_picture_preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
