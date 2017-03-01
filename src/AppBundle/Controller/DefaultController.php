<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("test", name="test")
     */
    public function totoAction()
    {
        $tab = [
            'test1', 'test2', 'test3'
        ];

        foreach ($tab as $value) {
            echo $value;
        }

        dump($tab);

        return $this->render('test/test.html.twig', [
            'entries' => $tab,
        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $job = new Job();

        $job
            ->setTitle('my title')
            ->setDescription('my description');


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/mobile", name="homepage_mobile")
     *
     * @param Request $request
     * @return Response
     */
    public function indexMobileAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/mobile.html.twig');
    }
}
