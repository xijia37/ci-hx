<?php  if(!defined('DEDEINC')) exit('dedecms');


/**
 *  设置Cookie记录
 *
 * @param     string  $key    键
 * @param     string  $value  值
 * @param     string  $kptime  保持时间
 * @param     string  $pa     保存路径
 * @return    void
 */

$cfg_cookie_encode = 'CcLQk7607T';
$cfg_domain_cookie = '';

if ( ! function_exists('set_cookie_s'))
{
    function set_cookie_s($key, $value, $kptime=0, $pa="/")
    {
        //global $cfg_cookie_encode,$cfg_domain_cookie;
        setcookie($key, $value, time()+$kptime, $pa,$cfg_domain_cookie);
        setcookie($key.'__ckMd5', substr(md5($cfg_cookie_encode.$value),0,16), time()+$kptime, $pa,$cfg_domain_cookie);
    }
}


/**
 *
 * @param     $key   键名
 * @return    void
 */
if ( ! function_exists('delete_cookie_s'))
{
    function delete_cookie_s($key)
    {
        //global $cfg_domain_cookie;
        setcookie($key, '', time()-360000, "/",$cfg_domain_cookie);
        setcookie($key.'__ckMd5', '', time()-360000, "/",$cfg_domain_cookie);
    }
}

/**
 *  获取Cookie记录
 *
 * @param     $key   键名
 * @return    string
 */
if ( ! function_exists('get_cookie_s'))
{
    function get_cookie_s($key)
    {
        //global $cfg_cookie_encode;
        if( !isset($_COOKIE[$key]) || !isset($_COOKIE[$key.'__ckMd5']) )
        {
            return '';
        }
        else
        {
            if($_COOKIE[$key.'__ckMd5']!=substr(md5($cfg_cookie_encode.$_COOKIE[$key]),0,16))
            {
                return '';
            }
            else
            {
                return $_COOKIE[$key];
            }
        }
    }
}
