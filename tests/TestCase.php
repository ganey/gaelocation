<?php

use Ganey\GAELocation\GAELocation;
use Config;
use DateTime;
use DateTimeZone;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

  /**
   * Default preparation for each test
   */

  protected $model;

  public function setUp()
  {
    parent::setUp();

    $this->model = new GAELocation();
  }


  /**
   * Creates the application.
   *
   * @return Symfony\Component\HttpKernel\HttpKernelInterface
   */
  public function createApplication()
  {
    $unitTesting = true;

    $testEnvironment = 'testing';

    return require __DIR__.'/../../start.php';
  }
}