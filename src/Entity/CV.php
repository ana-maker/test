<?php

namespace App\Entity;

use App\Repository\CVRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Class CV
 * @package App\Entity
 * @ORM\Entity(repositoryClass=CVRepository::class)
 * @ORM\Table(name="app_cv", indexes={@Index(columns={"work", "experience"}, flags={"fulltext"})})
 */
class CV
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column()
     */
    protected string $name;

    /**
     * @ORM\Column()
     */
    protected string $address;

    /**
     * @ORM\Column()
     */
    protected string $education;

    /**
     * @ORM\Column()
     */
    protected string $work;

    /**
     * @ORM\Column()
     */
    protected string $experience;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEducation(): string
    {
        return $this->education;
    }

    /**
     * @param string $education
     */
    public function setEducation(string $education): void
    {
        $this->education = $education;
    }

    /**
     * @return string
     */
    public function getWork(): string
    {
        return $this->work;
    }

    /**
     * @param string $work
     */
    public function setWork(string $work): void
    {
        $this->work = $work;
    }

    /**
     * @return string
     */
    public function getExperience(): string
    {
        return $this->experience;
    }

    /**
     * @param string $experience
     */
    public function setExperience(string $experience): void
    {
        $this->experience = $experience;
    }
}
