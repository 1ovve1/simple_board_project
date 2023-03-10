<?php declare(strict_types=1);

use Lowel\Workproject\App\Services\Auth;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

/**
 * Get url for a route by using either name/alias, class or method name.
 *
 * The name parameter supports the following values:
 * - Route name
 * - Controller/resource name (with or without method)
 * - Controller class name
 *
 * When searching for controller/resource by name, you can use this syntax "route.name@method".
 * You can also use the same syntax when searching for a specific controller-class "MyController@home".
 * If no arguments is specified, it will return the url for the current loaded route.
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}

/**
 * @param string|null $name
 * @param $parameters
 * @param array|null $getParams
 * @return string
 * @throws \InvalidArgumentException
 */
function route(?string $name = null, $parameters = null, ?array $getParams = null): string
{
    if (empty($_SERVER['HTTPS'])) {
        return 'http://' . url($name, $parameters, $getParams)->getAbsoluteUrl();
    } else {
        return 'https://' . url($name, $parameters, $getParams)->getAbsoluteUrl();
    }
}

/**
 * @param string $path
 * @return string
 */
function assets(string $path): string
{
    if (empty($_SERVER['HTTPS'])) {
        return 'http://' . url()->getHost() . '/assets/' . $path;
    } else {
        return 'https://' . url()->getHost() . '/assets/' . $path;
    }
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|mixed|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

/**
 * Paste html input element with csrf
 * @return string
 */
function csrf(): string
{
    return sprintf('<input type="hidden" id="csrf_token" name="csrf_token" value="%s">', csrf_token());
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

/**
 * Return config by filename from /config/ flooder
 * @param string $name
 * @return array
 */
function get_config(string $name): array
{
    $nameProtected = str_replace('..', '', $name);

    $path = __DIR__ . '/config/' . $nameProtected . '.php';

    if (!file_exists($path)) {
        throw new RuntimeException("Cannot find config by name '$name' (path: '$path'");
    }

    return (include $path);
}

/**
 * Return auth service
 * @return Auth|null
 */
function auth(): Auth|null
{
    return Auth::$instance;
}

/**
 * @return bool
 */
function is_auth(): bool
{
    return Auth::$instance !== null && Auth::$instance->user !== null;
}