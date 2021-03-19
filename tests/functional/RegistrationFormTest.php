<?php

namespace creode\magiclogintests\acceptance;

use Craft;
use craft\records\User;
use FunctionalTester;
use \Codeception\Test\Unit;

/**
 * Tests the functionality behind the custom registration form.
 */
class RegistrationFormTest extends Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function _before()
    {
        Craft::$app->setEdition(Craft::Pro);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    protected function _after()
    {
    }

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     * Test to demonstrate the registration form for Magic Links can be returned.
     * 
     * @return void
     */
    public function testRegistrationFormGet()
    {
        // Test that we can see the registration form.
        $this->tester->amOnPage('/magic-login/register');
        $this->tester->seeResponseCodeIs(200);
        $this->tester->canSee('email');
    }

    /**
     * Tests that with the correct parameters, users can register
     * for an account with a magic link.
     *
     * @return void
     */
    public function testUserCanRegister()
    {
        $this->tester->amOnPage('/magic-login/register');
        $this->tester->submitForm(
            '#register',
            [
                'email' => 'test@example.com',
                'password' => 'something'
            ],
            'submitButton'
        );

        $this->tester->canSeeRecord(User::class, ['email' => 'test@example.com']);
    }

    /**
     * Tests that if we don't supply a valid email address
     * a form error will be displayed back to the user.
     *
     * @return void
     */
    public function testErrorsDisplayedOnForm()
    {
        $this->tester->amOnPage('/magic-login/register');
        $this->tester->submitForm(
            '#register',
            [],
            'submitButton'
        );

        // TODO: This is likely going to editable in future.
        $this->tester->canSee('Please enter a valid email address.');
    }
}
