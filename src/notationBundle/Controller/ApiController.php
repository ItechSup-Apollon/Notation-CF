<?php

namespace notationBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use notationBundle\Entity\Person;
use notationBundle\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ApiController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('notationBundle:Api:index.html.twig');
    }


    /**
     * @Route("/api/session",name="api_session_ajout")
     */
    public function sessionAction(Request $request)
    {
        $session = new Session();

        $formSession = $this->createFormBuilder($session)
            ->add('intitule', 'text')
            ->add('enseignant',EntityType::class, array('class'=>'notationBundle:Person','choice_label'=>'nom'))
            ->add('eleve',EntityType::class, array('class'=>'notationBundle:Person','choice_label'=>'nom','multiple' => true))
            ->add('dateDebut', 'date')
            ->add('dateFin', 'date')
            ->add('save', 'submit', array('label' => 'ajouter une session'))
            ->getForm();

        $em= $this->getDoctrine()->getManager();
        $listeSession = $em->getRepository('notationBundle:Session')
            ->findAll();

        $formSession->handleRequest($request);

        if($formSession->isSubmitted() && $formSession->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            return $this->redirectToRoute('ajout_session');
        };


        return $this->render('notationBundle:Api:session.html.twig',array(
            'formsession' => $formSession -> createView(),
            'listesession' => $listeSession,
        ));
    }

    /**
     *
     * @Route("/api/session/{id}", name="api_session_detail")
     * @Method({"GET"})
     * @paramConverter("session",class="notationBundle:Session")
     */
    public function detailSessionAction(Request $request,Session $session){

        $formSession = $this->createFormBuilder($session)
            ->getForm();

        return $this->render('notationBundle:Api:detail.html.twig',array(
            'formsession' => $formSession -> createView(),
            'session' => $session,
        ));
            
    }


    /**
     * @Route("/api/personne/ajout",name="api_personne_ajout")
     */
    public function ajoutAction(Request $request)
    {

        $personne = new Person();

        $form = $this->createFormBuilder($personne)
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('save', 'submit', array('label' => 'ajouter une personne'))
            ->getForm();

        $em= $this->getDoctrine()->getManager();
        $liste = $em->getRepository('notationBundle:Person')
            ->findAll();



        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($personne);
                $em->flush();
                return $this->redirectToRoute('ajout_personne');
            };

        return $this->render(
            'notationBundle:Api:ajout.html.twig',
            array(
                'form' => $form -> createView(),
                'liste' => $liste,
            ));
    }
    /**
     * @Route("/api/personne/affiche/{id}",name="api_personne_affiche")
     * @Method({"GET"})
     */
    public function afficheAction(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $personne = $em->getRepository('notationBundle:Person')->find($id);

        $value = json_encode($personne);
        dump(json_last_error());
        dump($personne);
        dump($value);




    }

}
