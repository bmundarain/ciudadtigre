<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="CiudadTigre\AnuncianteBundle\Entity\CategoriaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Categoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=24, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rutafoto", type="string", length=255, nullable=true)
     */
    private $rutafoto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
    * @Assert\Image(maxSize = "20k")
    */
    protected $foto;

    
    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function __toString() 
    {
        return $this->getNombre();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set rutafoto
     *
     * @param string $rutafoto
     * @return Categoria
     */
    public function setRutafoto($rutafoto)
    {
        $this->rutafoto = $rutafoto;

        return $this;
    }

    /**
     * Get rutafoto
     *
     * @return string 
     */
    public function getRutafoto()
    {
        return $this->rutafoto;
    }
    
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
       $this->setUpdatedAt(new \DateTime());
    }
    

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Categoria
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Categoria
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null)
    {
        $this->foto = $foto;
    }
    
    /**
     * @return UploadedFile
     */
    public function getFoto()
    {
        return $this->foto;
    }
    
    public function subirFoto()
    {
        if (null === $this->foto) {
            return;
        }
        
        $directorioDestino = __DIR__.'/../../../../web/uploads/images/img-directorio';
        $nombreArchivoFoto = uniqid('ciudad-').'-directorio.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutafoto($nombreArchivoFoto);
    }
}
