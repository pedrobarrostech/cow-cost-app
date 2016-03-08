<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Cow;
use AppBundle\Form\Type\CowType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $list = $this->get('app.cow_request_service')->getList(); 
        $list = $this->calculateCowCostAction($list);
        return $this->render('cows/list.html.twig',
            array('list' => $list) 
        );
    }


    private function calculateCowCostAction($list)
    {
        foreach($list as $cow){
            $cost = $this->get('app.calculate_cow_cost')->calculate($cow->weight,$cow->age); 
            $cow->cost =$cost ;
        }

        return $list;
    }

    /**
     * @Route("/register", name="cow_registration")
     */
    public function registerAction(Request $request)
    { 
        $entity = new Cow();
        $form = $this->createForm(CowType::class, $entity, array(
            'action' => $this->generateUrl('cow_registration')
        ));

        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.cow_request_service')->insert($entity);
            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'cows/form-insert.html.twig',
            array('form' => $form->createView())
        );
    }
    


        


   



}
