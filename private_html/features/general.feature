Feature: general structure
	In order to see a word definition
	As a site visitor
	I need to be able navigate through the menu


	Scenario: presence of menu items for non-authenticated user
		Given I am on "?r=site/"
		Then I should see the following: "Piezonuclear Science, Home, Articles, Contact"
		And I should not see the following: "Journals, Authors"

	Scenario: menu for the authenticated user
		Given the following users exist:
			| login     | pswd |
			| test_user | test |
		Given I am logged in as "test_user" with password "test"
		Given I am on "?r=site/"
		Then I should see the following: "Piezonuclear Science, Home, Articles, Contact, Journals, Authors"


