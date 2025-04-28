<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apartment Management System</title>
    <link rel="stylesheet" href="styless.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        #loginSelect {
            color: white;
            text-decoration: none;
            /* background: linear-gradient(90Deg, #2F80ED); */
            background-color: #2F80ED;
            border: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        @media(max-width:550px){
            #loginSelect{
                /* background-color: black; */
                /* color: black; */
                background: linear-gradient(90Deg, #4CAF50, #2F80ED);
                background-color: #2F80ED;

            }
        }

        /* option {
            background: linear-gradient(45deg, #4CAF50, #2F80ED);

        } */

        nav ul li a:hover {
            color: #FFD700;
        }



        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            /* font-size: 3rem; */
            margin-bottom: 10px;
            text-transform: uppercase;
            animation: fadeIn 2s ease-in-out;
        }

        .hero p {
            /* font-size: 1.2rem; */
            /* margin-bottom: 20px; */
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <section>

                    <select id="loginSelect"  onchange="redirectToLogin()" class="form-select">
                        <option value="">Select login</option>
                        <option value="login.php">Tenant Login</option>
                        <option value="adminLogin.php" >Admin Login</option>
                        <option value= "./employee/e_login.php">Employee Login</option>
                        <option value="./owner/o_login.php">Owner Login</option>
                    </select>
                </section>
                <!-- <li><a href="login.php">Tenant Login</a></li>
                <li><a href="adminLogin.php">Admin Login</a></li>
                <li><a href="./employee/e_login.php">Employee Login</a></li>
                <li><a href="./owner/o_login.php">Owner Login</a></li> -->
                <!-- <li><a href="register.php">Register</a></li> -->
            </ul>
        </nav>
    </header>

    <!-- Main Section -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to the Apartment Management System</h1>
                <p>Your one-stop platform for booking apartments, making payments, and submitting maintenance requests.</p>
                <!-- <a href="register.php">
                    <div class="btn  btn-primary">Get Started</div>
                </a> -->
            </div>
        </section>



        <div class="container">

            <div class="row  my-5">
                <h2 id="key">Our Key Features</h2>
                <div class="col-12 col-md-4 my-3">
                    <div class="card" ">
                        <div class=" card-body">
                        <h5 class="card-title">Find & Book Apartment</h5>
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <p class="card-text">Browse through available apartments and book your dream home in no time.</p>
                        <!-- <a href="#" class="card-link">Card link</a> -->
                        <!-- <a href="#" class="card-link">Another link</a> -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 my-3">
                <div class="card" ">
                        <div class=" card-body">
                    <h5 class="card-title">Secure Payments</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <p class="card-text">Pay your rent securely and on time using our integrated payment system.</p>
                    <!-- <a href="#" class="card-link">Card link</a> -->
                    <!-- <a href="#" class="card-link">Another link</a> -->
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 my-3">
            <div class="card" ">
                        <div class=" card-body">
                <h5 class="card-title">Maintenance Requests</h5>
                <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                <p class="card-text">Easily submit maintenance requests and track their progress.</p>
                <!-- <a href="#" class="card-link">Card link</a> -->
                <!-- <a href="#" class="card-link">Another link</a> -->
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2025 Apartment Management System | All Rights Reserved</p>
            <p>Contact us: <a href="mailto:anal.hasan007@gmail.com">anal.hasan007@gmail.com</a></p>
        </div>
    </footer>

    <script>
    function redirectToLogin() {
        var url = document.getElementById("loginSelect").value;
        if (url) {
            window.location.href = url;
        }
    }
</script>

</body>

</html>