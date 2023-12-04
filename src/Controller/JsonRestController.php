<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class JsonRestController extends AbstractController
{
    /**
     * @Route("/json/rest", name="app_json_rest")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/JsonRestController.php',
        ]);
    }
     /**
     * @Route("/api/endpoint", name="get_json_request")
     */
    public function getRestJsonRequest()
    {
        
        $jsonMessage = "This is my info";

        // getting the file  path
        $jsonFile = $this->getParameter('kernel.project_dir') . '/public/data.json';

        // getting the file content
        $jsonData = file_get_contents($jsonFile);
        
        // decoding the json data
        $data = json_decode($jsonData, true);

        $developers = $data['developers'];


        return new JsonResponse(['Here are our developers: ' => $developers]);
    }

    public function postRestJsonRequest(Request $request)
    {
        // after using $request values and processing them

        return new JsonResponse(['message' => 'Data submitted successfully']);
    }
}
