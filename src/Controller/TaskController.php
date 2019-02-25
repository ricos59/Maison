<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskEditType;
use App\Form\TaskNewType;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/task")
 */
class TaskController extends AbstractController
{

    public function index(TaskRepository $taskRepository): Response
    {
      // dump( $this->getUser());
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findAll(),
        ]);
    }

    public function new(Request $request): Response
    {
        $task = new Task();
        $task->setDate(new \DateTime());
        $form = $this->createForm(TaskNewType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }


    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }


    public function edit(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskEditType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_index', [
                'id' => $task->getId(),
            ]);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, Task $task): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_index');
    }

    public function mytask(TaskRepository $taskRepository): Response
    {
      // dump( $this->getUser());
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findByUser($this->getUser()),
        ]);
    }

    public function mytaskday(TaskRepository $taskRepository): Response
    {

      // dump( $this->getUser());
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findByUserDate($this->getUser()),
            'tasks_late'=> $taskRepository->findByUserDateLate($this->getUser()),
        ]);
    }

    public function taskUser(TaskRepository $taskRepository, User $user): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findByUserDate($user),
            'tasks_late'=> $taskRepository->findByUserDateLate($user),
        ]);
    }

    public function menu(UserRepository $user): Response
    {

        return $this->render('menu.html.twig', [
            'users' =>$user->findAll(),
        ]);
    }
}
