<?php
include '../../sidebar.php';
include '../../head.php';
require '../../database.php';
include 'household_code.php';
include 'check_household.php';
?>

<body>
    <section class="home">
        <div id="overlay" class="overlay"></div>
        <div class="text">Household</div>
        <div class="financial">
            <div class="table-container">
                <div class="table-header">
                    <div class="search-box">
                        <i class='bx bx-search icon'></i>
                        <input type="text" id="search" placeholder="Search..." onkeyup="filterTable()" autofocus>
                    </div>
                    <div class="table-actions">
                        <button class="add-popup" onclick="openModal()">+ Add Household</button>
                    </div>
                </div>
                <table class="table-table" id="Table">
                    <thead>
                        <tr>
                            <th>Household Number</th>
                            <th>Total Members</th>
                            <th>Head Of Family</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require '../../database.php';
                        $sql = "SELECT h.household_id, h.total_members, r.resident_firstname, r.resident_lastname
                                FROM household_tb h
                                JOIN tb_resident r ON h.household_id = r.household_id
                                WHERE r.resident_householdrole = 'Head of Family'";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['household_id']}</td>
                                        <td>{$row['total_members']}</td>
                                        <td>{$row['resident_firstname']} {$row['resident_lastname']}</td>
                                        <td>
                                            <div class='buttons'>
                                                <form action='update_inventory.php' method='get' style='display:inline;'>
                                                    <input type='hidden' name='item_id' value='{$row['household_id']}'>
                                                    <button type='submit' class='update-btn' title='Edit'><i class='bx bx-sync'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No households found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- .table-container-->
            <div class="form-container">
                <form action="household_code.php" method="POST" enctype="multipart/form-data">
                    <h1 class="form-header">Household Form</h1>
                    <div style="position: relative;">
                        <span class="add_icon-close" onclick="closeModal()">
                            <i class='bx bxs-x-circle icon' style="position: absolute; left: 250px; margin-top: -70px;"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="householdnumber">Household Number:</label>
                        <input type="text" id="household_id" name="household_id" onblur="checkHousehold()" required>
                    </div>
                    <div class="form-group">
                        <label for="familyhead">Select Head of the Family:</label>
                        <select id="familyhead" name="household_familyhead" required>
                            <?php
                            $residents = $conn->query("SELECT resident_id, resident_firstname, resident_lastname FROM tb_resident WHERE household_id IS NULL");
                            while ($row = $residents->fetch_assoc()) {
                                echo "<option value='" . $row['resident_id'] . "'>" . $row['resident_firstname'] . " " . $row['resident_lastname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="TotalMembers">Total Members:</label>
                        <input type="text" id="totalmembers" name="household_familymembers" required>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="add-btn" name="add_item">
                            <i class='bx bx-plus'></i> Add Household
                        </button>
                    </div>
                </form>
            </div><!-- .inventory-->
            <?php include '../../footer.php' ?>
        </div>
    </section><!-- .home-->
    <script>
        function checkHousehold() {
            var householdId = document.getElementById("household_id").value;
            
            if (householdId !== "") {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "check_household.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText.trim();
                        if (response === "No Household Found") {
                            document.getElementById("totalmembers").value = response;
                        } else {
                            document.getElementById("totalmembers").value = response;
                        }
                    }
                };
                xhr.send("household_id=" + householdId);
            }
        }
    </script>
</body>
</html>
