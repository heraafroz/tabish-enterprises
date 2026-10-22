
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$supportedLanguages = ['ar', 'de', 'en', 'es', 'fr'];

if (
    isset($_GET['lang']) &&
    in_array($_GET['lang'], $supportedLanguages, true)
) {
    $_SESSION['lang'] = $_GET['lang'];
}

$currentLang = $_SESSION['lang'] ?? 'en';

if (!in_array($currentLang, $supportedLanguages, true)) {
    $currentLang = 'en';
    $_SESSION['lang'] = 'en';
}

$languageFile = __DIR__ . '/../languages/' . $currentLang . '.php';

if (!is_file($languageFile)) {
    $currentLang = 'en';
    $_SESSION['lang'] = 'en';
    $languageFile = __DIR__ . '/../languages/en.php';
}

$loadedTranslations = require $languageFile;

$translations = is_array($loadedTranslations)
    ? $loadedTranslations
    : [];

if (!is_array($translations)) {
    $translations = [];
}

// General translation function
if (!function_exists('t')) {
    function t($key, $default = '')
    {
        global $translations;

        $value = $translations[$key] ?? null;

        // Return only strings, not nested arrays.
        if (is_string($value) || is_numeric($value)) {
            return (string) $value;
        }

        if (is_string($default) && $default !== '') {
            return $default;
        }

        return $key;
    }
}

// Service translation function
if (!function_exists('t_service')) {
    function t_service($name, $field, $default = '')
    {
        global $translations;

        $value = $translations['services'][$name][$field] ?? null;

        if (is_string($value) || is_numeric($value)) {
            return (string) $value;
        }

        return is_string($default) ? $default : '';
    }
}
