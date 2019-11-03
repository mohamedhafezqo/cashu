<?php

namespace App\Controller\API;

use App\Contract\DriverAdapterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;

/**
 * Class DriverController
 *
 * @Rest\Route("/api/driver")
 * 
 * @package App\Controller\Api
 */
class DriverController extends Controller
{
    /**
     * @param Request $request
     * @param DriverAdapterInterface $driverAdapter
     *
     * @Rest\View(serializerGroups={"Default"})
     * @Rest\Route("/list", name="driver_list", methods={"GET"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns list of files from the driver provider",
     * )
     *
     * @return Response
     */
    public function list(Request $request , DriverAdapterInterface $driverAdapter)
    {
        $data = $this
            ->get('jms_serializer')
            ->serialize(['files' => $driverAdapter->listFiles($request->query->all())], 'json')
        ;

        return Response::create($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @param Request $request
     *
     * @Rest\Get("/callback")
     *
     * @return Response
     */
    public function ProviderCallback(Request $request)
    {
        return $this->redirectToRoute('driver_list', ['code' => $request->get('code')]);
    }
}
