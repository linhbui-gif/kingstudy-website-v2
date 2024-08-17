<?php
namespace App\Helpers;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Cache;

class Auth
{
    public static function keyAuthGoogle2fa() {
        return '2fa:user';
    }
    public static function isAuthGoogle2fa() {
        $key = self::keyAuthGoogle2fa();

        return session($key);
    }
    public static function setAuthGoogle2fa($flag=1) {
        $key = self::keyAuthGoogle2fa();

        return session([$key => $flag]);
    }
    public static function user_name($value=false) {
        $key = '_username';

        if ($value===false) {
            return session($key);
        }

        return session([$key => $value]);
    }

    public static function keyCacheToken() {
        if(self::user_name()) return 'token:'.self::user_name();

        return false;
    }

    //---------user info--------------------

    public static function keyCacheUserInfo() {
        if (auth()->id()) {
            return 'userinfo:'.auth()->id();
        }

        return false;
    }

    public static function setUserInfo($info, $expires_at=false) {
        $key = self::keyCacheUserInfo();

        if (!$key) return false;

        $minutes = ( $expires_at - time() ) / 60;

        cache([$key => $info], $minutes);
    }

    public static function getUserInfo() {
        return auth()->user();
    }

    //---------user id----------------------
    public static function getUserId() {
        return auth()->id();
    }

    //--------------------------------------

    public static function setToken($token, $expires_at=false) {
        $minutes = ( $expires_at - time() ) / 60;

        cache([self::keyCacheToken() => $token], $minutes);
    }
    public static function removeToken() {
        auth()->logout();
    }
    public static function getToken() {
        return auth()->token();
    }

    public static function check() {
        return auth()->check();
    }

    public static function is_admin($user=false) {
        if (!$user) $user = self::getUserInfo();

        if ($user->id==1) return 1;

        return 0; // admin của 1 công ty
    }

    public static function company_id($user=false) {
        if (!$user) $user = self::getUserInfo();

        if (isset($user->company_id)) return $user->company_id;

        return 0;
    }

    public static function forget_prefix($prefix_key)
    {
        if ($prefix_key=="*") return;

        if (config('cache.default') == 'redis') {
            $redis = Cache::getRedis();
            $keys = $redis->keys($prefix_key);
            $count = 0;
            foreach ($keys as $key) {
                $redis->del($key);
                $count++;
            }
            return $count;
        }

//        Cache::flush();
        return 1;
    }

    public static function keyGetPermissionsByUser($user_id) {
        return 'permissions:user:'.$user_id;
    }

    public static function forget_permissions() {
        return self::forget_prefix('permissions:user:*');
    }

    public static function get_permissions($user=false, $re_cache=false) {
        if (!$user) $user = self::getUserInfo();

        $key = self::keyGetPermissionsByUser($user->id);

        $permissions = Cache::get($key);

        if (!$re_cache && $permissions) return $permissions;

        $permissions = \Modules\AdminAuth\Entities\Permissions::getPermissionsByUser($user->id);

        Cache::forever($key, $permissions);

        return $permissions;
    }

    public static function has_permission($route_name, $user=false, $permissions=false, $debug=false) {
        if (!$user) $user = self::getUserInfo();
        if (self::is_admin($user)) return true;

        $roles = explode(",", $user->role_ids);

        if (in_array(1, $roles)) {
            return true;
        }
        // thuc hien call tu api va cache lai
        if (!$permissions) $permissions = self::get_permissions($user);

        if (is_array($route_name)) {
            foreach ($route_name as $rn) {
                if(array_key_exists($rn, $permissions)){
                    return true;
                }
            }

            return false;
        }
        if(array_key_exists($route_name, $permissions)){
            return true;
        }
        return false;
    }

    public static function get_first_permission($user=false, $permissions=false) {
        if (!$user) $user = self::getUserInfo();

        // thuc hien call tu api va cache lai
        if (!$permissions) $permissions = self::get_permissions($user);

        foreach ($permissions as $route_name => $flag) {
            if ($flag) {
                if (strpos($route_name, '.index')) {
                    return route($route_name);
                }
            }
        }

        return '/dashboard';
    }
}
