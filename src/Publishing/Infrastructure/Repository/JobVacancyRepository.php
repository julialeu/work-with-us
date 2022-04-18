<?php

namespace WorkWithUs\Publishing\Infrastructure\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Auth\Domain\Entity\JobVacancy;
use WorkWithUs\Publishing\Domain\ValueObject\JobVacancyStatus;

class JobVacancyRepository
{
    public function createJobVacancy(JobVacancy $jobVacancy): JobVacancy
    {
        $userId = $jobVacancy->userId();
        $jobVacancyStatus = $jobVacancy->jobVacancyStatus();
        $title = $jobVacancy->title();
        $description = $jobVacancy->description();
        $companyId = $jobVacancy->companyId();
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
                'status' => $jobVacancyStatus->getValue(),
                'title' => $title,
                'description' => $description,
                'company_id' => $companyId,
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

        $query = "select job_vacancies.id, status, title, description, company_id, companies.name as company_name, location,
                       modality, working_time,
                       experience, uuid, job_vacancies.created_at
                from job_vacancies
                    inner join companies on companies.id = job_vacancies.company_id
                where user_id = $userId";

        $query = $query . " limit " . $resultsPerPage . " OFFSET " . $offset;

        $result = DB::select($query);

        $jobVacancies = [];

        foreach ($result as $resultItem) {
            $jobVacancyStatus = new JobVacancyStatus($resultItem->status);

            $jobVacancy = new JobVacancy();
            $jobVacancy->setId($resultItem->id);
            $jobVacancy->setJobVacancyStatus($jobVacancyStatus);
            $jobVacancy->setTitle($resultItem->title);
            $jobVacancy->setDescription($resultItem->description);
            $jobVacancy->setCompanyId($resultItem->company_id);
            $jobVacancy->setCompanyName($resultItem->company_name);
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

        $jobVacancyStatus = new JobVacancyStatus($item->status);
        $jobVacancy = new JobVacancy();
        $jobVacancy->setId($item->id);
        $jobVacancy->setCompanyId($item->company_id);
        $jobVacancy->setUserId($item->user_id);
        $jobVacancy->setJobVacancyStatus($jobVacancyStatus);
        $jobVacancy->setTitle($item->title);
        $jobVacancy->setDescription($item->description);
        $jobVacancy->setLocation($item->location);
        $jobVacancy->setModality($item->modality);
        $jobVacancy->setWorkingTime($item->working_time);
        $jobVacancy->setExperience($item->experience);
        $jobVacancy->setUuid($item->uuid);

        $createdAt = new Carbon($item->created_at);
        $jobVacancy->setCreatedAt($createdAt);

        return $jobVacancy;
    }

    public function updateJobVacancy(JobVacancy $jobVacancy): void
    {
        $jobVacancyStatus = $jobVacancy->jobVacancyStatus()->getValue();
        $title = $jobVacancy->title();
        $description = $jobVacancy->description();
        $location = $jobVacancy->location();
        $modality = $jobVacancy->modality();
        $workingTime = $jobVacancy->workingTime();
        $experience = $jobVacancy->experience();
        $uuid = $jobVacancy->uuid();

        $query = "update job_vacancies
        set description = '$description',
            location = '$location', modality = '$modality', working_time = '$workingTime',
            experience = '$experience', status = '$jobVacancyStatus', title = '$title' where uuid = '$uuid'";

        DB::update($query);
    }

    public function findPublishedByCompanyId(int $companyId): array
    {
        $query = "select * from job_vacancies where company_id = $companyId and status = 'published'";
        $result = DB::select($query);

        $jobVacancies = [];

        foreach ($result as $resultItem) {
            $jobVacancyStatus = new JobVacancyStatus($resultItem->status);

            $jobVacancy = new JobVacancy();
            $jobVacancy->setId($resultItem->id);
            $jobVacancy->setJobVacancyStatus($jobVacancyStatus);
            $jobVacancy->setTitle($resultItem->title);
            $jobVacancy->setDescription($resultItem->description);
            $jobVacancy->setCompanyId($resultItem->company_id);
            $jobVacancy->setLocation($resultItem->location);
            $jobVacancy->setModality($resultItem->modality);
            $jobVacancy->setWorkingTime($resultItem->working_time);
            $jobVacancy->setExperience($resultItem->experience);
            $jobVacancy->setUuid($resultItem->uuid);
            $jobVacancy->setUrlToken($resultItem->url_token);

            $createdAt = new Carbon($resultItem->created_at);
            $jobVacancy->setCreatedAt($createdAt);

            $jobVacancies[] = $jobVacancy;
        }

        return $jobVacancies;
    }

    public function getJobVacancyByUrlToken(string $urlToken): JobVacancy
    {

        $query = "select * from job_vacancies where url_token = \"$urlToken\"";

        $result = DB::select($query);
        $item = $result[0];

        $jobVacancyStatus = new JobVacancyStatus($item->status);


        $result = new JobVacancy();
        $result->setId($item->id);
        $result->setJobVacancyStatus($jobVacancyStatus);
        $result->setTitle($item->title);
        $result->setDescription($item->description);
        $result->setCompanyId($item->company_id);
        $result->setLocation($item->location);
        $result->setModality($item->modality);
        $result->setWorkingTime($item->working_time);
        $result->setExperience($item->experience);
        $result->setUuid($item->uuid);

        $createdAt = new Carbon($item->created_at);
        $result->setCreatedAt($createdAt);

        return $result;
    }
}
