<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\Student1Type;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student-crud")
 */
class StudentCrudController extends AbstractController
{
    /**
     * @Route("/", name="student_crud_index", methods={"GET"})
     */
    public function index(StudentRepository $studentRepository): Response
    {
        return $this->render('student_crud/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="student_crud_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(Student1Type::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student_crud/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="student_crud_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student_crud/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_crud_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(Student1Type::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student_crud/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="student_crud_delete", methods={"POST"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
