<?php declare(strict_types = 1);
namespace omnivalor\behat;

use Behat\Mink\Element\NodeElement;
use Behat\Mink\WebAssert;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Doctrine\UserManager;

/**
 * Created by PhpStorm.
 * Date: 04.01.2017
 * Time: 13:35
 */

trait PartnerCenterContext
{
    public $tempBrandId;

    /**
     * @Then I click on verify button
     */
    public function iClickOnVerifyButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#wrapper a.verify.o-button.o-button--filled-gold');
            return true;
        });
    }

    /**
     * @Given I fill in code field with verification code
     */
    public function iFillInCodeFieldWithVerificationCode()
    {
        $verifyCode = $this->verifyCode;
        $this->spin(
            /**
             * @param FeatureContext $context
             * @param string $verifyCode
             * @return bool
             */
            function (FeatureContext $context, string $verifyCode) {
                $context->iFillInTheElement("#partner-start-verify .popup__row.popup__row--input > input", $verifyCode);
                return true;
        }, $verifyCode);
    }

    /**
     * @Then I click on popup verify button
     */
    public function iClickOnPopupVerifyButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#partner-start-verify .popup__row.popup__row--buttons .popup__button.popup__button--add.popup__button--right > button');
            return true;
        });
    }

    /**
     * @Then I click on verify product button
     */
    public function iClickOnVerifyProductButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#partner-start-verify .popup__row.popup__row--buttons .popup__button.popup__button--add.popup__button--right > button');
            return true;
        });
    }

    /**
     * @Then I click on view ad button
     */
    public function iClickOnViewAdButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs .btns-block .right a');
            return true;
        });
    }

    /**
     * @Given I open verified dropdown list
     */
    public function iOpenVerifiedDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters > th:nth-child(5) > div > a');
            return true;
        });
    }

    /**
     * @Given I select not verified in dropdown list
     */
    public function iSelectNotVerifiedInDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement(".table__filters > th:nth-child(5) > div > div > ul > li:nth-child(3)");
            return true;
        });
    }

    /**
     * @Given I select not verified watch in dropdown list
     */
    public function iSelectNotVerifiedWatchInDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#wrapper .cabinet__content.cabinet__row-element.cabinet__row-element--right.chosen-select > div > table > tbody > tr:nth-child(1) > td:nth-child(3) > a");
            return true;
        });
    }


    /**
     * @Given I fill in comment textarea
     */
    public function iFillInCommentTextarea()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement("#comment-form textarea", "Comment");
            return true;
        });
    }

    /**
     * @Then I click on comment button
     */
    public function iClickOnCommentButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#comment-form .right > button');
            return true;
        });
    }

    /**
     * @Then I click on deny button
     */
    public function iClickOnDenyButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#wrapper .cabinet-template.top-footer.responsive-block .cabinet__row-element.verify-container .cabinet__col.cabinet__col--right.omni-inputs .btns-block button');
            return true;
        });
    }

    /**
     * @Then I click on go back button
     */
    public function iClickOnGoBackButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#preview-top span');
            return true;
        });
    }

    /**
     * @Then I click on edit model button
     */
    public function iClickOnEditModelButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left div:nth-child(2) i');
            return true;
        });
    }

    /**
     * @Then I click on editing dropdown list
     */
    public function iClickOnEditingDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#pr_main2_model_entity');
            return true;
        });
    }

    /**
     * @Given I select model in editing dropdown list
     */
    public function iSelectModelInEditingDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#pr_main2_model_entity > option:nth-child(2)");
            return true;
        });
    }

    /**
     * @Then I click on edit serial number button
     */
    public function iClickOnEditSerialNumberButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(3) i');
            return true;
        });
    }

    /**
     * @Given I fill in SN field with edited SN
     */
    public function iFillInSNFieldWithEditedSN()
    {
        $this->iFillInTheElement(".cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(3) form input[type='text']", uniqid('', true));
    }

    /**
     * @Given I press on save SN button
     */
    public function iPressOnSaveButton()
    {
        $this->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(3) form button');
    }

    /**
     * @Then I click on edit reference number button
     */
    public function iClickOnEditReferenceNumberButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(4) > i');
            return true;
        });
    }

    /**
     * @Given I fill in RN field with edited RN
     */
    public function iFillInRNFieldWithEditedRN()
    {
        $this->iFillInTheElement(".cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(4) form input[type=\"text\"]", uniqid('', true));
    }

    /**
     * @Given I press on save RN button
     */
    public function iPressOnSaveRNButton()
    {
        $this->iClickOnTheElement('.cabinet__col.cabinet__col--right.omni-inputs > div:nth-child(1) .cabinet__sub-column--left > div:nth-child(4) form button');
    }

    /**
     * @Then I follow cancel link
     */
    public function iFollowCancelLink()
    {
        $this->iClickOnTheElement('.right a');
    }

    /**
     * @Then I click on yes purchase button
     */
    public function iClickOnYesPurchaseButton()
    {
        $this->iClickOnTheElement('.panel.full-width-button.fix-label.partner-block-wrapper .grid__row.flex-grid.flex-grid-align-items-center .flex-grid-tl-5 > div > div > div:nth-child(2) > label');
    }

    /**
     * @Then I click on purchased date dropdown list
     */
    public function iClickOnPurchasedDateDropdownList()
    {
        $this->iClickOnTheElement('.panel__selector--purchase .day-target-expander .chosen-container > a');
    }

    /**
     * @Given I fill in purchased date field with :date date
     * @param string $date
     */
    public function iFillInPurchasedCityFieldWithDate(string $date)
    {
        $this->iFillInTheElement(".panel__selector--purchase .day-target-expander .chosen-container.chosen-with-drop.chosen-container-active .chosen-search input[type='text']", $date);
    }

    /**
     * @Then I click on purchased city dropdown list
     */
    public function iClickOnPurchasedCityDropdownList()
    {
        $this->iClickOnTheElement('#purchased_city_select_chosen > a');
    }

    /**
     * @Given I fill in purchased city field with :city city
     * @param string $city
     */
    public function iFillInPurchasedCityFieldWithCity(string $city)
    {
        $this->iFillInTheElement("#purchased_city_select_chosen > div > div > input[type='text']", $city);
        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Then I click on yes serviced button
     */
    public function iClickOnYesServicedButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet-template.top-footer.responsive-block .omni-inputs > form > div:nth-child(3) > div.panel__block.grid.grid--thin-row-margin.panel__selector.panel__selector--service > div.flex-grid > div.flex-grid-tl-5 > div > div > div:nth-child(2) > label');
        });
    }

    /**
     * @Then I click on serviced city dropdown list
     */
    public function iClickOnServicedCityDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#serviced_city_select_chosen > a');
        });
    }

    /**
     * @Given I fill in serviced city field with :city city
     * @param string $city
     */
    public function iFillInServicedCityFieldWithCity(string $city)
    {
        $this->spin(function (FeatureContext $context, $city) {
            $context->iFillInTheElement("#serviced_city_select_chosen > div > div > input[type='text']", $city);
            return true;
        }, $city);
    }

    /**
     * @Given I fill in retailer field with :retailer retailer
     * @param string $retailer
     */
    public function iFillInRetailerFieldWithRetailer(string $retailer)
    {
        $this->spin(function (FeatureContext $context, $retailer) {
            $context->iFillInTheElement("#purchased_store_select_chosen > div > div > input[type='text']", $retailer);
            return true;
        }, $retailer);
    }

    /**
     * @Then I click on retailer dropdown list
     */
    public function iClickOnRetailerDropdownList()
    {
        $this->iClickOnTheElement('#purchased_store_select_chosen > a');
    }

    /**
     * @Given I press on Serviced Add button
     */
    public function iPressOnServicedAddButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#serviced_add_button');
        });
    }

    /**
     * @Given I select no original box at first upload step
     */
    public function iSelectNoOriginalBoxAtFirstUploadStep()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iCheckCustomCheckboxWith("pr_main2_box_0");
        });
    }

    /**
     * @Given I select no certificate at first upload step
     */
    public function iSelectNoCertificateAtFirstUploadStep()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iCheckCustomCheckboxWith("pr_main2_cert_0");
        });
    }

    /**
     * @Then I click on date dropdown list
     */
    public function iClickOnDateDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th.sort-active:first-child a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Given I fill in filter by date field with :date date
     * @param string $date
     */
    public function iFillInFilterByDateFieldWithDate(string $date)
    {
        $this->spin(function (FeatureContext $context,$date) {
            $context->iFillInTheElement(".table__filters th:first-child input", $date);
            return true;
        },$date);
    }

    /**
     * @Given I clean filter date field
    */
    public function iCleanFilterDateField()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:first-child input", '');
            return true;
        });
    }

    /**
     * @Given I fill in filter by name field with :name name
     * @param string $name
     */
    public function iFillInFilterByNameFieldWithName(string $name)
    {
        $this->spin(function (FeatureContext $context,$name) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", $name);
            return true;
        },$name);
    }

    /**
     * @Given I clean filter name field
     */
    public function iCleanFilterNameField()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", '');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Given I fill in filter by watch field with :watch watch
     * @param string $watch
     */
    public function iFillInFilterByWatchFieldWithWatch(string $watch)
    {
        $this->spin(function (FeatureContext $context, $watch) {
            $context->iFillInTheElement(".table__filters th:nth-child(3) input", $watch);
            return true;
        },$watch);
    }

    /**
     * @Given I clean filter watch field
     */
    public function iCleanFilterWatchField()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(3) input", '');
            return true;
        });
    }

    /**
     * @Then I click on name dropdown list
     */
    public function iClickOnNameDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(2) a');
            return true;
        });
    }

    /**
     * @Then I click on watch dropdown list
     */
    public function iClickOnWatchDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(3) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I click on State dropdown list
     */
    public function iClickOnStateDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(4) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I click on Verified dropdown list
     */
    public function iClickOnVerifiedDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(5) a');
            return true;
        });
    }

    /**
     * @Then I click on All dropdown list
     */
    public function iClickOnAllDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div a');
            $context->assertElementContains('.table__filters th:nth-child(4)','chosen-with-drop');
            return true;
        });
    }

    /**
     * @Then I click on All option
     */
    public function iClickOnAllOption()
    {
       $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(1)');
            return true;
        });
    }

    /**
     * @Then I click on Incomplete upload option
     */
    public function iClickOnIncompliteUploadOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(2)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on Active option
     */
    public function iClickOnActiveOption()
    {
       $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(3)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on Sold option
     */
    public function iClickOnSoldOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(4)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on In transit to omnivalor option
     */
    public function iClickOnInTransitToOmnivalorOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(5)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on In transit to buyer option
     */
    public function iClickOnInTransitToBuyerOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(6)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on Received by buyer option
     */
    public function iClickOnReceivedByBuyerOption()
    {
      $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(4) div div ul li:nth-child(7)');
            return true;
        });
    }

    /**
     * @Then I click on Company Sales menu item
     */
    public function iClickOnCompanySalesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(3)');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on sales name dropdown list
     */
    public function iClickOnSalesNameDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(1) a');
            return true;
        });
    }

    /**
     * @Then I click on sales watch dropdown list
     */
    public function iClickOnSalesWatchDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(2) a');
            return true;
        });
    }

    /**
     * @Then I click on employee dropdown list
     */
    public function iClickOnEmployeeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(3) a');
            return true;
        });
    }

    /**
     * @Then I click on sales status dropdown list
     */
    public function iClickOnSalesStatusDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(4) a');
            return true;
        });
    }

    /**
     * @Given I fill in sales filter by name field with :name name
     * @param string $name
     */
    public function iFillInSalesFilterByNameFieldWithName(string $name)
    {
        $this->spin(function (FeatureContext $context,$name) {
            $context->iFillInTheElement(".table__filters th:nth-child(1) input", $name);
            return true;
        },$name);
    }

    /**
     * @Given I clean sales name filter
     */
    public function iCleanSalesNameFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(1) input", '');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/3);
    }

    /**
     * @Given I fill in sales filter by watch field with :watch watch
     * @param string $watch
     */
    public function iFillInSalesFilterByWatchFieldWithName(string $watch)
    {
        $this->spin(function (FeatureContext $context,$watch) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", $watch);
            return true;
        },$watch);
    }

    /**
     * @Given I clean sales watch filter
     */
    public function iCleanSalesWatchFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", '');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/3);
    }

    /**
     * @Given I fill in sales filter by employee field with :employee employee
     * @param string $employee
     */
    public function iFillInSalesFilterByEmployeeFieldWithName(string $employee)
    {
        $this->spin(function (FeatureContext $context,$employee) {
            $context->iFillInTheElement(".table__filters th:nth-child(3) input", $employee);
            return true;
        },$employee);
    }

    /**
     * @Given I clean sales employee filter
     */
    public function iCleanSalesEmployeeFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(3) input", '');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/3);
    }

    /**
     * @Then I click on All verified dropdown list
     */
    public function iClickOnAllVerifiedDropdownList()
    {

        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(5) div a');
            $context->assertElementContains('.table__filters th:nth-child(5)','chosen-with-drop');
            return true;
        });
    }

    /**
     * @Then I click on Yes option
     */
    public function iClickOnYesOption()
    {
       $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(5) ul li:nth-child(2)');
            return true;
        });
    }

    /**
     * @Then I click on No option
     */
    public function iClickOnNoOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(5) ul li:nth-child(3)');
            return true;
        });
    }

    /**
     * @Then I click on Denied option
     */
    public function iClickOnDeniedOption()
    {
       $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(5) ul li:nth-child(4)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on Codes menu item
     */
    public function iClickOnCodesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(4)');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on price dropdown list
     */
    public function iClickOnPriceDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__header th:nth-child(4) a');
            return true;
        });
    }

    /**
     * @Then I click on Brands menu item
     */
    public function iClickOnBrandsMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(5)');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on Brands menu item no pagination
     */
    public function iClickOnBrandsMenuItemNoPagination()
    {
        /** @var $element NodeElement */
        $element = $this->findByCssSelector('ul.menu__wrapper > li:nth-child(5) a');

        // Generate url with specific paginator
        $url = $element->getAttribute('href') . '?page=1&count=500';
        $this->visitPath($url);

        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Given I fill in brand filter by brand field with :brand brand
     * @param string $brand
     */
    public function iFillInBrandFilterByBrandFieldWithBrand(string $brand)
    {
        $this->spin(function (FeatureContext $context,$brand) {
            $context->iFillInTheElement(".table__filters th:nth-child(1) input", $brand);
            return true;
        },$brand);
    }

    /**
     * @Then I click on second pagination link
     */
    public function iClickOnSecondPaginationLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__table-pagination .full span:nth-child(2) a');
            return true;
        });
    }

    /**
     * @Then I click on next pagination link
     */
    public function iClickOnNextPaginationLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__table-pagination span.next a');
            return true;
        });
    }

    /**
     * @Then I click on previous pagination link
     */
    public function iClickOnPreviousPaginationLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__table-pagination span.previous a');
            return true;
        });
    }

    /**
     * @Then I click on pagination Codes menu item
     */
    public function iClickOnPaginationCodesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(3)');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on pagination Brands menu item
     */
    public function iClickOnPaginationBrandsMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(4)');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on Store menu item
     */
    public function iClickOnStoreMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(5)');
            return true;
        });
    }

    /**
     * @Then I click on Store info menu item
     */
    public function iClickOnStoreInfoMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(6)');
            return true;
        });
    }

    /**
     * @Then I click on Employees menu item
     */
    public function iClickOnEmployeesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(6)');
            return true;
        });
    }

    /**
     * @Then I click on Employees users menu item
     */
    public function iClickOnEmployeesUsersMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(7)');
            return true;
        });
    }

    /**
     * @Then I click on Shipping menu item
     */
    public function iClickOnShippingMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(7)');
            return true;
        });
    }

    /**
     * @Then I click on Activity log item
     */
    public function iClickOnActivityMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(8)');
            return true;
        });
    }

    /**
     * @Given I press on Add brand button
     */
    public function iPressOnAddBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__content.cabinet__row-element.cabinet__row-element--right.chosen-select a');
            return true;
        });
    }

    /**
     * @Then I click on brands dropdown list
     */
    public function iClickOnBrandsDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('a.chosen-single');
            return true;
        });
    }

    /**
     * @Given I select brand in brand dropdown list
     */
    public function iSelectBrandInBrandDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#partner_new_brand_input_chosen ul.chosen-results li:nth-child(3)");
            return true;
        });
        $this->iWaitMillisecondsForResponse();

        /** @var $element NodeElement */
        $element = $this->findByCssSelector('#partner-new-brand-input');
        $this->tempBrandId = $element->getValue();
    }

    /**
     * @Given I remove brand from partner brands list
     */
    public function iRemoveBrandFromPartnerBrandsList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-brand');
            return true;
        });
    }

    /**
     * @Given I press on popup Add brand button
     */
    public function iPressOnPopupAddBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#add-brand .popup__button.popup__button--add.inactive > button');
            return true;
        });
    }

    /**
     * @Given I press on popup Delete button
     */
    public function iPressOnPopupDeleteButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#confirm-brand-remove');
            return true;
        });
    }

    /**
     * @Given I follow popup Cancel link
     */
    public function iFollowPopupCancelLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#add-brand .popup__button.popup__button--cancel.popup__button--close.o-btn.cabinet-btn.cabinet-grey-btn');
            return true;
        });
    }

    /**
     * @Given I press on Send Code button
     */
    public function iPressOnSendCodeButton()
    {
        $this->iClickOnTheElement('a.o-button.o-button--filled-gold.popup-send-code-button.cabinet__popup-btn--send-code.cabinet-additional-buttons');
        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Given I fill in first name field with user name
     */
    public function iFillInFirstNameFieldWithUserName()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement("#user_firstName", 'Seller');
            return true;
        });
    }

    /**
     * @Given I fill in last name field with user surname
     */
    public function iFillInLastNameFieldWithUserName()
    {
        $this->iFillInTheElement("#user_surname", 'Seller');
    }

    /**
     * @Given I fill in email field with user email
     */
    public function iFillInEmailFieldWithUserEmail()
    {
        $this->iFillInTheElement("#user_email", FeatureContext::USER_EMAIL);
    }

    /**
     * @Given I fill in email field with random user email
     */
    public function iFillInEmailFieldWithRandUserEmail()
    {
        $this->randomEmail = "mail".random_int(1,1000000)."@gmail.com";
        $this->iFillInTheElement("#user_email", $this->randomEmail);
    }

    /**
     * @Given I fill in cellphone field with user phone
     */
    public function iFillInCellphoneFieldWithUserPhone()
    {
        $this->iFillInTheElement("#user_phone", '1234567');
    }

    /**
     * @Given I press on popup Send Code button
     */
    public function iPressOnPopupSendCodeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#code-form .popup__button.popup__button--add.popup__button--right button');
            return true;
        });
    }

    /**
     * @Given I press on Order Codes button
     */
    public function iPressOnOrderCodesButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('a.o-button.o-button--filled-gold.cabinet__popup-btn--order-codes.cabinet-additional-buttons');
            return true;
        });
    }

    /**
     * @Then I click on codes dropdown list
     */
    public function iClickOnCodesDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#partner_new_order_codes_chosen a');
            return true;
        });
    }

    /**
     * @Given I select 50 codes amount in codes dropdown list
     */
    public function iSelectCodesAmountInCodesDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#partner_new_order_codes_chosen ul li:nth-child(2)");
            return true;
        });
    }

    /**
     * @Given I select 25 codes amount in codes dropdown list
     */
    public function iSelectPhysicalCodesAmountInCodesDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("#partner_new_order_codes_chosen ul li:nth-child(1)");
            return true;
        });
    }

    /**
     * @Given I press on popup Order Code button
     */
    public function iPressOnPopupOrderCodeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#order-codes-popup .popup__button.popup__button--add.inactive button');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I should see :text text in the :element element
     * @param string $text
     * @param string $element
     */
    public function assertElementContainText(string $text, string $element)
    {
        $this->getAssertedSession()->elementTextContains('css', $element, $this->fixStepArgument($text));
    }

//    /**
//     * @Then I should see product active
//     */
//    public function iShouldSeeProductActive()
//    {
//        $this->spin(function (FeatureContext $context) {
//            $context->assertElementContainsText('Product active','table tbody tr:nth-child(1) td.state.state-6 a');
//            return true;
//        });
//    }

    /**
     * @Then I should see product active status
     */
    public function iShouldSeeProductActiveStatus()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('table tbody tr:nth-child(1) td.state.state-6');
            return true;
        });
    }

    /**
     * Get asserted session by name.
     *
     * @param string|null $name Session name
     * @return WebAssert
     */
    public function getAssertedSession(string $name = null): WebAssert
    {
        return $this->assertSession($name);
    }

    /**
     * @Then I should see an :element popup
     * @param string $element
     */
    public function assertPopupOnPage(string $element)
    {
        $this->getAssertedSession()->elementExists('css', $element);
    }

    /**
     * @Given I follow codes popup Cancel link
     */
    public function iFollowCodesPopupCancelLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#order-codes-popup .popup__button.popup__button--cancel.popup__button--close.o-btn.cabinet-btn.cabinet-grey-btn');
            return true;
        });
    }

    /**
     * @Given I close codes popup
     */
    public function iCloseCodesPopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#order-codes-success-popup div.popup__button.popup__button--cancel.popup__button--close.o-btn.cabinet-btn.cabinet-grey-btn');
            return true;
        });
    }

    /**
     * @Given I fill in code field with user code
     */
    public function iFillInCodeFieldWithUserCode()
    {
        $this->iFillCodeInFieldFromPartnerToUser("#redeem_form > input[type='email']");
    }

    /**
     * @Given  I fill in code field with affiliate sell code
     */
    public function iFillInCodeFieldWithAffliliateSellCode()
    {
        $this->iFillCodeInFieldFromAffiliateToUser("#redeem_form > input[type='email']");
    }

    /**
     * @Given I press on Activate button
     */
    public function iPressOnActivateButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#send_redeem');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click on Digital menu item
     */
    public function iClickOnDigitalMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.subitem-container li:nth-child(1)');
            return true;
        });
    }

    /**
     * @Then I click on last uploaded Digital watch
     */
    public function iClickOnLastUploadedDigitalWatch()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(1) td.watch:nth-child(3) a');
            return true;
        });
    }

    /**
     * @Then I click on Sellcode dropdown list
     */
    public function iClickOnSellcodeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#seller_codes_chosen a');
            return true;
        });
    }

    /**
     * @Then I select first Sellcode
     */
    public function iSelectFirstSellcode()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#seller_codes_chosen ul li:nth-child(2)');
            return true;
        });
    }

//    /**
//     * @Then I select last activated Sellcode
//     */
//    public function iSelectLastActivatedSellcode()
//    {
//        $this->spin(function (FeatureContext $context) {
//            $context->iFillInTheElement("#redeem_form > input[type='email']", $textCode);
//            $context->iClickOnTheElement('#seller_codes_chosen ul li:nth-child(2)');
//            return true;
//        });
//
//    }

    /**
     * @Then I fill last Sellcode in field
     */
    public function iFillLastSellcodeInField()
    {
        $this->iFillCodeInFieldFromPartnerToUser("#seller_codes_chosen div div input[type='text']");
    }

    /**
     * @Then I fill last Sellcode from affiliate in field
     */
    public function iFillLastSellcodeFromAffiliateInField()
    {
        $this->iFillCodeInFieldFromAffiliateToUser("#seller_codes_chosen div div input[type='text']");
    }

    /**
     * @Then I fill code from affiliate in field
     * @param string $selector
     */
    public function iFillCodeInFieldFromAffiliateToUser(string $selector)
    {

        /** @var UserManager $userManager */
        $userManager = $this->getSymfonyService('fos_user.user_manager');

        $creator = $userManager->findUserByEmail(FeatureContext::AFFILIATE_EMAIL);
        $receiver = $userManager->findUserByEmail(FeatureContext::USER_EMAIL);
        $this->iFillCodeInField($creator, $receiver, $selector);
    }

    /**
     * @Then I fill code in field
     * @param string $selector
     */
    public function iFillCodeInFieldFromPartnerToUser(string $selector)
    {

        /** @var UserManager $userManager */
        $userManager = $this->getSymfonyService('fos_user.user_manager');

        $creator = $userManager->findUserByEmail(FeatureContext::PARTNER_EMAIL);
        $receiver = $userManager->findUserByEmail(FeatureContext::USER_EMAIL);
        $this->iFillCodeInField($creator, $receiver, $selector);
    }

    public function iFillCodeInField($creator, $receiver, $selector) {
        /** @var EntityManager $em */
        $em = $this->getSymfonyService('doctrine.orm.entity_manager');

        $code = $em->getRepository('OmnivalorUserBundle:Code')->findOneBy(
            [
                'creator' => $creator,
                'receiver'  => $receiver
            ], ['created' => 'desc']
        );
        $textCode = $code->getCode();

        $this->iFillInTheElement($selector, $textCode);
    }


    /**
     * @Then I select continue new product
     */
    public function iSelectContinueNewProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $selector = '.state.state-1 a';
            $context->getSession()->executeScript("window.location.href = $('$selector').attr('href');");
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I select active product
     */
    public function iSelectActiveProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $selector = '.state.state-6 a';
            $context->getSession()->executeScript("window.location.href = $('$selector').attr('href');");
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I should see a :product product
     * @param string $product
     */
    public function assertProductOnPage(string $product)
    {
        $this->spin(function (FeatureContext $context, $product) {
            $context->assertSession()->elementExists('css', $product);
            return true;
        }, $product);
    }

    /**
     * @Then I click on admin Codes menu item
     */
    public function iClickOnAdminCodesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.cabinet__sidebar.cabinet__row-element.cabinet__row-element--left.partner-sidebar ul li:nth-child(9) a');
            return true;
        });
   }

    /**
     * @Then I click on agree button
     */
    public function iClickOnAgreeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__td--righted.table__td--last div.table__button-container:nth-child(1) a');
            return true;
        });
    }

    /**
     * @Then I click on no sent button
     */
    public function iClickOnNoSentButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(1) td:nth-child(8) a');
            return true;
        });
    }

    /**
     * @Then I click on source all dropdown list
     */
    public function iClickOnSourceAllDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(6) div a');
            $context->assertElementContains('.table__filters th:nth-child(6)','chosen-with-drop');
            return true;
        });
    }

    /**
     * @Then I click on digital option
     */
    public function iClickOnDigitalOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(6) div div ul li:nth-child(2)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I click on physical option
     */
    public function iClickOnPhysicalOption()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.table__filters th:nth-child(6) div div ul li:nth-child(3)');
            return true;
        });
        $this->assertElementOnPage('tbody .table__row');
    }

    /**
     * @Then I should not see Send Codes Button
     */
    public function iShouldNotSeeSendCodesButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('a.o-button.o-button--filled-gold.popup-send-code-button.cabinet__popup-btn--send-code.cabinet-additional-buttons');
            return true;
        });
    }

    /**
     * @Then I should see Send Codes Button
     */
    public function iShouldSeeSendCodesButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('a.o-button.o-button--filled-gold.popup-send-code-button.cabinet__popup-btn--send-code.cabinet-additional-buttons');
            return true;
        });
    }

    /**
     * @Then I should not see Order Codes Button
     */
    public function iShouldNotSeeOrderCodesButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('a.o-button.o-button--filled-gold.cabinet__popup-btn--order-codes.cabinet-additional-buttons');
            return true;
        });
    }

    /**
     * @Then I should see Order Codes Button
     */
    public function iShouldSeeOrderCodesButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('a.o-button.o-button--filled-gold.cabinet__popup-btn--order-codes.cabinet-additional-buttons');
            return true;
        });
    }

    /**
     * @Then I click on employee Brands menu item
     */
    public function iClickOnEmployeeBrandsMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(4)');
            return true;
        });
    }

    /**
     * @Then I should not see Add Brand Button
     */
    public function iShouldNotSeeAddBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.cabinet-table__button.o-button.o-button--filled-gold.cabinet__popup-btn--add-brand');
            return true;
        });
    }

    /**
     * @Then I should see Add Brand Button
     */
    public function iShouldSeeAddBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.cabinet-table__button.o-button.o-button--filled-gold.cabinet__popup-btn--add-brand');
            return true;
        });
    }

    /**
     * @Then I should not see Delete brand Button
     */
    public function iShouldNotSeeDeleteBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-brand');
            return true;
        });
    }

    /**
     * @Then I should see Delete brand Button
     */
    public function iShouldSeeDeleteBrandButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-brand');
            return true;
        });
    }

    /**
     * @Then I should not see editing store address icon
     */
    public function iShouldNotSeeEditingStoreAddressIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.store-info-popup-btn.address-popup-btn i');
            return true;
        });
    }

    /**
     * @Then I should see editing store address icon
     */
    public function iShouldSeeEditingStoreAddressIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.store-info-popup-btn.address-popup-btn i');
            return true;
        });
    }

    /**
     * @Then I should not see editing store hours icon
     */
    public function iShouldNotSeeEditingStoreHoursIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.store-info-popup-btn.hours-edit i');
            return true;
        });
    }

    /**
     * @Then I should see editing store hours icon
     */
    public function iShouldSeeEditingStoreHoursIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.store-info-popup-btn.hours-edit i');
            return true;
        });
    }

    /**
     * @Then I should not see Add Employee Button
     */
    public function iShouldNotSeeAddEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.o-button.o-button--filled-gold.cabinet-table__button.cabinet__popup-btn--add-employee');
            return true;
        });
    }

    /**
     * @Then I should see Add Employee Button
     */
    public function iShouldSeeAddEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.o-button.o-button--filled-gold.cabinet-table__button.cabinet__popup-btn--add-employee');
            return true;
        });
    }

    /**
     * @Then I should not see Delete Employee Button
     */
    public function iShouldNotSeeDeleteEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-employee');
            return true;
        });
    }

    /**
     * @Then I should see Delete Employee Button
     */
    public function iShouldSeeDeleteEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-employee');
            return true;
        });
    }

    /**
     * @Then I should not see Active Log menu item
     */
    public function iShouldNotSeeActiveLogMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.cabinet__sidebar.cabinet__row-element.cabinet__row-element--left.partner-sidebar div ul li:nth-child(8)');
            return true;
        });
    }

    /**
     * @Then I should see Active Log menu item
     */
    public function iShouldSeeActiveLogMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.cabinet__sidebar.cabinet__row-element.cabinet__row-element--left.partner-sidebar div ul li:nth-child(8)');
            return true;
        });
    }

    /**
     * @Then I should not see continue new product
     */
    public function iShouldNotSeeContinueNewProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.state.state-1 a');
            return true;
        });
    }

    /**
     * @Then I should see continue new product
     */
    public function iShouldSeeContinueNewProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.state.state-1 a');
            return true;
        });
    }

    /**
     * @Then I should not see continue verified product
     */
    public function iShouldNotSeeContinueVerifiedProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementNotOnPage('.state.state-3 a');
            return true;
        });
    }

    /**
     * @Then I should see continue verified product
     */
    public function iShouldSeeContinueVerifiedProduct()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.state.state-3 a');
            return true;
        });
    }

    /**
     * @Then I should see product active link
     */
    public function iShouldSeeProductActiveLink()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.state.state-6 a');
            return true;
        });
    }

    /**
     * @Then I click on employee Codes menu item
     */
    public function iClickOnEmployeeCodesMenuItem()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('ul.menu__wrapper > li:nth-child(3)');
            return true;
        });
    }

    /**
     * @Then I click editing store hours icon
     */
    public function iClickEditingStoreHoursIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.store-info-popup-btn.hours-edit i');
            return true;
        });
    }

    /**
     * @Then I set opening hours randomly
     */
    public function iSetOpeningHoursRandomly()
    {
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_open');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_breakFrom');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_breakTo');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_close');
        $this->clickOnSelectElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_close');
    }

    public function clickOnSelectElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getRandomChildSelector($selector, $min = 2, $max = 34) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I click save hours button
     */
    public function iClickSaveHoursButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#savehours');
            return true;
        });
    }

    /**
     * @Then I should see invalid time error
     */
    public function iShouldSeeInvalidTimeError()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.invalid-time');
            return true;
        });
    }

    /**
     * @Then I set opening hours
     */
    public function iSetOpeningHours()
    {
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_open');
        $this->clickOnSelectOpenElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_open');
    }

    public function clickOnSelectOpenElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getOpenRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getOpenRandomChildSelector($selector, $min = 2, $max = 16) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I set break start hours
     */
    public function iSetBreakStartHours()
    {
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_breakFrom');
        $this->clickOnSelectBreakStartElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_breakFrom');
    }

    public function clickOnSelectBreakStartElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getBreakStartRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getBreakStartRandomChildSelector($selector, $min = 17, $max = 18) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I set break end hours
     */
    public function iSetBreakEndHours()
    {
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_breakTo');
        $this->clickOnSelectBreakEndElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_breakTo');
    }

    public function clickOnSelectBreakEndElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getBreakEndRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getBreakEndRandomChildSelector($selector, $min = 19, $max = 20) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I set close hours
     */
    public function iSetCloseHours()
    {
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_0_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_1_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_2_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_3_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_4_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_close');
        $this->clickOnSelectCloseElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_close');
    }

    public function clickOnSelectCloseElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getCloseRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getCloseRandomChildSelector($selector, $min = 21, $max = 34) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I set none opening hours
     */
    public function iSetNoneOpeningHours()
    {
        $this->clickOnSelectNoneElement('#omnivalor_userbundle_partner_opening_hours_openingHours_5_open');
        $this->clickOnSelectNoneElement('#omnivalor_userbundle_partner_opening_hours_openingHours_6_open');
    }

    public function clickOnSelectNoneElement($selectSelector) {
        $this->spin(function (FeatureContext $context) use ($selectSelector) {
            $context->iClickOnTheElement($selectSelector);
            return true;
        });

        $class = $this;
        $this->spin(function (FeatureContext $context) use ($class, $selectSelector) {
            $context->iClickOnTheElement(
                $selectSelector . ' ' . $class->getNoneRandomChildSelector('option')
            );
            return true;
        });
    }

    public function getNoneRandomChildSelector($selector, $min = 1, $max = 1) {
        $childNumber = mt_rand($min, $max);
        return "$selector:nth-child($childNumber)";
    }

    /**
     * @Then I click editing store info icon
     */
    public function iClickEditingStoreInfoIcon()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.store-info-popup-btn.address-popup-btn i');
            return true;
        });
    }

    /**
     * @Then I should see edit address popup
     */
    public function iShouldSeeEditAddressPopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.popup__wrapper.popup__wrapper--full.popup--edit-address.omni-inputs');
            return true;
        });
    }

    /**
     * @Given I fill in form company name field with :company company
     * @param string $company
     */
    public function iFillInFormCompanyNameFieldWithCompany(string $company)
    {
        $this->iFillInTheElement("#form_user_companyName", $company);
    }

    /**
     * @Given I fill in form webpage field with :webpage webpage
     * @param string $webpage
     */
    public function iFillInFormWebpageFieldWithWebpage(string $webpage)
    {
        $this->iFillInTheElement("#form_user_webpage", $webpage);
    }

    /**
     * @Given I fill in form email field with :email email
     * @param string $email
     */
    public function iFillInFormEmailFieldWithEmail(string $email)
    {
        $this->iFillInTheElement("#form_user_email", $email);
    }

    /**
     * @Given I fill in form address field with :address address
     * @param string $address
     */
    public function iFillInFormAddressFieldWithAddress(string $address)
    {
        $this->iFillInTheElement("#form_address_street", $address);
    }

    /**
     * @Given I fill in form city field with :city city
     * @param string $city
     */
    public function iFillInFormCityFieldWithCity(string $city)
    {
        $this->iFillInTheElement("#form_address_city", $city);
    }

    /**
     * @Given I fill in form region field with :region region
     * @param string $region
     */
    public function iFillInFormRegionFieldWithRegion(string $region)
    {
        $this->iFillInTheElement("#form_address_region", $region);
    }

    /**
     * @Given I fill in form zip field with :zip zip
     * @param string $zip
     */
    public function iFillInFormZipFieldWithZip(string $zip)
    {
        $this->iFillInTheElement("#form_address_zip", $zip);
    }

    /**
     * @Given I fill in form store phone field with :phone phone
     * @param string $phone
     */
    public function iFillInFormStorePhoneFieldWithPhone(string $phone)
    {
        $this->iFillInTheElement("#form_address_phone", $phone);
    }

    /**
     * @Given I fill in form personal phone field with :phone phone
     * @param string $phone
     */
    public function iFillInFormPersonalPhoneFieldWithPhone(string $phone)
    {
        $this->iFillInTheElement("#form_address_phone", $phone);
    }

    /**
     * @Then I click on form country dropdown list
     */
    public function iClickOnFormCountryDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#form_address_country_chosen a');
            return true;
        });
    }

    /**
     * @Then I select Sweden in country dropdown list
     */
    public function iSelectSwedenInCountryDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#form_address_country_chosen div ul li:nth-child(208)');
            return true;
        });
    }

    /**
     * @Then I select Afghanistan in country dropdown list
     */
    public function iSelectAfghanistanInCountryDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#form_address_country_chosen div ul li:nth-child(1)');
            return true;
        });
    }

    /**
     * @Then I click save store info button
     */
    public function iClickSaveStoreInfoButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#form_save');
            return true;
        });
    }

    /**
     * @Then I select first employee
     */
    public function iSelectFirstEmployee()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table tbody tr:nth-child(1) td:nth-child(1) span');
            return true;
        });
    }

    /**
     * @Then I should see edit employee popup
     */
    public function iShouldSeeEditEmployeePopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.popup__wrapper.popup--edit-employee');
            return true;
        });
    }

    /**
     * @Then I click add employee button
     */
    public function iClickAddEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('a.o-button.o-button--filled-gold.cabinet-table__button.cabinet__popup-btn--add-employee');
            return true;
        });
    }

    /**
     * @Then I should see add employee popup
     */
    public function iShouldSeeAddEmployeePopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.popup__wrapper.popup--add-employee');
            return true;
        });
    }

    /**
     * @Given I fill in employee first name field with :name name
     * @param string $name
     */
    public function iFillInEmployeeFirstNameFieldWithName(string $name)
    {
        $this->spin(function (FeatureContext $context, $name) {
            $context->iFillInTheElement("#omnivalor_admin_user_firstName", $name);
            return true;
        }, $name);
    }

    /**
     * @Given I fill in edit employee first name field with :name name
     * @param string $name
     */
    public function iFillInEditEmployeeFirstNameFieldWithName(string $name)
    {
        $this->spin(function (FeatureContext $context, $name) {
            $context->iFillInTheElement("#edit-employee #omnivalor_admin_user_firstName", $name);
            return true;
        }, $name);
    }

    /**
     * @Given I fill in employee last name field with :name name
     * @param string $name
     */
    public function iFillInEmployeeLastNameFieldWithName(string $name)
    {
        $this->iFillInTheElement("#omnivalor_admin_user_surname", $name);
    }

    /**
     * @Given I fill in edit employee last name field with :name name
     * @param string $name
     */
    public function iFillInEditEmployeeLastNameFieldWithName(string $name)
    {
        $this->iFillInTheElement("#edit-employee #omnivalor_admin_user_surname", $name);
    }

    /**
     * @Given I fill in employee email field with :email email
     * @param string $email
     */
    public function iFillInEmployeeEmailFieldWithEmail(string $email)
    {
        $this->iFillInTheElement("#omnivalor_admin_user_email", $email);
    }

    /**
     * @Given I fill random email in employee email field
     */
    public function iFillRandomEmailInEmployeeEmailField()
    {
        $randomAlias = uniqid('', true);
        $fullEmail = $randomAlias . "@" ."gmail.com";
        $this->iFillInTheElement("#omnivalor_admin_user_email", $fullEmail);
    }

    /**
     * @Given I fill random email in edit store info popup
     */
    public function iFillRandomEmailInEditStoreInfoPopup()
    {
        $randomAlias = uniqid('', true);
        $fullEmail = $randomAlias . "@" ."gmail.com";
        $this->iFillInTheElement("#form_user_email", $fullEmail);
    }

    /**
     * @Given I fill edit random email in employee email field
     */
    public function iFillEditRandomEmailInEmployeeEmailField()
    {
        $randomAlias = uniqid('', true);
        $fullEmail = $randomAlias . "@" ."gmail.com";
        $this->iFillInTheElement("#edit-employee #omnivalor_admin_user_email", $fullEmail);
    }

    /**
     * @Given I fill in employee phone field with :phone phone
     * @param string $phone
     */
    public function iFillInEmployeePhoneFieldWithPhone(string $phone)
    {
        $this->iFillInTheElement("#omnivalor_admin_user_phone", $phone);
    }

    /**
     * @Given I fill in edit employee phone field with :phone phone
     * @param string $phone
     */
    public function iFillInEditEmployeePhoneFieldWithPhone(string $phone)
    {
        $this->iFillInTheElement("#edit-employee #omnivalor_admin_user_phone", $phone);
    }

    /**
     * @Then I click form add employee button
     */
    public function iClickFormAddEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#add-employee-form .popup__row.popup__row--buttons .popup__button.popup__button--add.popup__button--right button');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Given I fill in employee name filter field with name
     */
    public function iFillInEmployeeNameFilterFieldWithName()
    {
        $this->iFillInTheElement("table thead tr.table__filters th:nth-child(1) input", 'Test Test');
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Given I fill in employee name filter field with edited name
     */
    public function iFillInEmployeeNameFilterFieldWithEditedName()
    {
        $this->iFillInTheElement("table thead tr.table__filters th:nth-child(1) input", 'TestEdited TestEdited');
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I click delete employee button
     */
    public function iClickDeleteEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('a.table__remove-button.cabinet__popup-btn.cabinet__popup-btn--remove-employee');
            return true;
        });
    }

    /**
     * @Then I should see remove employee popup
     */
    public function iShouldSeeRemoveEmployeePopup()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('.popup__wrapper.popup--remove-employee');
            return true;
        });
    }

    /**
     * @Then I click remove employee button
     */
    public function iClickRemoveEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#confirm-employee-remove');
            return true;
        });
    }

    /**
 * @Then I click save edit employee button
 */
    public function iClickSaveEditEmployeeButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.popup__button.popup__button--edit.popup__button--right button');
            return true;
        });
    }

    /**
 * @Then I click name employee dropdown list
 */
    public function iClickNameEmployeeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            /** @var PartnerCenterContext $context */
            $context->iClickOnTheElement('table thead tr.table__header th:nth-child(1) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I click email employee dropdown list
     */
    public function iClickEmailEmployeeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table thead tr.table__header th:nth-child(2) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I click role employee dropdown list
     */
    public function iClickRoleEmployeeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('table thead tr.table__header th:nth-child(4) a');
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY/2);
    }

    /**
     * @Then I check employee name sorting order with :mode
     * @param string $mode
     */
    public function iCheckEmployeeNameSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--employee .table__row .o-button--linkable', $mode);
    }

    /**
     * @Then I check employee role sorting order with :mode
     * @param string $mode
     */
    public function iCheckEmployeeRoleSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--employee .table__row td:nth-child(4)', $mode);
    }

    /**
     * @Then I check employee email sorting order with :mode
     * @param string $mode
     */
    public function iCheckEmployeeEmailSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--employee .table__row .table__td--link.edit-employee ', $mode);
    }

    /**
     * @param $selector
     * @param $mode
     * @param $type
     * @throws \Exception
     */
    public function checkSortingOrderBySelector($selector, $mode, $type = 'string')
    {
        if ($this->checkSortingOrder($selector, $mode, $type)) {
            throw new \Exception(sprintf('There should be such mode %s of ordering for selector %s', $mode, $selector));
        }
    }

    /**
     * Check order of list element
     *
     * @param $selector
     * @param string $mode
     * @param string $type
     * @return bool
     * @throws \Exception
     */
    public function checkSortingOrder($selector, $mode = 'ASC', $type = 'string')
    {
        /** @var NodeElement[] $list */
        $list = $this->findAllByCssSelector($selector);
        /** @var NodeElement $element */
        for ($i = 0; $i < count($list) - 1; $i++) {

            if ($type === 'string') {
                $cmp = strcmp($list[$i]->getText(), $list[$i + 1]->getText());
                if (($mode === 'ASC' && $cmp < 0) || ($mode === 'DESC' && $cmp > 0)) {
                    return false;
                }
            } else if ($type === 'date') {
                $first = \DateTime::createFromFormat('Y-m-d', $list[$i]->getText());
                $second = \DateTime::createFromFormat('Y-m-d', $list[$i + 1]->getText());

                if ($first === false) {
                    throw new \Exception(sprintf('Such value "%s" is not valid date string', $list[$i]->getText()));
                }

                if ($second === false) {
                    throw new \Exception(sprintf('Such value "%s" is not valid date string', $list[$i+1]->getText()));
                }

                $cmp = $first->getTimestamp() - $second->getTimestamp();
                if (($mode === 'ASC' && $cmp < 0) || ($mode === 'DESC' && $cmp > 0)) {
                    return false;
                }
            } else {
                throw new \Exception(sprintf('Type %s not implemented', $type));
            }
        }
        return true;
    }

    /**
     * @Then I check product date sorting order with :mode
     * @param string $mode
     */
    public function iCheckProductDateSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--sales .table__row .watch:first-child ', $mode, 'date');
    }

    /**
     * @Then I check product state sorting order with :mode
     * @param string $mode
     */
    public function iCheckProductStateSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--sales .table__row .state', $mode);
    }

    /**
     * @Then I check product watch sorting order with :mode
     * @param string $mode
     */
    public function iCheckProductWatchSortingOrderWith(string $mode)
    {
        $this->checkSortingOrderBySelector('.cabinet__table.table.table--sales .table__row .watch a', $mode);
    }

    /**
     * @Given I fill in employee filter by name field with :name name
     * @param string $name
     */
    public function iFillInEmployeeFilterByNameFieldWithName(string $name)
    {
        $this->spin(function (FeatureContext $context,$name) {
            $context->iFillInTheElement(".table__filters th:nth-child(1) input", $name);
            return true;
        },$name);
    }

    /**
     * @Given I clean employee name filter
     */
    public function iCleanEmployeeNameFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(1) input", '');
            return true;
        });
    }

    /**
     * @Given I fill in employee filter by email field with :email email
     * @param string $email
     */
    public function iFillInEmployeeFilterByEmailFieldWithName(string $email)
    {
        $this->spin(function (FeatureContext $context,$email) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", $email);
            return true;
        },$email);
    }

    /**
     * @Given I fill in employee filter by cellphone field with :phone phone
     * @param string $phone
     */
    public function iFillInEmployeeFilterByCellphoneFieldWithName(string $phone)
    {
        $this->spin(function (FeatureContext $context,$phone) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", $phone);
            return true;
        },$phone);
    }

    /**
     * @Given I clean employee email filter
     */
    public function iCleanEmployeeEmailFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(2) input", '');
            return true;
        });
    }

    /**
     * @Given I clean employee cellphone filter
     */
    public function iCleanEmployeeCellphoneFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iFillInTheElement(".table__filters th:nth-child(3) input", '');
            return true;
        });
    }

    /**
     * @Then I should see New code status in table
     */
    public function iShouldSeeNewCodeStatusInTable()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementContainsText("table tbody tr:nth-child(1) td:nth-child(8)", 'New');
            return true;
        });
    }

    /**
     * @Then I should see Active code status in table
     */
    public function iShouldSeeActiveCodeStatusInTable()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementContainsText("table tbody tr:nth-child(1) td:nth-child(8)", 'Active');
            return true;
        });
    }

    /**
     * @Then I should see Used code status in table
     */
    public function iShouldSeeUsedCodeStatusInTable()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementContainsText("table tbody tr:nth-child(1) td:nth-child(8)", 'Used');
            return true;
        });
    }

    /**
     * @Then I should see email error
     */
    public function iShouldSeeEmailError()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('#add-employee-form .form-container div:nth-child(3) ul li');
            return true;
        });
    }

    /**
     * @Then I should see phone error
     */
    public function iShouldSeePhoneError()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertPopupOnPage('#add-employee-form .form-container div:nth-child(4) ul li');
            return true;
        });
    }

    /**
     * @Given I fill in refferense number field with :serialnum number
     * @param string $refcode
     */
    public function iFillInReffNumberFieldWith(string $refcode)
    {
        $this->iFillInTheElement("#pr_main2_reference", $refcode);
    }

    /**
     * @Given I fill in serial number field with :serialnum number
     * @param string $serialNum
     */
    public function iFillInSerialNumberFieldWith(string $serialNum)
    {
        $this->iFillInTheElement("#pr_main2_articular", $serialNum);
    }

    /**
     * You should enter <select> id for select
     * @Given I select production year :prodYear at first upload step
     * @param string $prodYear
     * @internal param string $movement
     */
    public function iSelectProductionYearAtFirstStep(string $prodYear)
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnNextSelector('#pr_main2_year');
            return true;
        });
        $this->spin(function (FeatureContext $context,$prodYear) {
            $context->iFillInSearchFieldInSelectWith('#pr_main2_year',$prodYear);
            return true;
        },$prodYear);
    }

    /**
     * @Given I fill in waterproof field with :meters meters
     * @param string $meters
     */
    public function iFillInWaterproofFieldWith(string $meters)
    {
        $this->iFillInTheElement('#pr_main2_waterproof', $meters);
    }

    /**
     * @Given I select bezel size :bezelsize at first upload step
     * @param string $bezelSize
     */
    public function iSelectBezelSizeAtFirstUploadStep(string $bezelSize)
    {
        $this->iClickOnNextSelector('#pr_main2_caseSize');
        $this->iFillInSearchFieldInSelectWith('#pr_main2_caseSize', $bezelSize);
    }

    /**
     * @Given I fill in price field with price
     */
    public function iFillInPriceFieldWith()
    {
        $randomPrice = $this->randomPrice = (string) random_int(10000,990000);

        $this->spin(function (FeatureContext $context,$randomPrice ) {
            $context->iFillInTheElement("#target", $randomPrice);
            return true;
        },$randomPrice);
    }

    /**
     * @Then I should see success activation popup
     */
    public function iShouldSeeSuccessActivationPopup()
    {
        $this->spin(function (FeatureContext $context) {
            return $context->findByCssSelector('#successfully-activated-popup')->isVisible();
        });
    }

    /**
     * @Then I click on done button
     */
    public function iClickOnDoneButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.popup__body .o-button.o-button--filled-gold');
            return true;
        });
        $this->iWaitMillisecondsForResponse();
    }
    /**
     * @Then I click on Activate button
     */
    public function iClickOnActivateButton()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('#activate-button');
            return true;
        });
    }

    /**
     * @Given I fill in select brand field with :brand brand
     * @param string $brand
     */
    public function iFillInSelectBrandFieldWith(string $brand)
    {
        $this->spin(function (FeatureContext $context, $brand) {
            $context->iFillInTheElement("[placeholder='Search brands']",$brand);
            return true;
        },$brand);
    }

    /**
     *@Given I click on first found brand
     */
    public function iClickOnFirstFoundBrand() {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement(".sol-option:not(.sol-filtered-search) .sol-label");
            return true;
        });
        $this->iWaitMillisecondsForResponse();

    }

    /**
     * @Given I fill in select model field with :model model
     */
    public function iFillInSelectModelFieldWith(string $model)
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement("[placeholder='All models']");
            return true;
        },$model);

        $this->spin(function (FeatureContext $context, $model) {
            $context->iFillInTheElement("[placeholder='All models']",$model);
            return true;
        },$model);
    }

    /**
     *@Given I click on first found model
     */
    public function iClickOnFirstFoundModel() {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.sol-select.sol-active.sol-selection-bottom .sol-option:not(.sol-filtered-search) .sol-label');
            return true;
        });
    }

    /**
     * @Given I should see :subject in subject activity log
     * @param string $subject
     */
    public function iShouldSeeInSubjectActivityLog(string $subject) {
        $this->spin(function (FeatureContext $context, string $subject) {
            $context->assertElementContains('tbody tr td.subject', $subject);
            return true;
        },$subject);
    }

    /**
     *@Given I should see :activity in activity column activity log
     */
    public function iShouldSeeInActivityColumnActivityLog(string $activity) {
        $this->spin(function (FeatureContext $context, string $activity) {
            $context->assertElementContains('tbody tr td.activity', $activity);
            return true;
        },$activity);
    }

    /**
     *@Given I should see :source in source column codes page
     */
    public function iShouldSeeInSourceColumnCodesPage(string $source) {
        $this->spin(function (FeatureContext $context, string $source) {
            $context->assertElementContains('tbody tr td.source', $source);
            return true;
        },$source);
    }

    /**
     *@Given I click on send code button
     */
    public function iClickOnSendCodeButton() {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.affiliate-send-code');
            return true;
        });
    }

}