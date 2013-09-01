<?php
/**
 * View class
 *
 * PHP version 5.4
 *
 * @category   Commentar
 * @package    Presentation
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace Commentar\Presentation\View;

use Commentar\Presentation\ThemeLoader;

/**
 * View class
 *
 * @category   Commentar
 * @package    Presentation
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class View
{
    /**
     * @var \Commentar\Presentation\ThemeLoader Instance of a theme loader
     */
    protected $theme;

    /**
     * @var array List of variables to make available to the template
     */
    protected $variables = [];

    /**
     * Creates instance
     *
     * @param \Commentar\Presentation\ThemeLoader $theme     Instance of a theme loader
     * @param array                               $variables List of variables to make available to the template
     */
    public function __construct(ThemeLoader $theme, array $variables = [])
    {
        $this->theme     = $theme;
        $this->variables = $variables;
    }

    /**
     * Renders a full page (i.e. including header, footer etc)
     *
     * @return string The content of the page
     */
    public function renderPage()
    {
        $this->content = $this->renderTemplate();

        return $this->getContent($this->theme->getFile('page.phtml'));
    }

    /**
     * Gets the content of a template
     *
     * @param string $filename The full filename to render
     *
     * @return string The rendered content
     */
    protected function getContent($filename)
    {
        ob_start();
        require $filename;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * Renders the template of the view
     *
     * @return string The rendered template
     */
    abstract public function renderTemplate();

    /**
     * Renders a view
     *
     * @param string $viewName The name of the view to render
     * @param array  $data     The optional data to make available to the new view's template
     *
     * @return string The rendered template
     */
    protected function renderView($viewName, array $data = [])
    {
        $fullyQualifiedViewName = $this->getFullyQualifiedViewName($viewName);
        $view = new $fullyQualifiedViewName($this->theme, $data);

        return $view->renderTemplate();
    }

    /**
     * Gets the fully qualified view name
     *
     * @param string $viewName The name of the view
     *
     * @return string The fully qualified name of the view
     */
    protected function getFullyQualifiedViewName($viewName)
    {
        if (strpos($viewName, '\\')) {
            return $viewName;
        }

        return '\\Commentar\\Presentation\\View\\' . $viewName;
    }

    /**
     * Magic setter for the view
     *
     * @param mixed $key   The key under which to store the value
     * @param mixed $value The value to store
     */
    public function __set($key, $value)
    {
        $this->variables[$key] = $value;
    }

    /**
     * Magic getter for the view
     *
     * @param mixed $key The key from which to get the value
     *
     * @return mixed The value that belongs to the key
     * @throws \Commentar\Presentation\View\InvalidViewVariableException When the key is not found
     */
    public function __get($key)
    {
        if (!array_key_exists($key, $this->variables)) {
            throw new InvalidViewVariableException('Tryting to access an invalid view variable (`' . $key . '`).');
        }

        return $this->variables[$key];
    }
}
