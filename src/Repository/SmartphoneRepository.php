<?php

namespace App\Repository;

use App\Entity\Smartphone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * SmartphoneRepository fetches data from database.
 */
class SmartphoneRepository extends ServiceEntityRepository {

  public function __construct(ManagerRegistry  $registry) {
    parent::__construct($registry, Smartphone::class);
  }

  /**
   * Saves a smartphone object in the database.
   *
   * @param \App\Entity\Smartphone $smartphone
   *   Smartphone object that will be stored in the database.
   */
  public function save(Smartphone $smartphone):void {
    $this->getEntityManager()->persist($smartphone);
    $this->getEntityManager()->flush();
  }

  /**
   * Deletes a smartphone from the database.
   *
   * @param \App\Entity\Smartphone $smartphone
   *   Takes a smartphone object to delete that from database.
   */
  public function delete(Smartphone $smartphone):void {
    $this->getEntityManager()->remove($smartphone);
    $this->getEntityManager()->flush();
  }

}
