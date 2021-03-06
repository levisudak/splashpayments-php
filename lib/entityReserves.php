<?php 
namespace SplashPayments;

use SplashPayments\Exceptions\InvalidRequest;

class entityReserves extends BaseResource {
  protected $resourceName = "entityReserves";
  /**
   * @string
   * The ID of this resource.
   */
  public $id;

  /**
   * @string
   * The date and time at which this resource was created.
   */
  public $created;

  /**
   * @string
   * The date and time at which this resource was modified.
   */
  public $modified;

  /**
   * @string
   * The identifier of the Login that created this resource.
   */
  public $creator;

  /**
   * @string
   * The identifier of the Login that last modified this resource.
   */
  public $modifier;

  /**
   * @string
   * The Login that owns this resource.
   */
  public $login;

  /**
   * @string
   * The identifier of the Entity that this entityReserves resource relates to.
   */
  public $entity;

  /**
   * @integer
   * The amount held in this entityReserve. 
   * This field is specified as an integer in cents.
   */
  public $total;

  /**
   * @string
   * The currency of the amount in this entityReserve. 
   * Currently, this field only accepts the value 'USD'.
   */
  public $currency;


  public function delete($params = array()) {
      throw new \SplashPayments\Exceptions\InvalidRequest('Invalid Action');
  }

}

