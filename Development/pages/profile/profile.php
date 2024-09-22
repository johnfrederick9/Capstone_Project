<!-- Update Profile -->
<section class="profile">
    <div class="modal fade" id="UpadateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabelProfile" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg to increase width -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelProfile">Profile Update</h5>
                    <button type="button" class='bx bxs-x-circle icon' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateprofile" action="">
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
                                    <!-- Name fields (Left column) -->
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last-name">
                                    </div>

                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first-name">
                                    </div>

                                    <div class="form-group">
                                        <label for="middle-name">Middle Name</label>
                                        <input type="text" id="middle-name" name="middle-name">
                                    </div>

                                    <!-- Suffix, Sex, and Birth Date fields (Right column) -->
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <input type="text" id="suffix" name="suffix">
                                    </div>

                                    <div class="form-group">
                                        <label for="sex">Sex</label>
                                        <input type="text" id="sex" name="sex">
                                    </div>

                                    <div class="form-group">
                                        <label for="birth-date">Birth Date</label>
                                        <input type="date" id="birth-date" name="birth-date">
                                    </div>
                                </div>

                                <!-- Username and Password fields below the grid -->
                                <div class="form-group full-width">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username">
                                </div>

                                <!--<div class="form-group full-width">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password">-->
                                </div> 
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('submit', '#updateprofile', function(e) {
            e.preventDefault();
            //var tr = $(this).closest('tr');
            var item_name = $('#nameField').val();
            var item_description = $('#descriptionField').val();
            var item_count = $('#countField').val();
            var item_status = $('#statusField').val();
            var trid = $('#trid').val();
            var item_id = $('#item_id').val();
            if (item_name != '' && item_description != '' && item_count != '' && item_status != '') {
                $.ajax({
                    url: "update.php",
                    type: "post",
                    data: {
                        item_name: item_name,
                        item_description: item_description,
                        item_count: item_count,
                        item_status: item_status,
                        item_id: item_id
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            table = $('#example').DataTable();
                            var button = '<td><div class= "buttons"> <a href="javascript:void();" data-id="'+ item_id +'"  class="update-btn btn-sm editbtn" ><i class="bx bx-sync"></i></a>  <a href="!#" data-item_id="' + item_id + '"  class="delete-btn btn-sm deleteBtn" ><i class="bx bxs-trash"></i></a></div></td>';
                            var row = table.row("[id='" + trid + "']");
                            row.row("[id='" + trid + "']").data([item_id, item_name, item_description, item_count, item_status, button]);
                            $('#exampleModal').modal('hide');
                        } else {
                            alert('failed');
                        }
                    }
                });
            } else {
                alert('Fill all the required fields');
            }
        });
        $('#example').on('click', '.editbtn ', function(event) {
        var table = $('#example').DataTable();
        var trid = $(this).closest('tr').attr('id');
        // console.log(selectedRow);
        var item_id = $(this).data('id');
        $('#exampleModal').modal('show');

        $.ajax({
            url: "get_single_data.php",
            data: {
                item_id: item_id
            },
            type: 'post',
            success: function(data) {
                var json = JSON.parse(data);
                $('#nameField').val(json.item_name);
                $('#descriptionField').val(json.item_description);
                $('#countField').val(json.item_count);
                $('#statusField').val(json.item_status);
                $('#item_id').val(item_id);
                $('#trid').val(trid);
            }
        })
    });
    </script>
</section>