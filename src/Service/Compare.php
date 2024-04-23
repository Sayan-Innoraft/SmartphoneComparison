<?php

namespace App\Service;

use App\Entity\Smartphone;

/**
 * Compare class compares two smartphones.
 */
class Compare {

  /**
   * Takes two smartphones and compares them based to their specifications and
   * price and returns results as an associative array.
   *
   * @param \App\Entity\Smartphone $smartphone1
   *   First smartphone object.
   * @param \App\Entity\Smartphone $smartphone2
   *   Second smartphone object.
   *
   * @return array
   *   Returns comparison result as an associative array.
   */
  public static function compare(Smartphone $smartphone1, Smartphone $smartphone2):array {
    $result = [];
    $result[$smartphone1->getName()] = 0;
    $result[$smartphone2->getName()] = 0;

    if ($smartphone1->getFrontCamera() >
      $smartphone2->getFrontCamera()) {
      $result['front_camera'] = $smartphone1->getName();
      $result[$smartphone1->getName()]++;
    }
    elseif ($smartphone1->getFrontCamera() <
      $smartphone2->getFrontCamera()) {
      $result['front_camera'] = $smartphone2->getName();
      $result[$smartphone2->getName()]++;
    }else{
      $result['front_camera'] = 'Same';
    }

    if ($smartphone1->getBackCamera() >
      $smartphone2->getBackCamera()) {
      $result['back_camera'] = $smartphone1->getName();
      $result[$smartphone1->getName()]++;
    }
    elseif($smartphone1->getBackCamera() <
      $smartphone2->getBackCamera()) {
      $result['back_camera'] = $smartphone2->getName();
      $result[$smartphone2->getName()]++;
    }else{
      $result['back_camera'] = 'Same';
    }

    if ($smartphone1->getBatteryCapacity() >
      $smartphone2->getBatteryCapacity()) {
      $result['battery_capacity'] = $smartphone1->getName();
      $result[$smartphone1->getName()]++;
    }
    elseif ($smartphone1->getBatteryCapacity() <
      $smartphone2->getBatteryCapacity()) {
      $result['battery_capacity'] = $smartphone2->getName();
      $result[$smartphone2->getName()]++;
    }else{
      $result['battery_capacity'] = 'Same';
    }

    if ($smartphone1->getPrice() <
      $smartphone2->getPrice()) {
      $result['price'] = $smartphone1->getName();
      $result[$smartphone1->getName()]++;
    }
    elseif ($smartphone1->getPrice() >
      $smartphone2->getPrice()) {
      $result['price'] = $smartphone2->getName();
      $result[$smartphone2->getName()]++;
    }else{
      $result['price'] = 'Same';
    }

    if ($result[$smartphone1->getName()] >
      $result[$smartphone2->getName()]) {
      $result['result'] = 'Based on specifications the better option is ' .
        $smartphone1->getName();
    }
    elseif ($result[$smartphone1->getName()] <
      $result[$smartphone2->getName()]) {
      $result['result'] = 'Based on specifications the better option is ' .
        $smartphone2->getName();
    }else{
      $result['result'] = 'Both smartphones are overall same';
    }
    return $result;
  }

}
