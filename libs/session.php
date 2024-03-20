<?php

use Zend\Session\Container;

class Session {

    public static function init() {
        
        return;
    }
    
    public static function isActived() {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    public static function getId() {
        return session_id();
    }

    public static function get($key, $def = NULL) {
        $session = new Container(SESSION_PREFIX);
        if (is_array($key)) {
            $res = array();
            foreach ($key as $k) {
                $res[$k] = $session->offsetGet($k) ?: $def;
            }
            return $res;
        }
        return $session->offsetExists($key) ? $session->offsetGet($key) : $def;
    }

    public static function set($key, $val, $prefix = '') {
        $session = new Container(SESSION_PREFIX);
        if (is_array($key)) {
            $prefix = $val;
            foreach ($key as $k => $v) {
                $session->offsetSet($prefix . $k, $v);
            }
        } else {
            $session->offsetSet($prefix . $key, $val);
        }
    }

    public static function _unset($key, $prefix = '') {
        $session = new Container(SESSION_PREFIX);
        if (is_array($key)) {
            foreach ($key as $k) {
                $session->offsetUnset($prefix . $k);
            }
        } elseif ($session->offsetExists($prefix . $key)) {
            $session->offsetUnset($prefix . $key);
        }
    }

    public static function _isset($key) {
        $session = new Container(SESSION_PREFIX);
        return $session->offsetExists($key);
    }

    public static function destroy() {
        Container::getDefaultManager()->getStorage()->clear(SESSION_PREFIX);
    }

}

class Cookie {

    public static $prefix = TIEP_DAU_NGU_SESSION;

    public static function set($key, $val, $expire = 0, $path = "/") {
        if (is_array($key)) {
            if (!empty($key)) {
                $expire = $val;
                $path = $expire;
                foreach ($key as $name => $value) {
                    setcookie(self::$prefix . $name, $value, $expire, $path);
                }
            }
        } else {
            setcookie(self::$prefix . $key, $val, $expire, $path);
        }
    }

    public static function get($key) {
        return isset($_COOKIE[self::$prefix . $key]) ? $_COOKIE[self::$prefix . $key] : NULL;
    }

    public static function _isset($key) {
        return isset($_COOKIE[self::$prefix . $key]);
    }

    public static function _unset($key) {
        if (is_array($key)) {
            foreach ($key as $k) {
                self::_unset($k);
            }
        } else {
            setcookie(self::$prefix . $key, '', time() - 3600);
        }
    }

    public static function destroy($key = '') {
        if ($key != '') {
            setcookie(self::$prefix . $key, '', time() - 3600);
        } else {
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach ($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time() - 1000);
                    setcookie($name, '', time() - 1000, '/');
                }
            }
        }
    }

}
