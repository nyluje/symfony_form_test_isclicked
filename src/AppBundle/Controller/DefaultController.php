<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Entity;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
            $entity = new Entity();

            $form = $this->createForm('AppBundle\Form\FormType',$entity);


            $form->handleRequest($request);

            dump('form->isSubmitted(): '. $form->isSubmitted());
            dump('form->has(not_submit): '.$form->has('not_submit'));
            dump('form->get(not_submit)->isClicked: '.$form->get('not_submit')->isClicked());

            $isClicked = null;
            if($form->isSubmitted() && $form->has('not_submit')){
                $isClicked = 'Value for isClicked is ' . $form->get('not_submit')->isClicked();

            }

            if ($form->isSubmitted() && $form->isValid()) {
                // ... perform some action, such as saving the task to the database


            }



        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'form'=>$form->createView(),
            'is_clicked'=>$isClicked
        ]);

    }
}
