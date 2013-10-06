<?php
/**
 * View factory
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
use Commentar\ServiceBuilder\Builder as ServiceBuilder;
use Commentar\Auth\Authenticator;

/**
 * View factory
 *
 * @category   Commentar
 * @package    Presentation
 * @subpackage View
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Factory implements Builder
{
    /**
     * @var \Commentar\Presentation\ThemeLoader
     */
    private $theme;

    /**
     * @var \Commentar\ServiceBuilder\Builder
     */
    private $serviceFactory;

    /**
     * @var \Commentar\Auth\Authenticator
     */
    private $auth;

    /**
     * Creates instance
     *
     * @param \Commentar\Presentation\ThemeLoader $theme          The theme loader
     * @param \Commentar\ServiceBuilder\Builder   $serviceFactory Instance of a service factory
     * @param \Commentar\Auth\Authenticator       $auth           Instance of an authentication service
     */
    public function __construct(ThemeLoader $theme, ServiceBuilder $serviceFactory, Authenticator $auth)
    {
        $this->theme          = $theme;
        $this->serviceFactory = $serviceFactory;
        $this->auth           = $auth;
    }

    /**
     * Builds a view
     *
     * @param string $viewName      The name of the view to build
     * @param array  $viewVariables Optional list of view variables
     *
     * @return \Commentar\Presentation\View\View The created view
     */
    public function build($viewName, array $viewVariables = [])
    {
        if (strpos($viewName, '\\') === 0) {
            $fullyQualifiedViewName = $viewName;
        } else {
            $fullyQualifiedViewName = '\\Commentar\\Presentation\\View\\' . $viewName;
        }

        if (!class_exists($fullyQualifiedViewName)) {
            throw new InvalidViewException('Failed trying to load view (`' . $fullyQualifiedViewName . '`).');
        }

        return new $fullyQualifiedViewName($this->theme, $this->serviceFactory, $this->auth, $viewVariables);
    }
}
