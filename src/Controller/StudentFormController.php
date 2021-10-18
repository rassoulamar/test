<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StudentFormController extends AbstractController
{
    /**
     * @Route("/student-form", name="student_form")
     */
    public function index(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            $this->addFlash('success',"L'étudiant est ajouté avec succès");

            return $this->redirectToRoute('student_form');
        }
        return $this->render('student_form/index.html.twig', [
            'controller_name' => 'StudentFormController',
            'student'=>$student,
            'form' => $form->createView(),
        ]);
    }
}
