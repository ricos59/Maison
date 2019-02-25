<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity(repositoryClass="App\Repository\UserRepository")
*/
class User extends BaseUser
{
  /**
  * @ORM\Id()
  * @ORM\GeneratedValue()
  * @ORM\Column(type="integer")
  */
  protected $id;

  /**
  * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
  * @Assert\Valid()
  */
  private $image;

  public function __construct()
  {
    parent::__construct();
    // your own logic
  }

  public function getId(): ?int
  {
    return $this->id;
  }
}
