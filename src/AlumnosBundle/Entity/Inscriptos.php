<?php

namespace AlumnosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscriptos
 *
 * @ORM\Table(name="inscriptos", indexes={@ORM\Index(name="Reffos_user2", columns={"user_id"}), @ORM\Index(name="Refcurso4", columns={"curso_id"})})
 * @ORM\Entity
 */
class Inscriptos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_cursante", type="string", length=255, nullable=false)
     */
    private $tipoCursante;

    /**
     * @var string
     *
     * @ORM\Column(name="puntaje", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $puntaje;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion", type="string", length=255, nullable=true)
     */
    private $calificacion;

    /**
     * @var \AlumnosBundle\Entity\Curso
     *
     * @ORM\ManyToOne(targetEntity="AlumnosBundle\Entity\Curso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     * })
     */
    private $curso;

    /**
     * @var \AlumnosBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AlumnosBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Inscriptos
     */
    public function setFechaRegistro($fechaRegistro)
    {
        
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set tipoCursante
     *
     * @param string $tipoCursante
     * @return Inscriptos
     */
    public function setTipoCursante($tipoCursante)
    {
        $this->tipoCursante = $tipoCursante;

        return $this;
    }

    /**
     * Get tipoCursante
     *
     * @return string 
     */
    public function getTipoCursante()
    {
        return $this->tipoCursante;
    }

    /**
     * Set puntaje
     *
     * @param string $puntaje
     * @return Inscriptos
     */
    public function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;

        return $this;
    }

    /**
     * Get puntaje
     *
     * @return string 
     */
    public function getPuntaje()
    {
        return $this->puntaje;
    }

    /**
     * Set calificacion
     *
     * @param string $calificacion
     * @return Inscriptos
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set curso
     *
     * @param \AlumnosBundle\Entity\Curso $curso
     * @return Inscriptos
     */
    public function setCurso(\AlumnosBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \AlumnosBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set user
     *
     * @param \AlumnosBundle\Entity\User $user
     * @return Inscriptos
     */
    public function setUser(\AlumnosBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AlumnosBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
