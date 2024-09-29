<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$host = 'localhost';
$dbname = 'barangay_db';
$user = 'root';
$pass = '';

// MySQLi connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check MySQLi connection
if (!$conn) {
    die("MySQLi Connection failed: " . mysqli_connect_error());
}

// PDO connection (optional, only if you need it)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("PDO Connection failed: " . $e->getMessage());
}


/**
 * tb_user *
 * id - INT_PRIMARY KEY_AUTO_INCREMENT
 * lastname - VARCHAR
 * fistname - VARCHAR
 * middlename - VARCHAR
 * sex - VARCHAR
 * birtdate - DATE
 * barangayposition - VARCHAR
 * username - VARCHAR 
 * password - VARCHAR
 */

/**
 * tb_resident *
 * resident_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * resident_lastname - VARCHAR
 * resident_fistname - VARCHAR
 * resident_middlename - VARCHAR
 * resident_maidenname - VARCHAR
 * resident_sex - VARCHAR
 * resident_suffixes - VARCHAR
 * resident_address - VARCHAR
 * resident_educationalattainment - VARCHAR 
 * resident_status - VARCHAR 
 * resident_birtdate - DATE
 * resident_age - INT
 * resident_householdrole - VARCHAR
 * household_id - INT 
 */

 /**
 * tb_employee *
 * employee_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * employee_lastname - VARCHAR
 * employee_fistname - VARCHAR
 * employee_middlename - VARCHAR
 * employee_maidenname - VARCHAR
 * employee_sex - VARCHAR
 * employee_suffixes - VARCHAR
 * employee_address - VARCHAR
 * employee_educationalattainment - VARCHAR 
 * employee_status - VARCHAR 
 * employee_birtdate - DATE
 * employee_age - INT
 * employee_householdrole - VARCHAR
 * household_id - INT 
 */

/**
 * tb_document *
 * document_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * document_name - VARCHAR
 * document_date - DATE
 * document_info - VARCHAR
 * document_type - VARCHAR
* document_filepath - VARCHAR
 */

/**
 * tb_financial *
 * financial_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * financial_type - VARCHAR
 * financial_date - DATE
 * financial_filepath - VARCHAR
 */

/**
* tb_certificate *
* certificate_id - INT_PRIMARY KEY_AUTO_INCREMENT
*/

/**
 * tb_project *
 * project_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * project_name - VARCHAR
 * project_start - DATE
 * project_end - DATE
 * project_budget - DOUBLE
 * project_source - VARCHAR
 * project_status - VARCHAR
 * project_description - VARCHAR
 * project_location - VARCHAR
 * project_managers - VARCHAR
 * project_stakeholders - VARCHAR
 */

/**
* tb_inventory *
* item_id - INT_PRIMARY KEY_AUTO_INCREMENT
* item_name - VARCHAR
* item_description - VARCHAR
* item_count - INT
* item_status - VARCHAR
*/

/**
 * tb_event *
 * event_id - INT_PRIMARY KEY_AUTO_INCREMENT
 * event_name - VARCHAR 
 * event_location - VARCHAR
 * event_type - VARCHAR
 * event_start - DATE
 * event_end - DATE
 */


?>

