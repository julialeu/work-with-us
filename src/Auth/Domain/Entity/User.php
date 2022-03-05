<?php

namespace WorkWithUs\Auth\Domain\Entity;

class User
{
    private string $email;
    private string $hashedPassword;
    private string $name;
    private string $company;

    public function email(): string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function hashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword($hashedPassword): self
    {
        $this->hashedPassword = $hashedPassword;

        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function company(): string
    {
        return $this->company;
    }

    public function setCompany($company): self
    {
        $this->company = $company;

        return $this;
    }


}
