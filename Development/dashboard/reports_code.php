<?php
// Query to get the count of residents by educational attainment where isDisplayed = 1
$query = "
    SELECT 
        resident_educationalattainment, 
        COUNT(*) as count 
    FROM tb_resident 
    WHERE isDisplayed = 1 
    AND resident_educationalattainment IN ('Elementary', 'High School, Undergrad', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor Degree', 'Master Degree', 'Doctorate Degree')
    GROUP BY resident_educationalattainment
    ORDER BY FIELD(resident_educationalattainment, 'Elementary', 'High School, Undergrad', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor Degree', 'Master Degree', 'Doctorate Degree')
";

$result = mysqli_query($conn, $query);
$educational_data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $educational_data[] = $row;
    }
} else {
    error_log("Error fetching educational attainment data: " . mysqli_error($conn));
}

// Query to get the count of residents by age range where isDisplayed = 1
$ageQuery = "
    SELECT 
        CASE
            WHEN resident_age BETWEEN 1 AND 15 THEN '1-15'
            WHEN resident_age BETWEEN 16 AND 30 THEN '16-30'
            WHEN resident_age BETWEEN 31 AND 59 THEN '31-59'
            WHEN resident_age >= 60 THEN 'More than 60'
        END as age_range,
        COUNT(*) as count 
    FROM tb_resident 
    WHERE isDisplayed = 1 
    GROUP BY age_range
    ORDER BY FIELD(age_range, '1-15', '16-30', '31-59', 'More than 60')
";

$ageResult = mysqli_query($conn, $ageQuery);
$age_data = [];
if ($ageResult) {
    while ($row = mysqli_fetch_assoc($ageResult)) {
        $age_data[] = $row;
    }
} else {
    error_log("Error fetching age data: " . mysqli_error($conn));
}

// Employee Data Queries

// Query to get the count of employees by educational attainment where isDisplayed = 1
$employeeEducationalQuery = "
    SELECT 
        employee_educationalattainment, 
        COUNT(*) as count 
    FROM tb_employee 
    WHERE isDisplayed = 1 
    AND employee_educationalattainment IN ('Elementary', 'High School, Undergrad', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor Degree', 'Master Degree', 'Doctorate Degree')
    GROUP BY employee_educationalattainment
    ORDER BY FIELD(employee_educationalattainment, 'Elementary', 'High School, Undergrad', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor Degree', 'Master Degree', 'Doctorate Degree')
";

$employeeEducationalResult = mysqli_query($conn, $employeeEducationalQuery);
$employee_educational_data = [];
if ($employeeEducationalResult) {
    while ($row = mysqli_fetch_assoc($employeeEducationalResult)) {
        $employee_educational_data[] = $row;
    }
} else {
    error_log("Error fetching employee educational attainment data: " . mysqli_error($conn));
}

// Query to get the count of employees by age range where isDisplayed = 1
$employeeAgeQuery = "
    SELECT 
        CASE
            WHEN employee_age BETWEEN 1 AND 15 THEN '1-15'
            WHEN employee_age BETWEEN 16 AND 30 THEN '16-30'
            WHEN employee_age BETWEEN 31 AND 59 THEN '31-59'
            WHEN employee_age >= 60 THEN 'More than 60'
        END as age_range,
        COUNT(*) as count 
    FROM tb_employee 
    WHERE isDisplayed = 1 
    GROUP BY age_range
    ORDER BY FIELD(age_range, '1-15', '16-30', '31-59', 'More than 60')
";

$employeeAgeResult = mysqli_query($conn, $employeeAgeQuery);
$employee_age_data = [];
if ($employeeAgeResult) {
    while ($row = mysqli_fetch_assoc($employeeAgeResult)) {
        $employee_age_data[] = $row;
    }
} else {
    error_log("Error fetching employee age data: " . mysqli_error($conn));
}

// Query to get the count of blotter statuses
$blotterStatusQuery = "
    SELECT 
        blotter_status, 
        COUNT(*) AS count 
    FROM tb_blotter 
    WHERE isDisplayed = 1 
    GROUP BY blotter_status
    ORDER BY FIELD(blotter_status, 'Pending', 'Resolved', 'Dismissed', 'In Progress')
";

$blotterResult = mysqli_query($conn, $blotterStatusQuery);
$blotter_status = [];
if ($blotterResult) {
    while ($row = mysqli_fetch_assoc($blotterResult)) {
        $blotter_status[] = $row;
    }
} else {
    error_log("Error fetching blotter status data: " . mysqli_error($conn));
}

// Query to get the count of projects by status
$projectStatusQuery = "
    SELECT 
        project_status, 
        COUNT(*) AS count 
    FROM tb_project 
    WHERE isDisplayed = 1 
    GROUP BY project_status
";

$projectResult = mysqli_query($conn, $projectStatusQuery);
$project_status = [];
if ($projectResult) {
    while ($row = mysqli_fetch_assoc($projectResult)) {
        $project_status[] = $row;
    }
} else {
    error_log("Error fetching project status data: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>
