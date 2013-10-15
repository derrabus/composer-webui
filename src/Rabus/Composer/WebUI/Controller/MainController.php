<?php

namespace Rabus\Composer\WebUI\Controller;

use Composer\Composer;
use Composer\Package\PackageInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController
{
    /**
     * @var Composer
     */
    private $composer;

    /**
     * @param Composer $composer
     */
    public function __construct(Composer $composer)
    {
        $this->composer = $composer;
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        $content = '<html><body><table>';

        foreach ($this->composer->getRepositoryManager()->getLocalRepository()->getPackages() as $currentPackage) {
            /** @var PackageInterface $currentPackage */
            $content .= '<tr><td>'
                . $currentPackage->getPrettyName()
                . '</td><td>'
                . $currentPackage->getPrettyVersion() . '</td></tr>';
        }

        $content .= '</table></body></html>';

        return Response::create($content);
    }
}
