<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="FK_BF5476CAF8097ED5", columns={"id_demande"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type_notification", type="string", length=255, nullable=false)
     */
    private $typeNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="email_notification", type="string", length=255, nullable=false)
     */
    private $emailNotification;

    /**
     * @var int
     *
     * @ORM\Column(name="num_notification", type="integer", nullable=false)
     */
    private $numNotification;

    /**
     * @var \Demande
     *
     * @ORM\ManyToOne(targetEntity="Demande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_demande", referencedColumnName="ID")
     * })
     */
    private $idDemande;


}
