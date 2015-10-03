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
        $people = $this->getDoctrine()
                ->getRepository('AdFinemSimpleFormBundle:Person')
                ->findAll();
        
        return $this->render('AdFinemSimpleFormBundle:Default:list.html.twig', [
            'people' => $people
        ]);
//        return ['people' => $people];
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
    
    /**
     * @Route("/view/{id}", name="simple_form_view")
     * @Template()
     */
    public function viewAction(Request $request, $id)
    {
        /* @var $person Person */
        $person = $this->getDoctrine()
                ->getRepository('AdFinemSimpleFormBundle:Person')
                ->find($id);
        
        if (!$person) {
            throw $this->createNotFoundException();
        }
        
        return $this->render('AdFinemSimpleFormBundle:Default:view.html.twig', [
            'person' => $person
        ]);
    }
    
    /**
     * @Route("/edit/{id}", name="simple_form_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        /* @var $person Person */
        $person = $this->getDoctrine()
                ->getRepository('AdFinemSimpleFormBundle:Person')
                ->find($id);
        
        if (!$person) {
            throw $this->createNotFoundException();
        }
        
        /* workaround to disable attachments' relationship */
        $person->disableAttachmentsRelation();
        
        $form = $this->createForm(new PersonType(), $person);
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            
            return $this->redirectToRoute('simple_form_list', []);
        }
        
        return $this->render('AdFinemSimpleFormBundle:Default:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="simple_form_delete")
     * @Template()
     */
    public function deleteAction(Request $request)
    {
        
    }
}
