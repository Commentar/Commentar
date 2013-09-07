<?php

namespace CommentarTest\Mocks\Service;

class WithArguments
{
    private $foo;

    public function __construct($arg)
    {
        $this->foo = $arg;
    }

    public function test()
    {
        return $this->foo;
    }
}
