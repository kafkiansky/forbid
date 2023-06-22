@forbid
Feature: Forbid non-exhaustive abstraction
  Non exhaustive abstraction are forbidden

  Background:
    Given I have the following config
      """
      <?xml version="1.0"?>
      <psalm errorLevel="1">
        <projectFiles>
          <directory name="."/>
          <ignoreFiles> <directory name="../../vendor"/> </ignoreFiles>
        </projectFiles>
        <plugins>
          <pluginClass class="Kafkiansky\Forbid\Plugin"/>
        </plugins>
      </psalm>
      """
  Scenario: Asserting abstract class with non final public methods are forbidden
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        public function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see these errors
      | Type                                 | Message                                   |
      | NonExhaustiveAbstractionAreForbidden | Non exhaustive abstraction are forbidden. |

  Scenario: Asserting abstract class with non final protected methods are forbidden
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        protected function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see these errors
      | Type                                 | Message                                   |
      | NonExhaustiveAbstractionAreForbidden | Non exhaustive abstraction are forbidden. |

  Scenario: Asserting abstract class with final public methods are allowed
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        final public function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see no errors

  Scenario: Asserting abstract class with final protected methods are allowed
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        final protected function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see no errors

  Scenario: Asserting abstract class with abstract methods are allowed
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        abstract public function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see no errors

  Scenario: Asserting abstract class with private methods are allowed
    Given I have the following code
    """
    <?php
    abstract class Something
    {
        private function doSome(): void {}
    }
    """
    When I run Psalm
    Then I see no errors