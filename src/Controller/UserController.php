<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    protected $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(): Response
    {
        // if user == 'ROLE_ADMIN'
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
            return $this->render('user/index.html.twig', ['users' => $users]);
        } elseif ($this->security->isGranted('ROLE_USER')) {
            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
            return $this->render('user/index.html.twig', ['users' => $users]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
        //}
    }
    /**
     * @Route("/new", name="user_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('user_index');
            }
            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            return $this->render('user/show.html.twig', ['user' => $user]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
            }
            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();
            }
            return $this->redirectToRoute('user_index');
        } else {
            return $this->render('message/noAccess.html.twig');
        }
    }
}