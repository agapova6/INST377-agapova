<!DOCTYPE html>
<html>
<head>	
<style>
	div {
		margin-top: 20px;
		margin-bottom: 20px;
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

//writing function for general queries
function query_to_db($conn, $sql){
    $result = mysqli_query($conn, $sql);
    if ($result) {   
        echo "Your query was successful";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//querying to the DB using PHP 
$sql = 'SELECT first_name, last_name, email, address, city
                   FROM customer AS cstmr
                   JOIN address AS a
                       ON cstmr.address_id = a.address_id
                   JOIN city AS c
                       ON a.city_id = c.city_id 
                   WHERE customer_id = 10
                   ORDER BY last_name;';
		
$result = mysqli_query($conn, $sql);
$rows = array(); //creating an array to hold user's answers
if (mysqli_num_rows($result) > 0) {   
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
} else {
    echo "No results..";
}

$customer = $rows[0];


//closing the connection
mysqli_close($conn);

print "<h3>Welcome, customer! Please fill out the following information:</h3>";
// print $customer['address'];

?>

<div>
<!-- creating form -->
	<form name="customer" action='form_display.php' onsubmit="return validateForm();" method="POST">
		1. What is your first name?
		<input type="text" name="q1_fn" value="<?php print $customer['first_name']?>"><br><br>

        2. What is your last name?
		<input type="text" name="q2_ln" value="<?php print $customer['last_name']?>"><br><br>

        3. What is your email?
		<input type="email" name="q3_email" value="<?php print $customer['email']?>"><br><br>
	
        4. What is your address?
		<input type="text" name="q4_address" value="<?php print $customer['address']?>"><br><br>
        
        5. What is your city?
		<input type="text" name="q5_city" value="<?php print $customer['city']?>"><br><br>
       
	<input type="submit"><br>
	</form>
</div> 

</body>
</html>
