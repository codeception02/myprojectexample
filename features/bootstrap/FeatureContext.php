<?php declare(strict_types=1);

namespace omnivalor\behat;

use Behat\Mink\Element\NodeElement;
use JMS\Serializer\Tests\Fixtures\Node;
use samsonframework\behatextension\GenericFeatureContext;
use Sanpi\Behatch\Context\BrowserContext;
use SystemBundle\Tests\Dump;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends GenericFeatureContext
{

    use WatchUploadingContext;
    use SearchPageContext;
    use PartnerCenterContext;

    /** int Constants for browser types */
    const BROWSER_CHROME = 1;
    const BROWSER_FIREFOX = 2;
    const BROWSER_PHANTOMJS = 3;
    const BROWSER_UNKNOWN = 1;

    /*Some constants for usage*/
    const USER_EMAIL = "testsamsonos@gmail.com";
    const USER2_EMAIL = "maryna.kulyk2015@gmail.com";
    const USER_CENTER_EMAIL = "ts-22@ukr.net";
    const USER_SIGN_UP_EMAIL = "kurlik.kurlichok@gmail.com";
    const USER_PASSWORD = "123456";
    const PARTNER_EMAIL ='mastersnooker24@inbox.ru';
    const ADMIN_EMAIL ='superadmin@omnivalor.com';
    const ADMIN_PASSWORD = "123456";
    const EMPLOYEE_EMAIL = "expenect95@gmail.com";
    const AFFILIATE_EMAIL= "expenect@ukr.net";

    public $sellerEmail;
    public $buyerEmail;
    public $code;
    public $verifyCode;
    public $randomPrice;
    protected $browserContext;
    protected $nodeElement;
    # modelId is used in admin panel
    public $modelId;
    public $randomEmail;

    public function __construct($session = null)
    {
        parent::__construct($session);
        $this->browserContext = new BrowserContext();
    }



    /**
     * @Then I log out
     */
    public function iLogOut()
    {
        $this->spin(function (FeatureContext $context) {
            $context->visitPath('/logout');
            return true;
        });
    }

    /**
     * @Then I refresh DB :name
     * @param string $name
     */
    public function refreshDB(string $name)
    {
        $refresher = new Dump($this->getSymfonyService('doctrine.orm.entity_manager'));
        $refresher->exec(__DIR__ . '/../../' . $name);
    }
}
