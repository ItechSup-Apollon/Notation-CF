<?php

namespace notationBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use notationBundle\Entity\Person;
use notationBundle\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('notationBundle:Default:index.html.twig');
    }


    /**
     * @Route("/session",name="ajout_session")
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


        return $this->render('notationBundle:Default:session.html.twig',array(
            'formsession' => $formSession -> createView(),
            'listesession' => $listeSession,
        ));
    }

    /**
     *
     * @Route("/session/{id}/detail", name="detail_session")
     * @paramConverter("session",class="notationBundle:Session")
     */
    public function detailSessionAction(Request $request,Session $session){

        $formSession = $this->createFormBuilder($session)
            ->getForm();

        return $this->render('notationBundle:Default:detail.html.twig',array(
            'formsession' => $formSession -> createView(),
            'session' => $session,
        ));
            
    }


    /**
     * @Route("/personne/ajout",name="ajout_personne")
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
            'notationBundle:Default:ajout.html.twig',
            array(
                'form' => $form -> createView(),
                'liste' => $liste,
            ));
    }


}
