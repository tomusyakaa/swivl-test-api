<?php

namespace App\Controller\Api\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class BaseController
 * @package App\Controller\Api\Base
 */
class BaseController extends AbstractController
{

    /**
     * Returns array of form errors.
     *
     * @param FormInterface $form
     * @return array
     */
    protected function getValidationErrorsArray(FormInterface $form): array
    {
        $errors = array();

        foreach ($form->getErrors(true) as $error) {
            $errors[$error->getOrigin()->getName()] = $error->getMessage();
        }

        return $errors;
    }

    /**
     * Return request data.
     *
     * @param Request $request
     * @return array
     */
    protected function getJsonContent(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}