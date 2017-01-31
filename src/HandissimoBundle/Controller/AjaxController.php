<?php

namespace HandissimoBundle\Controller;


use HandissimoBundle\Entity\DisabilityTypes;
use HandissimoBundle\Repository\DisabilityTypesRepository;
use HandissimoBundle\Repository\NeedsRepository;
use HandissimoBundle\Repository\OrganizationsRepository;
use HandissimoBundle\Repository\StaffRepository;
use HandissimoBundle\Repository\StructuresTypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use HandissimoBundle\Form\AdvancedSearchType;
use Symfony\Component\HttpFoundation\Session\Session;

class AjaxController extends Controller
{

    public function researchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('HandissimoBundle\Form\ResearchType');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $data = $form->getData();
            $age = $form->getData()['age'];
            $this->get('session')->set('data', $form->getData());
            $this->get('session')->set('age', $form->getData()['age']);
            $result = $em->getRepository('HandissimoBundle:Organizations')->getByOrganizationName($data, $age);
            $this->get('session')->set('result', $result);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate($result, $request->query->getInt('page', 1), 2);
            $this->get('session')->set('pagination', $pagination);
            return $this->redirectToRoute('advanced_research_action', array('pagination' => $pagination));
        }
        return $this->render('front/index.html.twig', array(
            'form' => $form->createView(),
        ));

    }





    public function advancedResearchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();




        $formAdvancedResearch = $this->createForm(AdvancedSearchType::class/*, $searchAdvanced, array('organizationsRepository' => ($em->getRepository('HandissimoBundle:Organizations')))*/  );
        $formAdvancedResearch->handleRequest($request);
        $session = $request->getSession();

        if ($formAdvancedResearch->isSubmitted() && $formAdvancedResearch->isValid()) {

            $data = $formAdvancedResearch->getData();
            $age = $formAdvancedResearch->getData()['age'];

            /**
            * @var $repository OrganizationsRepository
            */
            $result = $em->getRepository('HandissimoBundle:Organizations')->getByMultipleCriterias($data, $age);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate($result, $request->query->getInt('page', 1), 2);
            return $this->render('front/search.html.twig', array(
              'result' => $result,
              'keyword' =>  $data,
              'age' => $age,
              'pagination' => $pagination,
              'form' => $formAdvancedResearch->createView($pagination),
            ));
        }

          return $this->render('front/search.html.twig', array(
              'result' => $session->get('result'),
              'keyword' =>  $session->get('data'),
              'age' => $session->get('age'),
              'pagination' => $session->get('pagination'),
              'form' => $formAdvancedResearch->createView($session->get('pagination')),

          ));


    }

 

      public function autoCompleteAction(Request $request, $keyword)
      {
          if ($request->isXmlHttpRequest())
          {
              /**
               * @var $repository OrganizationsRepository
               */
            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:Organizations');
            $organization = $repository->getByOrganizations($keyword);

            /**
             * @var $repository NeedsRepository
             */
            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:Needs');
            $needs = $repository->getByNeeds($keyword);

            /**
             * @var $repository DisabilityTypesRepository
             */
            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:DisabilityTypes');
            $disability = $repository->getByDisability($keyword);

            /**
             * @var $repository StructuresTypesRepository
             */
            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:StructuresTypes');
            $structure = $repository->getByStructure($keyword);

            /**
             * @var $repository StaffRepository
             */
            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:Staff');
            $staff = $repository->getByStaff($keyword);

            $data =  array_merge($organization, $needs, $disability, $structure, $staff);

            return new JsonResponse(array("data" => json_encode($data)));
        } else {
            throw new HttpException("500", "Invalid Call");
        }
    }
    public function postalAction(Request $request, $postalcode)
    {
        /**
         * @var $repository OrganizationsRepository
         */
        if ($request->isXmlHttpRequest()) {

            $repository = $this->getDoctrine()->getRepository('HandissimoBundle:Organizations');
            $postal = $repository->getByPostal($postalcode);

           /* $repository = $this->getDoctrine()->getRepository('HandissimoBundle:Organizations');
            $city = $repository->getByCity($postalcode);*/

           // $data =  array_merge($postal, $city);

            return new JsonResponse(array("data" => json_encode($postal)));
        } else {
            throw new HttpException('500', 'Invalid call');
        }
    }
}