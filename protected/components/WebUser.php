<?php

class WebUser extends CWebUser
{
    // This function returns the role from session (set during login)
    public function getRole()
    {
        return $this->getState('role');
    }
}
