<?php 
namespace SplashPayments\Utilities;

class Config {
  // The base url for requests
  private static $url = 'https://api.splashpayments.com';

  // Whether to trhow exceptions or not
  private static $exceptions = true;

  // apiKey to make the requests
  private static $apiKey;

  // sessionKey to make the requests
  private static $sessionKey;

  // Retrieve the current apiKey
  public static function getApiKey() {
    return self::$apiKey;
  }

  // Set the apiKey
  public static function setApiKey($newApiKey) {
    self::$apiKey = $newApiKey;
  }

  // Retrieve the current sessionKey
  public static function getSessionKey() {
    return self::$sessionKey;
  }

  // Set the sessionKey
  public static function setSessionKey($newSessionKey) {
    self::$sessionKey = $newSessionKey;
  }

  // Set the global $exceptions property
  public static function throwExceptions($exceptions) {
    self::$exceptions = is_bool($exceptions) && $exceptions;
  }

  // Get the global $exceptions property
  public static function exceptionsEnabled() {
    return self::$exceptions;
  }

  // Get the global url
  public static function getUrl() {
    return self::$url;
  }
}
