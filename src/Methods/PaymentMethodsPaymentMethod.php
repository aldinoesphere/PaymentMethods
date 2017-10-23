<?php
 
namespace PaymentMethods\Methods;
 
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Frontend\Contracts\Checkout;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodService;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Plugin\Application;
use Plenty\Plugin\Log\Loggable;

use PaymentMethods\Services\PaymentMethodService;
 
/**
 * Class PaymentMethodsPaymentMethod
 * @package PaymentMethods\Methods
 */
class PaymentMethodsPaymentMethod extends PaymentMethodService
{

    protected $name = '';

    protected $logoFileName = '';

    /**
     * Check the configuration if the payment method is active
     * Return true if the payment method is active, else return false
     *
     */
    public function isActive()
    {
        // if ($this->isEnabled())
        // {
        //     return true;
        // }
        return true;
    }
 
    /**
     * Get the name of the payment method. The name can be entered in the config.json.
     *
     */
    public function getName()
    {
        if(!strlen($this->name))
        {
            return $this->name;
        }
 
        return $this->name;
    }
 
    /**
     * Get the path of the icon. The URL can be entered in the config.json.
     *
     * @param ConfigRepository $configRepository
     * @return string
     */
    public function getIcon()
    {
        $app = pluginApp(Application::class);
        $icon = $app->getUrlPath('paymentmethods').'/images/logos/'.$this->getLogoFileName();

        return $icon;
    }

    public function getLogoFileName() {
        return $this->logoFileName;
    }
}