<?php

namespace MemoQuest\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * MotListe
 *
 * @ORM\Table(name="MQ_MOT_LISTE")
 * @ORM\Entity(repositoryClass="MemoQuest\Bundle\Entity\MotListeRepository")
 *
 * @ExclusionPolicy("all")
 */
class MotListe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ROW_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="MOT", type="string", length=255)
     *
     * @Constraints\NotNull
     * @Constraints\NotBlank
     * @Expose
     */
    private $mot;
    
    /**
     * @var string
     *
     * @ORM\Column(name="DEFINITION", type="string", length=255)
     *
     * @Constraints\NotNull
     * @Constraints\NotBlank
     * @Expose
     */
    private $definition;

	/**
     * @ORM\ManyToOne(targetEntity="Liste", inversedBy="mots", cascade={"persist"})
     * @ORM\JoinColumn(name="LIST_ID", referencedColumnName="ROW_ID")
     */
	private $liste;
	

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
     * Set mot
     *
     * @param string $mot
     * @return MotListe
     */
    public function setMot($mot)
    {
        $this->mot = $mot;

        return $this;
    }

    /**
     * Get mot
     *
     * @return string 
     */
    public function getMot()
    {
        return $this->mot;
    }

    /**
     * Set definition
     *
     * @param string $definition
     * @return MotListe
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string 
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Set liste
     *
     * @param \MemoQuest\Bundle\Entity\Liste $liste
     * @return MotListe
     */
    public function setListe(\MemoQuest\Bundle\Entity\Liste $liste = null)
    {
        $this->liste = $liste;

        return $this;
    }

    /**
     * Get liste
     *
     * @return \MemoQuest\Bundle\Entity\Liste 
     */
    public function getListe()
    {
        return $this->liste;
    }
}
