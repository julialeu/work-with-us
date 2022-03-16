<?php

namespace WorkWithUs\Auth\Infrastructure\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;

class JobVacancyRepository
{
    public function createJobVacancy(JobVacancy $jobVacancy): JobVacancy
    {
        $userId = $jobVacancy->userId();
        $title = $jobVacancy->title();
        $company = $jobVacancy->company();
        $location = $jobVacancy->location();
        $modality = $jobVacancy->modality();
        $workingTime = $jobVacancy->workingTime();
        $experience = $jobVacancy->experience();
        $uuid = $jobVacancy->uuid();
        $urlToken = $jobVacancy->urlToken();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $jobVacancyId = DB::table('job_vacancies')->insertGetId(
            [
                'user_id' => $userId,
                'title' => $title,
                'company' => $company,
                'location' => $location,
                'modality' => $modality,
                'working_time' => $workingTime,
                'experience' => $experience,
                'uuid' => $uuid,
                'url_token' => $urlToken,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        \Log::info('new job vacancy id: ' . $jobVacancyId);

        $jobVacancy->setId($jobVacancyId);

        return $jobVacancy;
    }

    public function getAll(
        int $userId
    ): array
    {
        $query = "select title, company, location,
                       modality, working_time,
                       experience, created_at
                from job_vacancies
                where user_id = $userId";

        $result = DB::select($query);

        return $result;
    }
}
