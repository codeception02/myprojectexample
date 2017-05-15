Feature: Partner page

  Background:
    Given I am on the homepage
    Given I set browser window size to "1920" x "950"

  Scenario: Partner should be able to click menu items C159
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Company Sales menu item
    And I should be on "/partner/sales/"
    And I click on pagination Codes menu item
    And I should be on "/partner/codes/"
    And I click on pagination Brands menu item
    And I should be on "/partner/brand/"
    And I click on Store menu item
    And I should be on "/partner/store/"
    And I click on Employees menu item
    And I should be on "/partner/employee/"
    And I click on Shipping menu item
    And I should be on "/partner/shipping/"

  Scenario: Partner should be able to verify product walkin C197
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Arnold" at first upload step
    And I select model "Harmony" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I press continue
    And I copy verification code
    And I log out
    And I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    When I click on verify button
    Then I fill in code field with verification code
    Then I click on popup verify button
    And I click on verify product button

  Scenario: Partner should be able to deny product walkin verification C196
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Arnold" at first upload step
    And I select model "Harmony" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I press continue
    And I copy verification code
    And I log out
    And I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    When I click on verify button
    Then I fill in code field with verification code
#    And I press "Verifiera"
    Then I click on popup verify button
    And I fill in comment textarea
    And I click on comment button
    And I click on deny button

  Scenario: Partner should be able to view ad and edit information about walkin product C198
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Arnold" at first upload step
    And I select model "Harmony" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I press continue
    And I copy verification code
    And I log out
    And I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    When I click on verify button
    Then I fill in code field with verification code
    Then I click on popup verify button
    Then I click on view ad button
    And I click on go back button
    Then I click on edit model button
    And I click on editing dropdown list
    And I select model in editing dropdown list
    And I press "SAVE"
    Then I click on edit serial number button
    And I fill in SN field with edited SN
    And I press on save SN button
    Then I click on edit reference number button
    And I fill in RN field with edited RN
    And I press on save RN button
    Then I follow cancel link
    And I should be on "/partner/verify"

  Scenario: Partner should be able to digitally-verify product C204
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Baume & Mercier" at first upload step
    And I select model "Classima" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I click on yes purchase button
    And I click on purchased city dropdown list
    And I fill in purchased city field with "Vasastan" city
    And I click on retailer dropdown list
    And I fill in retailer field with "Nazarenklock" retailer
    And I click on purchased date dropdown list
    And I fill in purchased date field with "2" date
    And I press "Add"
    And I press "continue"
    And I log out
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Digital menu item
    And I click on last uploaded Digital watch
    And I click on verify product button

  Scenario: Partner should be able to deny digital verification C230
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Baume & Mercier" at first upload step
    And I select model "Classima" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I click on yes purchase button
    And I click on purchased city dropdown list
    And I fill in purchased city field with "Vasastan" city
    And I click on retailer dropdown list
    And I fill in retailer field with "Nazarenklock" retailer
    And I click on purchased date dropdown list
    And I fill in purchased date field with "2" date
    And I press "Add"
    And I press "continue"
    And I log out
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Digital menu item
    And I click on last uploaded Digital watch
    And I fill in comment textarea
    And I click on comment button
    And I click on deny button

  Scenario: Partner should be able to sort and filter products C207 C210
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on date dropdown list
#    And I check product date sorting order with "ASC"
    And I click on date dropdown list
#    And I check product date sorting order with "DESC"
    And I click on name dropdown list
    And I click on name dropdown list
    And I click on watch dropdown list
    And I check product watch sorting order with "DESC"
    And I click on watch dropdown list
    And I check product watch sorting order with "ASC"
    And I click on State dropdown list
    And I check product state sorting order with "ASC"
    And I click on State dropdown list
    And I click on Verified dropdown list
    And I click on Verified dropdown list
    And I fill in filter by date field with "2017-01-10" date
    And I clean filter date field
    And I fill in filter by name field with "Alejandro Nazario" name
    And I clean filter name field
    And I fill in filter by watch field with "Rado Sintra" watch
    And I clean filter watch field

#  Scenario: Partner should be able to filter products by all states and statuses C211 C212
#    When I am on "/login-partner"
#    And I log in as partner
#    And I should be on "/partner"
#    And I click on All dropdown list
#    And I click on Incomplete upload option
#    And I click on All dropdown list
#    And I click on Active option
#    And I click on All dropdown list
#    And I click on Sold option
#    And I click on All dropdown list
#    And I click on In transit to omnivalor option
#    And I click on All dropdown list
#    And I click on In transit to buyer option
#    And I click on All dropdown list
#    And I click on Received by buyer option
#    And I click on All dropdown list
#    And I click on All option
#    And I click on All verified dropdown list
#    And I click on Yes option
#    And I click on All verified dropdown list
#    And I click on No option
#    And I click on All verified dropdown list
#    And I click on Denied option

#  Scenario: Partner should be able to filter sales by all states and statuses C217 C218
#    When I am on "/login-partner"
#    And I log in as partner
#    And I should be on "/partner"
#    And I click on Company Sales menu item
#    And I click on All dropdown list
#    And I click on Incomplete upload option
#    And I should see table row
#    And I click on All dropdown list
#    And I click on Active option
#    And I should see table row
#    And I click on All dropdown list
#    And I click on Sold option
#    And I should see table row
#    And I click on All dropdown list
#    And I click on In transit to omnivalor option
#    And I should see table row
#    And I click on All dropdown list
#    And I click on In transit to buyer option
#    And I should not see table row
#    And I click on All dropdown list
#    And I click on Received by buyer option
#    And I should not see table row
#    And I click on All dropdown list
#    And I click on All option
#    And I should see table row
#    And I click on All verified dropdown list
#    And I click on Yes option
#    And I should see table row
#    And I click on All verified dropdown list
#    And I click on No option
#    And I should see table row

  Scenario: Partner should be able to sort and filter sales C213 C214
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Company Sales menu item
    And I should be on "/partner/sales/"
    And I click on sales name dropdown list
    And I click on sales name dropdown list
    And I click on sales watch dropdown list
    And I click on sales watch dropdown list
    And I click on employee dropdown list
    And I click on employee dropdown list
    And I click on sales status dropdown list
    And I click on sales status dropdown list
    And I fill in sales filter by name field with "Pavlo Onysko" name
    And I clean sales name filter
    And I fill in sales filter by watch field with "Rado Sintra" watch
    And I clean sales watch filter
    And I fill in sales filter by employee field with "Rolex Company" employee
    And I clean sales employee filter

  Scenario: Partner should be able to sort and filter codes C219 C220
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I click on date dropdown list
    And I click on name dropdown list
    And I click on name dropdown list
    And I click on employee dropdown list
    And I click on employee dropdown list
    And I click on price dropdown list
    And I click on price dropdown list
    And I click on All verified dropdown list
    And I click on Yes option
    And I should see "Ja" in first row fifth column
    And I click on All verified dropdown list
    And I click on No option
    And I should see "Inaktiv" in first row fifth column
    And I click on source all dropdown list
    And I click on digital option
    And I should see "digital" in first row sixth column
    And I click on source all dropdown list
    And I click on physical option
    And I should see "physical" in first row sixth column

  Scenario: Partner should be able to filter brands by brand field filling C221
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Brands menu item
    And I wait "1000" milliseconds for response
    And I should be on "/partner/brand/"
    And I fill in brand filter by brand field with "Breguet" brand

  Scenario: Partner should be able to use pagination links on all pages C222
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I scroll vertically to "400" px
    And I click on second pagination link
    And I click on next pagination link
    And I click on previous pagination link
    And I click on Company Sales menu item
    And I should be on "/partner/sales/"
    And I scroll vertically to "300" px
    And I click on second pagination link
    And I click on next pagination link
    And I click on previous pagination link
    And I click on pagination Codes menu item
    And I should be on "/partner/codes/"
    And I scroll vertically to "300" px
    And I click on next pagination link
    And I click on previous pagination link
    And I click on pagination Brands menu item
    And I should be on "/partner/brand/"
    And I scroll vertically to "300" px
    And I click on second pagination link
    And I click on next pagination link
    And I click on previous pagination link

  Scenario: Master employee partner should be able to add and delete brands C223
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Brands menu item no pagination
    And I should be on "/partner/brand/"
    And I press on Add brand button
    And I click on brands dropdown list
    And I select brand in brand dropdown list
    And I press on popup Add brand button
    And I remove brand from partner brands list
     And I press on popup Delete button

  Scenario: Master employee partner should be able to add brands and cancel brand adding C224
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Brands menu item
    And I should be on "/partner/brand/"
    And I press on Add brand button
    And I follow popup Cancel link
    And I press on Add brand button
    And I click on brands dropdown list
    And I select brand in brand dropdown list
    And I press on popup Add brand button

  Scenario: Digital code lifecycle with statuses checking C225
#    partner sends code
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I press on Send Code button
    Then I fill in first name field with user name
    And I fill in last name field with user surname
    And I fill in email field with user email
    And I fill in cellphone field with user phone
    And I press on popup Send Code button
    Then I log out
#    admin checks if codes status is new
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
    And I should see New code status in table
    Then I log out
#    redeem page
    And I am login in as user
    And I go to "/redeem"
    And I wait "1000" milliseconds for response
    And I fill in code field with user code
    And I press on Activate button
    Then I should see "Kod aktiverad" text in the "#redeem_form" element
#    admin checks if codes status is active
    Then I log out
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
    And I should see Active code status in table
    Then I log out
#    seller upload watch
    And I am login in as user
    And I am on "/en/"
    When I click on sell link in header
    When I select brand "Baume & Mercier" at first upload step
    And I select model "Clifton" at first upload step
    And I select movement "Auto" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I select case material "Steel" at first upload step
    And I select dial color "blue" at first upload step
    And I select bezel material "Carbon" at first upload step
    And I select bracelet material "Leather" at first upload step
    And I select bracelet color "Black" at first upload step
    And I select clasp material "Steel" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I should be on second upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background page
    And I press continue
    And I copy verification code
    And I log out
#    partner verify watch
    And I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    When I click on verify button
    Then I fill in code field with verification code
    Then I click on popup verify button
    And I click on verify product button
    Then I log out
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on Unpriced listings menu item
    And I click on Product Id item
    And I click on last unpriced watch
    Then I fill in minPrice field with "25000" price
    And I fill in maxPrice field with "30000" price
    And I press Accept button
    Then I log out
#    status before ad activation
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
#    BUG: NOW STATUS IS USED
    And I should see Active code status in table
#    seller activate ad
    And I log out
    And I am on the homepage
    And I am login in as user
    And I am on "/en/profile"
    And I click on user sales menu item
    And I click on sales date dropdown list
    And I select last priced watch
    And I click on Sellcode dropdown list
    And I fill last Sellcode in field
    Then I should see "2.00" text in the "#comRate" element
    And I check agree terms
    And I scroll vertically to "200" px
    And I press "Activate my ad"
    And I press next
    And I should be on third payment step
    And I press next
    And I press visa button
    Then I fill card information
    Then I should see Payment completed page
    And I follow go to profile link
    And I click on sales date dropdown list
    And I should see product active status
    Then I log out
#    admin check if code status is used
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
    And I should see Used code status in table
    Then I log out
#    buyer pays
    And I am log in as buyer
    And I am on the homepage
    And I am on "/en/"
    And I press on search button
    And I should be on "/en/search"
    And I click on show filters link
    And I open dropdown brand list
    And I select brand in dropdown list
    And I minimize dropdown list
    And I open filter dropdown model list
    And I select model in dropdown list
    And I set range for input "minPrice" with value "22000" and input "maxPrice" with value "31000"
    And I press on search button in filter
    And I wait "1000" milliseconds for response
    And I hover on the first search watch
    And I click on the first search watch
    And I should see product page
    And I click on buy watch button
    And I press next
    And I should be on third payment step
    And I press next
    And I press visa button
    And I fill card information
    And I should see Payment completed page
    And I follow go to profile link
    And I click on sales date dropdown list
    And I am on "/profile/my/watches/bought"
    Then I log out
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on orders menu item
    And I click on purchased menu sub item
    And I click on created dropdown list
    And I select last purchased watch
    And I scroll vertically to "800" px
    And I click on shipping status dropdown list
    And I select finished shipping status
    And I click on Om to buyer status dropdown list
    And I select Om to buyer finished shipping status
    Then I log out
    And I am on the homepage
    And I am log in as buyer
    And I am on "/en/profile"
    And I click on purchases menu item
    And I click on sales date dropdown list
    Then I should see product bought status
    Then I log out
#    admin checks if code status is used
    And I am on the homepage
    And I log in as superadmin
    And I am on "/en/"
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
    And I should see Used code status in table

  Scenario: Admin should be able to view new digital codes status C241
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I press on Send Code button
    Then I fill in first name field with user name
    And I fill in last name field with user surname
    And I fill in email field with user email
    And I fill in cellphone field with user phone
    And I press on popup Send Code button
    Then I log out
    And I am login in as admin
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"

  Scenario: Master employee should be able to order printed codes and cancel codes ordering C226
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I press on Order Codes button
    And I follow codes popup Cancel link
    And I press on Order Codes button
    Then I click on codes dropdown list
    And I select 50 codes amount in codes dropdown list
    And I press on popup Order Code button
    Then I should see an "#order-codes-success-popup" popup
    And I close codes popup

  Scenario: Partner should be able to manage sales C231
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Company Sales menu item
    And I select continue new product
    And I should be on "/partner/add/product/"
    Then I move backward one page
    And I select active product
    Then I should see a "#product" product

  Scenario: Master employee should be able to order physical codes and view codes after admin verification C260
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I click on date dropdown list
    And I should see "digital" in source column codes page
    And I press on Order Codes button
    Then I click on codes dropdown list
    And I select 25 codes amount in codes dropdown list
    And I press on popup Order Code button
    Then I should see an "#order-codes-success-popup" popup
    And I close codes popup
    Then I log out
    And I am login in as admin
    And I click on Dashboard menu item
    And I click on admin Codes menu item
    And I click on seller codes menu sub item
    And I should be on "/dashboard/code/seller"
    And I press Physical request title button
    And I should be on "/dashboard/code/request/seller"
    And I click on first table dropdown list
    And I click on agree button
    And I click on first table dropdown list
    And I click on no sent button
    Then I log out
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Codes menu item
    And I should be on "/partner/codes/"
    And I click on date dropdown list
    And I click on date dropdown list
    And I should see "physical" in source column codes page

  Scenario: Employee should not be able to observe elements available for master employee C261
    When I am on "/login-partner"
    And I log in as partner employee
    And I should be on "/partner"
    And I click on Company Sales menu item
    And I should be on "/partner/sales/"
    And I should not see continue new product
    And I should not see continue verified product
    And I should see product active link
    And I click on employee Codes menu item
    And I should be on "/partner/codes/"
    And I should not see Send Codes Button
    And I should not see Order Codes Button
    Then I click on employee Brands menu item
    And I should be on "/partner/brand/"
    And I should not see Add Brand Button
    And I should not see Delete brand Button
    Then I click on Store menu item
    And I should be on "/partner/store/"
    And I should not see editing store address icon
    And I should not see editing store hours icon
    Then I click on Employees menu item
    And I should be on "/partner/employee/"
    And I should not see Add Employee Button
    And I should not see Delete Employee Button
    Then I should not see Active Log menu item

  Scenario: Master employee should be able to observe elements available only for master C262
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Company Sales menu item
    And I should be on "/partner/sales/"
    And I should see continue new product
#    And I should see continue verified product
#    Now there is no verified product
    And I should see product active link
    And I click on employee Codes menu item
    And I should be on "/partner/codes/"
    And I should see Send Codes Button
    And I should see Order Codes Button
    Then I click on employee Brands menu item
    And I should be on "/partner/brand/"
    And I should see Add Brand Button
    And I should see Delete brand Button
    Then I click on Store menu item
    And I should be on "/partner/store/"
    And I should see editing store address icon
    And I should see editing store hours icon
    Then I click on Employees menu item
    And I should be on "/partner/employee/"
    And I should see Add Employee Button
    And I should see Delete Employee Button
    Then I should see Active Log menu item

  Scenario: Master employee should be able to see errors while editing opening hours incorrectly C264
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Store info menu item
    And I should be on "/partner/store/"
    Then I click editing store hours icon
    And I set opening hours randomly
    And I click save hours button
    And I should see invalid time error

  Scenario: Master employee should be able to set opening hours correctly C265
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Store info menu item
    And I should be on "/partner/store/"
    Then I click editing store hours icon
    And I set opening hours
    And I set break start hours
    And I set break end hours
    And I set close hours
    And I click save hours button

  Scenario: Master employee should be able to set opening hours to none C266
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Store info menu item
    And I should be on "/partner/store/"
    Then I click editing store hours icon
    And I set opening hours
    And I set break start hours
    And I set break end hours
    And I set close hours
    And I set none opening hours
    And I click save hours button

  Scenario: Master employee should be able to edit store info C267
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Store info menu item
    And I should be on "/partner/store/"
    Then I click editing store info icon
    And I should see edit address popup
    Then I fill in form company name field with "Test" company
    And I fill in form webpage field with "http://www.google.com" webpage
    And  I fill random email in edit store info popup
    And I fill in form address field with "Val 73" address
    And I fill in form city field with "City" city
    And I fill in form region field with "Test" region
    And I fill in form zip field with "00000" zip
    And I fill in form store phone field with "506078681" phone
    And I fill in form personal phone field with "506078681" phone
    And I click on form country dropdown list
    And I select Afghanistan in country dropdown list
    And I click save store info button
#    set previous info
    Then I click editing store info icon
    And I should see edit address popup
    Then I fill in form company name field with "Nazarenklock" company
    And I fill in form webpage field with "http://www.cielo.it" webpage
    And I fill in form email field with "nazarenk123o@samsonos.com" email
    And I fill in form address field with "Luntmakargatan 73" address
    And I fill in form city field with "Vasastan" city
    And I fill in form region field with "Stockholm" region
    And I fill in form zip field with "11351" zip
    And I fill in form store phone field with "506078681" phone
    And I fill in form personal phone field with "506078681" phone
    And I click on form country dropdown list
    And I select Sweden in country dropdown list
    And I click save store info button
    And I click on Activity log item
    And I should see "Adress uppdaterad" in activity column activity log

  Scenario: Master employee should be able to view employee info C268
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    Then I select first employee
    And I should see edit employee popup

  Scenario: Master employee should be able to add employee C269
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    Then I click add employee button
    And I should see add employee popup
    Then I fill in employee first name field with "Test" name
    And I fill in employee last name field with "Test" name
    And I fill random email in employee email field
    And I fill in employee phone field with "1234567" phone
    And I click form add employee button
    And I fill in employee name filter field with name

  Scenario: Master employee should be able to edit employee info C270
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    And I fill in employee name filter field with name
    Then I select first employee
    And I should see edit employee popup
    Then I fill in edit employee first name field with "TestEdited" name
    And I fill in edit employee last name field with "TestEdited" name
    And I fill edit random email in employee email field
    And I fill in edit employee phone field with "0000000" phone
    And I click save edit employee button

  Scenario: Master employee should be able to delete employee C271
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    And I fill in employee name filter field with edited name
    And I click delete employee button
    And I should see remove employee popup
    Then I click remove employee button

  Scenario: Master should see error message registering employee with used email C272
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    Then I click add employee button
    And I should see add employee popup
    Then I fill in employee first name field with "Test" name
    And I fill in employee last name field with "Test" name
    And I fill in employee email field with "popo@test.com" email
    And I fill in employee phone field with "1234567" phone
    And I click form add employee button
    And I should see email error

  Scenario: Master should see error message registering employee with less than 7 symbols phone C273
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    Then I click add employee button
    And I should see add employee popup
    Then I fill in employee first name field with "Test" name
    And I fill in employee last name field with "Test" name
    And I fill random email in employee email field
    And I fill in employee phone field with "123" phone
    And I click form add employee button
    And I should see phone error

  Scenario: Partner should be able to sort and filter employees C274
    When I am on "/login-partner"
    And I log in as partner
    And I should be on "/partner"
    And I click on Employees users menu item
    And I should be on "/partner/employee/"
    And I click name employee dropdown list
    And I check employee name sorting order with "ASC"
    And I click name employee dropdown list
    And I check employee name sorting order with "DESC"
    And I click email employee dropdown list
    And I check employee email sorting order with "ASC"
    And I click email employee dropdown list
    And I check employee email sorting order with "DESC"
    And I click role employee dropdown list
    And I check employee role sorting order with "DESC"
    And I click role employee dropdown list
    And I check employee role sorting order with "ASC"
    And I fill in employee filter by name field with "Alexander Nazarenko" name
    And I clean employee name filter
    And I fill in employee filter by email field with "mastersnooker24@inbox.ru" email
    And I clean employee email filter
    And I fill in employee filter by cellphone field with "1234567" phone
    And I clean employee cellphone filter

  Scenario: Partner-should be able to create watch (partner activity)
    When I am on "/login-partner"
    And I log in as partner
    And I am on "/en/partner/add/product/"
    When I select brand "A. Lange" at first upload step
    And I select model "Zeitwerk" at first upload step
    And I fill in refferense number field with "43534534" number
    And I fill in serial number field with "32452345" number
    And I select movement "Auto" at first upload step
    And I select production year "1994" at first upload step
    And I select case condition at first upload step
    And I select bracelet condition at first upload step
    And I select clasp condition at first upload step
    And I select original box at first upload step
    And I select certificate at first upload step
    And I fill in waterproof field with "50" meters
    And I select case material "Platinum" at first upload step
    And I select dial color "Gold" at first upload step
    And I select bezel material "Ceramic" at first upload step
    And I select bezel size "14" at first upload step
    And I select bracelet material "Rubber" at first upload step
    And I select bracelet color "Green" at first upload step
    And I select clasp material "Tantalum" at first upload step
    And I select clasp type "Buckle" at first upload step
    And I click continue button at first upload step
    And I click on case plus icon
    When I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case back view popup
    And I attach img in first crop window
    Then I drag 12 icon to image
    And I drag 3 icon to image
    And I drag 6 icon to image
    And I drag 9 icon to image
    And I click on continue popup button
    And I should see case right view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I click on continue popup button
    And I should see case left view popup
    And I attach img in first crop window
    And I drag case right and left view six icon
    And I drag case right and left view twelve icon
    And I press "FINISH UPLOAD"
    And I should see four case img are uploaded
    And I click on bracelet plus icon
    And I attach img in second crop window
    And I click on second crop finish button
    And I click on clasp plus icon
    And I attach img in third crop window
    And I click on third crop continue popup button
    And I should see lock back view popup
    And I attach img in third crop window
    And I click on third crop finish button
    And I press continue
    And I should be on background partner page
    And I press continue
    And I fill in price field with price
    And I click on Activate button
    And I should see success activation popup
    And I click on done button
    And I am on "/en/partner/activity/"
    And I should see "Zeitwerk" in subject activity log
    And I should see "Klocka aktiverad" in activity column activity log
    And I am on "/en/"
    And I fill in select brand field with "A. Lange" brand
    And I click on first found brand
    And I fill in select model field with "Zeitwerk" model
    And I click on first found model
    And I press on search button
    And I should see price that was set by partner