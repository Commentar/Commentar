<?php
/**
 * View factory interface
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

/**
 * View factory interface
 *
 * @category   Commentar
 * @package    Presentation
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Builder
{
    /**
     * Builds a view
     *
     * @param string $viewName      The name of the view to build
     * @param array  $viewVariables Optional list of view variables
     *
     * @return \Commentar\Presentation\View\View The created view
     */
    public function build($viewName, array $viewVariables = []);
}
