<?php

namespace WorkWithUs\Auth\Infrastructure\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;

class JobVacancyRepository
{

    public function createJobVacancy(JobVacancy $jobVacancy): void
    {
        $userId = $jobVacancy->userId();
        $title = $jobVacancy->title();
        $company = $jobVacancy->company();
        $location = $jobVacancy->location();
        $modality =$jobVacancy->modality();
        $workTime =$jobVacancy->workTime();
        $experience =$jobVacancy->experience();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $id = DB::table('job_vacancies')->insertGetId(
            [
                'user_id' => $userId,
                'title' => $title,
                'company' => $company,
                'location' => $location,
                'modality' => $modality,
                'working_time' => $workTime,
                'experience' => $experience,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );


//        $query = "
//        INSERT INTO job_vacancies (user_id, title, company, location, modality, working_time, experience, created_at, update_at )
//        VALUES ('$userId','$title', '$company', '$location', '$modality', '$workTime', '$experience', $now, $now);
//        ";
//
//        DB::insert( $query );

        //var_dump($query);
    }
}
