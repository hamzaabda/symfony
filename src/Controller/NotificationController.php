<?php

namespace App\Controller;
use App\Entity\Demande;
use App\Entity\Notification;
use App\Form\NotificationType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;







/**
 * @Route("/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @Route("/table", name="app_notification_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $notifications = $entityManager
            ->getRepository(Notification::class)
            ->findAll();

        return $this->render('notification/index.html.twig', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * @Route("/pay", name="app_notification_indexx", methods={"GET"})
     */
    public function indexx(): Response
    {


        return $this->render('notification/payement.html.twig', [

        ]);
    }




    /**
     * @Route("/{id}/new", name="app_notification_new", methods={"GET", "POST"})
     */
    public function new(Request $request,Demande $demande , EntityManagerInterface $entityManager,DemandeRepository $repository,MailerInterface $mailer): Response
    {

        $notification = new Notification();

        $notification->setIdDemande($demande);
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->persist($notification);
            $entityManager->flush();
            $this->addFlash("success","votre reclamation a ete ajouter");
            $e=$form["emailNotification"]->getData();

            $email = (new Email())
                ->from('hamza.abda@esprit.tn')
                ->to($e)


                ->subject('???? votre demande ?? et?? trait?? ????ForU????')

                ->text('sending ');

            $mailer->send($email);

          /*  $sms = new SmsMessage(
            // the phone number to send the SMS message to
                '+21650890060',
                // the message
                'A new login was detected!'
            );

            $texter->send($sms); */


            return $this->redirectToRoute('app_notification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('notification/new.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_notification_show", methods={"GET"})
     */
    public function show(Notification $notification): Response
    {
        return $this->render('notification/show.html.twig', [
            'notification' => $notification,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_notification_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Notification $notification, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_notification_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('notification/edit.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, Notification $notification, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notification->getId(), $request->request->get('_token'))) {
            $entityManager->remove($notification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_notification_index', [], Response::HTTP_SEE_OTHER);
    }


}
