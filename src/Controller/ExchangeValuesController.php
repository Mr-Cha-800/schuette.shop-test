<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DevelopersHistory;
use Symfony\Component\HttpFoundation\Request;

class ExchangeValuesController extends AbstractController
{
    /**
     * @Route("/exchange/values", name="app_exchange_values")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ExchangeValuesController.php',
        ]);
    }

    /**
     * @Route("/api/exchange/all/values", name="app_exchange_values")
     */
    public function getAllHistoryRows(): JsonResponse
    {
        
        $historyRepository = $this->getDoctrine()->getRepository(DevelopersHistory::class);
        $historyRecords = $historyRepository->findAll();

        $response = [];
        foreach ($historyRecords as $record) {
            $response[] = [
                'id' => $record->getId(),
                'first_in' => $record->getFirstIn(),
                'second_in' => $record->getSecondIn(),
                'first_out' => $record->getFirstOut(),
                'second_out' => $record->getSecondOut(),
                'created_at' => $record->getCreatedAt()->format('Y-m-d H:i:s'),
                'updated_at' => $record->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($response);
    }
    public function postExchangeValuesRequest(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get JSON data from the request
        $requestData = json_decode($request->getContent(), true);

        // Extract parameters
        $first = $requestData['first'];
        $second = $requestData['second'];

        // Create a new History entity and save to the database
        $developers_history = new DevelopersHistory();
        $developers_history->setFirstIn($first);
        $developers_history->setSecondIn($second);
        $developers_history->setCreatedAt(new \DateTime());
        $developers_history->setUpdatedAt(new \DateTime());

        $entityManager->persist($developers_history);
        $entityManager->flush();

        // Exchange values using  ^ because of the rule in the file
        $first = $first ^ $second;
        $second = $first ^ $second;
        $first = $first ^ $second;

        // Update the entity with exchanged values and update date
        $developers_history->setFirstOut($first);
        $developers_history->setSecondOut($second);
        $developers_history->setUpdatedAt(new \DateTime());

        $entityManager->persist($developers_history);
        $entityManager->flush();

        // Return a JSON response
        return new JsonResponse(['message' => 'Values exchanged and saved']);
    
    }
    
}
