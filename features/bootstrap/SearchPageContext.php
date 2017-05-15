<?php declare(strict_types = 1);

namespace omnivalor\behat;
use Behat\Mink\Session;

/**
 * Created by PhpStorm.
 * Date: 27.12.2016
 * Time: 16:24
 */

trait SearchPageContext
{
    /**
     * @Given I click on show filters link
     */
    public function iClickOnShowFiltersLink()
    {
        $this->iClickOnTheElement('#select-filters label[for="filters_info__btn-id"]');
    }

    /**
     * @Given I select brand in dropdown list
     */
    public function iSelectBrandInDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement(".sol-selection div:nth-child(5)");
            return true;
        });
    }

    /**
     * @Given I minimize dropdown list
     */
    public function iMinimizeDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement(".sol-caret-container");
            return true;
        });
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Given I press on search button in filter
     */
    public function iPressOnSearchButtonInFilter()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.filters_info__content_footer_search_and_clear button');
            return true;
        });
    }

    /**
     * @Given I click on clear filters link
     */
    public function iClickOnClearFiltersLink()
    {
        $this->iClickOnTheElement('.filters_info__content_footer_search_and_clear i');
    }

    /**
     * @Then I should see selected search prototype
     */
    public function iShouldSeeSelectedSearchPrototype()
    {
        $this->assertElementOnPage('.select-filter-container span');
    }

    /**
     * @Given I open filter dropdown model list
     */
    public function iOpenFilterDropdownModelList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.filters_info__content__left > div:nth-child(2) .sol-inner-container .sol-caret-container');
            return true;
        });
    }

    /**
     * @Given I select model in dropdown list
     */
    public function iSelectModelInDropdownList()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iClickOnTheElement('.filters_info__content__left > div:nth-child(2) .sol-selection-container .sol-selection > div:nth-child(1)');
            return true;
        });
    }

    /**
     * @Given I open filter dropdown case list
     */
    public function iOpenFilterDropdownCaseList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(3) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select case in dropdown list
     */
    public function iSelectCaseInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(3) .sol-selection-container .sol-selection > div:nth-child(1)');
    }

    /**
     * @Given I open filter dropdown color list
     */
    public function iOpenFilterDropdownColorList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(4) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select dial color in dropdown list
     */
    public function iSelectDialColorInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(4) .sol-selection-container .sol-selection > div:nth-child(2)');
    }

    /**
     * @Given I open filter dropdown bracelet material list
     */
    public function iOpenFilterDropdownBraceletMaterialList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(5) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select bracelet material in dropdown list
     */
    public function iSelectBraceletMaterialInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(5) .sol-selection-container .sol-selection > div:nth-child(3)');
    }

    /**
     * @Given I open filter dropdown bracelet color list
     */
    public function iOpenFilterDropdownBraceletColorList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(6) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select bracelet color in dropdown list
     */
    public function iSelectBraceletColorInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(6) .sol-selection-container .sol-selection > div:nth-child(3)');
    }

    /**
     * @Given I open filter dropdown movement list
     */
    public function iOpenFilterDropdownMovementList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(7) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select movement in dropdown list
     */
    public function iSelectMovementInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(7) .sol-selection-container .sol-selection > div:nth-child(1)');
    }

    /**
     * @Given I open filter dropdown complications list
     */
    public function iOpenFilterDropdownComplicationsList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(8) .sol-inner-container .sol-caret-container');
    }

    /**
     * @Given I select complication in dropdown list
     */
    public function iSelectComplicationInDropdownList()
    {
        $this->iClickOnTheElement('.filters_info__content__left > div:nth-child(8) .sol-selection-container .sol-selection > div:nth-child(1)');
    }

    /**
     * @Given /^I set range for input "([^"]*)" with value "([^"]*)" and input "([^"]*)" with value "([^"]*)"$/
     * @param $inputName1
     * @param $inputValue1
     * @param $inputName2
     * @param $inputValue2
     */
    public function iSetRangeForTwoInputs($inputName1, $inputValue1, $inputName2, $inputValue2)
    {
        // Set input type hidden value via javascript
        // TODO Fix it
        /** @var Session $session */
        $session = $this->getSession();
        $session->executeScript("$('.filters_info__content__right input[name=\"$inputName1\"]').val($inputValue1);");
        $session->executeScript("$('.filters_info__content__right input[name=\"$inputName2\"]').val($inputValue2);");

        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Then I should see No products displayed text
     */
    public function iShouldSeeNoProductsDisplayedText()
    {
        $this->assertElementOnPage('#product-async-container h5');
    }

}
