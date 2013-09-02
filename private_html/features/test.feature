Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

  Scenario: Searching for a page that does exist
    Given I am on "/"
    When I fill in "search" with "Behavior Driven Development"
    And I press "searchButton"
    Then I should see "software development process"
