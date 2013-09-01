Feature: general structure
  In order to see a word definition
  As a site visitor
  I need to be able navigate through the menu

 
  Scenario: presence of menu items
    Given I am on "/"
    Then I should see "Piezonuclear Science"
    And I should see "Home"
    And I should see "Articles"
    And I should see "Authors"
    And I should see "Contact"
    And I should see "Journals"




