<?php

declare(strict_types=1);

namespace App\Entity;

class UserDto
{
    protected int $userId;

    protected string $email;

    protected int $age;

    protected string $name;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     *
     * @return UserDto
     */
    public function setUserId(int $userId): UserDto
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return UserDto
     */
    public function setEmail(string $email): UserDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     *
     * @return UserDto
     */
    public function setAge(int $age): UserDto
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return UserDto
     */
    public function setName(string $name): UserDto
    {
        $this->name = $name;
        return $this;
    }
}