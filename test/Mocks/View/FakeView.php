<?php

namespace CommentarTest\Mocks\View;

use Commentar\Presentation\View\View;

class FakeView extends View
{
    /**
     * Renders the template of the view
     *
     * @return string The rendered template
     */
    public function renderTemplate()
    {
        return 'fake view';
    }
}
