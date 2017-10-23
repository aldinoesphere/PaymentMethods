<?php  
namespace PaymentMethods\Services;


use Plenty\Plugin\Log\Loggable;

/**
* 
*/
class GatewayService
{
	
	use Loggable;

	/**
	* @var string
	*/
	protected $oppUrl = 'https://test.oppwa.com/v1/';

	public function getGatewayResponse($) {
		$url = $;
		$data = http_build_query($parameter, '', '&');
		// "authentication.userId=8a8294174b7ecb28014b9699220015cc" .
		// "&authentication.password=sy6KJsT8" .
		// "&authentication.entityId=8a8294174b7ecb28014b9699220015ca" .
		// "&amount=92.00" .
		// "&currency=EUR" .
		// "&paymentBrand=VISA" .
		// "&paymentType=DB" .
		// "&card.number=4200000000000000" .
		// "&card.holder=Jane Jones" .
		// "&card.expiryMonth=05" .
		// "&card.expiryYear=2018" .
		// "&card.cvv=123" .
		// "&createRegistration=true";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $responseData;
	}
}


?>