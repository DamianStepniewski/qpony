<?php

namespace App\Controller;

use App\Entity\Series;
use App\Form\SeriesType;
use App\Utils\SeriesCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    /**
     * @Route("/")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(SeriesType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = preg_split("/\r\n|\n|\r/", $form->getData()['inputData']);
            $out = [];
            foreach ($data as $v) {
                $out[$v] = SeriesCalculator::getMax($v);
            }

            return $this->render('series/result.html.twig', [
                'data' => $out
            ]);
        }

        return $this->render('series/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
