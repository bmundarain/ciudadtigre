<?php

namespace CiudadTigre\AnuncianteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subcategoria
 *
 * @ORM\Table(name="subcategoria", indexes={@ORM\Index(name="fk_subcategoria_categoria_idx", columns={"categoria_id"})})
 * @ORM\Entity
 */
class Subcategoria
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rutafoto", type="string", length=45, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="promocionado", type="integer", nullable=true)
     */
    private $promocionado;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;



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
     * @return Subcategoria
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
     * @return Subcategoria
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
    
    public function setCreatedAtValue()
    {
      if(!$this->getCreatedAt())
      {
        $this->created_at = new \DateTime();
      }
    }

    public function setUpdatedAtValue()
    {
      $this->updated_at = new \DateTime();
    }
    
    /**
     * Set promocionado
     *
     * @param integer $promocionado
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
     * @return integer 
     */
    public function getPromocionado()
    {
        return $this->promocionado;
    }

    /**
     * Set categoria
     *
     * @param \CiudadTigre\AnuncianteBundle\Entity\Categoria $categoria
     * @return Subcategoria
     */
    public function setCategoria(\CiudadTigre\AnuncianteBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \CiudadTigre\AnuncianteBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Subcategoria
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
     * @return Subcategoria
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
