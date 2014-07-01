<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anunciante
 */
class Anunciante
{
    /**
      * @var integer
      * 
      * @ORM\Column(name="id", type="integer", nullable=false)
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO") 
      */
    private $id;
    
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $rif;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telefono;


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
     * Set telefono
     *
     * @param string $telefono
     * @return Anunciante
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
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
}
