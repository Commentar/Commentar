<?php

namespace Commentar\Presentation\View;

class NotFound
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
        require $this->theme->getFile('blocks/error/not-found.phtml');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
