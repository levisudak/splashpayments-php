<?php 
namespace SplashPayments;

use SplashPayments\Exceptions\InvalidRequest;

class members extends BaseResource {
  protected $resourceName = "members";
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
   * The identifier of the Merchant associated with this Member.
   */
  public $merchant;

  /**
   * @string
   * The title that this Member holds in relation to the associated Merchant. 
   * For example, 'CEO', 'Owner' or 'Director of Finance'.
   */
  public $title;

  /**
   * @string
   * The first name associated with this Member.
   */
  public $first;

  /**
   * @string
   * The middle name associated with this Member.
   */
  public $middle;

  /**
   * @string
   * The last name associated with this Member.
   */
  public $last;

  /**
   * @string
   * The social security number of this Member. This field is required if the Merchant associated with the Member is a sole trader.
   */
  public $ssn;

  /**
   * @integer
   * The date of birth of this Member.  The date is specified as an eight digit string in YYYYMMDD format, for example, '20160120' for January 20, 2016.
   */
  public $dob;

  /**
   * @string
   * The driver's license number of this Member.
   */
  public $dl;

  /**
   * @string
   */
  public $dlstate;

  /**
   * @integer
   * The share of the Member's ownership of the associated Merchant, expressed in basis points. 
   * For example, 25.3% is expressed as '2530'.
   */
  public $ownership;

  /**
   * @string
   * The email address of this Member.
   */
  public $email;

  /**
   * @string
   */
  public $fax;

  /**
   * @string
   */
  public $phone;

  /**
   * @string
   */
  public $country;

  /**
   * @string
   */
  public $zip;

  /**
   * @string
   */
  public $state;

  /**
   * @string
   */
  public $city;

  /**
   * @string
   */
  public $address2;

  /**
   * @string
   */
  public $address1;

  /**
   * @integer
   * Indicates whether the Member is the 'primary' contact for the associated Merchant. Only one Member associated with each Merchant can be the 'primary' Member. 
   * A value of '1' means primary, and a value of '0' means not primary.
   */
  public $primary;

  /**
   * @integer
   * Whether this Member is marked as inactive. A value of '1' means inactive, and a value of '0' means active.
   */
  public $inactive;

  /**
   * @integer
   * Whether this Member should be marked as frozen. A value of '1' means frozen, and a value of '0' means not frozen.
   */
  public $frozen;


}

