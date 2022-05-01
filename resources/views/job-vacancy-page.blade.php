<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $jobVacancy->title() }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/job_vacancy_page.css">

</head>

<body>

<nav class="ccsticky-nav">
    <div class="company">
        {{ $companyName }}
    </div>
    <div class="job-attribute job-title">
        {{$jobVacancy->title()}}
    </div>
    <div class="job-attribute job-modality">
        @if ($jobVacancy->isModalityRemote())
            Remoto
       @elseif ($jobVacancy->isModalityHibryd())
            Híbrido
        @else
            Presencial
        @endif
    </div>
    <div  class="job-attribute job-location">
        {{ $jobVacancy->location() }}

        <span>· {{ $jobVacancy->workingTime() }}</span>
    </div>
</nav>

<div class="main">

    <div class="introduction">

        <div class="description">
            <h2>Descripción</h2>
        </div>

        {!! $jobVacancy->description() !!}
    </div>

    <div class="buttonApply">
        <button type="submit" value="submit">Inscribirme a esta oferta</button>
    </div>

</div>

</body>
</html>
