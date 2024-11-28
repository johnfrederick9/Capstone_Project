<?php
require 'database.php';
if (isset($conn) && $conn) {
    if (!empty($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE user_id = $user_id");

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $_SESSION["theme"] = $row["theme"];
        } else {
            $_SESSION["theme"] = "light";
        }

        $user_theme = $_SESSION["theme"];
    } else {
        header("Location: ../../index.php");
        exit;
    }
} else {
    die("Database connection not established.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Barangay Mantalogon Information System</title>
  <link rel="icon" href="../../assets/image/Logo.png">
</head>
<body class="<?php echo $user_theme; ?>">
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img class="Logo" src="../../assets/image/Logo.png" alt="Resident">
        </span>
        
        <div class="text logo-text">
          <span class="name">Barangay Mantalongon<br>Information System</span>
        </div>
      </div>
    </header>

    <div class="menu-bar">
      <div class="menu">
        <ul class="menu-links">
          <li class="nav-link">
            <a href="../dashboard/dashboard.php" title="Dashboard">
              <i class='bx bxs-dashboard icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../resident/table_resident.php" title="Resident">
            <i class='bx bxs-user-plus icon'></i>
              <span class="text nav-text">Resident Management</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../employee/table_employee.php" title="Employee">
              <i class='bx bxs-group icon'></i>
              <span class="text nav-text">Employee Management</span>
            </a>
          </li>

          <!--<li class="nav-link">
            <a href="../../pages/household/table_household.php">
              <i class='bx bxs-home icon'></i>
              <span class="text nav-text">Household Management</span>
            </a>
          </li>-->

          <li class="nav-link">
            <a href="../document/table_document.php" title="Document">
            <i class='bx bxs-folder icon'></i>
              <span class="text nav-text">Document Library</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../project/table_project.php" title="Project">
              <i class='bx bxs-chalkboard icon'></i>
              <span class="text nav-text">Project Monitoring</span>
            </a>
          </li>

          <li class="nav-link dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Certificates">
              <i class='bx bxs-certification icon'></i>
              <span class="text nav-text">Certificate Library</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="nav-link dropdown-content">
              <li>
                <a href="../indigency/table_indigency.php" title="Certificate of Indigency">
                &nbsp; &nbsp; <i class='bx bx-certification'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Indigency</span>
                </a>
              </li>
              <li>
                <a href="../residency/table_residency.php" title="Certificate of Residency">
                &nbsp; &nbsp; <i class='bx bx-certification'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Residency</span>
                </a>
              </li>
              <li>
                <a href="../business_permit/table_permit.php" title="Business Permit">
                &nbsp; &nbsp; <i class='bx bx-certification'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Business Permit</span>
                </a>
              </li>
              <li>
                <a href="../business_employee/table_employee.php" title="Business Employee">
                &nbsp; &nbsp; <i class='bx bx-certification'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Business Employee</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-link dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Inventory">
              <i class='bx bxs-briefcase icon'></i>
                <span class="text nav-text">Inventory Management</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="nav-link dropdown-content">
              <li>
                <a href="../inventory/table_inventory.php" title="Inventory Table">
                &nbsp; &nbsp; <i class='bx bx-briefcase'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Inventory Table</span>
                </a>
              </li>
              <li>
                <a href="../item-transactions/item_transaction.php" title="Item Transaction">
                &nbsp; &nbsp; <i class='bx bx-briefcase'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Item Transactions</span>
                </a>
              </li>
            </ul>
          </li>
      
          <li class="nav-link dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Financial">
            <i class='bx bxs-wallet icon'></i>
              <span class="text nav-text">Financial Library</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="nav-link dropdown-content">
              <li>
                <a href="../rao/table_rao_records.php" title="RAO-PS Table">
                &nbsp; &nbsp; <i class='bx bx-wallet'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;RAO-PS Table</span>
                </a>
              </li>
              <li>
                <a href="../rao-cont/table_rao_cont_records.php" title="RAO-CONT Table">
                &nbsp; &nbsp; <i class='bx bx-wallet'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;RAO-CONT Table</span>
                </a>
              </li>
              <li>
                <a href="../cashbook/table_cashbook_records.php" title="Cashbook Table">
                &nbsp; &nbsp; <i class='bx bx-wallet'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Cashbook Table</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-link dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Reports">
            <i class='bx bxs-report icon'></i>
              <span class="text nav-text">Reports</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="nav-link dropdown-content">
              <li>
                <a href="../blotter/table_blotter.php" title="Blotter Table">
                &nbsp; &nbsp; <i class='bx bxs-report'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Blotter</span>
                </a>
              </li>
              <li>
                <a href="../request/table_request.php" title="Request Table">
                &nbsp; &nbsp; <i class='bx bxs-report'></i>
                  <span class="text nav-text"> &nbsp; &nbsp; &nbsp;Request</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="bottom-content">
        <li>
        <a href="#!" data-id="<?php echo $row['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#UpdateProfileModal" title="Profile" class="editbtn">
                <i class='bx bxs-user icon'></i>
                <span class="text nav-text">
                    <?php 
                        $firstname = ucfirst(($row['firstname']));
                        $middlename_initial = $row['middlename'] ? ucfirst(strtolower(substr($row['middlename'], 0, 1))) . '.' : '';
                        $lastname = ucfirst(strtolower($row['lastname']));
                        echo $firstname . ' ' . $middlename_initial . ' ' . $lastname;
                    ?>
                    <br>
                    <p><?php echo $row["barangayposition"]; ?></p>
                </span>
            </a>

        </li>
        <li>
          <a href="../../logout.php" title="Log-out">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>

        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>

          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>
      </div>
    </div>
  </nav>
<?php
include "profile.php"
?>
<script>
// JavaScript for sidebar, mode switch, and dropdown
document.addEventListener("DOMContentLoaded", function () {
  const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".Logo"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text"),
        dropdowns = document.querySelectorAll('.dropdown');

  // Ensure dropdowns are closed on page load
  closeAllDropdowns();

   // Retrieve and apply saved sidebar state from local storage
   if (localStorage.getItem('sidebarState') === 'open') {
    sidebar.classList.remove("close");
  } else {
    sidebar.classList.add("close");
  }

  // Handle sidebar toggle
  toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    saveSidebarState();
  });

  // Save sidebar state to local storage
  function saveSidebarState() {
    if (sidebar.classList.contains("close")) {
      localStorage.setItem('sidebarState', 'closed');
    } else {
      localStorage.setItem('sidebarState', 'open');
    }
  }

  // Mode switch logic
  modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    const theme = body.classList.contains("dark") ? "dark" : "light";
    modeText.innerText = theme === "dark" ? "Light mode" : "Dark mode";
    saveUserThemePreference(theme);
  });

  function saveUserThemePreference(theme) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../../save_theme.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("theme=" + theme);
  }

  // Dropdown toggle logic
  dropdowns.forEach(dropdown => {
    const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
    const dropdownContent = dropdown.querySelector('.dropdown-content');

    dropdownToggle.addEventListener('click', function (e) {
      e.preventDefault(); // Prevent default anchor behavior

      const isVisible = dropdownContent.style.display === "block";
      closeAllDropdowns(); // Close other open dropdowns

      if (!isVisible) {
        dropdownContent.style.display = "block";
        dropdownContent.style.opacity = "1";
        dropdownContent.style.transform = "translateY(0)";
        dropdownContent.style.pointerEvents = "auto";
      }
    });
  });

  // Close all dropdowns function
  function closeAllDropdowns() {
    dropdowns.forEach(dropdown => {
      const content = dropdown.querySelector('.dropdown-content');
      content.style.display = "none";
      content.style.opacity = "0";
      content.style.transform = "translateY(-10px)";
      content.style.pointerEvents = "none";
    });
  }

  // Close dropdowns when clicking outside
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.dropdown')) {
      closeAllDropdowns();
    }
  });
});

</script>


</body>

</html>


