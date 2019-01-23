<?php

namespace App\Controller;

use App\Entity\Gerechten;
use App\Form\GerechtenType;
use App\Repository\GerechtenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/gerechten")
 */
class GerechtenController extends AbstractController
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="gerechten_index", methods={"GET"})
     */

    public function index(gerechtenRepository $gerechtenRepository): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            return $this->render('gerechten/index.html.twig', ['gerechten' => $gerechtenRepository->findAll()]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }


    /**
     * @Route("/new", name="gerechten_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $gerechten = new Gerechten();
            $form = $this->createForm(GerechtenType::class, $gerechten);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($gerechten);
                $em->flush();
                return $this->redirectToRoute('gerechten_index');
            }
            return $this->render('gerechten/new.html.twig', [
                'user' => $gerechten,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }

    /**
     * @Route("/{id}", name="gerechten_show", methods={"GET"})
     */
    public function show(gerechten $gerechten): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            return $this->render('gerechten/show.html.twig', ['gerechten' => $gerechten]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }


    /**
     * @Route("/{id}/edit", name="gerechten_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, gerechten $gerechten): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $form = $this->createForm(GerechtenType::class, $gerechten);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('gerechten_edit', ['id' => $user->getId()]);
            }
            return $this->render('gerechten/edit.html.twig', [
                'gerechten' => $gerechten,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }

    /**
     * @Route("/{id}", name="gerechten_delete", methods={"DELETE"})
     */
    public function delete(Request $request, gerechten $gerechten): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            if ($this->isCsrfTokenValid('delete' . $gerechten->getId(), $request->request->get('_token'))) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($gerechten);
                $em->flush();
            }
            return $this->redirectToRoute('gerechten_index');
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
}