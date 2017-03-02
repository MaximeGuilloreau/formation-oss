<?php

namespace AppBundle\Listeners;

use AppBundle\Detector\MobileDetector;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RequestListener
 */
class RequestListener
{
    const MOBILE_ROUTE = 'homepage_mobile';

    /** @var MobileDetector */
    private $mobileDectector;

    /** @var RouterInterface */
    private $router;

    /**
     * @param MobileDetector  $mobileDetector
     * @param RouterInterface $router
     */
    public function __construct(MobileDetector $mobileDetector, RouterInterface $router)
    {
        $this->mobileDectector = $mobileDetector;
        $this->router = $router;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function analyzeRequest(GetResponseEvent $event)
    {
        // Verifie Request est bien la requete principal
        if (!$event->isMasterRequest()) {
            return;
        }

        $userAgent = $event->getRequest()->headers->get('User-agent');
        if ($this->mobileDectector->isMobile($userAgent)) {
            return;
        }

        $routeName = $event->getRequest()->attributes->get('_route');
        if ($routeName === null || $routeName === self::MOBILE_ROUTE) {
            return;
        }

//        $event->setResponse(
//            new RedirectResponse(
//                $this->router->generate(self::MOBILE_ROUTE, ['_locale' => 'en'])
//            )
//        );
    }
}
