<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt New BSD License
 */

namespace Module\User;

use Pi;

/**
 * User Event Handler
 *
 * @author Liu Chuang <liuchuangww@gmail.com>
 */
class Event
{
    /**
     * User register event
     *
     * @param int $uid
     */
    public static function userRegister($uid)
    {
    }

    /**
     * User activate event
     *
     * @param int $uid
     */
    public static function userActivate($uid)
    {
    }

    /**
     * User enable event
     *
     * @param int $uid
     */
    public static function userEnable($uid)
    {

    }

    /**
     * User disable event
     *
     * @param int $uid
     */
    public static function userDisable($uid)
    {
    }

    /**
     * User delete event
     *
     * @param int $uid
     */
    public static function userDelete($uid)
    {
    }

    /**
     * User name change event
     *
     * @param array $params
     */
    public static function nameChange($params)
    {
        if (!empty($params)) {
            Pi::service('audit')->log('user-name-change', $params);
        }
    }

    /**
     * User email change event
     *
     * @param array $params
     */
    public static function emailChange($params)
    {
        if (!empty($params)) {
            Pi::service('audit')->log('user-email-change', $params);
        }
    }

    /**
     * User password change change event
     *
     * @param int $uid
     */
    public static function passwordChange($uid)
    {
        if ($uid) {
            Pi::service('audit')->log('user-password-change', $uid);
        }
    }

    /**
     * User role assign change event
     *
     * @param int $uid
     */
    public static function roleAssign($uid)
    {
    }

    /**
     * User role remove change event
     *
     * @param int $uid
     */
    public static function roleRemove($uid)
    {
    }

    /**
     * User login event
     *
     * @param int $uid
     */
    public static function userLogin($uid)
    {
        // Set ip login
        $ipLogin = Pi::user()->getIp();
        Pi::user()->data()->set(
            $uid,
            'last_login_ip',
            $ipLogin,
            'user'
        );

        // Set login count
        Pi::user()->data()->increment($uid, 'count_login', 1);

        // Set login time
        Pi::user()->data()->set(
            $uid,
            'last_login',
            time(),
            'user'
        );
    }

    /**
     * User logout event
     *
     * @param int $uid
     */
    public static function userLogout($uid)
    {
    }
}