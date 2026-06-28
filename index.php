<?php
$submit = false;
$error_msg = "";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "USTravel";

    $con = mysqli_connect($server, $username, $password, $database);

    if(!$con) {
        $error_msg = "Database connection failed!";
    } else {
        $name   = mysqli_real_escape_string($con, $_POST['name']);
        $age    = intval($_POST['age']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $email  = mysqli_real_escape_string($con, $_POST['email']);
        $phone  = mysqli_real_escape_string($con, $_POST['number']);
        $other  = mysqli_real_escape_string($con, $_POST['desc']);

        $sql = "INSERT INTO Trip (name, age, gender, email, phone, other, date)
                VALUES ('$name', $age, '$gender', '$email', '$phone', '$other', NOW())";

        if(mysqli_query($con, $sql)) {
            $submit = true;
        } else {
            $error_msg = "Something went wrong. Please try again.";
        }

        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IIT Delhi US Trip</title>

    <style>

        /* ---- Reset ---- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4ff;
            color: #333;
        }


        /* ---- NAVBAR ---- */
        .navbar {
            background-color: #1a56db;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }


        /* ---- HERO SECTION ---- */
        .hero {
            background-color: #1a56db;
            color: white;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 25px;
        }

        .hero a {
            background-color: #f59e0b;
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }

        .hero a:hover {
            background-color: #d97706;
        }


        /* ---- ABOUT SECTION ---- */
        .about {
            background-color: white;
            padding: 60px 30px;
            text-align: center;
        }

        .about h2 {
            font-size: 30px;
            margin-bottom: 15px;
            color: #1a56db;
        }

        .about p {
            font-size: 16px;
            color: #555;
            max-width: 700px;
            margin: 0 auto 40px auto;
            line-height: 1.7;
        }

        /* 3 cards side by side */
        .cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #e8f0fe;
            border-radius: 10px;
            padding: 30px 20px;
            width: 200px;
            text-align: center;
        }

        .card span {
            font-size: 40px;
        }

        .card h3 {
            margin: 10px 0 5px;
            color: #1a56db;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin: 0;
        }


        /* ---- FORM SECTION ---- */
        .form-section {
            padding: 60px 20px;
            background-color: #f0f4ff;
        }

        .form-box {
            background-color: white;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        /* Blue header inside the form box */
        .form-top {
            background-color: #1a56db;
            color: white;
            text-align: center;
            padding: 30px;
        }

        .form-top h2 {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .form-top p {
            font-size: 15px;
            opacity: 0.9;
        }

        /* The actual form fields */
        .form-body {
            padding: 30px;
        }

        /* Success message */
        .success-msg {
            background-color: #d1fae5;
            border: 2px solid #10b981;
            color: #065f46;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* Error message */
        .error-msg {
            background-color: #fee2e2;
            border: 2px solid #ef4444;
            color: #991b1b;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 15px;
        }

        /* Each label + input pair */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 14px;
            color: #333;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }

        /* Two fields side by side */
        .field-row {
            display: flex;
            gap: 15px;
        }

        .field-row .field {
            flex: 1;
        }

        /* Small red error text under field */
        .field-error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 4px;
            display: none;
        }

        /* Buttons row */
        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .btn-reset {
            flex: 1;
            padding: 12px;
            background-color: #f3f4f6;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-reset:hover {
            background-color: #e5e7eb;
        }

        .btn-submit {
            flex: 1;
            padding: 12px;
            background-color: #1a56db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #1648c0;
        }


        /* ---- FOOTER ---- */
        .footer {
            background-color: #1f2937;
            color: white;
            padding: 40px 30px 20px;
        }

        .footer-columns {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .footer-col h4 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #f9fafb;
        }

        .footer-col p,
        .footer-col a {
            color: #9ca3af;
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
        }

        .footer-col a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 15px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">✈️ IIT Delhi US Trip</div>
        <div>
            <a href="#about">About</a>
            <a href="#form">Register</a>
            <a href="#footer">Contact</a>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero">
        <h1>Explore the United States</h1>
        <p>Join IIT Delhi on an unforgettable journey across America</p>
        <a href="#form">Register Now</a>
    </section>


    <!-- ABOUT -->
    <section class="about" id="about">
        <h2>About This Trip</h2>
        <p>
            Experience the diverse culture, innovation, and natural beauty of the United States.
            This exclusive trip is designed for IIT Delhi students to network, learn, and create
            unforgettable memories.
        </p>
        <div class="cards">
            <div class="card">
                <span>🏙️</span>
                <h3>Major Cities</h3>
                <p>Visit NYC, LA, and more</p>
            </div>
            <div class="card">
                <span>🤝</span>
                <h3>Networking</h3>
                <p>Connect with industry leaders</p>
            </div>
            <div class="card">
                <span>📸</span>
                <h3>Experiences</h3>
                <p>Create lasting memories</p>
            </div>
        </div>
    </section>


    <!-- FORM -->
    <section class="form-section" id="form">
        <div class="form-box">

            <div class="form-top">
                <h2>Registration Form</h2>
                <p>Secure your spot on this incredible journey</p>
            </div>

            <div class="form-body">

                <!-- Success message shown after PHP submit -->
                <?php if($submit): ?>
                <div class="success-msg">
                    ✅ Registration Successful! We are happy to see you joining the US Trip!
                </div>
                <?php endif; ?>

                <!-- Error message from PHP -->
                <?php if($error_msg): ?>
                <div class="error-msg">
                    ⚠️ <?php echo $error_msg; ?>
                </div>
                <?php endif; ?>

                <form action="index.php" method="POST" id="myForm">

                    <!-- Name -->
                    <div class="field">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name">
                        <span class="field-error" id="name-error">Please enter your name.</span>
                    </div>

                    <!-- Age + Gender side by side -->
                    <div class="field-row">
                        <div class="field">
                            <label for="age">Age *</label>
                            <input type="number" id="age" name="age" placeholder="Your age" min="1">
                            <span class="field-error" id="age-error">Please enter a valid age.</span>
                        </div>
                        <div class="field">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="field">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com">
                        <span class="field-error" id="email-error">Please enter a valid email.</span>
                    </div>

                    <!-- Phone -->
                    <div class="field">
                        <label for="number">Contact Number</label>
                        <input type="tel" id="number" name="number" placeholder="9876543210" maxlength="15">
                    </div>

                    <!-- Description -->
                    <div class="field">
                        <label for="desc">Tell Us About Yourself</label>
                        <textarea id="desc" name="desc" rows="4" placeholder="Write something about yourself..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="buttons">
                        <button type="button" class="btn-reset" onclick="resetForm()">Clear Form</button>
                        <button type="submit" class="btn-submit">Submit Registration</button>
                    </div>

                </form>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="footer" id="footer">
        <div class="footer-columns">
            <div class="footer-col">
                <h4>IIT Delhi US Trip</h4>
                <p>Creating unforgettable experiences.</p>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <a href="#about">About</a>
                <a href="#form">Register</a>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>Email: trip@iitdelhi.ac.in</p>
                <p>Phone: +91 XXXX-XXXXX</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2024 IIT Delhi. All rights reserved.
        </div>
    </footer>


    <script>

        // ---- FORM VALIDATION ----
        // Runs when user clicks Submit button
        document.getElementById('myForm').addEventListener('submit', function(e) {

            // Step 1: Hide all old error messages
            document.getElementById('name-error').style.display  = 'none';
            document.getElementById('age-error').style.display   = 'none';
            document.getElementById('email-error').style.display = 'none';

            // Step 2: Assume form is fine
            var isValid = true;

            // Step 3: Check name field
            var name = document.getElementById('name').value;
            if (name.trim() === '') {
                document.getElementById('name-error').style.display = 'block';
                isValid = false;
            }

            // Step 4: Check age field
            var age = document.getElementById('age').value;
            if (age === '' || age < 1) {
                document.getElementById('age-error').style.display = 'block';
                isValid = false;
            }

            // Step 5: Check email field
            var email = document.getElementById('email').value;
            if (email.trim() === '' || !email.includes('@')) {
                document.getElementById('email-error').style.display = 'block';
                isValid = false;
            }

            // Step 6: If something is wrong, stop form from submitting
            if (!isValid) {
                e.preventDefault();
            }

        });


        // ---- RESET FORM ----
        function resetForm() {
            // Ask user to confirm before clearing
            var answer = confirm('Are you sure you want to clear the form?');
            if (answer === true) {
                document.getElementById('myForm').reset();
                // Hide error messages too
                document.getElementById('name-error').style.display  = 'none';
                document.getElementById('age-error').style.display   = 'none';
                document.getElementById('email-error').style.display = 'none';
            }
        }


        // ---- BLUE BORDER on focus ----
        // Loop through all inputs and add focus effect
        var allInputs = document.querySelectorAll('input, select, textarea');

        for (var i = 0; i < allInputs.length; i++) {
            // When user clicks on input, make border blue
            allInputs[i].addEventListener('focus', function() {
                this.style.borderColor = '#1a56db';
            });
            // When user clicks away, put border back to grey
            allInputs[i].addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
            });
        }

    </script>

</body>
</html>