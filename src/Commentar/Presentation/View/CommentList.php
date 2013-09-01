<?php

namespace Commentar\Presentation\View;

class CommentList
{
    private $theme;

    private $variables = [];

    public function __construct($theme, array $variables = [])
    {
        $this->theme     = $theme;
        $this->variables = $variables;
    }

    public function renderPage()
    {
        $this->content = $this->renderTemplate();

        ob_start();
        require $this->theme->getFile('page.phtml');
        $page = ob_get_contents();
        ob_end_clean();

        return $page;
    }

    protected function renderTemplate()
    {
        ob_start();
        require $this->theme->getFile('blocks/comments.phtml');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    protected function renderView($viewName, array $data = [])
    {
        $fullyQualifiedViewName = '\\Commentar\\Presentation\\View\\' . $viewName;
        $view = new $fullyQualifiedViewName($this->theme, $data);

        return $view->renderTemplate();
    }

    public function __set($key, $value)
    {
        $this->variables[$key] = $value;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->variables)) {
            throw new \Exception('Tryting to access an invalid view variable (`' . $key . '`).');
        }

        return $this->variables[$key];
    }
}
