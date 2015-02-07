Feature: Project manager edits a project
  In order to keep information about a project up to date
  As a project manager
  I want to edit the project's base information

  @simple
  Scenario: I want to change the name of a project
    Given there is a project named "Awesome project"
    When I change the name of that project to "Even more awesome project"
    Then the name of that project should be "Even more awesome project"