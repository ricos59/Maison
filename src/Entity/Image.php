<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
* @ORM\Table(name="image")
* @ORM\Entity
* @ORM\HasLifecycleCallbacks
*/
class Image
{
  /**
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;
  /**
  * @ORM\Column(name="url", type="string", length=255)
  */
  private $url;
  /**
  * @ORM\Column(name="alt", type="string", length=255)
  */
  private $alt;
  /**
  * @var UploadedFile
  */
  private $file;
  // On ajoute cet attribut pour y stocker le nom du fichier temporairement
  private $tempFilename;
}
