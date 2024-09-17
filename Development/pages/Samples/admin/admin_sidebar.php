<!DOCTYPE html>
<html lang="en">
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
            <a href="../../pages/dashboard/dashboard.php">
              <i class='bx bxs-dashboard icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/resident/table_resident.php">
            <i class='bx bxs-user-plus icon'></i>
              <span class="text nav-text">Resident Management</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/employee/table_employee.php">
              <i class='bx bxs-group icon'></i>
              <span class="text nav-text">Employee Management</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/document/table_document.php">
            <i class='bx bxs-folder icon'></i>
              <span class="text nav-text">Document Library</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/project/table_project.php">
              <i class='bx bxs-chalkboard icon'></i>
              <span class="text nav-text">Project Monitoring</span>
            </a>
          </li>

          <li class="nav-link dropdown">
            <a href="#">
              <i class='bx bxs-certification icon'></i>
              <span class="text nav-text">Certificate Library</span>
              <i class='bx bx-chevron-down arrow'></i>
            </a>
            <ul class="dropdown-content">
              <li><a href="../../pages/certificate/table_indigency-cert.php">Indigency</a></li>
              <li><a href="#"></a></li>
            </ul>
          </li>

          <li class="nav-link">
            <a href="../../pages/inventory/table_inventory.php">
              <i class='bx bxs-briefcase icon' ></i>
              <span class="text nav-text">Inventory</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="../../pages/financial/table_financial.php">
              <i class='bx bxs-wallet icon'></i>
              <span class="text nav-text">Financial Library</span>
            </a>
          </li>
          
          <li class="nav-link">
            <a href="../../pages/calendar/event_calendar.php">
              <i class='bx bxs-calendar-event icon' ></i>
              <span class="text nav-text">Event Calendar</span>
            </a>
          </li>
          <li class="nav-link">
            <a href="../../pages/reports/reports.php">
              <i class='bx bxs-report icon'></i>
              <span class="text nav-text">Reports</span>
            </a>
          </li>

        </ul>
      </div>
      <div class="bottom-content">

        
        <li>
          <a href="#">
            <i class='bx bxs-user icon'></i>
            <span class="text nav-text">Hello Administrator</p></span>
          </a>
        </li>

        <li>
          <a href="../../logout.php">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>

      </div>
    </div>
  </nav>
  <script>
    // JavaScript for sidebar, mode switch, and dropdown
    const body = document.querySelector('body'),
          sidebar = body.querySelector('nav'),
          toggle = body.querySelector(".Logo"),
          searchBtn = body.querySelector(".name"),
          dropdown = body.querySelector(".dropdown"),
          dropdownContent = body.querySelector(".dropdown-content");



    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });

    searchBtn.addEventListener("click", () => {
      sidebar.classList.remove("close");
    });



    dropdown.addEventListener("click", () => {
      dropdownContent.classList.toggle("show");
    });


    function openModal() {
      document.getElementById('overlay').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('overlay').style.display = 'none';
    }
  </script>

</body>

</html>


