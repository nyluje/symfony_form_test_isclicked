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
            dump('form->has(get_away_from_form): '.$form->has('get_away_from_form'));
            dump('form->get(get_away_from_form)->isClicked: '.$form->get('get_away_from_form')->isClicked());

            $isClicked = null;
            if($form->isSubmitted() && $form->has('get_away_from_form')){
                if($form->get('get_away_from_form')->isClicked() == 1){
                    $isClicked = 'It works as expected: $form->get(get_away_from_form)->isClicked() = '.$form->get('get_away_from_form')->isClicked();
                } else {
                    $isClicked = 'It DOESN\'T work as expected: $form->get(get_away_from_form)->isClicked() = '.$form->get('get_away_from_form')->isClicked();
                }

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
