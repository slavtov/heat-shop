<?php

function debug(array $arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function redirect($url = false)
{
	if ($url) {
		$redirect = $url;
	} else {
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
	}

	header('Location: ' . $redirect);
	exit();
}

function html($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function cleanArray(array $arr)
{
    foreach ($arr as $key => $value) {
        if (!$value) unset($arr[$key]);
    }

    return $arr;
}

function sqlPart(array $data)
{
    $values = '';

    foreach ($data as $key => $val) {
        if (!empty($val)) $values .= "`{$key}` = :{$key}, ";
    }

    return rtrim(rtrim($values), ',');
}

function updateSession(string $name, array $data): void
{
    foreach ($data as $key => $val) {
        if (!empty($val)) $_SESSION[$name][$key] = $val;
    }
}

function intArray(array $arr): array
{
    $res = [];
    foreach ($arr as $key => $val) $res[$key] = (int) $val;

    return cleanArray($res);
}

function getSuccess()
{
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success"><ul class="mt-2">' . PHP_EOL;

        foreach ($_SESSION['success'] as $success) {
            echo '<li>' . $success . '</li>' . PHP_EOL;
        }

        echo '</ul></div>' . PHP_EOL;

        unset($_SESSION['success']);
    }
}

function getError()
{
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger"><ul class="mt-2">' . PHP_EOL;

        foreach ($_SESSION['error'] as $error) {
            echo '<li>' . $error . '</li>' . PHP_EOL;
        }

        echo '</ul></div>' . PHP_EOL;

        unset($_SESSION['error']);
    }
}

// Notification of success or error
function getReport()
{
    getSuccess();
    getError();
}

function test_input($data, $exception = null)
{
    if (is_array($data)) {
        foreach ($data as $key => $val) {
            if ($exception) {
                if (is_array($exception)) {
                    foreach ($exception as $val) {
                        if (isset($data[$val])) continue;
                    }
                } else {
                    if (isset($data[$exception])) continue;
                }
            }
    
            $val = trim($val);
            $val = stripslashes($val);
            $val = html($val);
        
            $data[$key] = $val;
        }
    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = html($data);
    }

    return $data;
}

function checkLength($str, $min = null, $max = null): bool
{
    if (!$min OR !$max) return null;

    $length = strlen($str);
    $state  = true;

    if ($min) {
        if ($length < $min) $state = false;
    }

    if ($max) {
        if ($length > $max) $state = false;
    }

    return $state;
}

function slug($str)
{
    $converter = [
        'а'=>'a',  'б'=>'b',  'в'=>'v',
        'г'=>'g',  'д'=>'d',  'е'=>'e',
        'ё'=>'e',  'ж'=>'j',  'з'=>'z',
        'и'=>'i',  'й'=>'y',  'к'=>'k',
        'л'=>'l',  'м'=>'m',  'н'=>'n',
        'о'=>'o',  'п'=>'p',  'р'=>'r',
        'с'=>'s',  'т'=>'t',  'у'=>'u',
        'ф'=>'f',  'х'=>'h',  'ц'=>'c',
        'ч'=>'ch', 'ш'=>'sh', 'щ'=>'shch',
        'ы'=>'y',  'э'=>'e',  'ю'=>'yu',
        'я'=>'ya', 'ъ'=>'',   'ь'=>''];

    return str_replace(' ', '-', strtr(mb_strtolower(trim($str)), $converter));
}

function reArrayFiles($file)
{
    $file_ary   = [];
    $file_count = count($file['name']);
    $file_key   = array_keys($file);

    for ($i=0; $i < $file_count; $i++) {
        foreach ($file_key as $val) {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }

    return $file_ary;
}

// function config($dir, $params = __DIR__) {
// 	return include $params . '/'. $dir;
// }
