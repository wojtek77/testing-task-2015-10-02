<?php

namespace AdFinemSimpleFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use AdFinemSimpleFormBundle\Entity\Person;
use AdFinemSimpleFormBundle\Form\Type\PersonType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="simple_form_list")
     * @Template()
     */
    public function listAction(Request $request)
    {
        
    }
    
    /**
     * @Route("/add", name="simple_form_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $person = new Person();
        
        $form = $this->createForm(new PersonType(), $person);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            
            return $this->redirectToRoute('simple_form_list', []);
        }
        
        return $this->render('AdFinemSimpleFormBundle:Default:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
