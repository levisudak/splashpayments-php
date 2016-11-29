<?php 
namespace SplashPayments;

use \SplashPayments\Http\Request,
    \SplashPayments\Http\Response,
    \SplashPayments\Http\RequestParams,
    \SplashPayments\Exceptions\InvalidRequest,
    \SplashPayments\Utilities\Config as Config;

class BaseResource {
  protected $response;
  protected $requestOptions;
  protected $nestedParams;

  public function __construct($params = array()) {
    $this->nestedParams = array();
    $this->requestOptions = new \SplashPayments\Http\RequestParams();
    if ($params) {
      foreach ($params as $key => $value) {
        $this->$key = $value;
      }
    }
  }

  public function retrieve($params = array()) {
    $Request = Request::getInstance();

    // Get request values
    $values = $this->_getRequestValues($params);
    $search = $this->_buildSearch($values);
    if ($this->requestOptions) {
      $search .= $this->requestOptions->getSort();
    }
    $search = rtrim($search, "&");

    // Set the headers
    $headers = array('Content-Type: application/json');
    $headers[] = $search;
    $apiKey = Config::getApiKey();

    $sessionKey = Config::getSessionKey();
    if ($apiKey) {
      $headers[] = "APIKEY: {$apiKey}";
    }
    else if ($sessionKey) {
      $headers[] = "SESSIONKEY: {$sessionKey}"; 
    }
    // Set the url;
    $url = Config::getUrl();
    if (!$url) {
      throw new \Payrix\Exceptions\InvalidRequest("Invalid URL");
    }
    $url .= "/{$this->resourceName}";
    $expand = "";
    if ($this->requestOptions) {
      $expand .= $this->requestOptions->getExpand();
      $page = $this->requestOptions->getPage();
      $url .= "?";
      if ($expand) {
        $url .= $expand . "&";
      }
      if ($page) {
        $url .= $page;
      }
    }
    $url = rtrim($url, "/[& | ?]/");
    $res = $Request->sendHttp(
      'GET',
      $url,
      '',
      $headers
    );
    $this->response = new Response($res[0], $res[1], get_class($this));
    $success = $this->_validateResponse();
    if ($success) {
      // Increment page
      $this->requestOptions->goNextPage();
    }
    return $success;
  }

  public function create($params = array()) {
    $Request = Request::getInstance();

    // Get request values
    $values = $this->_getRequestValues($params, true);
    $headers = array('Content-Type: application/json');
    $apiKey = Config::getApiKey();
    $sessionKey = Config::getSessionKey();
    if ($apiKey) {
      $headers[] = "APIKEY: {$apiKey}";
    }
    else if ($sessionKey) {
      $headers[] = "SESSIONKEY: {$sessionKey}"; 
    }
    $url = Config::getUrl();
    if (!$url) {
      throw new \Payrix\Exceptions\InvalidRequest("Invalid URL");
    }
    $url .= "/{$this->resourceName}";
    $res = $Request->sendHttp(
      'POST',
      $url,
      $values,
      $headers
    );
    $this->response = new Response($res[0], $res[1], get_class($this));
    return $this->_validateResponse();
  }

  public function update($params = array()) {
    $Request = Request::getInstance();

    // Get request values
    $values = $this->_getRequestValues($params);
    if (!isset($values["id"])) {
      if (Config::exceptionsEnabled()) {
        throw new \SplashPayments\Exceptions\InvalidRequest("ID is required for this action");
      }
      else {
        return false;
      }
    }
    else {
      $id = $values["id"];
      unset($values["id"]);
    }

    $headers = array('Content-Type: application/json');
    $apiKey = Config::getApiKey();
    $sessionKey = Config::getSessionKey();
    if ($apiKey) {
      $headers[] = "APIKEY: {$apiKey}";
    }
    else if ($sessionKey) {
      $headers[] = "SESSIONKEY: {$sessionKey}"; 
    }
    $url = Config::getUrl();
    if (!$url) {
      throw new \Payrix\Exceptions\InvalidRequest("Invalid URL");
    }
    $url .= "/{$this->resourceName}/{$id}";
    $res = $Request->sendHttp(
      'PUT',
      $url,
      $values,
      $headers
    );

    $this->response = new Response($res[0], $res[1], get_class($this));
    return $this->_validateResponse();
  }

  public function delete($params = array()) {
    $Request = Request::getInstance();

    // Get request values
    $values = $this->_getRequestValues($params);
    if (!isset($values["id"])) {
      if (Config::exceptionsEnabled()) {
        throw new \SplashPayments\Exceptions\InvalidRequest("ID is required for this action;");
      }
      else {
        return false;
      }
    }

    $headers = array('Content-Type: application/json');
    $apiKey = Config::getApiKey();
    $sessionKey = Config::getSessionKey();
    if ($apiKey) {
      $headers[] = "APIKEY: {$apiKey}";
    }
    else if ($sessionKey) {
      $headers[] = "SESSIONKEY: {$sessionKey}"; 
    }
    $url = Config::getUrl();
    if (!$url) {
      throw new \Payrix\Exceptions\InvalidRequest("Invalid URL");
    }
    $url .= "/{$this->resourceName}/{$values["id"]}";
    $res = $Request->sendHttp(
      'DELETE',
      $url,
      '',
      $headers
    );

    $this->response = new Response($res[0], $res[1], get_class($this));
    return $this->_validateResponse();
  }

  // Set a nested obejct
  public function set($field, $param) {
    if (!is_string($field)) {
      return false;
    }

    if (is_array($param)) {
      $newParam = array();
      foreach ($param as $key => $object) {
        // Check that the objects are valid
        if ($this->_verifyObject($object)) {
          // Retrive nested params from resource object
          unset($object->nestedParams);
          unset($object->requestOptions);
          unset($object->resourceName);
          unset($object->response);

          $objectParams = array_filter((array) $object, function($value, $keyObject) {
            return isset($value);
          }, ARRAY_FILTER_USE_BOTH);
            $newParam[$key] = $objectParams;
        }
      }
      $this->_setNested($newParam, $field);
      return true;
    }
    else {
      if ($this->_verifyObject($param)) {
        $this->_setNested($param, $field);
        return true;
      }
      return false;
    }
  }

  // Get the status code of the request
  public function getStatus() {
    if (!$this->response) {
      return false;
    }
    return $this->response->getStatus();
  }

  // Whether the response has error or not
  public function hasErrors() {
    if (!$this->response) {
      return false;
    }
    return $this->response->hasErrors();
  }

  // Retrieve the response in array format
  public function getResponse() {
    if (!$this->response) {
      return array();
    }
    return $this->response->getResponse();
  }

  // Retrieve the errors in array format
  public function getErrors() {
    if (!$this->response) {
      return array();
    }
    return $this->response->getErrors();
  }

  // Retrieve the details of the response
  public function getDetails() {
    if (!$this->response) {
      return array();
    }
    return $this->response->getDetails();
  }

  public function hasMore() {
    if (!$this->response) {
      return true;
    }
    return $this->response->hasMore();
  }

  public function setOptions($params = false) {
    if ($params && get_class($params) === "SplashPayments\Http\RequestParams") {
      $this->requestOptions = $params;
    }
  }

  public function getOptions() {
    return $this->requestOptions;
  }

  private function _buildSearch($values = array()) {
    $search = "";
    foreach ($values as $key => $value) {
      if (isset($value)) {
        $search .= "{$key}[equals]={$value}&";
      }
    }
    return "SEARCH: {$search}";
  }

  private function _getRequestValues($params = array(), $getNested = false) {
    $nestedParams = $this->nestedParams;
    $requestOptions = $this->requestOptions;
    $resourceName = $this->resourceName;
    $response = $this->response;

    unset($this->nestedParams);
    unset($this->requestOptions);
    unset($this->resourceName);
    unset($this->response);
    $thisParams = (array) $this;
    $thisParams = array_filter($thisParams, function($value, $key) {
      return isset($value);
    }, ARRAY_FILTER_USE_BOTH);

      $newArray = array_merge($thisParams, $params);
      if ($getNested) {
        foreach ($nestedParams as $keyNested => $valueNested) {
          $newArray[$keyNested] = $valueNested;
        }
      }

      $this->nestedParams = $nestedParams;
      $this->requestOptions = $requestOptions;
      $this->resourceName = $resourceName;
      $this->response = $response;
      return $newArray;
  }

  private function _setNested($object, $field) {
    // Retrive nested params from resource object
    unset($object->nestedParams);
    unset($object->response);
    unset($object->requestOptions);
    unset($object->resourceName);
    $objectParams = array_filter($object, function($value, $keyObject) {
      return isset($value);
    }, ARRAY_FILTER_USE_BOTH);
      $this->nestedParams[$field] = $objectParams;
  }

  // Verify that the nested objects are valid resource objects
  private function _verifyObject($value) {
    $parent = get_class();
    if ($parent !== get_parent_class($value)) {
      return false;
    }
    return true;
  }

  private function _validateResponse() {
    // Get the errors
    if ($this->response->hasErrors()) {
      if (Config::exceptionsEnabled()) {
        throw new \SplashPayments\Exceptions\ApiErrors('There are errors in the response');
      }
      return false;
    }
    return true;
  }
}
