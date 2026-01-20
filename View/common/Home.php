<?php
// Frontend-only Home Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AIUB Portal | Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(
                rgba(0,0,0,0.55),
                rgba(0,0,0,0.55)
            ),
            url("assets/img/aiub-image.jpg") no-repeat center center/cover;
            color: #fff;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: rgba(0,0,0,0.55);
        }

        header img {
            height: 55px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 28px;
            font-weight: 500;
            opacity: 0.9;
        }

        nav a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .hero {
            min-height: calc(100vh - 90px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 12px;
        }

        .hero p {
            max-width: 750px;
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.95;
        }

        .hero .buttons {
            margin-top: 30px;
        }

        .hero .buttons a {
            display: inline-block;
            padding: 14px 34px;
            border-radius: 30px;
            background: #0056b3;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            margin: 0 10px;
            transition: background 0.3s;
        }

        .hero .buttons a:hover {
            background: #003f88;
        }

        footer {
            background: rgba(0,0,0,0.65);
            text-align: center;
            padding: 14px;
            font-size: 14px;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }
        }
    </style>
</head>

<body>

<header>
    <img src="assets/img/aiub-logo.png" alt="AIUB Logo">

    <nav>
        <a href="#">About</a>
        <a href="#">Academics</a>
        <a href="#">Admission</a>
        <a href="#">Research</a>
        <a href="#">Campus Life</a>
        <a href="index.php?page=login">Login</a>
    </nav>
</header>

<section class="hero">
    <h1>American International University Bangladesh</h1>
    <p>
        Empowering future leaders through excellence in education, research,
        innovation, and global engagement. This portal connects students,
        teachers, alumni, and administrators in one unified academic system.
    </p>

    <div class="buttons">
        <a href="index.php?page=login">AIUB Research & Internship Management Portal</a>
    </div>
</section>



</body>
</html>
