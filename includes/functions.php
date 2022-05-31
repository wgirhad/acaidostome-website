<?php

function page_output($page, $template) {
    $base_path = guess_base_path($page);
    $template_path = "{$base_path}/template/{$template}";
    $temp_file = $_SERVER['DOCUMENT_ROOT'] . "{$template_path}/template.tpl";
    $page_file = $_SERVER['DOCUMENT_ROOT'] . "{$base_path}/pages/{$page}.tpl";
    $overflow = defined('NO_OVERFLOW') ? ' class="no-overflow"' : '';
    $hideStart = '';
    $hideEnd = '';

    if (defined('HIDE_MENU')) {
        $hideStart = '<!--';
        $hideEnd = '-->';
    }

    check_cache($temp_file, $page_file);

    $tempData = file_get_contents($temp_file);
    $pageData = file_get_contents($page_file);

    $page = str_replace('{{page_content}}', $pageData, $tempData);
    $page = str_replace('{{template_path}}', $template_path, $page);
    $page = str_replace('{{base_path}}', $base_path, $page);
    $page = str_replace('{{hide_menu_start}}', $hideStart, $page);
    $page = str_replace('{{hide_menu_end}}', $hideEnd, $page);
    $page = str_replace('{{overflow}}', $overflow, $page);


    echo $page;
}

function guess_base_path($page) {
    $range = ($page === 'main') ? 1 : 2;
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    foreach (range(1, $range) as $x) {
        $path = substr($path, 0, strrpos($path, '/'));
    }
    return $path;
}

function check_cache($temp_file, $page_file) {
    $dates = array(
        filemtime($temp_file),
        filemtime($page_file),
        strtotime('2022-04-17T08:17:00-03:00')
    );

    $max = max($dates);

    $headers = getallheaders();
    if (isset($headers["If-Modified-Since"])) {
        $req = strtotime($headers["If-Modified-Since"]);
        if ($max == $req) {
            if (PHP_VERSION_ID < 50400) {
                header("HTTP/1.0 304 Not Modified");
            } else {
                http_response_code(304);
            }

            die();
        }
    }

    header("Last-Modified: " . date('r', $max));
}

if (!function_exists('getallheaders')) {
    /**
     * Get all HTTP header key/values as an associative array for the current request.
     *
     * @return string[string] The HTTP header key/value pairs.
     */
    function getallheaders()
    {
        $headers = array();
        $copy_server = array(
            'CONTENT_TYPE'   => 'Content-Type',
            'CONTENT_LENGTH' => 'Content-Length',
            'CONTENT_MD5'    => 'Content-Md5',
        );
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $key = substr($key, 5);
                if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                    $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                    $headers[$key] = $value;
                }
            } elseif (isset($copy_server[$key])) {
                $headers[$copy_server[$key]] = $value;
            }
        }
        if (!isset($headers['Authorization'])) {
            if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
                $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
                $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
                $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
            } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
                $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
            }
        }
        return $headers;
    }
}
