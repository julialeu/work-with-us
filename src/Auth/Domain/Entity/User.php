<?php

namespace WorkWithUs\Auth\Domain\Entity;

class User
{
    private ?int $userId;
    private string $email;
    private string $hashedPassword;
    private string $name;

    public function id(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

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
}
