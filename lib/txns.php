<?php 
namespace SplashPayments;

use SplashPayments\Exceptions\InvalidRequest;

class txns extends BaseResource {
  protected $resourceName = "txns";
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
   * The incoming ip address from which this Transaction was created.
   */
  public $ipCreated;

  /**
   * @string
   * The incoming ip address from which this Transaction was last modified.
   */
  public $ipModified;

  /**
   * @string
   * The identifier of the Merchant associated with this Transaction.
   */
  public $merchant;

  /**
   * @string
   * The identifier of the Token associated with this Transaction.
   */
  public $token;

  /**
   * @string
   * If the this Transaction is related to another Transaction, then this field is set to the identifier of the other Transaction. 
   * For example, if this Transaction is a refund, this field could be set to the identifier of the original sale Transaction.
   */
  public $fortxn;

  /**
   * @string
   * If the Transaction is linked to a Batch, this field specifies the identifier of the Batch.
   */
  public $batch;

  /**
   * @string
   * The identifier of the Subscription associated with this Transaction.
   */
  public $subscription;

  /**
   * @integer
   * The type of Transaction. 
   * This field is specified as an integer. 
   * Valid values are: 
   * '1': Sale Transaction. This is the most common type of Transaction, it processes a sale and charges the customer, 
   * '2': Auth Transaction. Authorizes and holds the requested total on the credit card, 
   * '3': Capture Transaction. Finalizes a prior Auth Transaction and charges the customer, 
   * '4': Reverse Authorization. Reverses a prior Auth Transaction and releases the credit hold 
   * '5': Refund Transaction. Refunds a prior Capture or Sale Transaction (total may be specified for a partial refund). 
   * '7': Echeck Sale Transaction. Sale Transaction for ECheck payment. 
   * '9': ECheck Refund Transaction. Refund Transaction for prior ECheck Sale Transaction. 
   * '10': Echeck PreSale Transaction. Notification of imminent Echeck Sale Transaction. 
   * '11': Echeck PreRefund Transaction. Notification of imminent Echeck Refund Transaction. 
   * '12': Echeck Verification Transaction. Attempt to verify validity of Echeck payment prior to sale. 
   * '13': Echeck Void Transaction. Voids prior Echeck transaction.
   */
  public $type;

  /**
   * @string
   * The expiration date of this Transaction. 
   * This field is stored as a text string in 'MMYY' format, where 'MM' is the number of a month, and 'YY' is the last two digits of a year. For example, '0623' for June 2023. 
   * The value must reflect a future date.
   */
  public $expiration;

  /**
   * @integer
   * The date on which the Transaction was authorized. 
   * The date is specified as an eight digit string in YYYYMMDD format, for example, '20160120' for January 20, 2016. 
   * The value of this field must represent a date in the past.
   */
  public $authDate;

  /**
   * @string
   * The authorization code for this Transaction. 
   * This field is stored as a text string, and must be between 0 and 20 characters long.
   */
  public $authCode;

  /**
   * @string
   * A timestamp indicating when this Transaction was captured. 
   * This field is set automatically.
   */
  public $captured;

  /**
   * @integer
   * Whether to allow partial amount authorizations of this Transaction. 
   * For example, if the transaction amount is $1000 and the processor only authorizes a smaller amount, then enabling this field  lets the Transaction proceed anyway. 
   * A value of '1' means that partial amount authorizations are allowed, and a value of '0' means that partial amount authorizations are not allowed.
   */
  public $allowPartial;

  /**
   * @string
   * The identifier of the Order associated with this Transaction. 
   * This field is stored as a text string, and must be between 0 and 20 characters long.
   */
  public $order;

  /**
   * @string
   * A description of this Transaction.  
   * This field is stored as a text string, and must be between 0 and 100 characters long.
   */
  public $description;

  /**
   * @string
   * The identifier of the terminal that processed this Transaction. 
   * The identifier is taken from the terminal system, and varies in format according to the type of terminal. 
   * This field is stored as a text string, and must be between 0 and 8 characters long.
   */
  public $terminal;

  /**
   * @integer
   * The origin of this Transaction. 
   * Valid values are: 
   * '1': Originated at a credit card terminal. 
   * '2': Originated through an eCommerce system. 
   * '3': Originated as a mail order or telephone order transaction. 
   * '4': Originated with Apple Pay. 
   * '5': Originated as a 3D Secure authorized transaction. 
   * '6': Originated as a 3D Secure transaction. 
   * '7': Originated as a recurring transaction on the card.
   */
  public $origin;

  /**
   * @integer
   * The amount of the total sum of this Transaction that is made up of tax. 
   * This field is specified as an integer in cents.
   */
  public $tax;

  /**
   * @integer
   * The total amount of this Transaction. 
   * This field is specified as an integer in cents.
   */
  public $total;

  /**
   * @string
   * The authorization code for this Transaction, as returned by the network.
   */
  public $authorization;

  /**
   * @integer
   * The total amount that was approved for this Transaction by the processor. 
   * This field is specified as an integer in cents.
   */
  public $approved;

  /**
   * @integer
   * Whether correct cvv was sent during this Transaction. A value of '1' means cvv was sent and was correct, and a value of '0' means that cvv was not sent or was not correct.
   */
  public $cvv;

  /**
   * @integer
   * Whether the card was swiped during this Transaction. 
   * This field is set to '1' automatically if 'track' data was received. 
   * A value of '1' means swiped, and a value of '0' means not swiped.
   */
  public $swiped;

  /**
   * @integer
   * Whether a signature was captured during this Transaction. 
   * A value of '1' means a signature was captured, and a value of '0' means a signature was not captured. 
   * You can set this field if you took a signature for the Transaction. The API also sets this field automatically if you associate a signature to the Transaction by creating a 'txnDatas' resource.
   */
  public $signature;

  /**
   * @integer
   */
  public $unattended;

  /**
   * @string
   * The first name associated with this Transaction.
   */
  public $first;

  /**
   * @string
   * The middle name associated with this Transaction.
   */
  public $middle;

  /**
   * @string
   * The last name associated with this Transaction.
   */
  public $last;

  /**
   * @string
   * The name of the company associated with this Transaction. 
   * Setting this field is especially important when processing an eCheck from a company.
   */
  public $company;

  /**
   * @string
   */
  public $email;

  /**
   * @string
   * The first line of the address associated with this Transaction. 
   * This field is stored as a text string, and must be between 1 and 100 characters long.
   */
  public $address1;

  /**
   * @string
   * The second line of the address associated with this Transaction. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $address2;

  /**
   * @string
   * The name of the city in the address associated with this Transaction. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $city;

  /**
   * @string
   * The U.S. state in the address associated with this Transaction. 
   * Valid values are: AL, AK, AZ, AR, CA, CO, CT, DE, DC, FL, GA, HI, ID, IL, IN, IA, KS, KY, LA, ME, MD, MA, MI, MN, MS, MO, MT, NE, NV, NH, NJ, NM, NY, NC, ND, OH, OK, OR, PA, RI, SC, SD, TN, TX, UT, VT, VA, WA, WV, WI, and WY.
   */
  public $state;

  /**
   * @string
   * The ZIP code in the address associated with this Transaction. 
   * This field is stored as a text string, and must be between 1 and 20 characters long.
   */
  public $zip;

  /**
   * @string
   * The country in the address associated with the Transaction. Currently, this field only accepts the value 'USA'.
   */
  public $country;

  /**
   * @string
   * The phone number associated with this Transaction. 
   * This field is stored as a text string, and must be between 10 and 15 characters long.
   */
  public $phone;

  /**
   * @integer
   * Indicates whether the Transaction is reserved, and the action that will be taken as a result. 
   * This field is specified as an integer. 
   * Valid values are: 
   * '0': Not reserved 
   * '1': If the Transaction is a sale or authorization, then block the capture of the Transaction. 
   * '2': Apply a manual override to any checks on the Transaction and allow it to proceed, and 
   * '3': Move all funds from this Transaction into a reserve.
   */
  public $reserved;

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


  public function delete($params = array()) {
      throw new \SplashPayments\Exceptions\InvalidRequest('Invalid Action');
  }

}

