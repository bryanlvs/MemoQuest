<?php

namespace MemoQuest\Bundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use MemoQuest\Bundle\Entity\User;
use MemoQuest\Bundle\Form\UserType;

class UserController extends FOSRestController implements ClassResourceInterface
{
    /**
     * Collection get action
     * @var Request $request
     * @return array
     *
     * @Rest\View()
     */
    public function cgetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MemoQuestBundle:User')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Get action
     * @var integer $userEmail email of the entity
     * @return array
     *
     * @Rest\View()
     */
    public function getAction($userEmail)
    {
        $em = $this->getDoctrine()->getManager();
    	
        $entity = $em->getRepository('MemoQuestBundle:User')->findOneBy(
            array(
                'email' => $userEmail,
            )
        );
        
        return array(
            'entity' => $entity,
        );
    }

    /**
     * Get entity instance
     * @var integer $id Id of the entity
     * @return User
     */
    protected function getEntity($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MemoQuestBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('User inexistant');
        }

        return $entity;
    }
    
    /**
     * Collection post action
     * @var Request $request
     * @return View|array
     */
    public function cpostAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectView(
                $this->generateUrl(
                    'get_user',
                    array('userEmail' => $entity->getEmail())
                ),
                Codes::HTTP_CREATED
            );
        }

        return array(
            'form' => $form,
        );
    }
    
    /**
     * Put action
     * @var Request $request
     * @var integer $id Id of the entity
     * @return View|array
     */
    public function putAction(Request $request, $id)
    {
        $entity = $this->getEntity($id);
        $form = $this->createForm(new UserType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Delete action
     * @var integer $id Id of the entity
     * @return View
     */
    public function deleteAction($id)
    {
        $entity = $this->getEntity($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }
}