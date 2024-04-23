<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Smartphone class is used for setting smartphone details and storing the data
 * in the database using ORM.
 */
#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone {

  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private int $id;

  #[Assert\NotNull]
  #[ORM\Column(type: 'string', length: 50)]
  private string $name;

  #[Assert\NotNull]
  #[ORM\Column(type: 'string', length: 50)]
  private string $brand;

  #[Assert\NotNull]
  #[Assert\Range([
    'min' => 5,
    'max' => 200
  ])]
  #[ORM\Column(type: 'integer')]
  private int $backCamera;

  #[Assert\Range([
    'min' => 5,
    'max' => 200
  ])]
  #[Assert\NotNull]
  #[ORM\Column(type: 'integer')]
  private int $frontCamera;

  #[Assert\Range([
    'min' => 3000,
    'max' => 10000
  ])]
  #[Assert\NotNull]
  #[ORM\Column(type: 'integer')]
  private int $batteryCapacity;

  #[Assert\Range([
    'min' => 1000,
    'max' => 300000
  ])]
  #[Assert\NotNull]
  #[ORM\Column(type: 'integer')]
  private int $price;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getBrand(): string
  {
    return $this->brand;
  }

  public function setBrand(string $brand): void
  {
    $this->brand = $brand;
  }

  public function getBackCamera(): int
  {
    return $this->backCamera;
  }

  public function setBackCamera(int $backCamera): void
  {
    $this->backCamera = $backCamera;
  }

  public function getFrontCamera(): int
  {
    return $this->frontCamera;
  }

  public function setFrontCamera(int $frontCamera): void
  {
    $this->frontCamera = $frontCamera;
  }

  public function getBatteryCapacity(): int
  {
    return $this->batteryCapacity;
  }

  public function setBatteryCapacity(int $batteryCapacity): void
  {
    $this->batteryCapacity = $batteryCapacity;
  }

  public function getPrice(): int
  {
    return $this->price;
  }

  public function setPrice(int $price): void
  {
    $this->price = $price;
  }

}
