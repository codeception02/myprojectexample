<?php

namespace omnivalor\behat;

use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Exception\ExpectationException;
use Behat\Symfony2Extension\Driver\KernelDriver;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use Omnivalor\OrderBundle\Entity\Order;
use Omnivalor\ProductBundle\Entity\Brand;
use Omnivalor\ProductBundle\Entity\Model;
use Omnivalor\ProductBundle\Entity\Product;
use Omnivalor\ProductBundle\Entity\Verification;
use Omnivalor\UserBundle\Entity\Address;

/**
 * All old nonstructure funtions from old FeatureContext.php are located in OldContext
 */


trait OldContext
{




    /**
     * Restore the automatic following of redirections
     *
     * @param BeforeScenarioScope $scope
     *
     * @BeforeScenario @collect
     */
    public static function disableFollowRedirects(\Behat\Behat\Hook\Scope\BeforeScenarioScope $scope)
    {
        $context = $scope->getEnvironment()->getContext(get_class());
        $context->getSession('symfony2')->getDriver()->getClient()->followRedirects(false);
    }

    /**
     * Restore the automatic following of redirections
     *
     * @param AfterScenarioScope $scope
     *
     * @AfterScenario @collect
     */
    public static function restoreFollowRedirects(\Behat\Behat\Hook\Scope\AfterScenarioScope $scope)
    {
        $context = $scope->getEnvironment()->getContext(get_class());
        $context->getSession('symfony2')->getDriver()->getClient()->followRedirects(true);
    }

    protected static function runConsole($command, Array $options = array())
    {

        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $_application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $_application->setAutoExit(false);

        $options = array_merge($options, array('command' => $command));
        return $_application->run(new \Symfony\Component\Console\Input\ArrayInput($options));
    }



    /**
     * Use this method wherever you'd like to show some comments during scenario
     *
     * @Given Seller supposed to send watch
     * @Given Admin supposed to confirm order
     * @Given Admin supposed to reject order
     * @Given Buyer supposed to confirm shipment
     * @Given Seller supposed to see his watch in the sold list
     * @Given Admin supposed to see that delivering was confirmed by buyer
     * @Given Admin should be able to see how much total omnicredit has not been used
     * @Given Admin should be able to see how much total omnicredit has been used
     */
    public function emptyMethodForExplanationDuringScenario()
    {
        return true;
    }

    /**
     * @BeforeScenario @testAdmin
     */
    public function createTestAdmin(BeforeScenarioScope $scope)
    {
        $this->iCreateAdminWithEmailAndPassword("admin@test.com", "12345");
    }

    /**
     * @Given I create admin with email :email and password :pswd
     */
    public function iCreateAdminWithEmailAndPassword($email, $pswd)
    {
        $this->iDeleteUserWithEmailFromDb($email);

        $userManager = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('fos_user.user_manager');

        $this->iCreateUserWithEmailAndPassword($email, $pswd);
        $user = $userManager->findUserByEmail($email);

        $user->addRole('ROLE_ADMIN');
        $userManager->updateUser($user);
    }

    /**
     * @Then I delete user with email :email from DB
     */
    public function iDeleteUserWithEmailFromDb($email)
    {
//        $this->iClearTestOrders();
//        $this->iClearTestProducts();
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $user = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($email);

        if ($user) {
            $this->removeTestProductCreatedBy($email);
            $em->remove($user);
            $em->flush();
        }
    }

    /**
     * @Given remove test product created by :user
     */
    public function removeTestProductCreatedBy($user)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $em->getRepository('OmnivalorProductBundle:Product')->removeProductByOwner($user);
    }

    /**
     * @Given I create user with email :email and password :pswd
     */
    public function iCreateUserWithEmailAndPassword($email, $pswd)
    {
        $this->iDeleteUserWithEmailFromDb($email);

        $userManager = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('fos_user.user_manager');

        if(null === ($user = $userManager->findUserByEmail($email))) {
            $user = $userManager->CreateUser();
            $user->setUserName($email);
            $user->setEmail($email);
            $user->setFirstname($email);
            $user->setSurname($email);
            $user->setPhone(55555555555);
            $user->setSsn(12345);
            $user->setPlainPassword($pswd);
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    }

    /**
     * @AfterScenario @testAdmin
     */
    public function removeTestAdmin(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("admin@test.com");
    }

    /**
     * @AfterScenario @testUser
     */
    public function removeTestUser(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("user@test.com");
    }

    /**
     * @BeforeScenario @testPartner
     */
    public function createTestPartner(BeforeScenarioScope $scope)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $partnerEmail = "partner@test.com";
        $this->iCreatePartnerWithEmailAndPassword($partnerEmail, "12345");

        $address = new Address();
        $address->setCountry("Sweden");
        $address->setCity("Stockholm");
        $address->setStreet("Wallingatan 1");
        $address->setZip(11160);

        $brand = new Brand();
        $brand->setName('x_testBrand');
        $brand->setPublished(1);

        $model = new Model();
        $model->setName('x_testModel');
        $model->setBrand($brand);
        $model->setPublished(1);

        $partner = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($partnerEmail);
        $partner->addBrand($brand);
        $partner->addAddress($address);
        $address->setUser($partner);

        $em->persist($brand);
        $em->persist($model);
        $em->persist($address);
        $em->flush();


    }

    /**
     * @Given I create partner with email :email and password :pswd
     */
    public function iCreatePartnerWithEmailAndPassword($email, $pswd)
    {
        $this->iDeleteUserWithEmailFromDb($email);

        $userManager = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('fos_user.user_manager');

        $this->iCreateUserWithEmailAndPassword($email, $pswd);
        $user = $userManager->findUserByEmail($email);

        $user->addRole('ROLE_MASTER');
        $user->setAuthorize(1);
        $user->setPartner(2);
        $user->setCompanyName('testCompany');
        $userManager->updateUser($user);
    }

    /**
     * @AfterScenario @testPartner
     */
    public function removeTestPartner(AfterScenarioScope $scope)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $this->iClearTestOrders();
        $this->iClearTestProducts("x_testModel");
        $em->getRepository('OmnivalorProductBundle:History')->removeHistoryByPartner("partner@test.com");
        $verifications = $em->getRepository('OmnivalorProductBundle:Verification')->findAll();
        foreach ($verifications as $verification) {
            $verification->setPartnerVerified(null);
            $em->flush();
            $em->remove($verification);
        }
        $em->flush();
        $em->getRepository('OmnivalorProductBundle:Brand')->removeBrandByName("x_testBrand");
        $this->iDeleteUserWithEmailFromDb("partner@test.com");
    }

    /**
     * @Given I clear test orders
     */
    public function iClearTestOrders()
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $testOrders = $em->getRepository('OmnivalorOrderBundle:Order')->findAll();
        if ($testOrders) {
            foreach (array_reverse($testOrders) as $testOrder) {
                $em->remove($testOrder);
                $em->flush();
            }
        }
    }

    /**
     * @Given I clear test products :model
     */
    public function iClearTestProducts($model = "testProductModel")
    {
        $this->iClearTestOrders();
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $productRepo = $em->getRepository('OmnivalorProductBundle:Product');
        $testProducts = $productRepo->findBy(array("model" => $model));
        foreach($testProducts as $testProduct) {
            $productRepo->removeProductById($testProduct->getId());
        }
    }

    /**
     * @BeforeScenario @testProduct
     */
    public function createTestProduct(BeforeScenarioScope $scope)
    {
        $this->createTestUser($scope);
        $propertiesArray = array(
            array("name" => "name",     "value" => "value"),
            array("name" => "status",   "value" => 6),
            array("name" => "price",    "value" => 10000),
            array("name" => "articular","value" => "test"),
            array("name" => "mechanism","value" => "Automatic"),
            array("name" => "gender",   "value" => "Unisex"),
            array("name" => "face",     "value" => "Black"),
            array("name" => "year",     "value" => 2000),
            array("name" => "case_mat", "value" => "Aluminium"),
            array("name" => "case_size","value" => "20 mm"),
            array("name" => "day",      "value" => 1),
        );
        $properties = new TableNode($propertiesArray);
        $this->createProductForUserWithProperties("user@test.com", $properties);

    }

    /**
     * @BeforeScenario @testUser
     */
    public function createTestUser(BeforeScenarioScope $scope)
    {
//        $this->iDeleteUserWithEmailFromDb("user@test.com");
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $userEmail = "user@test.com";

        $this->iCreateUserWithEmailAndPassword($userEmail, "12345");

        $address = new Address();
        $address->setCountry("Sweden");
        $address->setCity("Stockholm");
        $address->setStreet("Observatoriegatan 15");
        $address->setZip(11329);

        $user = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($userEmail);
        $user->addAddress($address);
        $address->setUser($user);

        $em->persist($address);
        $em->flush();
    }

    /**
     * User mast be created before calling this method
     *
     * @Given create product for user :email with properties:
     */
    public function createProductForUserWithProperties($email, TableNode $parametersTable)
    {
        $container = $this->getSession('symfony2')->getDriver()->getClient()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $userManager = $container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsernameOrEmail($email);
        if (null === $user) {
            throw new Exception(sprintf('User with email "s" not found', $email));
        }


        $brand = $em->getRepository('OmnivalorProductBundle:Brand')->findOneByName("testProductBrand");
        $model = $em->getRepository('OmnivalorProductBundle:Model')->findOneByName("testProductModel");

        if (!$brand) {
            $brand = new Brand();
            $brand->setName('testProductBrand');
            $brand->setPublished(1);

            $model = new Model();
            $model->setName('testProductModel');
            $model->setBrand($brand);
            $model->setPublished(1);

            $em->persist($brand);
            $em->persist($model);
        }

        $product = new Product();

        $product->setUser($user);
        $product->setPublished(1);
        $product->setBox(1);
        $product->setChronograph(1);
        $product->setModelEntity($model);

        foreach ($parametersTable as $row) {
            switch ($row['name']) {
                case "status":
                    $product->setStatus($row['value']);
                    break;
                case "step":
                    $product->setStep($row['value']);
                    break;
                case "price":
                    $product->setPrice($row['value']);
                    break;
                case "articular":
                    $product->setArticular($row['value']);
                    break;
                case "mechanism":
                    $product->setMechanism($row['value']);
                    break;
                case "gender":
                    $product->setGender($row['value']);
                    break;
                case "face":
                    $product->setFace($row['value']);
                    break;
                case "year":
                    $product->setYear($row['value']);
                    break;
                case "case_mat":
                    $product->setCaseMat($row['value']);
                    break;
                case "case_size":
                    $product->setCaseSize($row['value']);
                    break;
                case "date":
                    $product->setDate($row['value']);
                    break;
                case "minPrice":
                    $product->setMinPrice($row['value']);
                    break;
                case "maxPrice":
                    $product->setMaxPrice($row['value']);
                    break;
                case 'modelEntity':
                    $model = $em->getRepository('OmnivalorProductBundle:Model')->findOneByName($row['value']);
                    $product->setModelEntity($model);
                    $em->getRepository('OmnivalorProductBundle:Brand')->removeBrandByName("testProductBrand");
                    break;
                case 'verification':
                    // by default creates empty verification
                    $verification = new Verification();
                    if ($row['value'] == true) {
                        $partner = $userManager->findUserByUsernameOrEmail("partner@test.com");
                        $verification->setPartnerVerified($partner);
                        $verification->setPartnerSerial(12345);
                        $verification->setVerifiedDate(new \DateTime());
                    } elseif ($row['value'] == 'not verified') {
                        $partner = $userManager->findUserByUsernameOrEmail("partner@test.com");
                        $verification->setPartnerVerified($partner);
                    }
                    $em->persist($verification);
                    $product->setVerification($verification);
                    break;
                case 'parent':
                    // order must be created before this product
                    if ($row['value'] == true) {
                        $order = $em->getRepository('OmnivalorOrderBundle:Order')->findOneByCustomer($user);
                        $product->setParent($order->getProduct());
                    }
                    break;
            }
        }

        $em->persist($product);
        $em->flush();

    }

    /**
     * @AfterScenario @testProduct
     */
    public function removeTestProduct(AfterScenarioScope $scope)
    {
        $this->iClearTestProducts();
        $this->iDeleteUserWithEmailFromDb("user@test.com");
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $em->getRepository('OmnivalorProductBundle:Brand')->removeBrandByName("testProductBrand");
    }

    /**
     * @AfterScenario @clearAmazon
     */
    public function clearAmazon(AfterScenarioScope $scope)
    {
        $s3m = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('knp_gaufrette.filesystem_map')->get('amazon');
        $keys = preg_grep("/^test\/\w+\/(.*)/i", $s3m->keys());
        foreach($keys as $key) {
            $s3m->delete($key);
        }
    }

    /**
     * @AfterScenario @clearTestProducts
     */
    public function clearTestProducts(AfterScenarioScope $scope)
    {
        $this->iClearTestProducts();
    }

    /**
     * @AfterScenario @clearTestOrders
     */
    public function clearTestOrders(AfterScenarioScope $scope)
    {
        $this->iClearTestOrders();
    }

    /**
     * User mast be created before calling this method
     *
     * @Given create seller code for user :email
     */
    public function createSellerCodeForUser($email)
    {
        $container = $this->getSession('symfony2')->getDriver()->getClient()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $codeManager = $container->get('omni.code_manager');

        $user = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($email);
        $partner = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail("partner@test.com");
        $code = $codeManager->createCode('seller', 'digital', $partner, $partner);
        $codeManager->setCodeUser($code, $user);
        $codeManager->activateCode($code);
        $em->flush();
    }

    /**
     * User mast be created before calling this method
     *
     * @Given create buyer code for user :email
     */
    public function createBuyerCodeForUser($email)
    {
        $container = $this->getSession('symfony2')->getDriver()->getClient()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $codeManager = $container->get('omni.code_manager');

        $user = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($email);
        $partner = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail("partner3@test.com");
        $code = $codeManager->createCode('buyer', 'digital', $partner, $user);
        $em->flush();
    }

    /**
     *
     * @Given create physical buyer code for user :email
     */
    public function createPhysicalBuyerCodeForUser($email)
    {
        $container = $this->getSession('symfony2')->getDriver()->getClient()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $codeManager = $container->get('omni.code_manager');

        $user = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail($email);
        $partner = $em->getRepository('OmnivalorUserBundle:User')->findOneByEmail("partner3@test.com");
        $code = $codeManager->createCode('buyer', 'physical', $partner, $user);
        $this->code = $code->getCode();
        $em->flush();
    }

    /**
     * User mast be created before calling this method
     * Customer supposed to be first parameter in parameters table
     *
     * @Given create order for product created by user :email with properties:
     */
    public function createOrderForProductCreatedByUserWithProperties($email, TableNode $parametersTable)
    {
        $container = $this->getSession('symfony2')->getDriver()->getClient()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $userManager = $container->get('fos_user.user_manager');

        $user = $userManager->findUserByUsernameOrEmail($email);
        if (null === $user) {
            throw new Exception(sprintf('User with email %s not found', $email));
        }

        $product = $em->getRepository('OmnivalorProductBundle:Product')->findOneByUser($user);

        if (null === $product) {
            throw new Exception(sprintf('Product for user with email %s not found', $email));
        }

        $order = new Order();
        $order->setCreatedDate(new \DateTime());
        $order->setProduct($product);

        foreach ($parametersTable as $row) {
            switch ($row['name']) {
                case "customer":
                    $customer = $userManager->findUserByUsernameOrEmail($row['value']);

                    $order->setCustomer($customer);
                    $order->setDelivery($customer->getAddresses()[0]);
                    break;
                case "status":
                    $order->setStatus($row['value']);
                    break;
                case "decision":
                    $order->setDecision($row['value']);
                    break;
                case "omniCustomer":
                    $order->setOmniCustomer($row['value']);
                    break;
                case "omniCustomerInsurance":
                    $order->setOmniCustomerInsurance($row['value']);
                    break;
                case "buyer_code":
                    if ($row['value'] == true) {
                        $codeManager = $container->get('omni.code_manager');

                        $partner =  $userManager->findUserByUsernameOrEmail("partner@test.com");
                        $code = $codeManager->createCode('buyer', 'digital', $partner, $user);
                        $codeManager->setCodeUser($code, $order->getCustomer());
                        $codeManager->activateCode($code);
                        $em->flush();

                        $order->setBuyerCode($code);
                    }
                    break;
            }
        }

        $em->persist($order);
        $em->flush();

    }

    /**
     * @Given /^there are users:$/
     */
    public function thereAreUsers(TableNode $table)
    {
        $userManager = $this->getSession("symfony2")->getDriver()->getClient()->getContainer()->get('fos_user.user_manager');
        foreach ($table->getHash() as $hash) {
            $user = $userManager->createUser();
            $user->setUsername($hash['username']);
            $user->setPlainPassword($hash['password']);
            $user->setEmail($hash['email']);
            $user->setEnabled(true);
            $userManager->updateUser($user);
        }
    }

    /**
     * @BeforeStep @mink:phantomjs
     */
    public function beforeStep($event)
    {
        $text = $event->getStep()->getText();
        if (preg_match('/(follow|press|click|submit|attach)/i', $text)) {
            $this->ajaxClickHandler_before();
        }
    }

    /**
     * Hook into jQuery ajaxStart and ajaxComplete events.
     * Prepare __ajaxStatus() functions and attach them to these events.
     * Event handlers are removed after one run.
     */
    public function ajaxClickHandler_before()
    {
        $javascript = <<<JS
window.jQuery(document).one('ajaxStart.ss.test', function(){
    window.__ajaxStatus = function() {
        return 'waiting';
    };
});
window.jQuery(document).one('ajaxComplete.ss.test', function(){
    window.__ajaxStatus = function() {
        return 'no ajax';
    };
});
JS;
        $this->getSession()->executeScript($javascript);
    }

    /**
     * @AfterStep @mink:phantomjs
     */
    public function afterStep($event)
    {
        $text = $event->getStep()->getText();
        if (preg_match('/(follow|press|click|submit)/i', $text)) {
            $this->ajaxClickHandler_after();
        }
    }

    /**
     * Wait for the __ajaxStatus()to return anything but 'waiting'.
     * Don't wait longer than 5 seconds.
     */
    public function ajaxClickHandler_after()
    {
        $this->getSession()->wait(5000,
            "(typeof window.__ajaxStatus !== 'undefined' ?
                window.__ajaxStatus() : 'no ajax') !== 'waiting'"
        );
    }

    /**
     * @When I press form with class :formClass submit button
     */
    public function pressFormWithClassSubmitButton($formName)
    {
        $forms = $this->getSession()->getPage()->findAll('css', "form.".$formName);
        $wrightForm = $this->getSession()->getPage()->find('css', "form.".$formName);

        foreach($forms as $form) {
            if(!$form->getParent()->hasClass("bx-clone")) {
                $wrightForm = $form;
            }
        }

        $button = $wrightForm->find('css', "button[type=submit]");
        if (null === $wrightForm) {
            throw new Exception(sprintf('Submit button for saving "%s" picture not found', $formName));
        }

        $button->doubleClick();
    }

    /**
     * @When I press form with id :formID submit button
     */
    public function pressFormWithIDSubmitButton($formName)
    {
        $wrightForm = $this->getSession()->getPage()->find('css', "form#".$formName);

        $button = $wrightForm->find('css', "button[type=submit]");
        if (null === $wrightForm) {
            throw new Exception(sprintf('Submit button for saving "%s" picture not found', $formName));
        }

        $button->doubleClick();
    }

    /**
     * @When I should see uploaded :side picture
     */
    public function shouldSeeUploadedPicture($side)
    {
        $img = $this->getSession()->getPage()->find('css', "img.".$side);
        if (null === $img) {
            throw new Exception(sprintf('"%s" picture not found', $side));
        }
        if ($img->getAttribute("src") == null) {
            throw new Exception(sprintf('"%s" picture has empty image path', $side));
        }
    }

    /**
     * @When I close upload popup
     */
    public function closeUploadPopup()
    {
        $element = $this->getSession()->getPage()->find('css', "div.image-container-popup .popup-close");
        if (null === $element) {
            throw new Exception(sprintf('Popup-close button not found'));

        }
        $element->doubleClick();
    }

    /**
     * Without this, PhantomJs will fail if responsive design is in use.
     * @BeforeScenario @mink:phantomjs
     */
    public function resizeWindow()
    {
        $this->getSession()->resizeWindow(1440, 900, 'current');
    }

    /**
     * @Given /^I log out$/
     */
    public function iLogOut() {
        $this->getSession()->reset();
    }

    /**
     * @Given /^I press logout$/
     */
    public function iPressLogOut() {
        $this->visitPath("/logout");
    }


    /**
     * @Then Element :arg1 should be visible
     */
    public function elementShouldBeVisible($selector)
    {
        $element = $this->getSession()->getPage()->find('css', $selector);
        if (!$element) {
            throw new Exception(sprintf('Element with selector: "%s" is not found', $selector));
        }
        if (!$element->isVisible()){
            throw new Exception(sprintf('Element with selector: "%s" is not visible', $selector));
        }
    }

    /**
     * @Given /^I wait (\d+) second[s]? for response$/
     */
    public function iWaitForAjaxResponse($sec)
    {
        $this->getSession()->wait($sec*1000);
    }

    /**
     * @Given I am logged in as :arg1 with :arg2
     * @Given I log in as :arg1 with :arg2
     */
    public function iAmLoggedInAsWith($arg1, $arg2)
    {
        $this->iClickOnTheElement('.dropdown.menu li:nth-child(1) a');
        $this->iWaitMillisecondsForResponse(500);

//        $this->fillField('_username', $arg1);
//        $this->fillField('_password', $arg2);

        $this->getSession()->executeScript("$('#username').val('".$arg1."');");
        $this->getSession()->executeScript("$('#password').val('".$arg2."');");

        $this->iClickOnTheElement('#login-submit');
        $this->iWaitMillisecondsForResponse(2000);
    }



    /**
     * Find element by CSS selector
     *
     * @param string $selector CSS Selector
     *
     * @return \Behat\Mink\Element\NodeElement|mixed|null
     */
    protected function findElementByCssSelector($selector)
    {
        $element = $this->getSession()->getPage()->find('css', $selector);

        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $selector));
        }

        return $element;
    }



    /**
     * Get current session driver browser name.
     * @return null|string Current session driver browser name
     */
    protected function getBrowserName()
    {
        $session = $this->getSession();
        $driver = $session->getDriver();
        $userAgent = $driver->evaluateScript('return navigator.userAgent');
        $provider = $driver->evaluateScript('return navigator.vendor');

        if (preg_match('/google/i', $provider)) {
            return self::BROWSER_CHROME;
        } elseif (preg_match('/firefox/i', $userAgent)) {
            return self::BROWSER_FIREFOX;
        } elseif (preg_match('/phantomjs/i', $userAgent)) {
            return self::BROWSER_PHANTOMJS;
        } else {
            return self::BROWSER_UNKNOWN;
        }
    }

    /**
     * @When I click login button
     */
    public function iClickLoginButton()
    {
        // Click on the founded element
        $this->iClickOnTheElement('header .login-button');
    }

    /**
     * @Given I am logged in as testUser
     * @Given I log in as testUser
     */
    public function iAmLoggedInAsTestUser()
    {
        $this->iAmLoggedInAsWithForSymfony2("user@test.com", "12345");
    }

    /**
     * @Given I am logged in as :arg1 with :arg2 for symfony2
     */
    public function iAmLoggedInAsWithForSymfony2($arg1, $arg2)
    {
        $this->visit('/');

        $this->iOpenSignInPopup();
        $this->fillField('_username', $arg1);
        $this->fillField('_password', $arg2);
        $this->pressButton('login-submit');
    }

    /**
     * @When I open sign in popup
     */
    public function iOpenSignInPopup()
    {
        $this->iClickOnTheElement('a.sign-in-btn');
    }

    /**
     * @When I open recovery popup
     */
    public function iOpenRecoveryPopup()
    {
        $this->iOpenSignInPopup();
        $this->iClickOnTheElement('a.recovery_password');
    }

    /**
     * @When I follow recovery password link
     */
    public function iFollowRecoveryPasswordLink()
    {
        $this->iClickOnTheElement("a.recovery_password");
    }

    /**
     * @When I click product details link
     */

    public function iClickProductDetailsLink()
    {

        $this->iClickOnTheElement(".product-card a");
    }

    /**
     * @When I open product details
     */

    public function iOpenProductDetails()
    {
        $this->iClickOnTheElement('.product-card a');
    }

    /**
     * @When I open recommendation popup
     */
    public function iOpenRecommendationPopup()
    {
        $this->iClickOnTheElement('a.tipsa');
    }

    /**
     * @Then /^(\w+) should be on product page$/
     */
    public function iShouldBeOnProductPage($user)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', "a.buy");
        if (!$element) {
            throw new Exception(sprintf($user." haven't got to the product page"));
        }
    }

    /**
     * @Then Add to favourite link should be visible
     */
    public function addToFavouriteLinkShouldBeVisible()
    {
        $this->shouldBeVisible("a.favorite");
    }

    /**
     * @Then /^"([^"]*)" should be visible$/
     */
    public function shouldBeVisible($selector)
    {
        $element = $this->findElementByCssSelector($selector);

        $style = preg_replace('/\s/', '', $element->getAttribute('style'));

        if (false !== strpos($style, 'display:none')) {
            throw new \Exception("Element is hidden");
        }
    }

    /**
     * @Then Add to favourite link should be clickable
     */
    public function addToFavouriteLinkShouldBeClickable()
    {
        $element = $this->getSession()->getPage()->find('css', "a.favorite");
        if (!$element->hasAttribute("href")){
            throw new Exception(sprintf('Add to favourite link is not clickable', "a.favorite"));
        }
    }

    /**
     * @Then Add to favourite link should not be clickable
     */
    public function addToFavouriteLinkShouldNotBeClickable()
    {
        $element = $this->getSession()->getPage()->find('css', "a.favorite");
        if ($element->hasAttribute("href")){
            throw new Exception(sprintf('Add to favourite link is clickable'));
        }
    }

    /**
     * @Then Delete from favourite link should be visible
     */
    public function deleteFromFavouriteLinkShouldBeVisible()
    {
        $this->shouldBeVisible(".product-card .close-block > a");
    }

    /**
     * @When I click on delete from favourite link
     */
    public function iClickOnDeleteFromFavouriteLink()
    {
        $this->iClickOnTheElement(".product-card .close-block > a");
    }

    /**
     * @When I click add to favourite button
     */
    public function iClickAddToFavouriteButton()
    {
        $this->iClickOnTheElement("a.favorite");
    }

    /**
     * @When I click register button
     */
    public function iClickRegisterButton()
    {
        $session = $this->getSession();
        $element = $session->getPage()->find('css', "a.registration");
        $element->click();
//        $this->iClickOnTheElement("a.registration");
    }

    /**
     * @When I send this form
     */
    public function iSendFormButton()
    {
        //$session = $this->getSession();
        //$element = $session->getPage()->find('css', ".submit");
        //$element->click();
        $this->iClickOnTheElement(".submit");
    }

    /**
     * @Then Login button should be visible
     */
    public function loginButtonShouldBeVisible()
    {
        $this->shouldBeVisible("a.sign-in-btn");
    }

    /**
     * @Then Register button should be visible
     */
    public function registerButtonShouldBeVisible()
    {
        $this->shouldBeVisible("a.registration");
    }

    /**
     * @Then Login popup should be visible
     */
    public function loginPopupShouldBeVisible()
    {
        $this->shouldBeVisible("#sign-in-popup");
    }

    /**
     * @Then Recovery popup should be visible
     */
    public function recoveryPopupShouldBeVisible()
    {
        $this->shouldBeVisible("#recovery-popup");
    }

    /**
     * @Then Register popup should be visible
     */
    public function registerPopupShouldBeVisible()
    {
        $this->shouldBeVisible("#register-popup");
    }

    /**
     * @Then Product should be visible
     */
    public function productShouldBeVisible()
    {
        $this->shouldBeVisible(".product-card");
    }

    /**
     * @Then Product should not be visible
     */
    public function productShouldNotBeVisible()
    {
        $element = $this->getSession()->getPage()->find('css', ".product-card");
        if($element) {
            throw new Exception("There are some products in favourite section");
        }
    }

    /**
     * @When I fill in the Name field with :arg1
     */
    public function iFillInNameWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_firstName", $info);
    }


    /**
     * @Then  the :field should have value :value
     */
    public function theShouldHaveValue($field, $value)
    {

        switch ($field) {
            case "FirstName":
                $selector = '#user_firstName';
                break;
            case "Email":
                $selector = '#user_email';
                break;
            case "SecondName":
                $selector = '#user_surname';
                break;
            case "Phone":
                $selector = '#user_phone';
                break;
            case "SSN":
                $selector = '#user_ssn';
                break;
            case "Zip":
                $selector = '#omnivalor_userbundle_profile_address_zip';
                break;
            case "Country":
                $selector = '#omnivalor_userbundle_profile_address_country';
                break;
            case "Street":
                $selector = '#omnivalor_userbundle_profile_address_street';
                break;
            case "City":
                $selector = '#omnivalor_userbundle_profile_address_city';
                break;
            default:
                $selector = '';
        }

        $element = $this->getSession()->getPage()->find('css', $selector);
        if(null === $element) {
            throw new Exception(sprintf('Element with selector: "%s" is not visible', $field));
        }
        if ($element->getAttribute('value') != $value) {
            throw new Exception("Element found, but value doesn't match");
        }
    }

    /**
     * @When I fill in the Surname field with :arg1
     */
    public function iFillInSurnameWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_surname", $info);
    }

    /**
     * @When I fill in the Email field with :arg1
     */
    public function iFillInEmailWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_email", $info);
    }

    /**
     * @When I fill in the Password field with :arg1
     */
    public function iFillInPasswordWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_plainPassword_first", $info);
    }

    /**
     * @When I fill in the Confirm Password field with :arg1
     */
    public function iFillInConfirmPasswordWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_plainPassword_second", $info);
    }

    /**
     * @When I fill in the Phone Number field with :arg1
     */
    public function iFillInPhoneNumberWith($info)
    {
        $this->iFillInTheElement("fos_user_registration_form_phone", $info);
    }

    /**
     * @Given  I should get an email on :arg1 with: :arg2
     */
    public function iShouldGetAnEmail($email, PyStringNode $text)
    {
        $error     = sprintf('No message sent to "%s"', $email);
        $profile   = $this->getSymfonyProfile();
        $collector = $profile->getCollector('swiftmailer');
        foreach ($collector->getMessages() as $message) {
            // Checking the recipient email and the X-Swift-To
            // header to handle the RedirectingPlugin.
            // If the recipient is not the expected one, check
            // the next mail.
            $this->sellerEmail = $message->getBody();
            $correctRecipient = array_key_exists(
                $email, $message->getTo()
            );
            $headers = $message->getHeaders();
            $correctXToHeader = false;
            if ($headers->has('X-Swift-To')) {
                $correctXToHeader = array_key_exists($email,
                    $headers->get('X-Swift-To')->getFieldBodyModel()
                );
            }

            if (!$correctRecipient && !$correctXToHeader) {
                continue;
            }

            if (strpos($message->getBody(), $text->getRaw()) !== false) {

                return true;
            } else {
                $error = sprintf(
                    'An email has been found for "%s" but without '.
                    'the text "%s".', $email, $text->getRaw()
                );
            }
        }

        throw new ExpectationException($error, $this->getSession());
    }

    public function getSymfonyProfile()
    {
        $driver = $this->getSession('symfony2')->getDriver();

        if (!$driver instanceof KernelDriver) {
            throw new \Behat\Mink\Exception\UnsupportedDriverActionException(
                'You need to tag the scenario with '.
                '"@mink:symfony2". Using the profiler is not '.
                'supported by %s', $driver
            );
        }

        $driver->getClient()->followRedirects(true);

        $profile = $driver->getClient()->getProfile();

        if (false === $profile) {
            throw new \RuntimeException(
                'The profiler is disabled. Activate it by setting '.
                'framework.profiler.only_exceptions to false in '.
                'your config'
            );
        }

        return $profile;
    }

    /**
     * @Then /^\w+ follow ([a-z]+) link from email$/
     */
    public function iFollowTheLinkFromEmail($type)
    {
        $profile   = $this->getSymfonyProfile();

        $collector = $profile->getCollector('swiftmailer');
        if(isset($collector->getMessages()[0])) {
            $message = $collector->getMessages()[0]->getBody();
        } else {
            throw new \Exception('Email not found');
        }

        if ($type == "confirmation") {
            preg_match("|Please, confirm registration\s:\s+(.*)\s?<br>|", $message, $link);
        } elseif ($type == "resetting") {
            preg_match("|You can reset your password by accessing\s(.*)\s?<br>|", $message, $link);
        } elseif ($type == "recommendation") {
            preg_match("|recommended this watch\s(.*)\s*<br>|", $message, $link);
        } elseif ($type == "redeem") {
            preg_match("|send Code\s(.*)\s*<br>|", $message, $link);
            $this->getSession()->reload();
        }

        if (isset($link[1])) {
            $url = trim($link[1]);
        } else {
            throw new \Exception($type.' link not found');
        }

        $client = $this->getSession()->getDriver()->getClient();
        $client->request('GET', $url);
    }

    /**
     * Follow client redirection once
     *
     * @Then /^(?:|I )follow the redirection$/
     */
    public function followRedirect()
    {
        $this->getSession()->getDriver()->getClient()->followRedirect();
    }

    /**
     * @When I POST to :url a form :form_name with:
     */
    public function iPostToAFormWith($url, $form_name, TableNode $parametersTable)
    {
        $driver = $this->getSession()->getDriver();
        if (!$driver instanceof KernelDriver) {
            throw new \Exception('This step is only supported by the BrowserKitDriver');
        }
        $params = array();
        $files = array();
        $client = $driver->getClient();
        foreach ($parametersTable as $row) {
            switch ($row['type']) {
                case "string":
                    $text = $row['value'];
                    $params[$form_name][$row['name']] = $text;
                    break;
                case "array":
                    $explodedArrray = explode(':', $row['value']);
                    $text = $explodedArrray[1];
                    $params[$form_name][$row['name']][$explodedArrray[0]] = $text;
                    break;
                case "boolean":
                    $params[$form_name][$row['name']] = $row['value'];
                    break;
                case "file":
                    $fileUpload = new UploadedFile($row['value'], 'the_file_name');
                    $files[$form_name][$row['name']] = $fileUpload;
                    break;
                case "csrf":
                    $token = $client->getContainer()->get('form.csrf_provider')->generateCsrfToken($form_name);
                    $params[$form_name][$row['name']] = $token;
                    break;
            }
        }
        $headers = array('HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest');
        $client->request('POST', $url, $params, $files, $headers);
    }

    /**
     * @BeforeScenario @testUser2
     */
    public function createTestUser2(BeforeScenarioScope $scope)
    {
        $this->iCreateUserWithEmailAndPassword("user2@test.com", "12345");
    }

    /**
     * @AfterScenario @testUser2
     */
    public function removeTestUser2(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("user2@test.com");
    }


    // Create Product

    /**
     * @AfterScenario @clearUser3
     */
    public function removeTestUser3(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("user3@test.com");
    }

    /**
     * @AfterScenario @clearAdmin3
     */
    public function removeTestAdmin3(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("admin3@test.com");
    }

    /**
     * @AfterScenario @clearPartner3
     */
    public function removeTestPartner3(AfterScenarioScope $scope)
    {
        $this->iDeleteUserWithEmailFromDb("partner3@test.com");
    }

    /**
     * @When I click create product button
     */
    public function iClickCreateProductButton()
    {
        $this->iClickOnTheElement("a.anons");
    }

    /**
     * @Then I select last option from :select
     */
    public function iSelectFromCustomField($select)
    {
        $session = $this->getSession();

        $selectListButton = $session->getPage()->find('css', "div#$select > input.select-button");
        if (null === $selectListButton) {
            throw new Exception("Custom field ".$select." not found");
        }
        $selectListButton->click();

        $option = $session->getPage()->find('css', "div#$select li:last-of-type");
        //var_dump($option);
        if (null === $option) {
            throw new Exception("Options not found");
        }
        $option->click();
    }

    /**
     * @Then I select :value from dropdown :select
     */
    public function iSelectValueFromDropdown($value, $select)
    {
        $session = $this->getSession();

        $selectListButton = $session->getPage()->find('css', "div#$select > input.select-button");
        if (null === $selectListButton) {
            throw new Exception("Custom field ".$select." not found");
        }
        $selectListButton->click();

        $option = $session->getPage()->find('css', "div#$select li[data-value=$value]");
        if (null === $option) {
            throw new Exception("Options not found");
        }
        if (null === $option) {
            throw new Exception("First option not found");
        }
        $option->click();
    }

    /**
     * @When I fill in the Firstname field with :arg1
     */
    public function iFillInFirstname($info)
    {
        $this->iFillInTheElement("user[firstName]", $info);
    }

    /**
     * @When I fill in the SecondName field with :arg1
     */
    public function iFillInTheSecondnameFieldWith($info)
    {
        $this->iFillInTheElement("user[surname]", $info);
    }

    /**
     * @When I fill in the SSN field with :arg1
     */
    public function iFillInTheSsnFieldWith($info)
    {
        $this->iFillInTheElement("user[ssn]", $info);
    }

    /**
     * @When I fill in the Phone field with :arg1
     */
    public function iFillInThePhoneFieldWith($info)
    {
        $this->iFillInTheElement("user[phone]", $info);
    }

    /**
     * @When I fill in the Country field with :arg1
     */
    public function iFillInTheCountryFieldWith($info = null)
    {
        $this->iFillInTheElement("omnivalor_userbundle_profile_address[country]", $info);
    }

    /**
     * @When I fill in the City field with :arg1
     */
    public function iFillInTheCityFieldWith($info)
    {
        $this->iFillInTheElement("omnivalor_userbundle_profile_address[city]", $info);
    }

    /**
     * @When I fill in the Zip field with :arg1
     */
    public function iFillInTheZipFieldWith($info)
    {
        $this->iFillInTheElement("omnivalor_userbundle_profile_address[zip]", $info);
    }

    /**
     * @When I fill in the Street field with :arg1
     */
    public function iFillInTheStreetFieldWith($info)
    {
        $this->iFillInTheElement("omnivalor_userbundle_profile_address[street]", $info);
    }

    /**
     * @When I fill in the User Email field with :arg1
     */
    public function iFillInTheUserEmailFieldWith($info)
    {
        $this->iFillInTheElement("user[email]", $info);
    }

    /**
     * @When I fill in recovery email field with :value
     */
    public function iFillInRecoveryEmailFieldWith($value)
    {
        $element = $this->getSession()->getPage()->find("css", "form[name=fos_user_resetting_request] input[name=username]");
        if (null === $element) {
            throw new Exception("Recovery email field not found");
        }
        $element->setValue($value);
    }

//    /**
//     * Attaches file to field with specified id|name|label|value from Windows
//     *
//     * @When /^(?:|I )attach the file "(?P<path>[^"]*)" to "(?P<field>(?:[^"]|\\")*)" from Windows$/
//     */
//    public function attachFileToField($field, $path)
//    {
//        $field = $this->fixStepArgument($field);
//
//        if ($this->getMinkParameter('files_path')) {
//            $fullPath = $this->getMinkParameter('files_path').$path;
//        } else {
//            throw new Exception('Setup \'files_path\' in behat.yml');
//        }
//
//        $this->getSession()->getPage()->attachFileToField($field, $fullPath);
//    }

    /**
     * @Then go to next step button should be clickable
     */
    public function goToNextStepButtonShouldBeClickable()
    {
        $element = $this->getSession()->getPage()->find('css', "#official_next");
        if ($element->hasClass("not-active")){
            throw new Exception('Go to next step button is not clickable');
        }
    }

    /**
     * @Then go to next step button should not be clickable
     */
    public function goToNextStepButtonShouldNotBeClickable()
    {
        $element = $this->getSession()->getPage()->find('css', "#official_next");
        if (!$element->hasClass("not-active")){
            throw new Exception('Go to next step button is clickable');
        }
    }

    /**
     * @When I fill in search field with :value
     */
    public function iFillInSearchFieldWith($value)
    {
        $element = $this->getSession()->getPage()->find("css", "input[name=search]");
        if (null === $element) {
            throw new Exception("Search field not found");
        }
        $element->setValue($value);
    }

    /**
     * @Given create :n models for brand :brandName
     */
    public function createModelsForBrand($n, $brandName)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $brand = new Brand();
        $brand->setName($brandName);
        $brand->setPublished(1);
        $em->persist($brand);
        for($i = 1; $n >= $i; $i++){
            $model = new Model();
            $model->setName($brandName.'_Test_Model'.$i);
            $model->setBrand($brand);
            $model->setPublished(1);
            $em->persist($model);
        }
        $em->flush();
    }

    /**
     * @When I remove brand :brandName
     */
    public function iRemoveBrand($brandName)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $em->getRepository('OmnivalorProductBundle:Brand')->removeBrandByName($brandName);
    }

    /**
     * User mast be created before calling this method
     *
     * @Given create product for user :email with :model
     */
    public function createProductForUserWithModel($email, $model)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $userManager = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('fos_user.user_manager');
        $user = $userManager->findUserByUsernameOrEmail($email);
        if (null === $user) {
            throw new Exception(sprintf('User with email "s" not found', $email));
        }

        $product = new Product();

        $product->setUser($user);
        $product->setPublished(1);
        $product->setModelEntity($em->getRepository('OmnivalorProductBundle:Model')->findOneByName($model));
        $product->setBox(1);
        $product->setChronograph(1);
        $product->setStatus(6);
        $product->setPrice(1000);
        $em->persist($product);
        $em->flush();

    }

    /**
     * User mast be created before calling this method
     *
     * @Given create :n buyer codes for user :email
     */
    public function createBuyerCodesForUser($email, $model)
    {
        $em = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('doctrine.orm.entity_manager');
        $userManager = $this->getSession('symfony2')->getDriver()->getClient()->getContainer()->get('omni');
        $user = $userManager->findUserByUsernameOrEmail($email);
        if (null === $user) {
            throw new Exception(sprintf('User with email "s" not found', $email));
        }

        $product = new Product();

        $product->setUser($user);
        $product->setPublished(1);
        $product->setModelEntity($em->getRepository('OmnivalorProductBundle:Model')->findOneByName($model));
        $product->setBox(1);
        $product->setChronograph(1);
        $product->setStatus(6);
        $product->setPrice(1000);
        $em->persist($product);
        $em->flush();

    }

//    /**
//     * @Then I should not see search result
//     */
//    public function iShouldNotSeeSearchResult()
//    {
//        $element = $this->assertSession()->elementExists('css', '.search-ul');
//
//        if (trim($element->getHtml()) == null){
//            return true;
//        } else {
//            throw new Exception(sprintf('The element is not empty'));
//        }
//    }

//    /**
//     * @Then I should see search result
//     */
//    public function iShouldSeeSearchResult()
//    {
//        $element = $this->assertSession()->elementExists('css', '.search-ul');
//
//        if (trim($element->getHtml()) != null){
//            return true;
//        } else {
//            // throw new Exception(sprintf('The element is  empty'));
//        }

//    }

    /**
     * @When I check platinum filter case
     */
    public function iCheckPlatinumFilterCase()
    {
        $this->iCheckCustomCheckboxWith('BOETTMATERIALPlatinum');
    }



    /**
     * @When I check gold filter case
     */
    public function iCheckGoldFilterCase()
    {
        $this->iCheckCustomCheckboxWith('BOETTMATERIALGold');
    }

    /**
     * @When I press case filter select
     */
    public function iPressCaseFilterSelect()
    {
        $this->pressButton('BOETTMATERIAL');
    }

    /**
     * @When I check date filter checkbox
     */
    public function iCheckDateFilterCheckbox()
    {
        $this->iCheckCustomCheckboxWith('pr_date');
    }

    /**
     * @Then I should see platinum filter works
     */
    public function iShouldSeePlatinumFilterWorks()
    {
        $this->assertElementContains('.product_info', 'Platinum');
    }

    /**
     * @Then I should see gold filter works
     */
    public function iShouldSeeGoldFilterWorks()
    {
        $this->assertElementContains('.product_info', 'Gold');
    }

    /**
     * @When I open filter menu
     */
    public function iOpenFilterMenu()
    {
        $this->pressButton('full_show');
    }

    /**
     * @When I fill min price filter field with :arg1
     */
    public function iFillMinPriceFilterFieldWith($arg1)
    {
        $this->fillField('minPrice', $arg1);
    }

    /**
     * @Then I should see product with price more than :arg1
     */
    public function iShouldSeeProductWithPriceMoreThan($arg1)
    {
        $info = $this->getSession()->getPage()->find('css', ".product-price")->getText();
        $info = explode(' ', trim($info));
        if ($info[0] < $arg1) {
            throw new Exception(sprintf('Price of current product is less than %s', $arg1));
        }
    }

    /**
     * @When I press gender filter select
     */
    public function iPressGenderFilterSelect()
    {
        $this->pressButton('KÖN');
    }

    /**
     * @When I check unisex filter case
     */
    public function iCheckUnisexFilterCase()
    {
        $this->iCheckCustomCheckboxWith('KÖNUnisex');
    }

    /**
     * @Then I should see gender filter works
     */
    public function iShouldSeeGenderFilterWorks()
    {
        $this->assertElementContains('.header_footer', 'Unisex');
    }

    /**
     * @When I press case size filter select
     */
    public function iPressCaseSizeFilterSelect()
    {
        $this->pressButton('STORLEK');
    }

    /**
     * @When I check :arg1 filter size case
     */
    public function iCheckFilterSizeCase($arg1)
    {
        $this->iCheckCustomCheckboxWith('STORLEK'.$arg1);
    }

    /**
     * @Then I should see product with case size :arg1
     */
    public function iShouldSeeProductWithCaseSize($arg1)
    {
        $this->assertElementContains('.product_info', $arg1);
    }

    /**
     * @When I press mechanism filter select
     */
    public function iPressMechanismFilterSelect()
    {
        $this->pressButton('UPPVRIDNING');
    }

    /**
     * @When I check :arg1 in mechanism filter select
     */
    public function iCheckInMechanismFilterSelect($arg1)
    {
        $this->iCheckCustomCheckboxWith('UPPVRIDNING'.$arg1);
    }

    /**
     * @Then I should see product with :arg1 mechanism
     */
    public function iShouldSeeProductWithMechanism($arg1)
    {
        $this->assertElementContains('.header_footer', $arg1);
    }

    /**
     * @When I press face filter select
     */
    public function iPressFaceFilterSelect()
    {
        $this->pressButton('TAVLA');
    }

    /**
     * @When I check :arg1 in face filter select
     */
    public function iCheckInFaceFilterSelect($arg1)
    {
        $this->iCheckCustomCheckboxWith('TAVLA'.$arg1);
    }

    /**
     * @Then I should see product with :arg1 face
     */
    public function iShouldSeeProductWithFace($arg1)
    {
        $this->assertElementContains('.header_footer', $arg1);
    }

    /**
     * @Then I press send email button
     */
    public function iPressSendEmailButton()
    {
        $element = $this->getSession()->getPage()->find("css", "a#send_email");
        if (null === $element) {
            throw new Exception("Send email button not found");
        }
        $element->click();
    }

    /**
     * Click on the element with the provided xpath query
     *
     * @When I press on send seller code button
     */
    public function iPressOnSendSellerCodeButton()
    {
        $element = $this->getSession()->getPage()->find('css', ".submit .omni-blue-button");
        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', 'code button'));
        }
        // Click on the founded element
        $element->click();
    }

    /**
     *
     * @When I press on create request physical code button
     */
    public function iPressOnCreateRequestPhysicalCodeButton()
    {
        $element = $this->getSession()->getPage()->find('css', "#digital-code-btn");
        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', 'code button'));
        }
        // Click on the founded element
        $element->click();
    }

    /**
     *
     * @When I press button Agree
     */
    public function iPressButtonAgree()
    {
        $element = $this->getSession()->getPage()->find('css', ".btn-success:first-child");
        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', 'code button'));
        }
        // Click on the founded element
        $element->click();
    }

    /**
     *
     * @When I press SEND ALL button
     */
    public function iPressSendAllButton()
    {
        $element = $this->getSession()->getPage()->find('css', ".partner-button");
        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', 'code button'));
        }
        // Click on the founded element
        $element->click();
    }

    /**
     *
     * @When I press SEND button
     */
    public function iPressSendButton()
    {
        $element = $this->getSession()->getPage()->find('css', ".partner-button");
        // If element with current selector is not found then print error
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', 'code button'));
        }
        // Click on the founded element
        $element->click();
    }

    /**
     * @Then product must be verified
     */
    public function productMustBeVerified()
    {
        $element = $this->getSession()->getPage()->find("css", ".verification .status-row:last-child .status-indicator");
        if (null === $element) {
            throw new Exception("Verification indicator not found");
        }
        if (!$element->hasClass("completed")) {
            throw new Exception("Product is not verified");
        }
    }

    /**
     * @Then product must not be verified
     */
    public function productMustNotBeVerified()
    {
        $element = $this->getSession()->getPage()->find("css", ".verification .status-row:last-child .status-indicator");
        if (null === $element) {
            throw new Exception("Verification indicator not found");
        }
        if ($element->hasClass("completed")) {
            throw new Exception("Product is verified");
        }
    }

    /**
     * @Then I press submit button
     */
    public function iPressSubmitButton()
    {
        $element = $this->getSession()->getPage()->find("css", "input[type=submit]");
        $element = (null === $element) ? $this->getSession()->getPage()->find("css", "button[type=submit]") : $element;
        if (null === $element) {
            throw new Exception("Submit button not found");
        }
        $element->click();
    }

    /**
     * @Then product must be priced by Omnivalor
     */
    public function productMustBePricedByOmnivalor()
    {
        $element = $this->getSession()->getPage()->find("css", ".price .status-row .status-indicator");
        if (null === $element) {
            throw new Exception("Pricing indicator not found");
        }
        if (!$element->hasClass("completed")) {
            throw new Exception("Product price range is not set");
        }
    }

    /**
     * @Then product must not be priced
     */
    public function productMustNotBePriced()
    {
        $element = $this->getSession()->getPage()->find("css", ".price .status-row .status-indicator");
        if (null === $element) {
            throw new Exception("Pricing indicator not found");
        }
        if ($element->hasClass("completed")) {
            throw new Exception("Product price range is set");
        }
    }

    /**
     * @Then /^commission rate must be equal (\d+)$/
     */
    public function commissionRateMustBeEqual($com)
    {
        $element = $this->getSession()->getPage()->findById("comRate");
        if (null === $element) {
            throw new Exception("Commission rate not found");
        }
        if ($element->getText() != $com) {
            throw new Exception(sprintf('Commission rate equals: %s', $element->getText()));
        }
    }

    /**
     * @Then I select max price from range
     */
    public function iSelectMaxPriceFromRange()
    {
        $this->iClickOnTheElement(".irs-line-right");
    }

    /**
     * @Then pay and create product button must be active
     */
    public function payAndCreateProductMustBeActive()
    {
        $element = $this->getSession()->getPage()->find("css", ".buttons-block a:last-child");
        if (null === $element) {
            throw new Exception(" pay and create product button not found");
        }
        if ($element->hasClass("not-active")) {
            throw new Exception(" pay and create product button not active");
        }
    }

    /**
     * @Then User open seller code email and follow the link
     */
    public function userOpenSellerCodeEmailAndFollowTheLink()
    {

        preg_match("|send Code\s(.*)\s*<br>|", $this->sellerEmail, $link);
        $this->getSession()->reload();

        if (isset($link[1])) {
            $url = trim($link[1]);
        } else {
            throw new \Exception('Redeem link not found');
        }

        $client = $this->getSession()->getDriver()->getClient();
        $client->request('GET', $url);
    }

    /**
     * @Then User open buyer code email and follow the link
     */
    public function userOpenBuyerCodeEmailAndFollowTheLink()
    {

        preg_match("|send Code\s(.*)\s*<br>|", $this->sellerEmail, $link);
        $this->getSession()->reload();

        if (isset($link[1])) {
            $url = trim($link[1]);
        } else {
            throw new \Exception('Redeem link not found');
        }

        $client = $this->getSession()->getDriver()->getClient();
        $client->request('GET', $url);
    }

    /**
     * @Then /^I should see (\d+) rows in the table$/
     */
    public function iShouldSeeRowsInTheTable($rowCount)
    {
        $table = $this->getSession()->getPage()->find('css', 'table');
        if (!$table) {
            throw new \Exception('Cannot find a table!');
        }

        $rows = $table->findAll('css', 'tbody tr');

        if ($rowCount != count($rows)) {
            throw new \Exception('not the right number! - I see '.count($rows));
        }
    }

    /**
     * @Then I press pay and create product button
     */
    public function iPressPayAndCreateProductButton()
    {
        $element = $this->getSession()->getPage()->find("css", ".buttons-block a:last-child");
        if (null === $element) {
            throw new Exception(" pay and create product button not found");
        }
        $element->click();
    }

    /**
     * @Then I make successful payment
     */
    public function iMakeSuccessfulPayment()
    {
        $element = $this->getSession()->getPage()->find("css", "input[name=accepturl]");
        if (null === $element) {
            throw new Exception("Accept url filed not found");
        }
        if (null === $element->getValue()) {
            throw new Exception("Accept url not found");
        }
        $client = $this->getSession("symfony2")->getDriver()->getClient();
        $headers = array('HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest');
        $client->request('POST', $element->getValue(), array("statuscode" => 5), array(), $headers);
    }

    /**
     * @Then I press buy
     */
    public function iPressBuy()
    {
        $this->iClickOnTheElement(".buy");
    }

    /**
     * @Then I press next
     */
    public function iPressNext()
    {
        $this->iClickOnTheElement("#no_address a");
    }

    /**
     *
     * @Then /^(?:|I )am on buyer code list page$/
     */
    public function iAmOnBuyerCodeListPage()
    {
        $this->visitPath('/dashboard/code/buyer');
    }

    /**
     * @Then I confirm terms and conditions
     */
    public function iConfirmTermsAndConditions()
    {
        $this->iClickOnTheElement("#confirm .buttons-block a");
    }

    /**
     * @Then I go to payment
     */
    public function iGoToPayment()
    {
        $this->iClickOnTheElement("#form-product-upload .buttons-block button[type=submit]");
    }

    /**
     * @Then I go to my watches list
     */
    public function iGoToMyWatchesList()
    {
        $this->visit("/profile/my/watches");
        $this->getSession()->wait(2000);
    }

    /**
     * @Then I go to orders list
     */
    public function iGoToOrdersList()
    {
        $this->visit("/dashboard/products/bought");
        $this->getSession()->wait(2000);
    }

    /**
     * @Then I close notification popup
     */
    public function iCloseNotificationPopup()
    {
        $element = $this->getSession()->getPage()->find("css", ".popup-close");
        if (null === $element) {
            throw new Exception("Popup close button not found");
        }
        $element->click();
    }

    /**
     * @Then I should see that term of using my omnicredits expires in 2 years
     */
    public function iShouldSeeThatTermOfUsingMyOmnicreditsExpiresIn2Years()
    {
        $table = $this->getSession()->getPage()->find("css", ".table-credit");
        if (null === $table) {
            throw new Exception("Table with omnicredit not found");
        }

        $expDate = $table->find('css', "tbody td:last-child");
        if (null === $expDate) {
            throw new Exception("Expired date not found");
        }
        $expDay = explode(' ', $expDate->getText());
        if (strtotime($expDay[0]) != strtotime("+2 years", strtotime(date("d.m.Y")))) {
            throw new Exception("Expired date not in 2 years from now");
        }

    }

    /**
     * @Then I press add employee link
     */
    public function iPressAddEmployeeLink()
    {
        $element = $this->getSession()->getPage()->find("css", ".add-new-big");
        if (null === $element) {
            throw new Exception("Accept url filed not found");
        }
        $element->click();
    }

    /**
     * @When I press add brand link
     */
    public function iPressAddBrandLink()
    {
        $this->iClickOnTheElement('.add-partner-brand-link');
    }

    /**
     * @When I select :arg1 brand from partner brands select
     */
    public function iSelectBrandFromPartnerBrandsSelect($arg1)
    {
        $this->selectOption('partner-new-brand-input', $arg1);
    }

    /**
     * @When I click submit selected brand
     */
    public function iClickSubmitSelectedBrand()
    {
        $this->iClickOnTheElement('.add-partner-brand');
    }

    /**
     * @When I confirm brand in popup
     */
    public function iConfirmBrandInPopup()
    {
        $this->iClickOnTheElement('.add-partner-brand-popup .popup-close-yes');
    }

    /**
     * @When I register new partner employee
     */
    public function iRegisterNewPartnerEmployee()
    {
        $this->iClickOnTheElement('.partner-product-button.green');
    }

    /**
     * @When I open last order's details
     */
    public function iOpenLastOrdersDetails()
    {
        $elements = $this->getSession()->getPage()->findAll("css", ".dropdown");
        if (sizeof($elements) == 0) {
            throw new Exception("Order ID not found");
        }
        $lastOrder = array_pop($elements);
        $lastOrder->find('css', 'a')->click();
        if (!$lastOrder->hasClass('open')) {
            throw new Exception("Order details not visible");
        }
    }

    /**
     * @When /^I should see that price is (\d+)$/
     */
    public function iShouldSeeThatPriceIs($price)
    {
        $orderPrice = $this->findDetailsCells(0);
        if (intval($orderPrice->getText()) != $price) {
            throw new Exception(sprintf("Order price is %s", $orderPrice));
        }
    }

    public function findDetailsCells($cell)
    {
        $elements = $this->getSession()->getPage()->findAll("css", ".dropdown-menu");
        if (sizeof($elements) == 0) {
            throw new Exception("Order details not found");
        }
        $lastOrderDetails = array_pop($elements);
        $detailsCells = $lastOrderDetails->findAll('css', 'td');
        return $detailsCells[$cell];
    }

    /**
     * @When /^there were used (\d+) omnicredits$/
     */
    public function thereWereUsedOmnicredits($omnicredits)
    {
        $orderCredits = $this->findDetailsCells(1);
        if (intval($orderCredits->getText()) != $omnicredits) {
            throw new Exception(sprintf("There were used %s omnicredits, and supposed to be %s", array($orderCredits, $omnicredits)));
        }
    }

    /**
     * @When /^(\d+) was paid by the DIBS/
     */
    public function wasPaidByTheDIBS($dibs)
    {
        $orderDIBS = $this->findDetailsCells(2);
        if (intval($orderDIBS->getText()) != $dibs) {
            throw new Exception(sprintf("Money wat paid by the DUBS %s, and supposed to be %s", array($orderDIBS, $dibs)));
        }
    }

    /**
     * @When User enters code of card
     */
    public function userEntersCodeOfCard()
    {
        $this->iFillInTheElement("code", $this->code);
    }

    /**
     * @When I select English localization
     */
    public function iSellectEnglishLocalization()
    {
        $element = $this->getSession()->getPage()->find("css", "#countries_title");
        if (null === $element) {
            throw new Exception("Localization selector not found");
        }
        $element->click();

        $localizationList =  $this->getSession()->getPage()->findAll('css', '#countries_child li');

        if (sizeof($localizationList) == 0) {
            throw new Exception("Localization list not found");
        }
        $endLocalization = null;
        foreach ($localizationList as $localization) {
            if ($localization->getAttribute('title') == "ENGLISH") {
                $endLocalization = $localization;
            }
        }
        if (null === $endLocalization) {
            throw new Exception("English localization not found");
        }
        $endLocalization->click();
    }

    /**
     * @When I invalidate cache
     */
    public function iInvalidateCache()
    {
        $this->iClickOnTheElement("a.btn-invalidate-cache");
    }

    /**
     * @When I fill in translation key with :arg1
     */
    public function iFillInTranslationKeyWith($info)
    {
        $this->iFillInTheElement("lxk_trans_unit_key", $info);
    }

    /**
     * @When I fill in EN translation with :arg1
     */
    public function iFillInENTranslationWith($info)
    {
        $this->iFillInTheElement("lxk_trans_unit_translations_0_content", $info);
    }

    /**
     * @When I click add new IP address
     */
    public function iClickAddNewIPAddress()
    {
        $this->iClickOnTheElement(".new-link-field");
    }

    /**
     * @When I fill in IP address input with :arg1
     */
    public function iFillInIPAddressInputWith($info)
    {
        $this->iFillInTheElement("master_IPs_1_value", $info);
    }

    /**
     * @Then /^"([^"]*)" should not be visible$/
     */
    public function shouldNotBeVisible($selector) {
        $visible = 0;
        $el = $this->getSession()->getPage()->find('css', $selector);
        $style = '';
        while ($el) {

            if(!empty($el)){
                $style = preg_replace('/\s/', '', $el->getAttribute('style'));
            } else {
                throw new Exception("Element ({$selector}) not found");
            }
            if (!(false !== strstr($style, 'display:none'))) {
                $visible = 1;
                $el = $el->getParent();
            } else {
                $visible = 0;
                break;
            }
        }

        if ($visible) {
            throw new Exception("Element is visible");
        }

        return true;
    }

    /**
     * Checks, that option from select with specified id|name|label|value is selected.
     *
     * @Then /^the "(?P<option>(?:[^"]|\\")*)" option from "(?P<select>(?:[^"]|\\")*)" should be selected/
     * @Then /^the option "(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)" should be selected$/
     * @Then /^"(?P<option>(?:[^"]|\\")*)" from "(?P<select>(?:[^"]|\\")*)" should be selected$/
     */
    public function theOptionFromShouldBeSelected($option, $select)
    {
        $selectField = $this->getSession()->getPage()->findField($select);
        if (null === $selectField) {
            throw new ElementNotFoundException($this->getSession(), 'select field', 'id|name|label|value', $select);
        }

        $optionField = $selectField->find('named', array(
            'option',
            $option,
        ));

        if (null === $optionField) {
            throw new ElementNotFoundException($this->getSession(), 'select option field', 'id|name|label|value', $option);
        }

        if (!$optionField->isSelected()) {
            throw new ExpectationException('Select option field with value|text "'.$option.'" is not selected in the select "'.$select.'"', $this->getSession());
        }
    }

    /**
     * @When I close compare popup
     */
    public function iCloseComparePopup()
    {
        $function = <<<JS
(function(){
  $('#compare-3-product').hide();
    $('#popup-wrapper').hide();
})()
JS;
        $this->getSession()->executeScript($function);
    }


    /**
     * Check that there are more than or = to a number of elements on a page
     *
     * @Then /^I should see more "([^"]*)" or more "([^"]*)" elements$/
     */
    public function iShouldSeeMoreOrMoreElements($num, $element)
    {
        $container = $this->getSession()->getPage();
        $nodes = $container->findAll('css', $element);

        $count = count($nodes);

        if (intval($num) > $count) {
            $message = sprintf('%d elements less than %s "%s" found on the page, but should be %d.', $count, $element, $element, $num);
            throw new ExpectationException($message, $this->session);
        }
    }




    /**
     * @Then I close current tab
     */
    public function iCloseCurrentTab()
    {
        $window = $this->getSession()->getWindowName();
        $this->getSession()->stop($window);
    }



    /**
     * @Then I fill in popup searchfield with :arg
     */
    public function iFillInPopupSearchfieldWithBre($text)
    {
        $this->getSession()->executeScript("
            $('.popup-search.popupSearchField').val('$text').keyup();
            ");
    }
    /**
     * @Then I fill in main searchfield with :arg
     */
    public function iFillInMainSearchfieldWith($text)
    {
        $this->getSession()->executeScript("
            $('.search-line input').val('$text').keyup();
            ");
    }

    /**
     * @Then I send emails
     */
    public function iSendEmails()
    {
        $sendEmailObject = new MailSendFile();
        $sendEmailObject->sendEmail();
    }


}