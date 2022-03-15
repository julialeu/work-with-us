<?php

namespace WorkWithUs\Auth\Domain\Service;

class GenerateUuidService
{
    public function generate(): string
    {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString1 = '';
        $randomString2 = '';
        $randomString3 = '';
        $randomString4 = '';
        $randomString5 = '';


        for ($i = 0; $i < 8; $i++) {
            $index = rand(0, strlen($characters)-1);
            //strlen($characters)
            $randomString1 .= $characters[$index];
        }

        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters)-1);
            $randomString2 .= $characters[$index];
        }

        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters)-1);
            $randomString3 .= $characters[$index];
        }

        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($characters)-1);
            $randomString4 .= $characters[$index];
        }

        for ($i = 0; $i < 12; $i++) {
            $index = rand(0, strlen($characters)-1);
            $randomString5 .= $characters[$index];
        }

        return $randomString1 . "-" . $randomString2 . "-" . $randomString3 . "-" . $randomString4 . "-" . $randomString5;
    }
}
