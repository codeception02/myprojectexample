<?php declare(strict_types = 1);
namespace omnivalor\behat;
use Behat\Mink\Element\NodeElement;
use Doctrine\ORM\EntityManager;
use Omnivalor\UserBundle\Entity\Email;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Created by PhpStorm.
 * Date: 09.12.2016
 * Time: 12:03
 */
trait WatchUploadingContext
{

    /**
     * @Then I should see Payment completed page
     */
    public function iShouldSeePaymentCompletedPage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.confirm-content');
            return true;
        });
    }
    /**
     * @Given I click on sell link in header
     */
    public function iClickOnSellLinkInHeader()
    {
        $this->iClickOnTheElement(".sell");
    }

    /**
     * @Given I select brand :brand at first upload step
     * @param string $brand
     */
    public function iSelectBrandAtFirstUploadStep(string $brand)
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnNextSelector('#pr_main2_brand');
            return true;
        });
        $this->spin(function (FeatureContext $context,$brand) {
            $context->iFillInSearchFieldInSelectWith('#pr_main2_brand', $brand);
            return true;
        },$brand);
    }

//    public function iClickOnNextSelector($selector)
//    {
//        $this->spin(function ($context, $selector) {
//            $context->iClickOnTheElement( $selector.' + div');
//            return true;
//        }, $selector);
//    }

    public function iClickOnNextSelector($selector)
    {
        $this->iClickOnTheElement( $selector.' + div');
    }

    /**
     * @Given I fill in search field in opened select with
     * @param string $selector
     * @param string $data
     */
    public function iFillInSearchFieldInSelectWith(string $selector, string $data)
    {
        $this->iFillInTheElement($selector." + div .chosen-drop .chosen-search input", $data);
    }

    /**
     * @Given I select model :model at first upload step
     * @param string $model
     */
    public function iSelectModelAtFirstUploadStep(string $model)
    {
        $this->spin(function (FeatureContext $context,$model) {
            $context->iClickOnNextSelector('#pr_main2_model_entity');
            $context->iFillInSearchFieldInSelectWith('#pr_main2_model_entity',$model);
            return true;
        },$model);
    }

    /**
     * You should enter <select> id for select
     * @Given I select movement :movement at first upload step
     * @param string $movement
     */
    public function iSelectMovementAtFirstUploadStep(string $movement)
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnNextSelector('#pr_main2_mechanism');
            return true;
        });
        $this->spin(function (FeatureContext $context,$movement) {
            $context->iFillInSearchFieldInSelectWith('#pr_main2_mechanism',$movement);
            return true;
        },$movement);
    }

    /**
     * @Given I select case material :material at first upload step
     * @param string $material
     */
    public function iSelectCaseMaterialAtFirstUploadStep(string $material)
    {
        $this->iClickOnNextSelector('#pr_main2_caseMat');
        $this->iFillInSearchFieldInSelectWith('#pr_main2_caseMat',$material);
    }

    /**
     * @Given I select dial color :color at first upload step
     * @param string $color
     */
    public function iSelectDialColorAtFirstUploadStep(string $color)
    {
        $this->iClickOnNextSelector('#pr_main2_face');
        $this->iFillInSearchFieldInSelectWith('#pr_main2_face',$color);
    }

    /**
     * @Given I select bezel material :bezelmaterial at first upload step
     * @param string $bezelmaterial
     */
    public function iSelectBezelMaterialAtFirstUploadStep(string $bezelmaterial)
    {
        $this->iClickOnNextSelector("#pr_main2_bezelMat");
        $this->iFillInSearchFieldInSelectWith("#pr_main2_bezelMat", $bezelmaterial);
    }

    /**
     * @Given I select bracelet material :braceletmaterial at first upload step
     * @param string $braceletmaterial
     */
    public function iSelectBraceletMaterialAtFirstUploadStep(string $braceletmaterial)
    {
        $this->iClickOnNextSelector("#pr_main2_beltMat");
        $this->iFillInSearchFieldInSelectWith("#pr_main2_beltMat", $braceletmaterial);
    }

    /**
     * @Given I select bracelet color :braceletcolor at first upload step
     * @param string $braceletcolor
     */
    public function iSelectBraceletColorAtFirstUploadStep(string $braceletcolor)
    {
        $this->iClickOnNextSelector("#pr_main2_beltColor");
        $this->iFillInSearchFieldInSelectWith("#pr_main2_beltColor", $braceletcolor);
    }

    /**
     * @Given I select clasp material :material at first upload step
     * @param string $material
     */
    public function iSelectClaspMaterialAtFirstUploadStep(string $material)
    {
        $this->iClickOnNextSelector('#pr_main2_lockMat');
        $this->iFillInSearchFieldInSelectWith('#pr_main2_lockMat',$material);
    }

    /**
     * @Given I select clasp type :type at first upload step
     * @param string $material
     */
    public function iSelectClaspTypeAtFirstUploadStep(string $material)
    {
        $this->iClickOnNextSelector('#pr_main2_lockType');
        $this->iFillInSearchFieldInSelectWith('#pr_main2_lockType',$material);
    }

    /**
     * @Given I select case condition at first upload step
     */
    public function iSelectCaseConditionAtFirstUploadStep()
    {
        $this->iCheckCustomCheckboxWith("pr_main2_caseCond_1");
    }

    /**
     * @Given I select bracelet condition at first upload step
     */
    public function iSelectBraceletConditionAtFirstUploadStep()
    {
        $this->iCheckCustomCheckboxWith("pr_main2_beltCond_2");
    }

    /**
     * @Given I select clasp condition at first upload step
     */
    public function iSelectClaspConditionAtFirstUploadStep()
    {
        $this->iCheckCustomCheckboxWith("pr_main2_lockCond_3");
    }

    /**
     * @Given I select original box at first upload step
     */
    public function iSelectOriginalBoxAtFirstUploadStep()
    {
        $this->iCheckCustomCheckboxWith("pr_main2_box_0");
    }

    /**
     * @Given I select certificate at first upload step
     */
    public function iSelectCertificateAtFirstUploadStep()
    {
        $this->iCheckCustomCheckboxWith("pr_main2_cert_0");
    }

    /**
     * @Given I click continue button at first upload step
     */
    public function iClickContinueButtonAtFirstUploadStep()
    {
        $this->iClickOnTheElement(".continue-button-block .o-button.o-button--filled-gold");

    }

    /**
     * @Given I should be on second upload step
     */
    public function iShouldBeOnSecondUploadStep()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageAddress("/en/profile/product/create/images");
            return true;
        });
    }

    /**
     * @Given I click on case plus icon
     */
    public function iClickOnCasePlusIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#first-crop-window .flex-grid .flex-grid-tl-3 .image-creation__add-button.icon.icon--add-watch");
            return true;
        });
    }

    /**
     * @Given I click on bracelet plus icon
     */
    public function iClickOnBraceletPlusIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#second-crop-window .flex-grid .flex-grid-tl-3 .image-creation__add-button.icon.icon--add-watch");
            return true;
        });
    }

    /**
     * @Given I click on clasp plus icon
     */
    public function iClickOnClaspPlusIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#third-crop-window .flex-grid .flex-grid-tl-3 .image-creation__add-button.icon.icon--add-watch");
            return true;
        });
    }

    /**
     * @Given I attach img in first crop window
     */
    public function iAttachImgInFirstCropWindow()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iAttachFileToField('#first-crop-window .file-image','case1.jpg');
            return true;
        });
    }

    /**
     * @Given I attach img in second crop window
     */
    public function iAttachImgInSecondCropWindow()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iAttachFileToField('#second-crop-window .file-image','case1.jpg');
            return true;
        });
    }

    /**
     * @Given I attach img in third crop window
     */
    public function iAttachImgInThirdCropWindow()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iAttachFileToField('#third-crop-window .file-image','case1.jpg');
            return true;
        });
    }

    /**
     * Attach file to input by selector.
     *
     * @Then /^(?:|I ) attach "(?P<file>[^"]+)" to "(?P<field>[^"]+)"$/
     * @param string $selector
     * @param string $file
     */
    public function iAttachFileToField(string $selector, string $file)
    {
        // Add file path
        $path = '';
        if ($this->getMinkParameter('files_path')) {
            $path = rtrim($this->getMinkParameter('files_path'), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        }

        $this->findByCssSelector($selector)->attachFile($path.$file);
    }


//    /**Z:\\omnivalor.local\\features\\bootstrap\\images\\
//         * Drags and drops the specified element to the specified container. This step does not work in all the browsers, consider it experimental.
//         *
//         * The steps definitions calling this step as part of them should
//         * manage the wait times by themselves as the times and when the
//         * waits should be done depends on what is being dragged & dropper.
//         *
//         * @When /^I drag "(?P<element_string>(?:[^"]|\\")*)" "(?P<selector1_string>(?:[^"]|\\")*)" and drop in "(?P<container_element_string>(?:[^"]|\\")*)" "(?P<selector2_string>(?:[^"]|\\")*)"$/
//         * @param string $element
//         * @param string $selectortype
//         * @param string $containerelement
//         * @param string $containerselectortype
//         */
//    public function i_drag_and_drop_in($element, $selectortype, $containerelement, $containerselectortype) {
//
//            list($sourceselector, $sourcelocator) = $this->transform_selector($selectortype, $element);
//            $sourcexpath = $this->getSession()->getSelectorsHandler()->selectorToXpath($sourceselector, $sourcelocator);
//            list($containerselector, $containerlocator) = $this->transform_selector($containerselectortype, $containerelement);
//            $destinationxpath = $this->getSession()->getSelectorsHandler()->selectorToXpath($containerselector, $containerlocator);
//            $this->getSession()->getDriver()->dragTo($sourcexpath, $destinationxpath);
//    }



    /**
     * @Then I drag 12 icon to image
     */
    public function iDragTwelveIconToImage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-clock div:nth-child(1)" , ".cropper-tool__image.cropper-tool__image--uploaded-active .test4-1");
            return true;
        });
    }

   /**
     * @Then I drag 3 icon to image
     */
    public function iDragThirdIconToImage()
    {
        $this->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-clock div:nth-child(3)" , ".cropper-tool__image.cropper-tool__image--uploaded-active .test4-2");
    }

    /**
     * @Then I drag 6 icon to image
     */
    public function iDragSixIconToImage()
    {
        $this->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-clock div:nth-child(5)" , ".cropper-tool__image.cropper-tool__image--uploaded-active .test4-3");
    }

    /**
     * @Then I drag 9 icon to image
     */
    public function iDragNineIconToImage()
    {
        $this->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-clock div:nth-child(7)" , ".cropper-tool__image.cropper-tool__image--uploaded-active .test4-4");
    }

    /**
     * @Then I click on continue popup button
     */
    public function iClickOnContinuePopupButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement(".cropper-tool__continue-button-wrapper .btn.btn--gray");
            return true;
        });
    }

    /**
     * @Then I should see case back view popup
     */
    public function iShouldSeeCaseBackView()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageContainsText('CASE BACK VIEW');
            return true;
        });
    }

    /**
     * @Then I should see case right view popup
     */
    public function iShouldSeeCaseRightView()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageContainsText('CASE RIGHT VIEW');
            return true;
        });
    }

    /**
     * @Then I should see case left view popup
     */
    public function iShouldSeeCaseLeftView()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageContainsText('CASE LEFT VIEW');
            return true;
        });
    }

    /**
     * @Then I should see lock back view popup
     */
    public function iShouldSeeLockBackView()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageContainsText('LOCK BACK VIEW');
            return true;
        });
    }

    /**
     * @Then I drag case right and left view six icon
     */
    public function iDragCaseRightAndLeftViewSixIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-side div:nth-child(3)",".cropper-tool__image.cropper-tool__image--uploaded-active .test4-4");
            return true;
        });
    }

    /**
     * @Then I drag case right and left view twelve icon
     */
    public function iDragCaseRightAndLeftViewTwelveIcon()
    {
        $this->dragElementTo(".cropper-tool__draggable-wrapper.cropper-tool__draggable-wrapper--type-side div:nth-child(1)",".cropper-tool__image.cropper-tool__image--uploaded-active .test4-2");
    }

    /**
     * @Then I click on second crop finish button
     */
    public function iClickOnSecondCropFinishButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#second-crop-window .cropper-tool__finish-button button');
            return true;
        });
    }

    /**
     * @Then I click on third crop finish button
     */
    public function iClickOnThirdCropFinishButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#third-crop-window .cropper-tool__finish-button button');
            return true;
        });
    }

    /**
     * @Then I press continue
     */
    public function iPressContinue()
    {
        $this->spin(function (FeatureContext $context) {
            $context->pressButton('continue');
            return true;
        });
    }

    /**
     * @Then I should be on third payment step
     */
    public function iShouldBeOnThirdStep()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.checkout-subtitle');
            return true;
        });
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.content-loading');
            return true;
        });

    }


    /**
     * @Then I should see four case img are uploaded
     */
    public function iShouldSeeFourCaseImgAreUploaded()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.flex-grid-tl-3.flex-grid-mm-6.flex-grid-ms-12.image-creation:nth-child(4) .lazy-image-loaded');
            return true;
        });
    }

    /**
     * @Then I click on third crop continue popup button
     */
    public function iClickOnThirdCropContinuePopupButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#third-crop-window .btn.btn--gray');
            return true;
        });
    }

    /**
     * @Then I should be on background page
     */
    public function iShouldBeOnBackgroundPage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageAddress("/en/profile/product/create/background");
            return true;
        });
    }

    /**
     * @Then I should be on background partner page
     */
    public function iShouldBeOnBackgroundPartnerPage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageAddress("/en/partner/add/product/background");
            return true;
        });
    }

    /**
     * @Then I log in as partner
     */
    public function iLogInAsPartner()
    {
        $this->iFillInTheElement('#email_form input', FeatureContext::PARTNER_EMAIL);
        $this->iClickOnTheElement('[for="email_pass"]');
        $this->iClickOnTheElement('.o-button--filled-gold.two-state');
        $this->spin(function (FeatureContext $context) {
            $code = $context->getEmailCode(FeatureContext::PARTNER_EMAIL);
            $context->iFillInTheElement('#auth_form input.sms-code', (string)$code);
            return true;
        });
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#auth_form .o-button--filled-gold');
            return true;
        });
        $this->iWaitMillisecondsForResponse();
        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Then I log in as affiliate
     */
    public function iLogInAsAffiliate()
    {
        $this->iFillInTheElement('#email_form input', FeatureContext::AFFILIATE_EMAIL);
        $this->iClickOnTheElement('[for="email_pass"]');
        $this->iClickOnTheElement('.o-button--filled-gold.two-state');
        $this->spin(function (FeatureContext $context) {
            $code = $context->getEmailCode(FeatureContext::AFFILIATE_EMAIL);
            $context->iFillInTheElement('#auth_form input.sms-code', (string)$code);
            return true;
        });
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#auth_form .o-button--filled-gold');
            return true;
        });
        $this->iWaitMillisecondsForResponse();
        $this->iWaitMillisecondsForResponse();
    }
    /**
     * @Then I log in as partner employee
     */
    public function iLogInAsPartnerEmployee()
    {
        $this->iFillInTheElement('#email_form input', FeatureContext::EMPLOYEE_EMAIL);
        $this->iClickOnTheElement('[for="email_pass"]');
        $this->iClickOnTheElement('.o-button--filled-gold.two-state');
        $this->spin(function (FeatureContext $context) {
            $code = $context->getEmailCode(FeatureContext::EMPLOYEE_EMAIL);
            $context->iFillInTheElement('#auth_form input.sms-code', (string)$code);
            return true;
        });
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#auth_form .o-button--filled-gold');
            return true;
        });
        $this->iWaitMillisecondsForResponse();
        $this->iWaitMillisecondsForResponse();
    }


    /**
     * @Given I log in as superadmin
     */
    public function iLogInAsSuperadmin()
    {
        $this->iClickOnLoginIcon();
        $this->iFillInLoginFieldWithAdminEmail();
        $this->iFillInPasswordFieldWithAdminPassword();
        $this->iClickLoginButtonInLoginPopup();
    }

    /**
     * Get email code when partner signed in
     *
     * @param string $email
     * @return int
     */
    public function getEmailCode(string $email) {

        /** @var EntityManager $entityManager */
        $entityManager = $this->getSymfonyService('doctrine.orm.entity_manager');

        $emailEntity = null;

        // Try get email entity from db with waiting
        for ($i = 5; $i--;) {

            $this->iWaitMillisecondsForResponse();

            /** @var Email $emailEntity Get last email entity by email because previous action was send the code to email */
            $emailEntity = $entityManager->getRepository(Email::class)->findLastEmailEntityByEmail($email);

            if ($emailEntity) {
                break;
            }
        }

        if (!$emailEntity) {
            throw new \InvalidArgumentException(sprintf(
                'Email entity for email %s not found when trying get the code',
                $email
            ));
        }

        $emailMessage = $emailEntity->getHtmlBody();
        $crawler = new Crawler($emailMessage);

        // Get first p element and remove all not numbers
        $code = preg_replace('/\D/', '', $crawler->filter('table table tr:first-child td p:first-child span')->text());

        return $code;
    }

    public function getRegistrationConfirmLink(string $email) {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getSymfonyService('doctrine.orm.entity_manager');

        $emailEntity = null;

        // Try get email entity from db with waiting
        for ($i = 5; $i--;) {

            $this->iWaitMillisecondsForResponse();

            /** @var Email $emailEntity Get last email entity by email because previous action was send the code to email */
            $emailEntity = $entityManager->getRepository(Email::class)->findLastEmailEntityByEmail($email);

            if ($emailEntity) {
                break;
            }
        }

        if (!$emailEntity) {
            throw new \InvalidArgumentException(sprintf(
                'Email entity for email %s not found when trying get the code',
                $email
            ));
        }

        $emailMessage = $emailEntity->getHtmlBody();
        var_dump($emailMessage);
        $crawler = new Crawler($emailMessage);

        // Get first p element and remove all not numbers
        $code = preg_replace('\/en\/register\/confirm\/(.*)"\starget', '', $crawler->filter('a:last-child()')->text());


        return $code;
    }

    /**
     * @Then I select last unpriced product
     */
    public function iSelectLastUnpricedListing()
    {
        $this->iClickOnTheElement('.table__header th a');
        $this->iWaitMillisecondsForResponse(FeatureContext::DELAY*0.2);
        $this->iClickOnTheElement('.table__row .table__button-container a');
    }


    /**
     * @Then I click on Dashboard menu item
     */
    public function iClickOnDashboardMenuItem()
    {
        $this->visitPath('/dashboard/');
    }

    /**
     * @Then I click on Unpriced listings menu item
     */
    public function iClickOnUnpticedListingsMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__sidebar.cabinet__row-element.cabinet__row-element--left.partner-sidebar ul li:nth-child(4) a');
            return true;
        });
    }

    /**
     * @Then I click on Product Id item
     */
    public function iClickOnProductIdItem()
    {
        $this->iClickOnTheElement('tr.table__header th:nth-child(1) a');
    }

    /**
     * @Then I click on last unpriced watch
     */
    public function iClickOnLastUnpricedWatch()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(1) td.table__td--righted.table__td--last a');
            return true;
        });
    }

    /**
     * @Given I fill in minPrice field with :price price
     * @param string $price
     */
    public function iFillInMinPriceFieldWithPrice(string $price)
    {
        $this->spin(function (FeatureContext $context,$price) {
            $context->iFillInTheElement('.grid__col.grid__col--price.grid__col--min input[type=\"text\"]', $price);
            return true;
        },$price);
    }

    /**
     * @Given I fill in maxPrice field with :price price
     * @param string $price
     */
    public function iFillInMaxPriceFieldWithPrice(string $price)
    {
        $this->spin(function (FeatureContext $context,$price) {
            $context->iFillInTheElement('.grid__col.grid__col--price.grid__col--max input[type=\"text\"]', $price);
            return true;
        },$price);
    }

    /**
     * @Then I press Accept button
     */
    public function iPressAcceptButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.grid__col.grid__col--btn.grid__col--accept input');
            return true;
        });
    }

    /**
     * @Then I click on user sales menu item
     */
    public function iClickOnUserSalesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__sidebar.cabinet__row-element.cabinet__row-element--left.partner-sidebar ul li:nth-child(2) a');
            return true;
        });
    }

    /**
     * @Then I click on sales date dropdown list
     */
    public function iClickOnSalesDateDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('th.date a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(1500);
    }

    /**
     * @Then I select last priced watch
     */
    public function iSelectLastPricedWatch()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(1) td.state.state-4 a');
            return true;
        });
        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Then I check agree terms
     */
    public function iCheckAgreeTerms()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.grid__col--p100.omni-inputs label.required');
            return true;
        });
    }

    /**
     * @Then I follow go to profile link
     */
    public function iFollowGoToProfileLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#checkout-container a');
            return true;
        });
    }

    /**
     * @Then I click on shipping status dropdown list
     */
    public function iClickOnShippingStatusDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__table.table tbody tr:nth-child(2) td:nth-child(9) select');
            return true;
        });
    }

    /**
     * @Then I select finished shipping status
     */
    public function iSelectFinishedShippingStatus()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(2) td:nth-child(9) select option:nth-child(4)');
            return true;
        });
    }

    /**
     * @Then I click on Om to buyer status dropdown list
     */
    public function iClickOnOmToBuyerStatusDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__table.table tbody tr:nth-child(3) td:nth-child(9) select');
            return true;
        });
    }

    /**
     * @Then I select Om to buyer finished shipping status
     */
    public function iSelectOmToBuyerFinishedShippingStatus()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(3) td:nth-child(9) select option:nth-child(4)');
            return true;
        });
    }

    /**
     * @When I copy verification code
     */
    public function iCopyVerificationCode()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.uuid-block');
            return true;
        });
        /** @var NodeElement $code */
        $code = $this->findByCssSelector('.uuid-block');
        $this->verifyCode = $code->getText();
    }

    /**
     * @Then I should see product bought status
     */
    public function iShouldSeeProductBoughtStatus()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('table tbody tr:nth-child(1) td.state.state-9');
            return true;
        });
    }

    /**
     * @Then I click on valuate button
     */
    public function iClickOnValuateButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.header-menu ul li:nth-child(4)');
            return true;
        });
    }

    /**
     * @Given I should be on second valuate step
     */
    public function iShouldBeOnSecondValuateStep()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPageAddress("/en/profile/product/create/images/valuate");
            return true;
        });
    }

    /**
     * @Then I press Valuate button
     */
    public function iPressValuateButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#change-parts-add-button');
            return true;
        });
    }

    /**
     * @When I should see ok popup
     */
    public function iShouldSeeOkPopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.custom-popup__body');
            return true;
        });
    }

    /**
     * @Then I click on ok button
     */
    public function iClickOnOkButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.custom-popup__ok-button');
            return true;
        });
    }

    /**
     * @Then I sort first column in table
     */
    public function iSortFirstColumnInTable()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('tr th a');
            return true;
        });
    }

    /**
     * @Then I should see :type type in first row
     * @param string $type
     */
    public function iShouldSeeTypeInFirstRow(string $type)
    {
        $this->spin(function (FeatureContext $context, $type) {
            $context->assertElementContains('tbody tr:nth-child(1) td:nth-child(5)',$type);
            return true;
        },$type);
    }

    /**
     * @Then I click on valuate link in first row
     */
    public function iClickOnValuateLinkInFirstRow()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('tbody tr:nth-child(1) td:nth-child(6) a');
            return true;
        });
    }

    /**
     * @Then I click on first sorting link in table
     */
    public function iClickOnFirstSortingLinkInTable()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(1) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I click on continue link user valuation page
     */
    public function iClickOnContinueLinkUserValuationPage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('tbody tr td:nth-child(6) a');
            return true;
        });
    }

    /**
     * @Then I should see :minPrice in min price column
     * @param string $price
     * @internal param string $type
     */
    public function iShouldSeeInMinPriceColumn(string $price)
    {
        $this->spin(function (FeatureContext $context, $price) {
            $context->assertElementContains('tbody tr:nth-child(1) td:nth-child(3)',$price);
            return true;
        },$price);
    }

    /**
     * @Then I should see :maxPrice in max price column
     * @param string $price
     * @internal param string $type
     */
    public function iShouldSeeInMaxPriceColumn(string $price)
    {
        $this->spin(function (FeatureContext $context, $price) {
            $context->assertElementContains('tbody tr:nth-child(1) td:nth-child(4)',$price);
            return true;
        },$price);
    }

    /**
     * @Then I should see :minPriceValuate valuate min price in admin popup
     * @param string $price
     * @internal param string $type
     */
    public function iShouldSeeValuateMinPriceInAdminPopup(string $price)
    {
        $this->spin(function (FeatureContext $context, $price) {
            $context->assertElementContains(' .grid__row--semi-table-margin:nth-child(1) .row__price .grid__col.grid__col--price.grid__col--min',$price);
            return true;
        },$price);
    }

    /**
     * @Then I should see :maxPriceValuate valuate max price in admin popup
     * @param string $price
     * @internal param string $type
     */
    public function iShouldSeeValuateMaxPriceInAdminPopup(string $price)
    {
        $this->spin(function (FeatureContext $context, $price) {
            $context->assertElementContains(' .grid__row--semi-table-margin:nth-child(1) .row__price .grid__col.grid__col--price.grid__col--max',$price);
            return true;
        },$price);
    }

    /**
     * @Given I fill after valuation in minPrice field with :price price
     * @param string $price
     */
    public function iFillAfterValuationInMinPriceFieldWithPrice(string $price)
    {
        $this->spin(function (FeatureContext $context,$price) {
            $context->iFillInTheElement("[name='minPrice']", $price);
            return true;
        },$price);
    }

    /**
     * @Given I fill after valuation in maxPrice field with :price price
     * @param string $price
     */
    public function iFillAfterValuationInMaxPriceFieldWithPrice(string $price)
    {
        $this->spin(function (FeatureContext $context,$price) {
            $context->iFillInTheElement("[name='maxPrice']", $price);
            return true;
        },$price);
    }

}
