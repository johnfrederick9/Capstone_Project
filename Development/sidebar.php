<?php
session_start();
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
            <a href="../../pages/dashboard/dashboard.php" title="Dashboard">
              <i class='bx bxs-dashboard icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/resident/table_resident.php" title="Resident">
            <i class='bx bxs-user-plus icon'></i>
              <span class="text nav-text">Resident Management</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/employee/table_employee.php" title="Employee">
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
            <a href="../../pages/document/table_document.php" title="Document">
            <i class='bx bxs-folder icon'></i>
              <span class="text nav-text">Document Library</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/project/table_project.php" title="Project">
              <i class='bx bxs-chalkboard icon'></i>
              <span class="text nav-text">Project Monitoring</span>
            </a>
          </li>

          <li class="nav-link dropdown">
            <a href="#" title="Certificates">
              <i class='bx bxs-certification icon'></i>
              <span class="text nav-text">Certificate Library</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="nav-link dropdown-content">
              <li><a href="../../pages/certificate/table_indigency.php" title="Indigency Certificate">
            <i class='bx bxs-certification'></i> 
                <span class="text nav-text">&nbsp;&nbsp;Indigency Certificate</span>
              </a>
              </li>
              <li><a href="#"></a></li>
            </ul>
          </li>

          <li class="nav-link">
            <a href="../../pages/inventory/table_inventory.php"  title="Inventory">
              <i class='bx bxs-briefcase icon' ></i>
              <span class="text nav-text">Inventory</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/financial/table_financial.php"  title="Financial">
              <i class='bx bxs-wallet icon'></i>
              <span class="text nav-text">Financial Library</span>
            </a>
          </li>
          
          <li class="nav-link">
            <a href="../../pages/calendar/event_calendar.php"  title="Calendar">
              <i class='bx bxs-calendar-event icon' ></i>
              <span class="text nav-text">Event Calendar</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="../../pages/reports/reports.php"  title="Graphs & Reports">
              <i class='bx bxs-report icon'></i>
              <span class="text nav-text">Graphs & Reports</span>
            </a>
          </li>

        </ul>
      </div>
      <div class="bottom-content">
        <li>
        <a href="#!" data-id="<?php echo $row['user_id']; ?>" data-bs-toggle="modal" data-bs-target="#UpdateProfileModal" title="Profile" class="editbtn">
                <i class='bx bxs-user icon'></i>
                <span class="text nav-text">
                    <?php 
                        $firstname = ucfirst(strtolower($row['firstname']));
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
    const body = document.querySelector('body'),
          sidebar = body.querySelector('nav'),
          toggle = body.querySelector(".Logo"),
          searchBtn = body.querySelector(".name"),
          modeSwitch = body.querySelector(".toggle-switch"),
          modeText = body.querySelector(".mode-text"),
          dropdown = body.querySelector(".dropdown"),
          dropdownContent = body.querySelector(".dropdown-content");

    if (body.classList.contains("dark")) {
      modeText.innerText = "Light mode";
    } else {
      modeText.innerText = "Dark mode";
    }

    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });

    searchBtn.addEventListener("click", () => {
      sidebar.classList.remove("close");
    });

    modeSwitch.addEventListener("click", () => {
      body.classList.toggle("dark");
      let theme = "light";
      if (body.classList.contains("dark")) {
        theme = "dark";
        modeText.innerText = "Light mode";
      } else {
        theme = "light";
        modeText.innerText = "Dark mode";
      }
      // Save user preference in the database
      saveUserThemePreference(theme);
    });

    dropdown.addEventListener("click", () => {
      dropdownContent.classList.toggle("show");
    });

    function saveUserThemePreference(theme) {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "../../save_theme.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("theme=" + theme);
    }

    function openModal() {
      document.getElementById('overlay').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('overlay').style.display = 'none';
    }
  </script>

</body>

</html>


