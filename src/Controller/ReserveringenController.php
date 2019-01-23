<?php

namespace App\Controller;

use App\Entity\Reserveringen;
use App\Form\ReserveringenType;
use App\Repository\ReserveringenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/reserveringen")
 */
class ReserveringenController extends AbstractController
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="reserveringen_index", methods={"GET"})
     */

    public function index(reserveringenRepository $reserveringenRepository): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            return $this->render('reserveringen/index.html.twig', ['reserveringen' => $reserveringenRepository->findAll()]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }


    /**
     * @Route("/new", name="reserveringen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $reserveringen = new reserveringen();
            $form = $this->createForm(ReserveringenType::class, $reserveringen);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($reserveringen);
                $em->flush();
                return $this->redirectToRoute('reserveringen_index');
            }
            return $this->render('reserveringen/new.html.twig', [
                'user' => $reserveringen,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }

    /**
     * @Route("/{id}", name="reserveringen_show", methods={"GET"})
     */
    public function show(reserveringen $reserveringen): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            return $this->render('reserveringen/show.html.twig', ['reserveringen' => $reserveringen]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }


    /**
     * @Route("/{id}/edit", name="reserveringen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, reserveringen $reserveringen): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $form = $this->createForm(ReserveringenType::class, $reserveringen);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('reserveringen_edit', ['id' => $user->getId()]);
            }
            return $this->render('reserveringen/edit.html.twig', [
                'reserveringen' => $reserveringen,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }

    /**
     * @Route("/{id}", name="reserveringen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, reserveringen $reserveringen): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            if ($this->isCsrfTokenValid('delete' . $reserveringen->getId(), $request->request->get('_token'))) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($reserveringen);
                $em->flush();
            }
            return $this->redirectToRoute('reserveringen_index');
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
}