<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8"> <!-- Character set -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make the page responsive -->
    <title>MAPH</title> <!-- Title of the page -->
    
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Body styling: Flexbox to center content */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full screen height */
            background: linear-gradient(135deg, #007bff, #6610f2); /* Gradient background */
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Container for the login form */
        .login-container {
            background: #ffffff; /* White background for the form */
            padding: 40px;
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow around the box */
            text-align: center;
            animation: fadeIn 0.8s ease-in-out; /* Fade-in animation */
        }

        /* Animation for fading in the container */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); } /* Start from transparent and slightly smaller */
            to { opacity: 1; transform: scale(1); } /* End at full opacity and normal size */
        }

        /* Login button styling */
        .btn-login {
            background-color: #007bff; /* Blue color */
            color: #fff; /* White text */
            font-size: 1.2rem; /* Slightly larger text */
            padding: 12px 30px; /* Padding inside the button */
            border-radius: 8px; /* Rounded corners */
            border: none;
            transition: all 0.3s ease; /* Smooth transition for hover effect */
            text-decoration: none; /* Remove underline from link */
            display: inline-block; /* Make it inline-block for proper size */
        }

        /* Hover effect on the login button */
        .btn-login:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        /* Logo styling */
        .logo {
            margin-bottom: 20px; /* Space below the logo */
        }

        /* Logo image animation */
        .logo img {
            width: 200px; /* Fixed width */
            height: auto; /* Maintain aspect ratio */
            transition: transform 0.3s ease; /* Smooth transition for hover effect */
        }

        /* Hover effect on logo */
        .logo img:hover {
            transform: rotate(5deg) scale(1.1); /* Rotate and slightly enlarge logo on hover */
        }
    </style>
</head>
<body>
    <!-- Main login container -->
    <div class="login-container">
        <!-- Logo section -->
        <div class="logo">
            <img src="{{ asset('storage/img/logo1.png') }}" alt="Logo MAPH"> <!-- Logo image -->
        </div>

        <!-- Login Button: Links to login route -->
        <a href="{{ route('login') }}" class="btn btn-login">Ingresar</a>
    </div>

    <!-- Bootstrap JS for functionality (e.g., responsive navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
