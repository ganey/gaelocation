<?php
/**
 * Created by PhpStorm.
 * User: mgane
 * Date: 13/04/15
 * Time: 16:12
 */


class GAELocationTest extends Illuminate\Foundation\Testing\TestCase {

  private $model;


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

    return require __DIR__.'/../../bootstrap/start.php';
  }

  public function testObjects()
  {
    $this->assertInstanceOf(
      'Ganey\GAELocation',
      $this->model,
      'Basic model loaded'
    );
  }

  public function testConfig()
  {
    $this->assertEquals(
      null,
      Config::get('gaelocation::city'),
      'default config city'
    );

    $this->assertEquals(
      null,
      Config::get('gaelocation::latlng'),
      'default config latitude/longitude'
    );

    $this->assertEquals(
      null,
      Config::get('gaelocation::countrycode'),
      'default config countrycode'
    );

    $this->assertEquals(
      null,
      Config::get('gaelocation::region'),
      'default config region'
    );

    $this->assertEquals(
      'Europe/London',
      Config::get('gaelocation::timezone'),
      'default config timezone'
    );
  }

  public function testTimezonefromcountrycode()
  {
    $this->assertEquals(
      'Europe/London',
      GAELocation::GeoIP_time_zone_by_country_and_region('GB','en'),
      'match timezone for London'
    );

    $this->assertEquals(
      'America/New_York',
      GAELocation::GeoIP_time_zone_by_country_and_region('US','DC'),
      'match timezone for NYC'
    );

    $this->assertEquals(
      'Pacific/Galapagos',
      GAELocation::GeoIP_time_zone_by_country_and_region('EC','01'),
      'match timezone for Galapagos'
    );

    $this->assertEquals(
      'Indian/Cocos',
      GAELocation::GeoIP_time_zone_by_country_and_region('CC',null),
      'match timezone for Cocos'
    );

    $this->assertEquals(
      null,
      GAELocation::GeoIP_time_zone_by_country_and_region(null,null),
      'return null timezone'
    );
  }

  public function testIsocountrylist()
  {
    $this->assertEquals(
      GAELocation::generate_iso_country_list(),
      $this->model->generate_iso_country_list(),
      'match country list'
    );
  }
}
