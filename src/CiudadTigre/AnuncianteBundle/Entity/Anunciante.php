<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anunciante
 *
 * @ORM\Table(name="anunciante", indexes={@ORM\Index(name="fk_anunciante_subcategoria_idx", columns={"subcategoria_id"})})
 * @ORM\Entity
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
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=45, nullable=false)
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
     * @ORM\Column(name="direccion", type="text", nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="rutaimg1", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="mapa", type="string", length=45, nullable=true)
     */
    private $mapa;

    /**
     * @var \Subcategoria
     *
     * @ORM\ManyToOne(targetEntity="Subcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subcategoria_id", referencedColumnName="id")
     * })
     */
    private $subcategoria;



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
     * @return Anunciante
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
}
