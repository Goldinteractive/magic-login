<?php
/**
 * Magic Login plugin for Craft CMS 3.x
 *
 * A Magic Link plugin which sits on top of the existing user sign in and registration process.
 *
 * @link      https://www.creode.co.uk
 * @copyright Copyright (c) 2021 Creode
 */

namespace creode\magiclogin\models;

use craft\base\Model;

/**
 * MagicLogin Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Creode
 * @package   MagicLogin
 * @since     1.0.0
 */
class Settings extends Model
{
	// Public Properties
	// =========================================================================

	/**
	 * Default value for how many minutes a magic link is valid.
	 *
	 * @var integer
	 */
	public $linkExpiry = 15;

	/**
	 * Default random password length generated with a user.
	 *
	 * @var integer
	 */
	public $passwordLength = 16;

	/**
	 * Subject line on the Magic Login authentication email.
	 *
	 * @var string
	 */
	public $authenticationEmailSubject = 'Magic Login Link';

    /**
     * Regex pattern of email addresses which are able to register
     *
     * @var string
     */
    public $allowedEmailPatternForRegistration = '.*';

    /**
     * If a user without an account tries to login, automatically register him
     * ($allowedEmailPatternForRegistration must match)
     *
     * @var bool
     */
    public $autoRegisterOnLogin = false;

    /**
     * The number of seconds that the user can remain in logged-in status.
     * 0 = session
     *
     * @var integer
     */
    public $loginDuration = 0;

	// TODO: Add a setting to say if magic login click should also verify a user.
	// Grey out the option if verification is disabled on the website.

	// Public Methods
	// =========================================================================

	/**
	 * Returns the validation rules for attributes.
	 *
	 * Validation rules are used by [[validate()]] to check if attribute values are valid.
	 * Child classes may override this method to declare different validation rules.
	 *
	 * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			[['linkExpiry', 'passwordLength', 'loginDuration'], 'number'],
            [['autoRegisterOnLogin'], 'boolean'],
			[['authenticationEmailSubject', 'allowedEmailPatternForRegistration'], 'string'],
		];
	}
}
