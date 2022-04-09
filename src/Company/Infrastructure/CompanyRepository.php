<?php

namespace WorkWithUs\Company\Infrastructure;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use WorkWithUs\Company\Domain\Entity\Company;

class CompanyRepository
{
    /**
     * @param int $userId
     * @return Company[]
     */
    public function getByUserId(int $userId): array
    {
        $query = "select c.id as company_id, c.name as company_name, c.slug as slug, c.created_at
        from user_company uc
        left join companies c on uc.company_id = c.id
        where uc.user_id = $userId;";

        $result = DB::select($query);

        $companies = [];
        foreach ($result as $item) {
            $company = new Company();
            $company->setId($item->company_id);
            $company->setSlug($item->slug);
            $company->setName($item->company_name);
            $company->setCreatedAt(new Carbon($item->created_at));

            $companies[] = $company;
        }

        return $companies;
    }
}
