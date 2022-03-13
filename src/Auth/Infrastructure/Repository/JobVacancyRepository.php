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
        $modality =$jobVacancy->modality();
        $workingTime =$jobVacancy->workingTime();
        $experience =$jobVacancy->experience();

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
                'created_at' => $now,
                'updated_at' => $now
            ]
        );

        \Log::info('new job vacancy id: '  . $jobVacancyId);

        $jobVacancy->setId($jobVacancyId);

        return $jobVacancy;
    }
}
