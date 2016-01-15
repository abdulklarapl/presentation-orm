<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use JMS\Serializer\Serializer;

/**
 * Class ViewListener
 * @package AppBundle\EventListener
 */
class ViewListener
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ViewListener constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof Response) {
            return $result;
        }

        $serialized = $this->serializer->serialize($result, 'json');
        $response = new Response();
        $response->setContent($serialized);
        $response->headers->add(array('Content-type' => 'application/json'));
        $event->setResponse($response);
    }
}
