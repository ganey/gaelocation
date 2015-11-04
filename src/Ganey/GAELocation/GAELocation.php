<?php
namespace Ganey\GAELocation;

use Config;
use DateTime;
use DateTimeZone;

class GAELocation
{
  //Todo: Tests;
  protected $_city;

  protected $_latlng;

  //Two letter ISO Country Code
  protected $_countrycode;

  protected $_region;

  // Valid PHP Timezone
  protected $_timezone;

  public function __construct()
  {
    /*
     * Uses the $_SERVER variables set by Google App Engine.
     *
     * Set defaults in config file with config publish as the variables are only returned on running GAE instances
     * Local SDK instances do not currently return values.
     */
    $this->_city = getenv('HTTP_X_APPENGINE_CITY') ?: (Config::get('gaelocation::city') ?: null);
    $this->_latlng = getenv('HTTP_X_APPENGINE_CITYLATLONG') ?: (Config::get('gaelocation::latlng') ?: null);
    $this->_countrycode = getenv('HTTP_X_APPENGINE_COUNTRY') ?: (Config::get('gaelocation::countrycode') ?: null);
    $this->_region = getenv('HTTP_X_APPENGINE_REGION') ?: (Config::get('gaelocation::region') ?: null);

    $this->_timezone = $this->GeoIP_time_zone_by_country_and_region($this->_countrycode, $this->_region) ?: (Config::get('gaelocation::timezone') ?: null);
  }

  /*
  * FAKE the PECL GEOIP::GeoIP_time_zone_by_country_and_region() function as it's not provided on App Engine.
   *
   * I'm aware this code looks horrible, but it's based on the C code in the maxmind C code: (https://gist.github.com/salathe/2408624#file-timezone-c)
   *
   * Thanks!
   *
  */
  public static function GeoIP_time_zone_by_country_and_region($country = null, $region = null)
  {
    $timezone = null;
    if ($country == null) {
      return null;
    }
    if ($region == null) {
      $region = "";
    }
    if ($country === "AD") {
      $timezone = "Europe/Andorra";
    } else if ($country === "AE") {
      $timezone = "Asia/Dubai";
    } else if ($country === "AF") {
      $timezone = "Asia/Kabul";
    } else if ($country === "AG") {
      $timezone = "America/Antigua";
    } else if ($country === "AI") {
      $timezone = "America/Anguilla";
    } else if ($country === "AL") {
      $timezone = "Europe/Tirane";
    } else if ($country === "AM") {
      $timezone = "Asia/Yerevan";
    } else if ($country === "AO") {
      $timezone = "Africa/Luanda";
    } else if ($country === "AR") {
      if ($region === "01") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "02") {
        $timezone = "America/Argentina/Catamarca";
      } else if ($region === "03") {
        $timezone = "America/Argentina/Tucuman";
      } else if ($region === "04") {
        $timezone = "America/Argentina/Rio_Gallegos";
      } else if ($region === "05") {
        $timezone = "America/Argentina/Cordoba";
      } else if ($region === "06") {
        $timezone = "America/Argentina/Tucuman";
      } else if ($region === "07") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "08") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "09") {
        $timezone = "America/Argentina/Tucuman";
      } else if ($region === "10") {
        $timezone = "America/Argentina/Jujuy";
      } else if ($region === "11") {
        $timezone = "America/Argentina/San_Luis";
      } else if ($region === "12") {
        $timezone = "America/Argentina/La_Rioja";
      } else if ($region === "13") {
        $timezone = "America/Argentina/Mendoza";
      } else if ($region === "14") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "15") {
        $timezone = "America/Argentina/San_Luis";
      } else if ($region === "16") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "17") {
        $timezone = "America/Argentina/Salta";
      } else if ($region === "18") {
        $timezone = "America/Argentina/San_Juan";
      } else if ($region === "19") {
        $timezone = "America/Argentina/San_Luis";
      } else if ($region === "20") {
        $timezone = "America/Argentina/Rio_Gallegos";
      } else if ($region === "21") {
        $timezone = "America/Argentina/Buenos_Aires";
      } else if ($region === "22") {
        $timezone = "America/Argentina/Catamarca";
      } else if ($region === "23") {
        $timezone = "America/Argentina/Ushuaia";
      } else if ($region === "24") {
        $timezone = "America/Argentina/Tucuman";
      }
    } else if ($country === "AS") {
      $timezone = "US/Samoa";
    } else if ($country === "AT") {
      $timezone = "Europe/Vienna";
    } else if ($country === "AU") {
      if ($region === "01") {
        $timezone = "Australia/Canberra";
      } else if ($region === "02") {
        $timezone = "Australia/NSW";
      } else if ($region === "03") {
        $timezone = "Australia/North";
      } else if ($region === "04") {
        $timezone = "Australia/Queensland";
      } else if ($region === "05") {
        $timezone = "Australia/South";
      } else if ($region === "06") {
        $timezone = "Australia/Tasmania";
      } else if ($region === "07") {
        $timezone = "Australia/Victoria";
      } else if ($region === "08") {
        $timezone = "Australia/West";
      }
    } else if ($country === "AW") {
      $timezone = "America/Aruba";
    } else if ($country === "AX") {
      $timezone = "Europe/Mariehamn";
    } else if ($country === "AZ") {
      $timezone = "Asia/Baku";
    } else if ($country === "BA") {
      $timezone = "Europe/Sarajevo";
    } else if ($country === "BB") {
      $timezone = "America/Barbados";
    } else if ($country === "BD") {
      $timezone = "Asia/Dhaka";
    } else if ($country === "BE") {
      $timezone = "Europe/Brussels";
    } else if ($country === "BF") {
      $timezone = "Africa/Ouagadougou";
    } else if ($country === "BG") {
      $timezone = "Europe/Sofia";
    } else if ($country === "BH") {
      $timezone = "Asia/Bahrain";
    } else if ($country === "BI") {
      $timezone = "Africa/Bujumbura";
    } else if ($country === "BJ") {
      $timezone = "Africa/Porto-Novo";
    } else if ($country === "BL") {
      $timezone = "America/St_Barthelemy";
    } else if ($country === "BM") {
      $timezone = "Atlantic/Bermuda";
    } else if ($country === "BN") {
      $timezone = "Asia/Brunei";
    } else if ($country === "BO") {
      $timezone = "America/La_Paz";
    } else if ($country === "BQ") {
      $timezone = "America/Curacao";
    } else if ($country === "BR") {
      if ($region === "01") {
        $timezone = "America/Rio_Branco";
      } else if ($region === "02") {
        $timezone = "America/Maceio";
      } else if ($region === "03") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "04") {
        $timezone = "America/Manaus";
      } else if ($region === "05") {
        $timezone = "America/Bahia";
      } else if ($region === "06") {
        $timezone = "America/Fortaleza";
      } else if ($region === "07") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "08") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "11") {
        $timezone = "America/Campo_Grande";
      } else if ($region === "13") {
        $timezone = "America/Belem";
      } else if ($region === "14") {
        $timezone = "America/Cuiaba";
      } else if ($region === "15") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "16") {
        $timezone = "America/Belem";
      } else if ($region === "17") {
        $timezone = "America/Recife";
      } else if ($region === "18") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "20") {
        $timezone = "America/Fortaleza";
      } else if ($region === "21") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "22") {
        $timezone = "America/Recife";
      } else if ($region === "23") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "24") {
        $timezone = "America/Porto_Velho";
      } else if ($region === "25") {
        $timezone = "America/Boa_Vista";
      } else if ($region === "26") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "27") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "28") {
        $timezone = "America/Maceio";
      } else if ($region === "29") {
        $timezone = "America/Sao_Paulo";
      } else if ($region === "30") {
        $timezone = "America/Recife";
      } else if ($region === "31") {
        $timezone = "America/Araguaina";
      }
    } else if ($country === "BS") {
      $timezone = "America/Nassau";
    } else if ($country === "BT") {
      $timezone = "Asia/Thimphu";
    } else if ($country === "BW") {
      $timezone = "Africa/Gaborone";
    } else if ($country === "BY") {
      $timezone = "Europe/Minsk";
    } else if ($country === "BZ") {
      $timezone = "America/Belize";
    } else if ($country === "CA") {
      if ($region === "AB") {
        $timezone = "America/Edmonton";
      } else if ($region === "BC") {
        $timezone = "America/Vancouver";
      } else if ($region === "MB") {
        $timezone = "America/Winnipeg";
      } else if ($region === "NB") {
        $timezone = "America/Halifax";
      } else if ($region === "NL") {
        $timezone = "America/St_Johns";
      } else if ($region === "NS") {
        $timezone = "America/Halifax";
      } else if ($region === "NT") {
        $timezone = "America/Yellowknife";
      } else if ($region === "NU") {
        $timezone = "America/Rankin_Inlet";
      } else if ($region === "ON") {
        $timezone = "America/Rainy_River";
      } else if ($region === "PE") {
        $timezone = "America/Halifax";
      } else if ($region === "QC") {
        $timezone = "America/Montreal";
      } else if ($region === "SK") {
        $timezone = "America/Regina";
      } else if ($region === "YT") {
        $timezone = "America/Whitehorse";
      }
    } else if ($country === "CC") {
      $timezone = "Indian/Cocos";
    } else if ($country === "CD") {
      if ($region === "02") {
        $timezone = "Africa/Kinshasa";
      } else if ($region === "05") {
        $timezone = "Africa/Lubumbashi";
      } else if ($region === "06") {
        $timezone = "Africa/Kinshasa";
      } else if ($region === "08") {
        $timezone = "Africa/Kinshasa";
      } else if ($region === "10") {
        $timezone = "Africa/Lubumbashi";
      } else if ($region === "11") {
        $timezone = "Africa/Lubumbashi";
      } else if ($region === "12") {
        $timezone = "Africa/Lubumbashi";
      }
    } else if ($country === "CF") {
      $timezone = "Africa/Bangui";
    } else if ($country === "CG") {
      $timezone = "Africa/Brazzaville";
    } else if ($country === "CH") {
      $timezone = "Europe/Zurich";
    } else if ($country === "CI") {
      $timezone = "Africa/Abidjan";
    } else if ($country === "CK") {
      $timezone = "Pacific/Rarotonga";
    } else if ($country === "CL") {
      $timezone = "Chile/Continental";
    } else if ($country === "CM") {
      $timezone = "Africa/Lagos";
    } else if ($country === "CN") {
      if ($region === "01") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "02") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "03") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "04") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "05") {
        $timezone = "Asia/Harbin";
      } else if ($region === "06") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "07") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "08") {
        $timezone = "Asia/Harbin";
      } else if ($region === "09") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "10") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "11") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "12") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "13") {
        $timezone = "Asia/Urumqi";
      } else if ($region === "14") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "15") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "16") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "18") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "19") {
        $timezone = "Asia/Harbin";
      } else if ($region === "20") {
        $timezone = "Asia/Harbin";
      } else if ($region === "21") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "22") {
        $timezone = "Asia/Harbin";
      } else if ($region === "23") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "24") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "25") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "26") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "28") {
        $timezone = "Asia/Shanghai";
      } else if ($region === "29") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "30") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "31") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "32") {
        $timezone = "Asia/Chongqing";
      } else if ($region === "33") {
        $timezone = "Asia/Chongqing";
      }
    } else if ($country === "CO") {
      $timezone = "America/Bogota";
    } else if ($country === "CR") {
      $timezone = "America/Costa_Rica";
    } else if ($country === "CU") {
      $timezone = "America/Havana";
    } else if ($country === "CV") {
      $timezone = "Atlantic/Cape_Verde";
    } else if ($country === "CW") {
      $timezone = "America/Curacao";
    } else if ($country === "CX") {
      $timezone = "Indian/Christmas";
    } else if ($country === "CY") {
      $timezone = "Asia/Nicosia";
    } else if ($country === "CZ") {
      $timezone = "Europe/Prague";
    } else if ($country === "DE") {
      $timezone = "Europe/Berlin";
    } else if ($country === "DJ") {
      $timezone = "Africa/Djibouti";
    } else if ($country === "DK") {
      $timezone = "Europe/Copenhagen";
    } else if ($country === "DM") {
      $timezone = "America/Dominica";
    } else if ($country === "DO") {
      $timezone = "America/Santo_Domingo";
    } else if ($country === "DZ") {
      $timezone = "Africa/Algiers";
    } else if ($country === "EC") {
      if ($region === "01") {
        $timezone = "Pacific/Galapagos";
      } else if ($region === "02") {
        $timezone = "America/Guayaquil";
      } else if ($region === "03") {
        $timezone = "America/Guayaquil";
      } else if ($region === "04") {
        $timezone = "America/Guayaquil";
      } else if ($region === "05") {
        $timezone = "America/Guayaquil";
      } else if ($region === "06") {
        $timezone = "America/Guayaquil";
      } else if ($region === "07") {
        $timezone = "America/Guayaquil";
      } else if ($region === "08") {
        $timezone = "America/Guayaquil";
      } else if ($region === "09") {
        $timezone = "America/Guayaquil";
      } else if ($region === "10") {
        $timezone = "America/Guayaquil";
      } else if ($region === "11") {
        $timezone = "America/Guayaquil";
      } else if ($region === "12") {
        $timezone = "America/Guayaquil";
      } else if ($region === "13") {
        $timezone = "America/Guayaquil";
      } else if ($region === "14") {
        $timezone = "America/Guayaquil";
      } else if ($region === "15") {
        $timezone = "America/Guayaquil";
      } else if ($region === "17") {
        $timezone = "America/Guayaquil";
      } else if ($region === "18") {
        $timezone = "America/Guayaquil";
      } else if ($region === "19") {
        $timezone = "America/Guayaquil";
      } else if ($region === "20") {
        $timezone = "America/Guayaquil";
      } else if ($region === "22") {
        $timezone = "America/Guayaquil";
      }
    } else if ($country === "EE") {
      $timezone = "Europe/Tallinn";
    } else if ($country === "EG") {
      $timezone = "Africa/Cairo";
    } else if ($country === "EH") {
      $timezone = "Africa/El_Aaiun";
    } else if ($country === "ER") {
      $timezone = "Africa/Asmera";
    } else if ($country === "ES") {
      if ($region === "07") {
        $timezone = "Europe/Madrid";
      } else if ($region === "27") {
        $timezone = "Europe/Madrid";
      } else if ($region === "29") {
        $timezone = "Europe/Madrid";
      } else if ($region === "31") {
        $timezone = "Europe/Madrid";
      } else if ($region === "32") {
        $timezone = "Europe/Madrid";
      } else if ($region === "34") {
        $timezone = "Europe/Madrid";
      } else if ($region === "39") {
        $timezone = "Europe/Madrid";
      } else if ($region === "51") {
        $timezone = "Africa/Ceuta";
      } else if ($region === "52") {
        $timezone = "Europe/Madrid";
      } else if ($region === "53") {
        $timezone = "Atlantic/Canary";
      } else if ($region === "54") {
        $timezone = "Europe/Madrid";
      } else if ($region === "55") {
        $timezone = "Europe/Madrid";
      } else if ($region === "56") {
        $timezone = "Europe/Madrid";
      } else if ($region === "57") {
        $timezone = "Europe/Madrid";
      } else if ($region === "58") {
        $timezone = "Europe/Madrid";
      } else if ($region === "59") {
        $timezone = "Europe/Madrid";
      } else if ($region === "60") {
        $timezone = "Europe/Madrid";
      }
    } else if ($country === "ET") {
      $timezone = "Africa/Addis_Ababa";
    } else if ($country === "FI") {
      $timezone = "Europe/Helsinki";
    } else if ($country === "FJ") {
      $timezone = "Pacific/Fiji";
    } else if ($country === "FK") {
      $timezone = "Atlantic/Stanley";
    } else if ($country === "FO") {
      $timezone = "Atlantic/Faeroe";
    } else if ($country === "FR") {
      $timezone = "Europe/Paris";
    } else if ($country === "GA") {
      $timezone = "Africa/Libreville";
    } else if ($country === "GB") {
      $timezone = "Europe/London";
    } else if ($country === "GD") {
      $timezone = "America/Grenada";
    } else if ($country === "GE") {
      $timezone = "Asia/Tbilisi";
    } else if ($country === "GF") {
      $timezone = "America/Cayenne";
    } else if ($country === "GG") {
      $timezone = "Europe/Guernsey";
    } else if ($country === "GH") {
      $timezone = "Africa/Accra";
    } else if ($country === "GI") {
      $timezone = "Europe/Gibraltar";
    } else if ($country === "GL") {
      if ($region === "01") {
        $timezone = "America/Thule";
      } else if ($region === "02") {
        $timezone = "America/Godthab";
      } else if ($region === "03") {
        $timezone = "America/Godthab";
      }
    } else if ($country === "GM") {
      $timezone = "Africa/Banjul";
    } else if ($country === "GN") {
      $timezone = "Africa/Conakry";
    } else if ($country === "GP") {
      $timezone = "America/Guadeloupe";
    } else if ($country === "GQ") {
      $timezone = "Africa/Malabo";
    } else if ($country === "GR") {
      $timezone = "Europe/Athens";
    } else if ($country === "GS") {
      $timezone = "Atlantic/South_Georgia";
    } else if ($country === "GT") {
      $timezone = "America/Guatemala";
    } else if ($country === "GU") {
      $timezone = "Pacific/Guam";
    } else if ($country === "GW") {
      $timezone = "Africa/Bissau";
    } else if ($country === "GY") {
      $timezone = "America/Guyana";
    } else if ($country === "HK") {
      $timezone = "Asia/Hong_Kong";
    } else if ($country === "HN") {
      $timezone = "America/Tegucigalpa";
    } else if ($country === "HR") {
      $timezone = "Europe/Zagreb";
    } else if ($country === "HT") {
      $timezone = "America/Port-au-Prince";
    } else if ($country === "HU") {
      $timezone = "Europe/Budapest";
    } else if ($country === "ID") {
      if ($region === "01") {
        $timezone = "Asia/Pontianak";
      } else if ($region === "02") {
        $timezone = "Asia/Makassar";
      } else if ($region === "03") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "04") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "05") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "06") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "07") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "08") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "09") {
        $timezone = "Asia/Jayapura";
      } else if ($region === "10") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "11") {
        $timezone = "Asia/Pontianak";
      } else if ($region === "12") {
        $timezone = "Asia/Makassar";
      } else if ($region === "13") {
        $timezone = "Asia/Makassar";
      } else if ($region === "14") {
        $timezone = "Asia/Makassar";
      } else if ($region === "15") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "16") {
        $timezone = "Asia/Makassar";
      } else if ($region === "17") {
        $timezone = "Asia/Makassar";
      } else if ($region === "18") {
        $timezone = "Asia/Makassar";
      } else if ($region === "19") {
        $timezone = "Asia/Pontianak";
      } else if ($region === "20") {
        $timezone = "Asia/Makassar";
      } else if ($region === "21") {
        $timezone = "Asia/Makassar";
      } else if ($region === "22") {
        $timezone = "Asia/Makassar";
      } else if ($region === "23") {
        $timezone = "Asia/Makassar";
      } else if ($region === "24") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "25") {
        $timezone = "Asia/Pontianak";
      } else if ($region === "26") {
        $timezone = "Asia/Pontianak";
      } else if ($region === "30") {
        $timezone = "Asia/Jakarta";
      } else if ($region === "31") {
        $timezone = "Asia/Makassar";
      } else if ($region === "33") {
        $timezone = "Asia/Jakarta";
      }
    } else if ($country === "IE") {
      $timezone = "Europe/Dublin";
    } else if ($country === "IL") {
      $timezone = "Asia/Jerusalem";
    } else if ($country === "IM") {
      $timezone = "Europe/Isle_of_Man";
    } else if ($country === "IN") {
      $timezone = "Asia/Calcutta";
    } else if ($country === "IO") {
      $timezone = "Indian/Chagos";
    } else if ($country === "IQ") {
      $timezone = "Asia/Baghdad";
    } else if ($country === "IR") {
      $timezone = "Asia/Tehran";
    } else if ($country === "IS") {
      $timezone = "Atlantic/Reykjavik";
    } else if ($country === "IT") {
      $timezone = "Europe/Rome";
    } else if ($country === "JE") {
      $timezone = "Europe/Jersey";
    } else if ($country === "JM") {
      $timezone = "America/Jamaica";
    } else if ($country === "JO") {
      $timezone = "Asia/Amman";
    } else if ($country === "JP") {
      $timezone = "Asia/Tokyo";
    } else if ($country === "KE") {
      $timezone = "Africa/Nairobi";
    } else if ($country === "KG") {
      $timezone = "Asia/Bishkek";
    } else if ($country === "KH") {
      $timezone = "Asia/Phnom_Penh";
    } else if ($country === "KI") {
      $timezone = "Pacific/Tarawa";
    } else if ($country === "KM") {
      $timezone = "Indian/Comoro";
    } else if ($country === "KN") {
      $timezone = "America/St_Kitts";
    } else if ($country === "KP") {
      $timezone = "Asia/Pyongyang";
    } else if ($country === "KR") {
      $timezone = "Asia/Seoul";
    } else if ($country === "KW") {
      $timezone = "Asia/Kuwait";
    } else if ($country === "KY") {
      $timezone = "America/Cayman";
    } else if ($country === "KZ") {
      if ($region === "01") {
        $timezone = "Asia/Almaty";
      } else if ($region === "02") {
        $timezone = "Asia/Almaty";
      } else if ($region === "03") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "04") {
        $timezone = "Asia/Aqtobe";
      } else if ($region === "05") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "06") {
        $timezone = "Asia/Aqtau";
      } else if ($region === "07") {
        $timezone = "Asia/Oral";
      } else if ($region === "08") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "09") {
        $timezone = "Asia/Aqtau";
      } else if ($region === "10") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "11") {
        $timezone = "Asia/Almaty";
      } else if ($region === "12") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "13") {
        $timezone = "Asia/Aqtobe";
      } else if ($region === "14") {
        $timezone = "Asia/Qyzylorda";
      } else if ($region === "15") {
        $timezone = "Asia/Almaty";
      } else if ($region === "16") {
        $timezone = "Asia/Aqtobe";
      } else if ($region === "17") {
        $timezone = "Asia/Almaty";
      }
    } else if ($country === "LA") {
      $timezone = "Asia/Vientiane";
    } else if ($country === "LB") {
      $timezone = "Asia/Beirut";
    } else if ($country === "LC") {
      $timezone = "America/St_Lucia";
    } else if ($country === "LI") {
      $timezone = "Europe/Vaduz";
    } else if ($country === "LK") {
      $timezone = "Asia/Colombo";
    } else if ($country === "LR") {
      $timezone = "Africa/Monrovia";
    } else if ($country === "LS") {
      $timezone = "Africa/Maseru";
    } else if ($country === "LT") {
      $timezone = "Europe/Vilnius";
    } else if ($country === "LU") {
      $timezone = "Europe/Luxembourg";
    } else if ($country === "LV") {
      $timezone = "Europe/Riga";
    } else if ($country === "LY") {
      $timezone = "Africa/Tripoli";
    } else if ($country === "MA") {
      $timezone = "Africa/Casablanca";
    } else if ($country === "MC") {
      $timezone = "Europe/Monaco";
    } else if ($country === "MD") {
      $timezone = "Europe/Chisinau";
    } else if ($country === "ME") {
      $timezone = "Europe/Podgorica";
    } else if ($country === "MF") {
      $timezone = "America/Marigot";
    } else if ($country === "MG") {
      $timezone = "Indian/Antananarivo";
    } else if ($country === "MK") {
      $timezone = "Europe/Skopje";
    } else if ($country === "ML") {
      $timezone = "Africa/Bamako";
    } else if ($country === "MM") {
      $timezone = "Asia/Rangoon";
    } else if ($country === "MN") {
      $timezone = "Asia/Choibalsan";
    } else if ($country === "MO") {
      $timezone = "Asia/Macao";
    } else if ($country === "MP") {
      $timezone = "Pacific/Saipan";
    } else if ($country === "MQ") {
      $timezone = "America/Martinique";
    } else if ($country === "MR") {
      $timezone = "Africa/Nouakchott";
    } else if ($country === "MS") {
      $timezone = "America/Montserrat";
    } else if ($country === "MT") {
      $timezone = "Europe/Malta";
    } else if ($country === "MU") {
      $timezone = "Indian/Mauritius";
    } else if ($country === "MV") {
      $timezone = "Indian/Maldives";
    } else if ($country === "MW") {
      $timezone = "Africa/Blantyre";
    } else if ($country === "MX") {
      if ($region === "01") {
        $timezone = "America/Mexico_City";
      } else if ($region === "02") {
        $timezone = "America/Tijuana";
      } else if ($region === "03") {
        $timezone = "America/Hermosillo";
      } else if ($region === "04") {
        $timezone = "America/Merida";
      } else if ($region === "05") {
        $timezone = "America/Mexico_City";
      } else if ($region === "06") {
        $timezone = "America/Chihuahua";
      } else if ($region === "07") {
        $timezone = "America/Monterrey";
      } else if ($region === "08") {
        $timezone = "America/Mexico_City";
      } else if ($region === "09") {
        $timezone = "America/Mexico_City";
      } else if ($region === "10") {
        $timezone = "America/Mazatlan";
      } else if ($region === "11") {
        $timezone = "America/Mexico_City";
      } else if ($region === "12") {
        $timezone = "America/Mexico_City";
      } else if ($region === "13") {
        $timezone = "America/Mexico_City";
      } else if ($region === "14") {
        $timezone = "America/Mazatlan";
      } else if ($region === "15") {
        $timezone = "America/Chihuahua";
      } else if ($region === "16") {
        $timezone = "America/Mexico_City";
      } else if ($region === "17") {
        $timezone = "America/Mexico_City";
      } else if ($region === "18") {
        $timezone = "America/Mazatlan";
      } else if ($region === "19") {
        $timezone = "America/Monterrey";
      } else if ($region === "20") {
        $timezone = "America/Mexico_City";
      } else if ($region === "21") {
        $timezone = "America/Mexico_City";
      } else if ($region === "22") {
        $timezone = "America/Mexico_City";
      } else if ($region === "23") {
        $timezone = "America/Cancun";
      } else if ($region === "24") {
        $timezone = "America/Mexico_City";
      } else if ($region === "25") {
        $timezone = "America/Mazatlan";
      } else if ($region === "26") {
        $timezone = "America/Hermosillo";
      } else if ($region === "27") {
        $timezone = "America/Merida";
      } else if ($region === "28") {
        $timezone = "America/Monterrey";
      } else if ($region === "29") {
        $timezone = "America/Mexico_City";
      } else if ($region === "30") {
        $timezone = "America/Mexico_City";
      } else if ($region === "31") {
        $timezone = "America/Merida";
      } else if ($region === "32") {
        $timezone = "America/Monterrey";
      }
    } else if ($country === "MY") {
      if ($region === "01") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "02") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "03") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "04") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "05") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "06") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "07") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "08") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "09") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "11") {
        $timezone = "Asia/Kuching";
      } else if ($region === "12") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "13") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "14") {
        $timezone = "Asia/Kuala_Lumpur";
      } else if ($region === "15") {
        $timezone = "Asia/Kuching";
      } else if ($region === "16") {
        $timezone = "Asia/Kuching";
      }
    } else if ($country === "MZ") {
      $timezone = "Africa/Maputo";
    } else if ($country === "NA") {
      $timezone = "Africa/Windhoek";
    } else if ($country === "NC") {
      $timezone = "Pacific/Noumea";
    } else if ($country === "NE") {
      $timezone = "Africa/Niamey";
    } else if ($country === "NF") {
      $timezone = "Pacific/Norfolk";
    } else if ($country === "NG") {
      $timezone = "Africa/Lagos";
    } else if ($country === "NI") {
      $timezone = "America/Managua";
    } else if ($country === "NL") {
      $timezone = "Europe/Amsterdam";
    } else if ($country === "NO") {
      $timezone = "Europe/Oslo";
    } else if ($country === "NP") {
      $timezone = "Asia/Katmandu";
    } else if ($country === "NR") {
      $timezone = "Pacific/Nauru";
    } else if ($country === "NU") {
      $timezone = "Pacific/Niue";
    } else if ($country === "NZ") {
      if ($region === "85") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "E7") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "E8") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "E9") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F1") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F2") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F3") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F4") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F5") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F7") {
        $timezone = "Pacific/Chatham";
      } else if ($region === "F8") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "F9") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "G1") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "G2") {
        $timezone = "Pacific/Auckland";
      } else if ($region === "G3") {
        $timezone = "Pacific/Auckland";
      }
    } else if ($country === "OM") {
      $timezone = "Asia/Muscat";
    } else if ($country === "PA") {
      $timezone = "America/Panama";
    } else if ($country === "PE") {
      $timezone = "America/Lima";
    } else if ($country === "PF") {
      $timezone = "Pacific/Marquesas";
    } else if ($country === "PG") {
      $timezone = "Pacific/Port_Moresby";
    } else if ($country === "PH") {
      $timezone = "Asia/Manila";
    } else if ($country === "PK") {
      $timezone = "Asia/Karachi";
    } else if ($country === "PL") {
      $timezone = "Europe/Warsaw";
    } else if ($country === "PM") {
      $timezone = "America/Miquelon";
    } else if ($country === "PN") {
      $timezone = "Pacific/Pitcairn";
    } else if ($country === "PR") {
      $timezone = "America/Puerto_Rico";
    } else if ($country === "PS") {
      $timezone = "Asia/Gaza";
    } else if ($country === "PT") {
      if ($region === "02") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "03") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "04") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "05") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "06") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "07") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "08") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "09") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "10") {
        $timezone = "Atlantic/Madeira";
      } else if ($region === "11") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "13") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "14") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "16") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "17") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "18") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "19") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "20") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "21") {
        $timezone = "Europe/Lisbon";
      } else if ($region === "22") {
        $timezone = "Europe/Lisbon";
      }
    } else if ($country === "PW") {
      $timezone = "Pacific/Palau";
    } else if ($country === "PY") {
      $timezone = "America/Asuncion";
    } else if ($country === "QA") {
      $timezone = "Asia/Qatar";
    } else if ($country === "RE") {
      $timezone = "Indian/Reunion";
    } else if ($country === "RO") {
      $timezone = "Europe/Bucharest";
    } else if ($country === "RS") {
      $timezone = "Europe/Belgrade";
    } else if ($country === "RU") {
      if ($region === "01") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "02") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "03") {
        $timezone = "Asia/Novokuznetsk";
      } else if ($region === "04") {
        $timezone = "Asia/Novosibirsk";
      } else if ($region === "05") {
        $timezone = "Asia/Vladivostok";
      } else if ($region === "06") {
        $timezone = "Europe/Moscow";
      } else if ($region === "07") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "08") {
        $timezone = "Europe/Samara";
      } else if ($region === "09") {
        $timezone = "Europe/Moscow";
      } else if ($region === "10") {
        $timezone = "Europe/Moscow";
      } else if ($region === "11") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "13") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "14") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "15") {
        $timezone = "Asia/Anadyr";
      } else if ($region === "16") {
        $timezone = "Europe/Samara";
      } else if ($region === "17") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "18") {
        $timezone = "Asia/Krasnoyarsk";
      } else if ($region === "20") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "21") {
        $timezone = "Europe/Moscow";
      } else if ($region === "22") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "23") {
        $timezone = "Europe/Kaliningrad";
      } else if ($region === "24") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "25") {
        $timezone = "Europe/Moscow";
      } else if ($region === "26") {
        $timezone = "Asia/Kamchatka";
      } else if ($region === "27") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "28") {
        $timezone = "Europe/Moscow";
      } else if ($region === "29") {
        $timezone = "Asia/Novokuznetsk";
      } else if ($region === "30") {
        $timezone = "Asia/Vladivostok";
      } else if ($region === "31") {
        $timezone = "Asia/Krasnoyarsk";
      } else if ($region === "32") {
        $timezone = "Asia/Omsk";
      } else if ($region === "33") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "34") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "35") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "36") {
        $timezone = "Asia/Anadyr";
      } else if ($region === "37") {
        $timezone = "Europe/Moscow";
      } else if ($region === "38") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "39") {
        $timezone = "Asia/Krasnoyarsk";
      } else if ($region === "40") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "41") {
        $timezone = "Europe/Moscow";
      } else if ($region === "42") {
        $timezone = "Europe/Moscow";
      } else if ($region === "43") {
        $timezone = "Europe/Moscow";
      } else if ($region === "44") {
        $timezone = "Asia/Magadan";
      } else if ($region === "45") {
        $timezone = "Europe/Samara";
      } else if ($region === "46") {
        $timezone = "Europe/Samara";
      } else if ($region === "47") {
        $timezone = "Europe/Moscow";
      } else if ($region === "48") {
        $timezone = "Europe/Moscow";
      } else if ($region === "49") {
        $timezone = "Europe/Moscow";
      } else if ($region === "50") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "51") {
        $timezone = "Europe/Moscow";
      } else if ($region === "52") {
        $timezone = "Europe/Moscow";
      } else if ($region === "53") {
        $timezone = "Asia/Novosibirsk";
      } else if ($region === "54") {
        $timezone = "Asia/Omsk";
      } else if ($region === "55") {
        $timezone = "Europe/Samara";
      } else if ($region === "56") {
        $timezone = "Europe/Moscow";
      } else if ($region === "57") {
        $timezone = "Europe/Samara";
      } else if ($region === "58") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "59") {
        $timezone = "Asia/Vladivostok";
      } else if ($region === "60") {
        $timezone = "Europe/Kaliningrad";
      } else if ($region === "61") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "62") {
        $timezone = "Europe/Moscow";
      } else if ($region === "63") {
        $timezone = "Asia/Yakutsk";
      } else if ($region === "64") {
        $timezone = "Asia/Sakhalin";
      } else if ($region === "65") {
        $timezone = "Europe/Samara";
      } else if ($region === "66") {
        $timezone = "Europe/Moscow";
      } else if ($region === "67") {
        $timezone = "Europe/Samara";
      } else if ($region === "68") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "69") {
        $timezone = "Europe/Moscow";
      } else if ($region === "70") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "71") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "72") {
        $timezone = "Europe/Moscow";
      } else if ($region === "73") {
        $timezone = "Europe/Samara";
      } else if ($region === "74") {
        $timezone = "Asia/Krasnoyarsk";
      } else if ($region === "75") {
        $timezone = "Asia/Novosibirsk";
      } else if ($region === "76") {
        $timezone = "Europe/Moscow";
      } else if ($region === "77") {
        $timezone = "Europe/Moscow";
      } else if ($region === "78") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "79") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "80") {
        $timezone = "Asia/Yekaterinburg";
      } else if ($region === "81") {
        $timezone = "Europe/Samara";
      } else if ($region === "82") {
        $timezone = "Asia/Irkutsk";
      } else if ($region === "83") {
        $timezone = "Europe/Moscow";
      } else if ($region === "84") {
        $timezone = "Europe/Volgograd";
      } else if ($region === "85") {
        $timezone = "Europe/Moscow";
      } else if ($region === "86") {
        $timezone = "Europe/Moscow";
      } else if ($region === "87") {
        $timezone = "Asia/Novosibirsk";
      } else if ($region === "88") {
        $timezone = "Europe/Moscow";
      } else if ($region === "89") {
        $timezone = "Asia/Vladivostok";
      }
    } else if ($country === "RW") {
      $timezone = "Africa/Kigali";
    } else if ($country === "SA") {
      $timezone = "Asia/Riyadh";
    } else if ($country === "SB") {
      $timezone = "Pacific/Guadalcanal";
    } else if ($country === "SC") {
      $timezone = "Indian/Mahe";
    } else if ($country === "SD") {
      $timezone = "Africa/Khartoum";
    } else if ($country === "SE") {
      $timezone = "Europe/Stockholm";
    } else if ($country === "SG") {
      $timezone = "Asia/Singapore";
    } else if ($country === "SH") {
      $timezone = "Atlantic/St_Helena";
    } else if ($country === "SI") {
      $timezone = "Europe/Ljubljana";
    } else if ($country === "SJ") {
      $timezone = "Arctic/Longyearbyen";
    } else if ($country === "SK") {
      $timezone = "Europe/Bratislava";
    } else if ($country === "SL") {
      $timezone = "Africa/Freetown";
    } else if ($country === "SM") {
      $timezone = "Europe/San_Marino";
    } else if ($country === "SN") {
      $timezone = "Africa/Dakar";
    } else if ($country === "SO") {
      $timezone = "Africa/Mogadishu";
    } else if ($country === "SR") {
      $timezone = "America/Paramaribo";
    } else if ($country === "ST") {
      $timezone = "Africa/Sao_Tome";
    } else if ($country === "SV") {
      $timezone = "America/El_Salvador";
    } else if ($country === "SX") {
      $timezone = "America/Curacao";
    } else if ($country === "SY") {
      $timezone = "Asia/Damascus";
    } else if ($country === "SZ") {
      $timezone = "Africa/Mbabane";
    } else if ($country === "TC") {
      $timezone = "America/Grand_Turk";
    } else if ($country === "TD") {
      $timezone = "Africa/Ndjamena";
    } else if ($country === "TF") {
      $timezone = "Indian/Kerguelen";
    } else if ($country === "TG") {
      $timezone = "Africa/Lome";
    } else if ($country === "TH") {
      $timezone = "Asia/Bangkok";
    } else if ($country === "TJ") {
      $timezone = "Asia/Dushanbe";
    } else if ($country === "TK") {
      $timezone = "Pacific/Fakaofo";
    } else if ($country === "TL") {
      $timezone = "Asia/Dili";
    } else if ($country === "TM") {
      $timezone = "Asia/Ashgabat";
    } else if ($country === "TN") {
      $timezone = "Africa/Tunis";
    } else if ($country === "TO") {
      $timezone = "Pacific/Tongatapu";
    } else if ($country === "TR") {
      $timezone = "Asia/Istanbul";
    } else if ($country === "TT") {
      $timezone = "America/Port_of_Spain";
    } else if ($country === "TV") {
      $timezone = "Pacific/Funafuti";
    } else if ($country === "TW") {
      $timezone = "Asia/Taipei";
    } else if ($country === "TZ") {
      $timezone = "Africa/Dar_es_Salaam";
    } else if ($country === "UA") {
      if ($region === "01") {
        $timezone = "Europe/Kiev";
      } else if ($region === "02") {
        $timezone = "Europe/Kiev";
      } else if ($region === "03") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "04") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "05") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "06") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "07") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "08") {
        $timezone = "Europe/Simferopol";
      } else if ($region === "09") {
        $timezone = "Europe/Kiev";
      } else if ($region === "10") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "11") {
        $timezone = "Europe/Simferopol";
      } else if ($region === "13") {
        $timezone = "Europe/Kiev";
      } else if ($region === "14") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "15") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "16") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "17") {
        $timezone = "Europe/Simferopol";
      } else if ($region === "18") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "19") {
        $timezone = "Europe/Kiev";
      } else if ($region === "20") {
        $timezone = "Europe/Simferopol";
      } else if ($region === "21") {
        $timezone = "Europe/Kiev";
      } else if ($region === "22") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "23") {
        $timezone = "Europe/Kiev";
      } else if ($region === "24") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "25") {
        $timezone = "Europe/Uzhgorod";
      } else if ($region === "26") {
        $timezone = "Europe/Zaporozhye";
      } else if ($region === "27") {
        $timezone = "Europe/Kiev";
      }
    } else if ($country === "UG") {
      $timezone = "Africa/Kampala";
    } else if ($country === "US") {
      if ($region === "AK") {
        $timezone = "America/Anchorage";
      } else if ($region === "AL") {
        $timezone = "America/Chicago";
      } else if ($region === "AR") {
        $timezone = "America/Chicago";
      } else if ($region === "AZ") {
        $timezone = "America/Phoenix";
      } else if ($region === "CA") {
        $timezone = "America/Los_Angeles";
      } else if ($region === "CO") {
        $timezone = "America/Denver";
      } else if ($region === "CT") {
        $timezone = "America/New_York";
      } else if ($region === "DC") {
        $timezone = "America/New_York";
      } else if ($region === "DE") {
        $timezone = "America/New_York";
      } else if ($region === "FL") {
        $timezone = "America/New_York";
      } else if ($region === "GA") {
        $timezone = "America/New_York";
      } else if ($region === "HI") {
        $timezone = "Pacific/Honolulu";
      } else if ($region === "IA") {
        $timezone = "America/Chicago";
      } else if ($region === "ID") {
        $timezone = "America/Denver";
      } else if ($region === "IL") {
        $timezone = "America/Chicago";
      } else if ($region === "IN") {
        $timezone = "America/Indianapolis";
      } else if ($region === "KS") {
        $timezone = "America/Chicago";
      } else if ($region === "KY") {
        $timezone = "America/New_York";
      } else if ($region === "LA") {
        $timezone = "America/Chicago";
      } else if ($region === "MA") {
        $timezone = "America/New_York";
      } else if ($region === "MD") {
        $timezone = "America/New_York";
      } else if ($region === "ME") {
        $timezone = "America/New_York";
      } else if ($region === "MI") {
        $timezone = "America/New_York";
      } else if ($region === "MN") {
        $timezone = "America/Chicago";
      } else if ($region === "MO") {
        $timezone = "America/Chicago";
      } else if ($region === "MS") {
        $timezone = "America/Chicago";
      } else if ($region === "MT") {
        $timezone = "America/Denver";
      } else if ($region === "NC") {
        $timezone = "America/New_York";
      } else if ($region === "ND") {
        $timezone = "America/Chicago";
      } else if ($region === "NE") {
        $timezone = "America/Chicago";
      } else if ($region === "NH") {
        $timezone = "America/New_York";
      } else if ($region === "NJ") {
        $timezone = "America/New_York";
      } else if ($region === "NM") {
        $timezone = "America/Denver";
      } else if ($region === "NV") {
        $timezone = "America/Los_Angeles";
      } else if ($region === "NY") {
        $timezone = "America/New_York";
      } else if ($region === "OH") {
        $timezone = "America/New_York";
      } else if ($region === "OK") {
        $timezone = "America/Chicago";
      } else if ($region === "OR") {
        $timezone = "America/Los_Angeles";
      } else if ($region === "PA") {
        $timezone = "America/New_York";
      } else if ($region === "RI") {
        $timezone = "America/New_York";
      } else if ($region === "SC") {
        $timezone = "America/New_York";
      } else if ($region === "SD") {
        $timezone = "America/Chicago";
      } else if ($region === "TN") {
        $timezone = "America/Chicago";
      } else if ($region === "TX") {
        $timezone = "America/Chicago";
      } else if ($region === "UT") {
        $timezone = "America/Denver";
      } else if ($region === "VA") {
        $timezone = "America/New_York";
      } else if ($region === "VT") {
        $timezone = "America/New_York";
      } else if ($region === "WA") {
        $timezone = "America/Los_Angeles";
      } else if ($region === "WI") {
        $timezone = "America/Chicago";
      } else if ($region === "WV") {
        $timezone = "America/New_York";
      } else if ($region === "WY") {
        $timezone = "America/Denver";
      }
    } else if ($country === "UY") {
      $timezone = "America/Montevideo";
    } else if ($country === "UZ") {
      if ($region === "01") {
        $timezone = "Asia/Tashkent";
      } else if ($region === "02") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "03") {
        $timezone = "Asia/Tashkent";
      } else if ($region === "06") {
        $timezone = "Asia/Tashkent";
      } else if ($region === "07") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "08") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "09") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "10") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "12") {
        $timezone = "Asia/Samarkand";
      } else if ($region === "13") {
        $timezone = "Asia/Tashkent";
      } else if ($region === "14") {
        $timezone = "Asia/Tashkent";
      }
    } else if ($country === "VA") {
      $timezone = "Europe/Vatican";
    } else if ($country === "VC") {
      $timezone = "America/St_Vincent";
    } else if ($country === "VE") {
      $timezone = "America/Caracas";
    } else if ($country === "VG") {
      $timezone = "America/Tortola";
    } else if ($country === "VI") {
      $timezone = "America/St_Thomas";
    } else if ($country === "VN") {
      $timezone = "Asia/Phnom_Penh";
    } else if ($country === "VU") {
      $timezone = "Pacific/Efate";
    } else if ($country === "WF") {
      $timezone = "Pacific/Wallis";
    } else if ($country === "WS") {
      $timezone = "Pacific/Samoa";
    } else if ($country === "YE") {
      $timezone = "Asia/Aden";
    } else if ($country === "YT") {
      $timezone = "Indian/Mayotte";
    } else if ($country === "YU") {
      $timezone = "Europe/Belgrade";
    } else if ($country === "ZA") {
      $timezone = "Africa/Johannesburg";
    } else if ($country === "ZM") {
      $timezone = "Africa/Lusaka";
    } else if ($country === "ZW") {
      $timezone = "Africa/Harare";
    }

    return $timezone;
  }

  // Modified version of the timezone list function from http://stackoverflow.com/a/17355238/507629
// Includes current time for each timezone (would help users who don't know what their timezone is)

  public static function generate_timezone_list($with_current_time = false)
  {
    static $regions = [
      DateTimeZone::AFRICA,
      DateTimeZone::AMERICA,
      DateTimeZone::ANTARCTICA,
      DateTimeZone::ASIA,
      DateTimeZone::ATLANTIC,
      DateTimeZone::AUSTRALIA,
      DateTimeZone::EUROPE,
      DateTimeZone::INDIAN,
      DateTimeZone::PACIFIC,
    ];

    $timezones = [];
    foreach ($regions as $region) {
      $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
    }

    $timezone_offsets = [];
    foreach ($timezones as $timezone) {
      $tz = new DateTimeZone($timezone);
      $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by timezone name
    ksort($timezone_offsets);

    $timezone_list = [];
    foreach ($timezone_offsets as $timezone => $offset) {
      $offset_prefix = $offset < 0 ? '-' : '+';
      $offset_formatted = gmdate('H:i', abs($offset));

      $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

      $t = new DateTimeZone($timezone);
      $c = new DateTime(null, $t);
      $current_time = $with_current_time ? "- ".$c->format('g:i A'):'';

      $timezone_list[$timezone] = "(${pretty_offset}) $timezone $current_time";
    }

    return $timezone_list;
  }

  public static function getOffset($timezone) {
    $tz = new DateTimeZone($timezone);
    $offset = $tz->getOffset(new DateTime);

    $offset_prefix = $offset < 0 ? '-' : '+';
    $offset_formatted = gmdate('H:i', abs($offset));

    $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

    return $pretty_offset;
  }

  public static function generate_iso_country_list()
  {
    $countryList = [
      "GB" => "United Kingdom",
      "AF" => "Afghanistan",
      "AX" => "Åland Islands",
      "AL" => "Albania",
      "DZ" => "Algeria",
      "AS" => "American Samoa",
      "AD" => "Andorra",
      "AO" => "Angola",
      "AI" => "Anguilla",
      "AQ" => "Antarctica",
      "AG" => "Antigua and Barbuda",
      "AR" => "Argentina",
      "AM" => "Armenia",
      "AW" => "Aruba",
      "AU" => "Australia",
      "AT" => "Austria",
      "AZ" => "Azerbaijan",
      "BS" => "Bahamas",
      "BH" => "Bahrain",
      "BD" => "Bangladesh",
      "BB" => "Barbados",
      "BY" => "Belarus",
      "BE" => "Belgium",
      "BZ" => "Belize",
      "BJ" => "Benin",
      "BM" => "Bermuda",
      "BT" => "Bhutan",
      "BO" => "Bolivia, Plurinational State of",
      "BQ" => "Bonaire, Sint Eustatius and Saba",
      "BA" => "Bosnia and Herzegovina",
      "BW" => "Botswana",
      "BV" => "Bouvet Island",
      "BR" => "Brazil",
      "IO" => "British Indian Ocean Territory",
      "BN" => "Brunei Darussalam",
      "BG" => "Bulgaria",
      "BF" => "Burkina Faso",
      "BI" => "Burundi",
      "KH" => "Cambodia",
      "CM" => "Cameroon",
      "CA" => "Canada",
      "CV" => "Cape Verde",
      "KY" => "Cayman Islands",
      "CF" => "Central African Republic",
      "TD" => "Chad",
      "CL" => "Chile",
      "CN" => "China",
      "CX" => "Christmas Island",
      "CC" => "Cocos (Keeling) Islands",
      "CO" => "Colombia",
      "KM" => "Comoros",
      "CG" => "Congo",
      "CD" => "Congo, the Democratic Republic of the",
      "CK" => "Cook Islands",
      "CR" => "Costa Rica",
      "CI" => "Côte d'Ivoire",
      "HR" => "Croatia",
      "CU" => "Cuba",
      "CW" => "Curaçao",
      "CY" => "Cyprus",
      "CZ" => "Czech Republic",
      "DK" => "Denmark",
      "DJ" => "Djibouti",
      "DM" => "Dominica",
      "DO" => "Dominican Republic",
      "EC" => "Ecuador",
      "EG" => "Egypt",
      "SV" => "El Salvador",
      "GQ" => "Equatorial Guinea",
      "ER" => "Eritrea",
      "EE" => "Estonia",
      "ET" => "Ethiopia",
      "FK" => "Falkland Islands (Malvinas)",
      "FO" => "Faroe Islands",
      "FJ" => "Fiji",
      "FI" => "Finland",
      "FR" => "France",
      "GF" => "French Guiana",
      "PF" => "French Polynesia",
      "TF" => "French Southern Territories",
      "GA" => "Gabon",
      "GM" => "Gambia",
      "GE" => "Georgia",
      "DE" => "Germany",
      "GH" => "Ghana",
      "GI" => "Gibraltar",
      "GR" => "Greece",
      "GL" => "Greenland",
      "GD" => "Grenada",
      "GP" => "Guadeloupe",
      "GU" => "Guam",
      "GT" => "Guatemala",
      "GG" => "Guernsey",
      "GN" => "Guinea",
      "GW" => "Guinea-Bissau",
      "GY" => "Guyana",
      "HT" => "Haiti",
      "HM" => "Heard Island and McDonald Islands",
      "VA" => "Holy See (Vatican City State)",
      "HN" => "Honduras",
      "HK" => "Hong Kong",
      "HU" => "Hungary",
      "IS" => "Iceland",
      "IN" => "India",
      "ID" => "Indonesia",
      "IR" => "Iran, Islamic Republic of",
      "IQ" => "Iraq",
      "IE" => "Ireland",
      "IM" => "Isle of Man",
      "IL" => "Israel",
      "IT" => "Italy",
      "JM" => "Jamaica",
      "JP" => "Japan",
      "JE" => "Jersey",
      "JO" => "Jordan",
      "KZ" => "Kazakhstan",
      "KE" => "Kenya",
      "KI" => "Kiribati",
      "KP" => "Korea, Democratic People's Republic of",
      "KR" => "Korea, Republic of",
      "KW" => "Kuwait",
      "KG" => "Kyrgyzstan",
      "LA" => "Lao People's Democratic Republic",
      "LV" => "Latvia",
      "LB" => "Lebanon",
      "LS" => "Lesotho",
      "LR" => "Liberia",
      "LY" => "Libya",
      "LI" => "Liechtenstein",
      "LT" => "Lithuania",
      "LU" => "Luxembourg",
      "MO" => "Macao",
      "MK" => "Macedonia, the former Yugoslav Republic of",
      "MG" => "Madagascar",
      "MW" => "Malawi",
      "MY" => "Malaysia",
      "MV" => "Maldives",
      "ML" => "Mali",
      "MT" => "Malta",
      "MH" => "Marshall Islands",
      "MQ" => "Martinique",
      "MR" => "Mauritania",
      "MU" => "Mauritius",
      "YT" => "Mayotte",
      "MX" => "Mexico",
      "FM" => "Micronesia, Federated States of",
      "MD" => "Moldova, Republic of",
      "MC" => "Monaco",
      "MN" => "Mongolia",
      "ME" => "Montenegro",
      "MS" => "Montserrat",
      "MA" => "Morocco",
      "MZ" => "Mozambique",
      "MM" => "Myanmar",
      "NA" => "Namibia",
      "NR" => "Nauru",
      "NP" => "Nepal",
      "NL" => "Netherlands",
      "NC" => "New Caledonia",
      "NZ" => "New Zealand",
      "NI" => "Nicaragua",
      "NE" => "Niger",
      "NG" => "Nigeria",
      "NU" => "Niue",
      "NF" => "Norfolk Island",
      "MP" => "Northern Mariana Islands",
      "NO" => "Norway",
      "OM" => "Oman",
      "PK" => "Pakistan",
      "PW" => "Palau",
      "PS" => "Palestinian Territory, Occupied",
      "PA" => "Panama",
      "PG" => "Papua New Guinea",
      "PY" => "Paraguay",
      "PE" => "Peru",
      "PH" => "Philippines",
      "PN" => "Pitcairn",
      "PL" => "Poland",
      "PT" => "Portugal",
      "PR" => "Puerto Rico",
      "QA" => "Qatar",
      "RE" => "Réunion",
      "RO" => "Romania",
      "RU" => "Russian Federation",
      "RW" => "Rwanda",
      "BL" => "Saint Barthélemy",
      "SH" => "Saint Helena, Ascension and Tristan da Cunha",
      "KN" => "Saint Kitts and Nevis",
      "LC" => "Saint Lucia",
      "MF" => "Saint Martin (French part)",
      "PM" => "Saint Pierre and Miquelon",
      "VC" => "Saint Vincent and the Grenadines",
      "WS" => "Samoa",
      "SM" => "San Marino",
      "ST" => "Sao Tome and Principe",
      "SA" => "Saudi Arabia",
      "SN" => "Senegal",
      "RS" => "Serbia",
      "SC" => "Seychelles",
      "SL" => "Sierra Leone",
      "SG" => "Singapore",
      "SX" => "Sint Maarten (Dutch part)",
      "SK" => "Slovakia",
      "SI" => "Slovenia",
      "SB" => "Solomon Islands",
      "SO" => "Somalia",
      "ZA" => "South Africa",
      "GS" => "South Georgia and the South Sandwich Islands",
      "SS" => "South Sudan",
      "ES" => "Spain",
      "LK" => "Sri Lanka",
      "SD" => "Sudan",
      "SR" => "Suriname",
      "SJ" => "Svalbard and Jan Mayen",
      "SZ" => "Swaziland",
      "SE" => "Sweden",
      "CH" => "Switzerland",
      "SY" => "Syrian Arab Republic",
      "TW" => "Taiwan, Province of China",
      "TJ" => "Tajikistan",
      "TZ" => "Tanzania, United Republic of",
      "TH" => "Thailand",
      "TL" => "Timor-Leste",
      "TG" => "Togo",
      "TK" => "Tokelau",
      "TO" => "Tonga",
      "TT" => "Trinidad and Tobago",
      "TN" => "Tunisia",
      "TR" => "Turkey",
      "TM" => "Turkmenistan",
      "TC" => "Turks and Caicos Islands",
      "TV" => "Tuvalu",
      "UG" => "Uganda",
      "UA" => "Ukraine",
      "AE" => "United Arab Emirates",
      "US" => "United States",
      "UM" => "United States Minor Outlying Islands",
      "UY" => "Uruguay",
      "UZ" => "Uzbekistan",
      "VU" => "Vanuatu",
      "VE" => "Venezuela, Bolivarian Republic of",
      "VN" => "Viet Nam",
      "VG" => "Virgin Islands, British",
      "VI" => "Virgin Islands, U.S.",
      "WF" => "Wallis and Futuna",
      "EH" => "Western Sahara",
      "YE" => "Yemen",
      "ZM" => "Zambia",
      "ZW" => "Zimbabwe"];

    return $countryList;
  }

  /**
   * @return null
   */
  public function getCity()
  {
    return $this->_city;
  }

  /**
   * @return null
   */
  public function getLatlng()
  {
    return $this->_latlng;
  }

  /**
   * @return null
   */
  public function getCountrycode()
  {
    return $this->_countrycode;
  }

  /**
   * @return null
   */
  public function getRegion()
  {
    return $this->_region;
  }

  /**
   * @return null
   */
  public function getTimezone()
  {
    return $this->_timezone;
  }
}