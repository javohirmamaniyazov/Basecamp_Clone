<!DOCTYPE html>
<html>
<head>
    <title>Basecamp</title>
    <style>
        /* CSS styles for the navbar */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #34495e;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-title {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            padding-top: 15px;

        }

        .navbar-title a {
            text-decoration: none;
            color: #fff;
        }

        .navbar-buttons {
            display: flex;
            gap: 10px;
        }

        .navbar-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .navbar-button:hover {
            background-color: #2980b9;
        }

        .navbar-info {
            margin: 50px auto;
            text-align: center;
            font-size: 18px;
            color: #333;
            background-color: #f8f8f8;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .navbar-info h1 {
            font-size: 32px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .navbar-info p {
            margin-bottom: 10px;
        }

        .navbar-info-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .navbar-info-button:hover {
            background-color: #2980b9;
        }

        .basecamp-images {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .basecamp-images img {
            width: 200px;
            height: auto;
            margin: 10px;
            transition: transform 0.3s ease;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .basecamp-images img:hover {
            transform: scale(1.1);
        }

        .features {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 50px;
            padding: 0;
            list-style-type: none;
        }

        .feature-card {
            width: 300px;
            height: 200px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .feature-card-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .feature-card-description {
            font-size: 16px;
            color: #666;
            text-align: center;
            padding: 0 20px;
        }

        .basecamp_title {
            display: flex;
        }

        h4 {
            margin-top:5px;
            margin-left: 4px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-title">
            <a class="basecamp_title" href="/"> <img class="basecamp-logo" src="https://assets.stickpng.com/thumbs/62c6f1487a58a4aa1fb770a7.png" width="35px" height="35px"/><h4>BASECAMP</h4></a>
        </div>
        @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="navbar-button">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="navbar-button">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </nav>

    <div class="navbar-info">
        <h1>Streamline Your Projects with Basecamp</h1>
        <p>Basecamp is a powerful project management tool that allows you to collaborate with your team, manage tasks, and stay organized. With features like message boards, to-do lists, file sharing, and more, Basecamp helps you keep everything in one place and easily accessible.</p>
        <a href="/signup" class="navbar-info-button">Get Started</a>
    </div>

    <div class="basecamp-images">
        <img src="data:image/jpeg;base64,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" alt="Basecamp Logo 1">
        <img src="data:image/png;base64,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" alt="Basecamp Logo 2">
        <img src="data:image/jpeg;base64,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" alt="Basecamp Logo 3">
    </div>

    <ul class="features">
        <li class="feature-card">
            <h2 class="feature-card-title">Task Management</h2>
            <p class="feature-card-description">Create and assign tasks to team members, set due dates, track progress, and get notified when tasks are completed.</p>
        </li>
        <li class="feature-card">
            <h2 class="feature-card-title">Collaboration</h2>
            <p class="feature-card-description">Communicate with your team through message boards, share files, and have discussions in a centralized location.</p>
        </li>
        <li class="feature-card">
            <h2 class="feature-card-title">File Sharing</h2>
            <p class="feature-card-description">Upload and share files with your team, ensuring everyone has access to the latest version and can collaborate seamlessly.</p>
        </li>
        <li class="feature-card">
            <h2 class="feature-card-title">Calendar</h2>
            <p class="feature-card-description">Keep track of important dates, deadlines, and events with the integrated calendar feature.</p>
        </li>
    </ul>

    <!-- Rest of your page content goes here -->

</body>
</html>
