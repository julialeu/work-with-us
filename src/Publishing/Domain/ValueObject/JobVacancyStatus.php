<?php

namespace WorkWithUs\Publishing\Domain\ValueObject;

use MyCLabs\Enum\Enum;

final class JobVacancyStatus extends Enum
{
    public const PUBLISHED = 'published';
    public const UNPUBLISHED = 'unpublished';

    public static function published(): JobVacancyStatus
    {
        return new JobVacancyStatus(self::PUBLISHED);
    }

    public static function unpublished(): JobVacancyStatus
    {
        return new JobVacancyStatus(self::UNPUBLISHED);
    }
}
