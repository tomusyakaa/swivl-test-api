<?php


namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ExceptionSubscriber
 * @package App\EventSubscriber
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @return \array[][]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
            ],
        ];
    }

    /**
     * Return all exception in json way.
     *
     * @param ExceptionEvent $event
     */
    public function processException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $statusCode = Response::HTTP_BAD_REQUEST;
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        }

        $data = ['message' => $exception->getMessage()];

        $response = new JsonResponse($data, $statusCode);
        $event->setResponse($response);
    }

}