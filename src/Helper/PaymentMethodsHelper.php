<?php
 
namespace PaymentMethods\Helper;
 
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Modules\Payment\Method\Models\PaymentMethod;
 
/**
 * Class PaymentMethodsHelper
 *
 * @package PaymentMethods\Helper
 */
class PaymentMethodsHelper
{
    /**
     * @var PaymentMethodRepositoryContract $paymentMethodRepository
     */
    private $paymentMethodRepository;
 
    /**
     * PaymentMethodsHelper constructor.
     *
     * @param PaymentMethodRepositoryContract $paymentMethodRepository
     */
    public function __construct(PaymentMethodRepositoryContract $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }
 
    /**
     * Create the ID of the payment method if it doesn't exist yet
     */
    public function createMopIfNotExists()
    {
        // Check whether the ID of the Pay upon pickup payment method has been created
        if($this->getPaymentMethod() == 'no_paymentmethod_found')
        {
            $paymentMethodData = array( 'pluginKey' => 'plenty_paymentmethods',
                                        'paymentKey' => 'PAYMENTMETHODS',
                                        'name' => 'payment methods');
 
            $this->paymentMethodRepository->createPaymentMethod($paymentMethodData);
        }
    }
 
    /**
     * Load the ID of the payment method for the given plugin key
     * Return the ID for the payment method
     *
     * @return string|int
     */
    public function getPaymentMethod()
    {
        $paymentMethods = $this->paymentMethodRepository->allForPlugin('plenty_paymentmethods');
 
        if( !is_null($paymentMethods) )
        {
            foreach($paymentMethods as $paymentMethod)
            {
                if($paymentMethod->paymentKey == 'PAYMENTMETHODS')
                {
                    return $paymentMethod->id;
                }
            }
        }
 
        return 'no_paymentmethod_found';
    }
}