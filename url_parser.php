<?php
/**
 * Created by PhpStorm.
 * User: vladdoroshchuk
 * Date: 2/2/19
 * Time: 7:27 PM
 */
const TLD = [
    'com', 
    'co',
    'org',
    'in',
    'us',
    'gov',
    'mil',
    'int',
    'edu',
    'net',
    'biz',
    'info',
    'ua',
];

/**
 * @return string
 */
function getUrl() 
{
    $shortOption = '';
    $longOption = [
        'url:',
        'u:',
    ];
    $get = getopt($shortOption, $longOption);

    return isset($get['url']) ? $get['url'] : ( isset($get['u']) ? $get['u'] : (!empty($argv[1]) ? $argv[1] : '' ));
}

/**
 * @param string $host
 * @param array $hostParams
 * @return array
 */
function getHostParams($host = '', $hostParams = [])
{
    $hostItems = array_reverse(explode('.', $host));
    
    if(!empty($hostItems[0]) && in_array($hostItems[0], TLD)) {
        $hostParams['tld'] = ".$hostItems[0]";
        
        if(!empty($hostItems[1]) && in_array($hostItems[1], TLD)) {
            $hostParams['sld'] = ".$hostItems[1]" . $hostParams['tld'];
            $hostParams['domain'] = (!empty($hostItems[2])) ? $hostItems[2] . $hostParams['sld'] : $hostParams['sld'];
            $subDomain = getSubDomain(array_reverse(array_slice($hostItems, 3)));
        }
        else {
            $hostParams['domain'] =  (!empty($hostItems[1])) ? $hostItems[1] . $hostParams['tld'] : $hostParams['tld'];
            $subDomain = getSubDomain(array_reverse(array_slice($hostItems, 2)));
        }

        if($subDomain){
            $hostParams['subdomain'] = $subDomain;
        }
    }
    
    return $hostParams;
}

/**
 * @param array $subDomain
 * @return string
 */
function getSubDomain(array $subDomain = [])
{
    return implode(".", $subDomain);
}

/**
 * @param $path
 * @return array
 */
function getPathParams($path)
{
    preg_match('/.+\.(\w{2,4})$/i', $path, $result);
    return !empty($result[1]) ? ['extension' => $result[1]] : [];
}

/**
 * @param string $url
 * @return array
 */
function parseUrl($url = '') 
{
    if(filter_var($url, FILTER_VALIDATE_URL) === false) {
        return [
            'error' => "url $url is not correct!!",
        ];
    }
    $parsedUrl = parse_url($url);
    $tld = !empty($parsedUrl['host']) ? getHostParams($parsedUrl['host']): [];
    $path = !empty($parsedUrl['path']) ? getPathParams($parsedUrl['path']): [];
    if(!empty($parsedUrl['query'])){
        parse_str($parsedUrl['query'], $parsedUrl['parsedQuery']);
    }
    return array_merge($parsedUrl, $tld, $path);
}

/**
 * @return string
 */
function parser() 
{
    $url = getUrl();
    return json_encode(parseUrl($url));
}

$result = parser();
print_r($result);
