<?php

namespace WorkWithUs\Publishing\Infrastructure\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;

class JobVacancyRepository
{
    public function createJobVacancy(JobVacancy $jobVacancy): JobVacancy
    {
        $userId = $jobVacancy->userId();
        $title = $jobVacancy->title();
        $description = $jobVacancy->description();
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
                'description' => $description,
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

    /**
     * @param int $pageNumber
     * @param int $userId
     * @param int $resultsPerPage
     * @return JobVacancy[]
     */
    public function getJobVacanciesByUserIdPaginated(
        int $pageNumber,
        int $userId,
        int $resultsPerPage
    ): array {

        $offset = ($resultsPerPage * $pageNumber) - $resultsPerPage;

        $query = "select id, title, description, company, location,
                       modality, working_time,
                       experience, uuid, created_at
                from job_vacancies
                where user_id = $userId";

        $query = $query . " limit " . $resultsPerPage . " OFFSET " . $offset;
        $result = DB::select($query);

        $jobVacancies = [];

        foreach ($result as $resultItem) {
            $jobVacancy = new JobVacancy();
            $jobVacancy->setId($resultItem->id);
            $jobVacancy->setTitle($resultItem->title);
            $jobVacancy->setDescription($resultItem->description);
            $jobVacancy->setCompany($resultItem->company);
            $jobVacancy->setLocation($resultItem->location);
            $jobVacancy->setModality($resultItem->modality);
            $jobVacancy->setWorkingTime($resultItem->working_time);
            $jobVacancy->setExperience($resultItem->experience);
            $jobVacancy->setUuid($resultItem->uuid);

            $createdAt = new Carbon($resultItem->created_at);
            $jobVacancy->setCreatedAt($createdAt);

            $jobVacancies[] = $jobVacancy;
        }

        return $jobVacancies;
    }

    public function countJobVacanciesByUserId(int $userId): int
    {
        $query = "select count(id) as total from job_vacancies where user_id = $userId";
        $result = DB::select($query);

        $numItems = $result[0]->total;

        return $numItems;
    }

    public function findByUuid(string $uuid): JobVacancy
    {
        $query = "select * from job_vacancies where uuid = '$uuid'";
        $result = DB::select($query);
        // Item es de tipo stdClass
        $item = $result[0];

        $jobVacancy = new JobVacancy();
        $jobVacancy->setId($item->id);
        $jobVacancy->setUserId($item->user_id);
        $jobVacancy->setTitle($item->title);
        $jobVacancy->setDescription($item->description);
        $jobVacancy->setCompany($item->company);
        $jobVacancy->setLocation($item->location);
        $jobVacancy->setModality($item->modality);
        $jobVacancy->setWorkingTime($item->working_time);
        $jobVacancy->setExperience($item->experience);
        $jobVacancy->setUuid($item->uuid);

        $createdAt = new Carbon($item->created_at);
        $jobVacancy->setCreatedAt($createdAt);

        return $jobVacancy;
    }

    public function editJobVacancy(JobVacancy $jobVacancy): void
    {
        $title = $jobVacancy->title();
        $description = $jobVacancy->description();
        $company = $jobVacancy->company();
        $location = $jobVacancy->location();
        $modality = $jobVacancy->modality();
        $workingTime = $jobVacancy->workingTime();
        $experience = $jobVacancy->experience();
        $uuid = $jobVacancy->uuid();

        $query = "update job_vacancies
        set description = '$description', company = '$company',
            location = '$location', modality = '$modality', working_time = '$workingTime',
            experience = '$experience', title = '$title' where uuid = '$uuid'";

        DB::update($query);
    }
}
