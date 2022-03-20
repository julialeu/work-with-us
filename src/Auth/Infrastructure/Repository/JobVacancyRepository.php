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

        $jobVacancy->setId($jobVacancyId);

        return $jobVacancy;
    }

    public function getJobVacanciesByUserIdPaginated(
        int $pageNumber,
        int $userId,
        int $resultsPerPage
    ): array {

        $offset = ($resultsPerPage * $pageNumber) - $resultsPerPage;

        $query = "select user_id, title, company, location,
                       modality, working_time,
                       experience, uuid, created_at
                from job_vacancies
                where user_id = $userId";

        $query = $query . " limit " . $resultsPerPage . " OFFSET " . $offset;
        $result = DB::select($query);

        return $result;
    }

    public function countJobVacanciesByUserId(int $userId): int
    {
        $query = "select count(id) as total from job_vacancies where user_id = $userId";
        $result = DB::select($query);

        $numItems = $result[0]->total;

        return $numItems;
    }
}
