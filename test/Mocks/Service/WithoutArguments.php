<?php

namespace CommentarTest\Mocks\Service;

class WithoutArguments
{
    private $foo;

    public function __construct()
    {
        $this->foo = true;
    }

    public function test()
    {
        return $this->foo;
    }
}
