<?php
 
namespace PaymentMethods\Providers;

/**
* Use root class
*/ 
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Modules\Payment\Events\Checkout\ExecutePayment;
use Plenty\Modules\Payment\Events\Checkout\GetPaymentMethodContent;
use Plenty\Modules\Basket\Events\Basket\AfterBasketCreate;
use Plenty\Modules\Basket\Events\Basket\AfterBasketChanged;
use Plenty\Modules\Basket\Events\BasketItem\AfterBasketItemAdd;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodContainer;

/**
* Use Additional Class
*/
use PaymentMethods\Helper\PaymentMethodsHelper;
use PaymentMethods\Methods\PaymentMethodsPaymentMethod;
 
/**
 * Class PaymentMethodsServiceProvider
 * @package PaymentMethods\Providers
 */
class PaymentMethodsServiceProvider extends ServiceProvider
{
    public function register()
    {

    }
 
    /**
     * Boot additional services for the payment method
     *
     * @param PaymentMethodsHelper $paymentHelper
     * @param PaymentMethodContainer $payContainer
     * @param Dispatcher $eventDispatcher
     */
    public function boot( PaymentMethodsHelper $paymentHelper,
                          PaymentMethodContainer $payContainer,
                          Dispatcher $eventDispatcher)
    {
        $this->registerPaymentMethod($payContainer, 'VSA_METHOD', vsaMethod::class);
    }

    public function registerPaymentMethod($payContainer, $paymentMethods, $class) {
        $payContainer->register(
            'PaymentMethods::' . $paymentMethods, 
            $class,
                [
                    AfterBasketChanged::class,
                    AfterBasketItemAdd::class, 
                    AfterBasketCreate::class 
                ]
        );
    }
}