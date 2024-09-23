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
                   <form id="updateprofile" action="" method="POST">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <input type="hidden" name="trid" id="trid" value="">
                    <div class="container">
                        <div class="profile-section">
                            <div class="profile-picture">
                                <img src="../../assets/image/profile_default.png" alt="Profile Picture">
                            </div>
                            <div class="profile-info">
                                <p><strong><?php $firstname = ucfirst(strtolower($row['firstname']));
                                    $middlename_initial = $row['middlename'] ? ucfirst(strtolower(substr($row['middlename'], 0, 1))) . '.' : '';
                                    $lastname = ucfirst(strtolower($row['lastname']));
                                    echo $firstname . ' ' . $middlename_initial . ' ' . $lastname;
                                    ?></strong></p>
                                <p><?php echo $row["barangayposition"];?></p>
                                <p>Suffix: <?php echo $row["suffix"];?></p>
                                <p>Sex: <?php echo $row["sex"];?></p>
                                <p>BirthDate: <?php echo date("F j, Y", strtotime($row["birthdate"])); ?></p>

                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="form-grid">
                                <!-- Name fields -->
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" value="<?php echo $row["lastname"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" name="firstname" value="<?php echo $row["firstname"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" id="middlename" name="middlename" value="<?php echo $row["middlename"];?>">
                                </div>

                                <!-- Suffix, Sex, Birth Date fields -->
                                <div class="form-group">
                                    <label for="suffix">Suffix</label>
                                    <select id="suffix" class="input-field" name="suffix" required>
                                        <option value="None" <?php echo $row['suffix'] === 'None' ? 'selected' : ''; ?>>None</option>
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
                                    <input type="date" id="birthdate" name="birthdate" value="<?php echo $row["birthdate"];?>">
                                </div>
                            </div>

                            <!-- Username and Password -->
                            <div class="form-group full-width">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $row["username"];?>">
                            </div>

                           <!-- <div class="form-group full-width">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required>
                            </div>-->
                        </div>
                    </div> 
                   </form>
                </div>
            </div>
        </div>
    </div>
</section>