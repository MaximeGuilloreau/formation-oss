<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Job;
use AppBundle\Form\JobType;
use AppBundle\Form\SearchJobType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/job")
 */
class JobController extends Controller
{
    /**
     * @Route("/", name="job_index")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $form = $this->createForm(SearchJobType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $jobs = $this->get('formation_oss.job.manager')->search($data);
        } else {
            $jobs = $this->get('formation_oss.job.manager')->findAll();
        }

        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="job_edit")
     *
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function editAction(Request $request, int $id): Response
    {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);

        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('formation_oss.object_saver')->save($job);

            return $this->redirectToRoute('job_show', ['id' => $job->getId()]);
        }

        return $this->render('job/edit.html.twig', [
            'form' => $form->createView(),
            'job' => $job,
        ]);
    }

    /**
     * @Route("/new", name="job_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('formation_oss.object_saver')->save($job);

            return $this->redirectToRoute('job_show', ['id' => $job->getId()]);
        }

        return $this->render('job/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_delete")
     * @Method({"POST", "DELETE"});
     *
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function deleteAction(Request $request, int $id): Response
    {
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($job);
        $em->flush();

        return $this->redirectToRoute('job_index');
    }

    /**
     * @Route("/{id}", name="job_show")
     * @Method({"GET"})
     *
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function showAction(Request $request, int $id): Response
    {
        $deleteForm = $this
            ->createFormBuilder()
            ->setAction($this->generateUrl('job_delete', ['id' => $id]))
            ->getForm();
        $job = $this->getDoctrine()->getRepository(Job::class)->find($id);

        return $this->render('job/show.html.twig', [
            'deleteForm' => $deleteForm->createView(),
            'job' => $job,
        ]);
    }
}
