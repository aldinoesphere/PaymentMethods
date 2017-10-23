<?php  
/**
* 
*/
class vsaMethod extends PaymentMethodsPaymentMethod
{
	use Loggable;

	/**
	* @var name
	*/
	protected $name = 'Visa';

	/**
	* @var logoFileName
	*/
	protected $logoFileName = 'vsa.png';

}
?>