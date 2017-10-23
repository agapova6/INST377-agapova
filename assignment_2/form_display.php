<!DOCTYPE html>
<html>
<head>	
<style>
	div {
		margin-top: 20px;
		margin-bottom: 20px;
	}
	td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    td.key {
        background-color: #f95ca2;
    }
    td.value {
        background-color: pink;
    }
    td.exist {
        background-color: #f7b4d2;
    }
    
</style>

<script>
function validateForm() {
    // you can write a code for validating your forms (if you want).
}
</script>

</head>
<body>

<?php 
// forms need to be generated here inside the PHP tag.

//receving the submitted data
$answer1 = $_POST["q1_fn"];
$answer2 = $_POST["q2_ln"];
$answer3 = $_POST["q3_email"];
$answer4 = $_POST["q4_address"];
$answer5 = $_POST["q5_city"];

$server = "localhost";
$username = "root";
$password = "password";
$db = "sakila";

//connecting to server
$conn = mysqli_connect($server, $username, $password, $db);

//checking connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br><br>";

//writing the function for general queries
function query_to_db($conn, $sql){
    $result = mysqli_query($conn, $sql);
    if ($result) {   
        echo "Your query was successful.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//fixing any odd spelling from user input for Q1 using function
$answer1_escaped = mysqli_real_escape_string($conn, $answer1);
$answer1_sql = "SELECT * FROM customer
                WHERE first_name = '$answer1_escaped'"; 
                  
//checking if the submitted data for Q1 is new or already exists		
$result = mysqli_query($conn, $answer1_sql);
$answer1_exists = "new";
if (mysqli_num_rows($result) > 0) { 
    $answer1_exists = "exists"; 
}

//for Q2...
$answer2_escaped = mysqli_real_escape_string($conn, $answer2);
$answer2_sql = "SELECT * FROM customer
                   WHERE last_name = '$answer2_escaped'"; 
	
$result = mysqli_query($conn, $answer2_sql);
$answer2_exists = "new";
if (mysqli_num_rows($result) > 0) {  
    $answer2_exists = "exists"; 
}

//for Q3...
$answer3_escaped = mysqli_real_escape_string($conn, $answer3);
$answer3_sql = "SELECT * FROM customer
                   WHERE first_name = '$answer3_escaped'"; 
	
$result = mysqli_query($conn, $answer3_sql);
$answer3_exists = "new";
if (mysqli_num_rows($result) > 0) {  
    $answer3_exists = "exists"; 
}

//for Q4...
$answer4_escaped = mysqli_real_escape_string($conn, $answer4);
$answer4_sql = "SELECT * FROM customer
                   WHERE first_name = '$answer4_escaped'"; 
                   
$result = mysqli_query($conn, $answer4_sql);
$answer4_exists = "new";
if (mysqli_num_rows($result) > 0) {
    $answer4_exists = "exists"; 
}

//for Q5...
$answer5_escaped = mysqli_real_escape_string($conn, $answer5);
$answer5_sql = "SELECT * FROM customer
                   WHERE first_name = '$answer5_escaped'"; 
                   
$result = mysqli_query($conn, $answer5_sql);
$answer5_exists = "new";
if (mysqli_num_rows($result) > 0) {
    $answer5_exists = "exists"; 
}


?>

<h3>Information about customer:</h3>

<div>
<table> <!-- printing results in a table -->
<tr>
    <td class="key">First name</td>
    <td class="value"><?php print $answer1?></td>
    <td class="exist"><?php print $answer1_exists?></td>
</tr>
<tr>
    <td class="key">Last name</td>
    <td class="value"><?php print $answer2?></td>
    <td class="exist"><?php print $answer2_exists?></td>
</tr>
<tr>
    <td class="key">Email</td>
    <td class="value"><?php print $answer3?></td>
    <td class="exist"><?php print $answer3_exists?></td>
</tr>
<tr>
    <td class="key">Address</td>
    <td class="value"><?php print $answer4?></td>
    <td class="exist"><?php print $answer4_exists?></td>
</tr>
<tr>
    <td class="key">City</td>
    <td class="value"><?php print $answer5?></td>
    <td class="exist"><?php print $answer5_exists?></td>
</tr>
  
</table>
</div>


</body>
</html>
