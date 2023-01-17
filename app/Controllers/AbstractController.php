<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Pecee\SimpleRouter\SimpleRouter as Router;

abstract class AbstractController
{
    protected Request $request;
    protected Response $response;

    public function __construct()
    {
        $this->request = Router::router()->getRequest();
        $this->response = new Response($this->request);
    }

    /**
     * Render given html/php template by given template name
     * @param string $template
     * @return string
     */
    static function render(string $template): string
    {
        $template_path = self::resolveTemplatePath($template);

        return self::loadTemplate($template_path);
    }

    /**
     * Resolve template path and return it (php > html > RuntimeException)
     * @param string $template
     * @return string
     */
    private static function resolveTemplatePath(string $template): string
    {
        $template_path = ($_ENV['VIEWS_PATH'] ?? '') . str_replace('.', '/', $template);

        if (file_exists($template_path . '.php')) {
            return $template_path . '.php';
        } elseif(file_exists($template_path . '.html')) {
            return $template_path . '.html';
        } else {
            throw new \RuntimeException("Template with name '$template' not found by path '$template_path'");
        }
    }

    /**
     * Load given template in buffer and return it
     *
     * @param string $template_path
     * @return string
     */
    private static function loadTemplate(string $template_path): string
    {
        ob_start();
        include $template_path;
        return ob_get_clean();
    }
}