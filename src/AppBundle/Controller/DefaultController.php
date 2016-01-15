<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\Serializer;

class DefaultController extends Controller
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param PostRepository $postRepository
     */
    public function setPostRepository($postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostNative(Request $request)
    {
        return $this->postRepository->findAll();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostSimpleAction(Request $request)
    {
        return $this->postRepository->getAll();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostJsonAction(Request $request)
    {
        return $this->postRepository->getAllInJson();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostJsonSimpleAction(Request $request)
    {

        $json = $this->postRepository->getAllInJson(false);
        $response = new Response();
        $response->setContent($json);
        $response->headers->add(array('Content-type' => 'application/json'));
        return $response;
    }
}
