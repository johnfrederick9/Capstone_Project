<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['profile_update'])) {
        // Get the user_id from the session
        if (!isset($_SESSION['user_id'])) {
            die("User is not logged in."); // Ensure user_id is set
        }

        $user_id = intval($_SESSION["user_id"]); // Sanitize user_id

        // Retrieve form data
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
        $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);

        // Construct the SQL query
        $sql = "UPDATE tb_user SET 
                    lastname = '$lastname',
                    firstname = '$firstname',
                    middlename = '$middlename',
                    suffix = '$suffix',
                    sex = '$sex',
                    birthdate = '$birthdate',
                    username = '$username'
                WHERE user_id = $user_id";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "
            <div id='toast' class='toast'>   
                <div class='toast-content'>
                    <i class='bx bxs-check-circle icon'></i>
                    <div class='message'>
                        <span class='text'>Profile Update Successful</span>
                    </div>
                </div>
            </div>
            <script>
                const toast = document.getElementById('toast');
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                    window.location.href = ''; // Reload the page
                }, 800);
            </script>
            ";
        } else {
            echo "<div class='alert alert-danger'>Error updating profile: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!-- Update Profile Section -->
<section class="profile">
    <div class="modal fade" id="UpdateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabelProfile" aria-hidden="true" class="editbtn">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProfile">Profile Update</h5>
                    <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                            <form id="updateprofile" action="" method="POST" enctype="multipart/form-data">
                                <div class="container">
                                    <div class="profile-section">
                                    <div class="profile-picture">
                                <?php
                                    // Check if a profile picture exists for the user in the database
                                    $profile_picture = !empty($row['profile_picture']) ? $row['profile_picture'] : 'profile_default.png';
                                    ?>
                                    <!-- Display the profile picture (either the uploaded one or the default) -->
                                    <img src="<?php echo '../../uploads/profile_pictures/' . $profile_picture; ?>" alt="Profile Picture">
                                    
                                    <!-- Buttons for choosing file and deleting image -->
                                    <div class="button-group" style="display: flex; gap: 5px;">
                                        <!-- Choose File Button -->
                                        <button type="button" class="btn" title="Choose File Image" style="background: none; border: none;" onclick="document.getElementById('profile_picture_input').click()">
                                            <i class='bx bx-image' style="font-size: 20px;"></i>
                                        </button>
                                        <input type="file" id="profile_picture_input" name="profile_picture" accept="image/*" style="display: none;">
                                        
                                        <!-- Delete Image Button -->
                                        <button type="submit" name="delete_profile_picture" title="Delete Image" class="btn" style="background: none; border: none;" onclick="return confirm('Are you sure you want to delete your profile picture?')" >
                                            <i class='bx bx-trash' style="font-size: 20px;"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="profile-info">
                                    <p><strong><?php echo $firstname . ' ' . $middlename_initial . ' ' . $lastname;?></strong></p>
                                    <p><?php echo $row["barangayposition"];?></p>
                                    <p>Sex: <?php echo $row["sex"];?></p>
                                    <p>Birth Date: <?php echo date("F j, Y", strtotime($row["birthdate"])); ?></p>

                                    <form method="POST" enctype="multipart/form-data">
                                        <!-- Other form fields -->

                                        <!-- Hidden input to identify the form submission -->
                                        <input type="hidden" name="profile_update" value="true">

                                        <button type="submit" class="btn btn-primary" id="profile_update" onclick="return confirm('Are you sure you want to update your profile?')">Update</button>
                                    </form>

                                </div>
                            </div>
                            <div class="form-section">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($row["lastname"]);?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($row["firstname"]);?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="middlename">Middle Name</label>
                                        <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($row["middlename"]);?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select id="suffix" class="input-field" name="suffix" required>
                                            <option value=" " <?php echo $row['suffix'] === 'None' ? 'selected' : ''; ?>>None</option>
                                            <option value="Sr." <?php echo $row['suffix'] === 'Sr.' ? 'selected' : ''; ?>>Sr.</option>
                                            <option value="Jr." <?php echo $row['suffix'] === 'Jr.' ? 'selected' : ''; ?>>Jr.</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select id="sex" class="input-field" name="sex" required>
                                            <option value="" disabled <?php echo empty($row['sex']) ? 'selected' : ''; ?>>Sex</option>
                                            <option value="Male" <?php echo $row['sex'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo $row['sex'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">Birth Date</label>
                                        <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($row["birthdate"]);?>">
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row["username"]);?>">
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
