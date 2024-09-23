<!-- Update Profile -->
<section class="profile">
    <div class="modal fade" id="UpdateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabelProfile" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg to increase width -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProfile">Profile Update</h5>
                    <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <form id="updateprofile" action="">
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <input type="hidden" name="trid" id="trid" value="">
                    <div class="container">
                        <div class="profile-section">
                            <div class="profile-picture">
                                <img src="../../assets/image/profile_default.png" alt="Profile Picture">
                            </div>
                            <div class="profile-info">
                                <p><strong>Name</strong></p>
                                <p>Barangay Position</p>
                                <p>Suffix</p>
                                <p>Sex</p>
                                <p>Birth Date</p>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                            <div class="form-section">
                                <div class="form-grid">
                                    <!-- Name fields -->
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="lastname" name="last-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="firstname" name="first-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name">Middle Name</label>
                                        <input type="text" id="middlename" name="middle-name">
                                    </div>

                                    <!-- Suffix, Sex, Birth Date fields -->
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select id="suffix" class="input-field" name="suffix" required>
                                            <option value="None">None</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="Jr.">Jr.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <select id="sex" class="input-field" name="sex" required>
                                            <option value="" disabled>Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="birth-date">Birth Date</label>
                                        <input type="date" id="birthdate" name="birth-date">
                                    </div>
                                </div>

                                <!-- Username field -->
                                <div class="form-group full-width">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username">
                                </div>

                                <div class="form-group full-width">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="username">
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $('#example').on('click', '.editbtn ', function(event) {
    var table = $('#example').DataTable();
    var trid = $(this).closest('tr').attr('id');
    // console.log(selectedRow);
    var user_id = $(this).data('id');
    $('#exampleModal').modal('show');

    $.ajax({
        url: "get_single_data.php",
        data: {
            user_id: user_id
        },
        type: 'post',
        success: function(data) {
            var json = JSON.parse(data);
            $('#lastname').val(json.lastname);
            $('#firstname').val(json.firstname);
            $('#middlename').val(json.middlename);
            $('#suffix').val(json.suffix);
            $('#sex').val(json.sex);
            $('#birthdate').val(json.birthdate);
            $('#username').val(json.username);
            $('#user_id').val(user_id);
            $('#trid').val(trid);
        }
    })
});
</script>