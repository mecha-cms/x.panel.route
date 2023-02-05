<?php

// Disable this extension if `route` extension is disabled or removed ;)
if (!isset($state->x->route)) {
    return $_;
}

if ('POST' === $_SERVER['REQUEST_METHOD'] && 0 === strpos($_['path'] . '/', 'route/') && 0 === strpos($_['type'] . '/', 'file/route/')) {
    // Force `.php` file extension
    if (isset($_POST['file']['name'])) {
        $_POST['file']['name'] .= '.php';
    }
}

if (0 === strpos($_['path'] . '/', 'route/') && !array_key_exists('type', $_GET) && !isset($_['type'])) {
    if (!empty($_['part']) && $_['folder']) {
        $_['type'] = 'files/route';
    } else if (empty($_['part']) && $_['file']) {
        $x = pathinfo($_['file'], PATHINFO_EXTENSION);
        if ('php' === $x) {
            $_['type'] = 'file/route';
        }
    }
    $_['deep'] = $_GET['deep'] ?? true; // Recurse file(s)/folder(s) list
    $_['x'] = $_GET['x'] ?? 1; // List file(s) only
}

Hook::set('_', function ($_) {
    if (isset($_['lot']['bar']['lot'][0]['lot']['folder']['lot']['route'])) {
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['route']['icon'] = 'M9.64,13.4C8.63,12.5 7.34,12.03 6,12V15L2,11L6,7V10C7.67,10 9.3,10.57 10.63,11.59C10.22,12.15 9.89,12.76 9.64,13.4M18,15V12C17.5,12 13.5,12.16 13.05,16.2C14.61,16.75 15.43,18.47 14.88,20.03C14.33,21.59 12.61,22.41 11.05,21.86C9.5,21.3 8.67,19.59 9.22,18.03C9.5,17.17 10.2,16.5 11.05,16.2C11.34,12.61 14.4,9.88 18,10V7L22,11L18,15M13,19A1,1 0 0,0 12,18A1,1 0 0,0 11,19A1,1 0 0,0 12,20A1,1 0 0,0 13,19M11,11.12C11.58,10.46 12.25,9.89 13,9.43V5H16L12,1L8,5H11V11.12Z';
        $_['lot']['bar']['lot'][0]['lot']['folder']['lot']['route']['skip'] = false; // This will make `.\lot\route` folder always visible!
    }
    if (0 === strpos($_['path'] . '/', 'route/')) {
        if (0 === strpos($_['type'] . '/', 'file/route/')) {
            if (isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name'])) {
                $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['unit'] = '.php';
                $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['x'] = false;
                if ('get' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'])) {
                    $_['lot']['bar']['lot'][0]['lot']['set']['description'][1] = 'Route';
                    $_['lot']['bar']['lot'][0]['lot']['set']['icon'] = 'M2,4C2,2.89 2.9,2 4,2H7V4H4V7H2V4M22,4V7H20V4H17V2H20A2,2 0 0,1 22,4M20,20V17H22V20C22,21.11 21.1,22 20,22H17V20H20M2,20V17H4V20H7V22H4A2,2 0 0,1 2,20M10,2H14V4H10V2M10,20H14V22H10V20M20,10H22V14H20V10M2,10H4V14H2V10Z';
                    $_['lot']['bar']['lot'][0]['lot']['set']['url']['query']['type'] = 'file/route';
                    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'] = pathinfo($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['name']['value'], PATHINFO_FILENAME);
                }
                if ('set' === $_['task'] && isset($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content'])) {
                    $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['file']['lot']['fields']['lot']['content']['value'] = '<?php

return function ($content, $path, $query, $hash) {
    // `$content` holds the return value of the route.
    // `$path` holds the current URL path value.
    // `$query` holds the current URL query value.
    // `$hash` holds the current URL hash value.
};';
                }
            }
        } else if (0 === strpos($_['type'] . '/', 'files/route/')) {
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['blob']['skip'] = true; // Disable blob button
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['description'][1] = 'Route';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['title'] = 'Route';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['file']['url']['query']['type'] = 'file/route';
            $_['lot']['desk']['lot']['form']['lot'][0]['lot']['tasks']['lot']['folder']['skip'] = true; // Disable folder button
        }
    }
    return $_;
}, 0);

Hook::set('_', function ($_) {
    if (0 !== strpos($_['type'] . '/', 'files/route/')) {
        return $_;
    }
    if (
        !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot']) &&
        !empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type']) &&
        'files' === $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['type']
    ) {
        foreach ($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'] as $k => &$v) {
            if ('.php' === substr($k, -4)) {
                $v['title'] = substr($k, strlen(LOT . D . 'route'), -4);
            }
        }
        unset($v);
    }
    return $_;
}, 10.1);

return $_;