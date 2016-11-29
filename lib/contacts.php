<?php 
namespace SplashPayments;

use SplashPayments\Exceptions\InvalidRequest;

class contacts extends BaseResource {
  protected $resourceName = "contacts";
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
   * The identifier of the Entity that this Contact relates to.
   */
  public $entity;

  /**
   * @string
   * The first name associated with this Contact.
   */
  public $first;

  /**
   * @string
   * The middle name associated with this Contact.
   */
  public $middle;

  /**
   * @string
   * The last name associated with this Contact.
   */
  public $last;

  /**
   * @string
   * A description of this Contact.
   */
  public $description;

  /**
   * @string
   * The email address of this Contact.
   */
  public $email;

  /**
   * @string
   * The fax number associated with this Contact. 
   * This field is stored as a text string, and must be between 10 and 15 characters long.
   */
  public $fax;

  /**
   * @string
   * The phone number associated with this Contact. 
   * This field is stored as a text string, and must be between 10 and 15 characters long.
   */
  public $phone;

  /**
   * @string
   * The country in the address associated with the Contact. Currently, this field only accepts the value 'USA'.
   */
  public $country;

  /**
   * @string
   * The ZIP code in the address associated with this Contact. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $zip;

  /**
   * @string
   * The U.S. state in the address associated with this Contact. 
   * Valid values are: AL, AK, AZ, AR, CA, CO, CT, DE, DC, FL, GA, HI, ID, IL, IN, IA, KS, KY, LA, ME, MD, MA, MI, MN, MS, MO, MT, NE, NV, NH, NJ, NM, NY, NC, ND, OH, OK, OR, PA, RI, SC, SD, TN, TX, UT, VT, VA, WA, WV, WI, and WY.
   */
  public $state;

  /**
   * @string
   * The name of the city in the address associated with this Contact. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $city;

  /**
   * @string
   * The second line of the address associated with this Contact. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $address2;

  /**
   * @string
   * The first line of the address associated with this Contact. 
   * This field is stored as a text string, and must be between 1 and 100 characters long.
   */
  public $address1;

  /**
   * @integer
   * Whether this resource is marked as inactive. A value of '1' means inactive, and a value of '0' means active.
   */
  public $inactive;

  /**
   * @integer
   * Whether this resource is marked as frozen. A value of '1' means frozen, and a value of '0' means not frozen.
   */
  public $frozen;


}

