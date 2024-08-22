<?php
session_start();

// check if user is already logged in, redirect to login page
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

// check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pasword = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $birth = date('Y-m-d', strtotime($_POST['birth']));
    $hobby = $_POST['hobby'];

    // validate form data
	$errors = array();

	if (empty($name)) {
	    $errors[] = "Name is required.";
	}

	if (empty($email)) {
	    $errors[] = "Email is required.";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $errors[] = "Invalid email format.";
	}

	if (empty($pasword)) {
	    $errors[] = "Password is required.";
	} elseif (strlen($pasword) < 6) {
	    $errors[] = "Password must be at least 6 characters long.";
	}

	if ($pasword != $confirm_password) {
	    $errors[] = "Passwords do not match.";
	}

	if (empty($gender)) {
	    $errors[] = "Gender is required.";
	}

	if (empty($birth)) {
	    $errors[] = "Date of birth is required.";
	} else {
	    $currentYear = date('Y');
	    $minBirthYear = $currentYear - 100;
	    $maxBirthYear = $currentYear - 18;
	    $birthYear = date('Y', strtotime($birth));

	    if ($birthYear < $minBirthYear || $birthYear > $maxBirthYear) {
	        $errors[] = "Invalid birth date. You must be at least 18 years old.";
	    }
	}

	if (empty($hobby)) {
	    $errors[] = "Hobby is required.";
	}


    // if no errors, save user data to database
	if (count($errors) == 0) {
	    // connect to database (replace the values with your own)
	    include 'config.php';

	    // check if email already exists
	    $sql = "SELECT * FROM users WHERE email='$email'";
	    $result = mysqli_query($conn, $sql);
	    if (mysqli_num_rows($result) > 0) {
	        $errors[] = "Email already exists.";
	    } else {
	        // save user data to database with plain text password
	        $sql = "INSERT INTO users (name, email, pasword, gender, birth, hobby, cdt) VALUES ('$name', '$email', 	'$pasword', '$gender', '$birth', '$hobby', current_timestamp())";

	        if (mysqli_query($conn, $sql)) {
	            // set session variable
	            $_SESSION["email"] = $email;
				$_SESSION["name"] = $name;

	            // redirect to the current page
	            header("location: " . $_SERVER['PHP_SELF']);
	            exit;
	        } else {
	            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	        }
	    }

	    // close database connection
	    mysqli_close($conn);
	}

}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <title>Create account</title>
</head>
<body>

	<!-- New header section -->
	<header class="new-header">
	    <div class="social-media">
	      <a href="#" class="fa fa-facebook"></a>
	      <a href="#" class="fa fa-twitter"></a>
	      <a href="#" class="fa fa-instagram"></a>
	      <a href="#" class="fa fa-youtube-play"></a>
	    </div>
	    <div class="text">
	      <h4>"Experience the Joy of Growing, Start Your Plant Collection Now!"</h4>
		</div>
	</header>
    <div class="container">
        <?php
        // display errors
        if (!empty($errors)) {
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<center><h3>$error</h3></center>";
            }
            echo "</ul>";
        }
        ?>
        <h1>Create Account</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="birth">Date of Birth:</label>
            <input type="date" id="birth" name="birth" required>

            <label for="hobby">Hobby:</label>
            <input type="text" id="hobby" name="hobby" placeholder="Enter your hobby" required>

            <input type="submit" value="Create account" class="btn">
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
