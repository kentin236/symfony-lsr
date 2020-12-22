<?php

namespace App\Controller;

use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\Schema;
use OpenApi\Annotations\Tag;
use OpenApi\Annotations as OpenApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route(path="/api/index", name="api_index", methods={"GET"})
     * @OpenApi\Response(
     *     response="200",
     *     description="api index route",
     *     @Schema()
     * )
     * @Parameter(
     *   name="toto",
     *   in="query",
     *   required=false,
     *   example="hello world"
     * )
     * @Tag(name="vanilla")
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->json([], Response::HTTP_OK);
    }

    /**
     * @Route(path="/api/index", name="api_index_post", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        return $this->json([], Response::HTTP_CREATED);
    }

    /**
     * @Route(path="/api/index/{id}", name="api_index_put", methods={"PUT"})
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function put(Request $request, $id): JsonResponse
    {
        return $this->json(['id' => $id], Response::HTTP_CREATED);
    }

    /**
     * @Route(path="/api/index/{id}", name="api_index_patch", methods={"PATCH"})
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function patch(Request $request, $id): JsonResponse
    {
        return $this->json(['id' => $id], Response::HTTP_CREATED);
    }

    /**
     * @Route(path="/api/index/{id}", name="api_index_delete", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->json(['id' => $id], Response::HTTP_ACCEPTED);
    }
}