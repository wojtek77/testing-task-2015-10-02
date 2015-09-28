<?php

namespace AdFinemSimpleFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attachment
 *
 * @ORM\Table(options={"collate"="utf8_polish_ci"})
 * @ORM\Entity
 * 
 * @ORM\HasLifecycleCallbacks
 */
class Attachment
{
    use traits\CreateUpdateFields;
    
    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="attachments")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id", nullable=false)
     */
    protected $person;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var binary
     *
     * @ORM\Column(name="data", type="blob")
     */
    private $data;

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
     * Set name
     *
     * @param string $name
     *
     * @return Attachment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Attachment
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set person
     *
     * @param \AdFinemSimpleFormBundle\Entity\Person $person
     *
     * @return Attachment
     */
    public function setPerson(\AdFinemSimpleFormBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \AdFinemSimpleFormBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
