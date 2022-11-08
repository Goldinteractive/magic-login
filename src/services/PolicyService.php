<?php

namespace creode\magiclogin\services;

use craft\base\Component;
use creode\magiclogin\MagicLogin;

class PolicyService extends Component
{
    public function isAllowedToRegister(?string $email): bool
    {
        $pattern = trim(MagicLogin::getInstance()->getSettings()->allowedEmailPatternForRegistration,'/');

        return $email && preg_match('/'.$pattern.'/', $email) === 1;
    }
}
