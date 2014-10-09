<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Anunciante
 *
 * @ORM\Table(name="anunciante", indexes={@ORM\Index(name="fk_anunciante_subcategoria_idx", columns={"subcategoria_id"})})
 * @ORM\Entity(repositoryClass="CiudadTigre\AnuncianteBundle\Entity\AnuncianteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Anunciante
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=45, nullable=false)
     * @Assert\NotBlank()
     */
    private $rif;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", nullable=true)
     */
    private $direccion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="avenida", type="text", nullable=true)
     */
    private $avenida;
    
    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="text", nullable=true)
     */
    private $sector;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="text", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     * @Assert\Email(checkMX=true, message = "Ingresa un email válido")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono1", type="string", length=45, nullable=false)
     */
    private $telefono1;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono2", type="string", length=45, nullable=true)
     */
    private $telefono2;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=45, nullable=true)
     */
    private $twitter;

    /**
     * @var integer
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits;

    /**
     * @var string
     *
     * @ORM\Column(name="horario", type="text", nullable=true)
     */
    private $horario;
    
    /**
    * @Assert\Image(maxSize = "500k")
    */
    protected $foto1;
    
    /**
    * @Assert\Image(maxSize = "500k")
    */
    protected $foto2;
    
    /**
    * @Assert\Image(maxSize = "500k")
    */
    protected $foto3;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaimg1", type="string", length=255, nullable=true)
     */
    private $rutaimg1;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaimg2", type="string", length=255, nullable=true)
     */
    private $rutaimg2;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaimg3", type="string", length=255, nullable=true)
     */
    private $rutaimg3;

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
     * @var string
     *
     * @ORM\Column(name="mapa", type="string", length=500, nullable=true)
     */
    private $mapa;

    /**
     * @var string
     *
     * @ORM\Column(name="promocionado", type="string", length=45, nullable=true)
     */
    private $promocionado;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=true)
     */
    private $habilitado;

    /**
     * @var \Subcategoria
     *
     * @ORM\ManyToOne(targetEntity="Subcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subcategoria_id", referencedColumnName="id")
     * })
     */
    private $subcategoria;
    
    
    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function __toString() 
    {
        return $this->getNombre();
    }

    /**
    * @param UploadedFile $foto
    */
    public function setFoto1(UploadedFile $foto = null)
    {
        $this->foto1 = $foto;
    }
    
    /**
    * @return UploadedFile
    */
    public function getFoto1()
    {
        return $this->foto1;
    }
    
    /**
    * @param UploadedFile $foto
    */
    public function setFoto2(UploadedFile $foto = null)
    {
        $this->foto2 = $foto;
    }
    
    /**
    * @return UploadedFile
    */
    public function getFoto2()
    {
        return $this->foto2;
    }
    
    /**
    * @param UploadedFile $foto
    */
    public function setFoto3(UploadedFile $foto = null)
    {
        $this->foto3 = $foto;
    }
    
    /**
    * @return UploadedFile
    */
    public function getFoto3()
    {
        return $this->foto3;
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
     * @return Anunciante
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
     * Set rif
     *
     * @param string $rif
     * @return Anunciante
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string 
     */
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Anunciante
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Anunciante
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Anunciante
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono1
     *
     * @param string $telefono1
     * @return Anunciante
     */
    public function setTelefono1($telefono1)
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    /**
     * Get telefono1
     *
     * @return string 
     */
    public function getTelefono1()
    {
        return $this->telefono1;
    }

    /**
     * Set telefono2
     *
     * @param string $telefono2
     * @return Anunciante
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    /**
     * Get telefono2
     *
     * @return string 
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Anunciante
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Anunciante
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Anunciante
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     * @return Anunciante
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set horario
     *
     * @param string $horario
     * @return Anunciante
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string 
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set rutaimg1
     *
     * @param string $rutaimg1
     * @return Anunciante
     */
    public function setRutaimg1($rutaimg1)
    {
        $this->rutaimg1 = $rutaimg1;

        return $this;
    }

    /**
     * Get rutaimg1
     *
     * @return string 
     */
    public function getRutaimg1()
    {
        return $this->rutaimg1;
    }

    /**
     * Set rutaimg2
     *
     * @param string $rutaimg2
     * @return Anunciante
     */
    public function setRutaimg2($rutaimg2)
    {
        $this->rutaimg2 = $rutaimg2;

        return $this;
    }

    /**
     * Get rutaimg2
     *
     * @return string 
     */
    public function getRutaimg2()
    {
        return $this->rutaimg2;
    }

    /**
     * Set rutaimg3
     *
     * @param string $rutaimg3
     * @return Anunciante
     */
    public function setRutaimg3($rutaimg3)
    {
        $this->rutaimg3 = $rutaimg3;

        return $this;
    }

    /**
     * Get rutaimg3
     *
     * @return string 
     */
    public function getRutaimg3()
    {
        return $this->rutaimg3;
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
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
     * Set mapa
     *
     * @param string $mapa
     * @return Anunciante
     */
    public function setMapa($mapa)
    {
        $this->mapa = $mapa;

        return $this;
    }

    /**
     * Get mapa
     *
     * @return string 
     */
    public function getMapa()
    {
        return $this->mapa;
    }

    /**
     * Set promocionado
     *
     * @param string $promocionado
     * @return Anunciante
     */
    public function setPromocionado($promocionado)
    {
        $this->promocionado = $promocionado;

        return $this;
    }

    /**
     * Get promocionado
     *
     * @return string 
     */
    public function getPromocionado()
    {
        return $this->promocionado;
    }

    /**
     * Set subcategoria
     *
     * @param \CiudadTigre\AnuncianteBundle\Entity\Subcategoria $subcategoria
     * @return Anunciante
     */
    public function setSubcategoria(\CiudadTigre\AnuncianteBundle\Entity\Subcategoria $subcategoria = null)
    {
        $this->subcategoria = $subcategoria;

        return $this;
    }

    /**
     * Get subcategoria
     *
     * @return \CiudadTigre\AnuncianteBundle\Entity\Subcategoria 
     */
    public function getSubcategoria()
    {
        return $this->subcategoria;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Anunciante
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Anunciante
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    
    public function subirFoto1()
    {
        if (null === $this->foto1) {
            return;
        }
        
        $directorioDestino = __DIR__.'/../../../../web/uploads/images/img-tiendas';
        $nombreArchivoFoto = uniqid('ciudad-').'-foto1.jpg';
        $this->foto1->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutaimg1($nombreArchivoFoto);
    }
    
    public function subirFoto2()
    {
        if (null === $this->foto2) {
            return;
        }
        
        $directorioDestino = __DIR__.'/../../../../web/uploads/images/img-tiendas';
        $nombreArchivoFoto = uniqid('ciudad-').'-foto2.jpg';
        $this->foto2->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutaimg2($nombreArchivoFoto);
    }
    
    public function subirFoto3()
    {
        if (null === $this->foto3) {
            return;
        }
        
        $directorioDestino = __DIR__.'/../../../../web/uploads/images/img-tiendas';
        $nombreArchivoFoto = uniqid('ciudad-').'-foto3.jpg';
        $this->foto3->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutaimg3($nombreArchivoFoto);
    }

    /**
     * Set avenida
     *
     * @param string $avenida
     * @return Anunciante
     */
    public function setAvenida($avenida)
    {
        $this->avenida = $avenida;

        return $this;
    }

    /**
     * Get avenida
     *
     * @return string 
     */
    public function getAvenida()
    {
        return $this->avenida;
    }

    /**
     * Set sector
     *
     * @param string $sector
     * @return Anunciante
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string 
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Anunciante
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set habilitado
     *
     * @param integer $habilitado
     * @return Anunciante
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    /**
     * Get habilitado
     *
     * @return integer 
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }
}
