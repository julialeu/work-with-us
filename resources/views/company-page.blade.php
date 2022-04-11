<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Work With Us</title>
    <link rel="stylesheet" href="/company_page.css">

</head>
<body>

<nav class="ccsticky-nav">
    <div class="company">
        {{ $companyName }}
    </div>
</nav>
<div class="main">
    <h1>Careers at Zara</h1>

    <div>
        <br><br>
        <p>Wallbox is a global company, dedicated to changing the way the world uses energy in the electric vehicle
            industry. We create smart charging systems that combine innovative technology with outstanding design and
            manage
            the communication between vehicle, grid, buildng, and charger.
        </p>

        <p>Wallbox offers a complete portfolio of charging and energy management and public chargingsolutions for
            residential and semi-public globally.</p>

        <p>Founded in 2015, with headquarters in Barcelona, Wallbox’s mission is to facilitate the adoption of electric
            vehicles today to make more sustainable use of energy tomorrow.</p>
    </div>

    <br><br><br>

    <div class="openings">

        <br><br>

        <div class="job-vacancies">

            <h3>Job Openings</h3>
            <ul class="list">
                <li>
                    <a class="job-block" href="hola">


                        <div class="item">
                            <small class="date">
                                Posted 3 days ago
                            </small>
                            <h3 class="title">NodeJS Backend Software Engineer</h3>
                            <div>
                                <span class="modality">Remote</span>
                            </div>
                            <span class="location">Spain</span>
                            <span class="working_time">Full time</span>
                        </div>

                    </a>
                </li>
                <li>
                    <div class="item">
                        <small class="date">
                            Posted 3 days ago
                        </small>
                        <h3 class="title">NodeJS Backend Software Engineer</h3>
                        <div>
                            <span class="modality">Remote</span>
                        </div>
                        <span class="location">Spain</span>
                        <span class="working_time">Full time</span>
                    </div>

                </li>

            </ul>

        </div>

        <br><br><br>
        <br><br><br>


    </div>


</div>

</body>
</html>
