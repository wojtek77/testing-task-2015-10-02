<?php

namespace AdFinemSimpleFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class AttachmentController extends Controller
{
    /**
     * @Route("/attachment/download/{id}", name="attachment_download")
     * @Template()
     */
    public function downloadAction(Request $request, $id)
    {
        /* @var $attachment \AdFinemSimpleFormBundle\Entity\Attachment */
        $attachment = $this->getDoctrine()
                ->getRepository('AdFinemSimpleFormBundle:Attachment')
                ->find($id);
        
        if (!$attachment) {
            throw $this->createNotFoundException();
        }
        
        $handle = $attachment->getFile();
        $content = stream_get_contents($handle);
        
        $response = new \Symfony\Component\HttpFoundation\Response($content);
        
        $d = $response->headers->makeDisposition(
            \Symfony\Component\HttpFoundation\ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $attachment->getOriginalName()
        );
        $response->headers->set('Content-Disposition', $d);
        
        return $response;
    }

}
