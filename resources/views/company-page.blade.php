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

    <div class="introduction">
        <h1>Careers at {{ $companyName }}</h1>

        <br>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
            electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
            Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like
            Aldus PageMaker including versions of Lorem Ipsum.
        </p>

        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin
            literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
            Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem
            Ipsum passage, and going through the cites of the word in classical literature</p>

    </div>

    <br><br><br>

    <div class="openings">

        <br><br>

        <div class="job-vacancies">

            <h3>Job Openings</h3>

            <form>
                <label for="working_time">Jornada:</label>&nbsp
                <select id="working_time" name="working_time">
                    <option value="">Selecciona una opción...</option>
                    <option value="full_time" <?php if($workingTime === 'full_time') { echo 'selected'; } ?> >Jornada completa</option>
                    <option value="part_time" <?php if($workingTime === 'part_time') {echo 'selected';} ?> >Media jornada</option>
                </select><br>

                <label for="modality">Modalidad:</label>&nbsp
                <select id="modality" name="modality">
                    <option value="">Selecciona una opción...</option>
                    <option value="on_site" <?php if ($modality === 'on_site') {echo 'selected';} ?> >Presencial</option>
                    <option value="remote" <?php if ($modality === 'remote') {echo 'selected';} ?> >Remoto</option>
                    <option value="hybrid" <?php if ($modality === 'hibryd') {echo 'selected';} ?> >Híbrido</option>
                </select><br>

                <label for="experience">Experiencia:</label>&nbsp
                <select id="experience" name="experience">
                    <option value="">Selecciona una opción...</option>
                    <option value="trainee" <?php if ($experience === 'trainee') {echo 'selected';} ?> >Prácticas</option>
                    <option value="junior" <?php if ($experience === 'junior') {echo 'selected';} ?> >Junior</option>
                    <option value="senior" <?php if ($experience === 'senior') {echo 'selected';} ?> >Senior</option>
                </select><br><br>

                <br>
                <button type="submit" value="Submit">Submit</button>

{{--                <th><a href="<?php echo($nameUrl); ?>">Nombre</a></th>--}}

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
