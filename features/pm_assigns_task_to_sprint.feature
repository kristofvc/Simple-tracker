Feature: Project manager assigns tasks to a sprint
  In order to get things done in a sprint
  As a project manager
  I want to assign a task to that sprint

  Scenario: Successfully assigning 1 task to the next sprint
    Given a sprint named "next" with a duration of 2 hours
    And a task "Setup project" with an estimate of 2 hours
    When I choose to assign the task "Setup project" to the given sprint
    Then the given sprint should be filled with 1 task
    And the given sprint estimate should be 2 hours

  Scenario: Can't assign a task to the next sprint
    Given a sprint named "next" with a duration of 2 hours
    And a task "Setup project" with an estimate of 2 hours
    And a task "Write scenario" with an estimate of 1 hour
    When I choose to assign the task "Write scenario" to the given sprint
    And I choose to assign the task "Setup project" to the given sprint
    Then the given sprint should be filled with 1 task
    And the given sprint estimate should be 1 hour
    And I should be notified that the task estimate is too long for the given sprint
