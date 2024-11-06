<?php
// Query to get the count of residents by educational attainment where isDisplayed = 1
$query = "
    SELECT 
        resident_educationalattainment, 
        COUNT(*) as count 
    FROM tb_resident 
    WHERE isDisplayed = 1 
    AND resident_educationalattainment IN ('Elementary', 'High School, Undergraduate', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor\'s Degree', 'Master\'s Degree', 'Doctorate Degree')
    GROUP BY resident_educationalattainment
    ORDER BY FIELD(resident_educationalattainment, 'Elementary', 'High School, Undergraduate', 'High School, Graduate', 'College, Undergrad', 'Vocational', 'Bachelor\'s Degree', 'Master\'s Degree', 'Doctorate Degree')
";
$result = mysqli_query($conn, $query);

$educational_data = [];
while($row = mysqli_fetch_assoc($result)) {
    $educational_data[] = $row;
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
while($row = mysqli_fetch_assoc($ageResult)) {
    $age_data[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>
