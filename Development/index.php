<?php
include 'head.php';
include 'database.php'; // Include your database connection

// Fetch officials from the database
$query = "SELECT user_id, lastname, firstname, middlename, sex, birthdate, barangayposition FROM tb_user";
$result = mysqli_query($conn, $query);
?>
<html>
    <title>Barangay Mantalongon Information System</title>
    <link rel="icon" href="assets/image/Logo.png">
    <body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <img src="assets/image/logo.png" style="height: 60px; margin-top:10px;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="#officials">Officials</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Log In</a>
                                <ul>
                                    <li><a href="login.php">As Officials</a></li>
                                    <li><a href="pages/Samples/table.php">Updates</a></li>
                                </ul>
                            </li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h4>Mantalongon</h4>
                            <h4>Information System</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="assets/image/banner2.jpg" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="assets/image/banner1.jpg" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="assets/image/banner3.jpg" alt="">
                            </div>
                          </div>
                          <!-- // Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>About Us</h6>
                        </div>
                        <img src="assets/image/mantalongon_map.png" alt=""><br>
                        <img src="assets/image/about1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-content">
                        <br><br><p>This Barangay Information System (BIS) is a digital platform designed to enhance the administrative and operational efficiency of barangays, the smallest administrative units in the Philippines. It provides a centralized database for managing resident information, issuing documents and certificates, handling case and incident reports, and tracking financial transactions.</p>
                        <p>The system also monitors projects and programs, facilitates communication between barangay officials and residents, and manages health and social services. By automating routine tasks and providing accessible data, BIS improves transparency, supports decision-making, and fosters community engagement. It serves as a valuable tool for both barangay officials and residents, streamlining processes and enhancing the quality of local governance and service delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->

    <!-- ***** Menu Area Starts ***** -->
    <section class="section" id="officials">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Barangay Staff & Officials</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item-carousel">
            <div class="col-lg-12">
                <div class="owl-menu-item owl-carousel">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="item">
                        <div class='card card1'>
                            <div class='info'>
                                <h1 class='title'><?php echo $row['barangayposition']; ?></h1>
                                <p class='description'><?php
                                    $firstname = ucfirst(strtolower($row['firstname']));
                                    $middlename_initial = $row['middlename'] ? ucfirst(strtolower(substr($row['middlename'], 0, 1))) . '.' : '';
                                    $lastname = ucfirst(strtolower($row['lastname']));
                                    echo $firstname . ' ' . $middlename_initial . ' ' . $lastname;
                                    ?> <br> Birthdate: <?php echo $row['birthdate']; ?> <br> Sex: <?php echo $row['sex']; ?><br> </p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
        include 'footer.php';
        ?>
    <!----===== jQuery ===== -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!----===== Plugins For Index ===== -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/slick.js"></script> 
    <script src="assets/js/isotope.js"></script> 

    <!----===== Global Init ===== -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
<?php
mysqli_close($conn);
?>
