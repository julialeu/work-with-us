<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/company_page.css">

    <title>Work With Us</title>

</head>
<body>

<nav class="ccsticky-nav">
    <div class="company">
        {{ $companyName }}
    </div>
</nav>
<div class="main">

    <div class="introduction">
        <h1>Careers at {{ $companyName }}</h1>

        {!! $companyDescription !!}

    </div>

    <br><br><br>

    <div class="openings">

        <br><br>

        <div class="job-vacancies">

            <h2>Job Openings</h2>

            <form>
                <div>
                    <select id="working_time" name="working_time">
                        <option value="">Jornada</option>
                        <option value="full_time" <?php if($workingTime === 'full_time') { echo 'selected'; } ?> >Jornada completa</option>
                        <option value="part_time" <?php if($workingTime === 'part_time') {echo 'selected';} ?> >Media jornada</option>
                    </select>

                    <select id="modality" name="modality">
                        <option value="">Modalidad</option>
                        <option value="on_site" <?php if ($modality === 'on_site') {echo 'selected';} ?> >Presencial</option>
                        <option value="remote" <?php if ($modality === 'remote') {echo 'selected';} ?> >Remoto</option>
                        <option value="hybrid" <?php if ($modality === 'hibryd') {echo 'selected';} ?> >Híbrido</option>
                    </select>

                    <select id="experience" name="experience">
                        <option value="">Experiencia</option>
                        <option value="trainee" <?php if ($experience === 'trainee') {echo 'selected';} ?> >Prácticas</option>
                        <option value="junior" <?php if ($experience === 'junior') {echo 'selected';} ?> >Junior</option>
                        <option value="senior" <?php if ($experience === 'senior') {echo 'selected';} ?> >Senior</option>
                    </select>
                </div>
                <br>
                <button type="submit" value="Submit" class="button submitButton">Filtrar</button>

            </form>



            <ul class="list">

                <li>
                    @foreach ($jobVacancies as $jobVacancy)

                        <?php
                        $date = $jobVacancy->createdAt();
                        $now = new Carbon\Carbon();
                        $diffDays = $date->diffInDays($now);
                        ?>

                        <a class="job-block" href="{{ $companySlug }}/{{ $jobVacancy->urlToken() }}">

                            <div class="item">

                                @if ($diffDays === 1)
                                    <small class="date">Hace {{ $diffDays}} día</small>
                                @else
                                    <small class="date">Hace {{ $diffDays}} días</small>

                                @endif
                                <h3 class="title">{{ $jobVacancy->title() }}</h3>
                                <div>
                                    <span class="modality">{{ $jobVacancy->modality() }}</span>
                                </div>
                                <span class="tag location">{{ $jobVacancy->location() }}</span>
                                <span class="tag working_time">· {{ $jobVacancy->workingTime() }}</span>
                            </div>
                    @endforeach
                </li>
            </ul>

        </div>

        <br><br><br>
        <br><br><br>


    </div>


</div>

</body>
</html>
