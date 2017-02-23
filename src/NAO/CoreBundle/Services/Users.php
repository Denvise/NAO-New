<?php

namespace NAO\CoreBundle\Services;

use NAO\CoreBundle\Entity\User;

class Users
{
    public function setUserAccount(User $user)
    {
        $group = $user->getAccountType();

        if ($group == 'Particulier') {
            $user->setRoles(array('ROLE_USER'));
            $user->setValid(true);
        } else {
            $user->setRoles(array('ROLE_ADMIN'));
            $user->setValid(false);
        }
    }
}
