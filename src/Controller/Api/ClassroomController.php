<?php

namespace App\Controller\Api;

use App\Controller\Api\Base\BaseController;
use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClassroomController
 * @package App\Controller
 * @Route("/classrooms", name="classroom_")
 */
class ClassroomController extends BaseController
{
    /** @var ClassroomRepository */
    protected $classroomRepo;
    /** @var EntityManagerInterface  */
    protected $em;

    /**
     * ClassroomController constructor.
     * @param EntityManagerInterface $em
     * @param ClassroomRepository $classroomRepo
     */
    public function __construct(EntityManagerInterface $em, ClassroomRepository $classroomRepo)
    {
        $this->em = $em;
        $this->classroomRepo = $classroomRepo;
    }

    /**
     * Add new classroom.
     *
     * @param Request $request
     * @return JsonResponse
     * @Route("", name="save", methods={"POST"})ph
     */
    public function postAction(Request $request): JsonResponse
    {
        $classroom = new Classroom();

        return $this->handleSaveAction($classroom, $request);

    }

    /**
     * Return all active classrooms.
     *
     * @Route("", name="classroooms_all", methods={"GET"})
     */
    public function getAll(): JsonResponse
    {
        return $this->json($this->classroomRepo->getActive());
    }

    /**
     * Return classroom by id.
     *
     * @Route("/{id}", name="classroom_one", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getOne(int $id): JsonResponse
    {
        $classroom = $this->getClassroom($id);

        return $this->json($classroom);
    }

    /**
     * @Route("/{id}", name="classroom_remove", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function removeOne(int $id): JsonResponse
    {
        $classroom = $this->getClassroom($id);

        $this->em->remove($classroom);
        $this->em->flush();

        return $this->json(['message' => 'Success']);
    }

    /**
     * Update classroom by id.
     *
     * @Route("/{id}", name="classroom_update", methods={"PUT"}, requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @return
     */
    public function updateOne(int $id, Request $request): JsonResponse
    {
        $classroom = $this->getClassroom($id);

        return $this->handleSaveAction($classroom, $request);
    }

    /**
     * Change isActive classroom field.
     *
     * @Route("/{id}/status", name="classroom_update", methods={"PATCH"}, requirements={"id"="\d+"})
     * @param Classroom $classroom
     * @return JsonResponse
     */
    public function statusChange(Classroom $classroom): JsonResponse
    {
        $isActive = !$classroom->getIsActive();
        $classroom->setIsActive($isActive);

        $this->em->persist($classroom);
        $this->em->flush();

        return new JsonResponse($classroom, Response::HTTP_OK);
    }

    /**
     * Find classroom.
     *
     * @param $id
     * @return Classroom
     */
    private function getClassroom($id): Classroom
    {
        $classroom = $this->classroomRepo->find($id);

        if (!$classroom) {
            throw $this->createNotFoundException();
        }

        return $classroom;
    }

    /**
     * Save Classroom entity.
     *
     * @param Classroom $classroom
     */
    private function saveClassroom(Classroom $classroom)
    {
        $this->em->persist($classroom);
        $this->em->flush();
    }

    /**
     * Get form errors.
     *
     * @param FormInterface $form
     * @return array
     */
    private function validateForm(FormInterface $form): array
    {
        if (!$form->isValid()) {
            return $this->getValidationErrorsArray($form);
        }

        return [];
    }

    /**
     * Save request data.
     *
     * @param Classroom $classroom
     * @param Request $request
     * @return JsonResponse
     */
    private function handleSaveAction(Classroom $classroom, Request $request): JsonResponse
    {
        $form      = $this->createForm(ClassroomType::class, $classroom);

        $form->submit($this->getJsonContent($request));

        $errors = $this->validateForm($form);

        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        $this->saveClassroom($classroom);

        return new JsonResponse($classroom, Response::HTTP_OK);
    }
}
