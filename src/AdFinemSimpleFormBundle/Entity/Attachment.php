<?php

namespace AdFinemSimpleFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var UploadedFile|resource
     *
     * @ORM\Column(name="file", type="blob")
     * 
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "1024k"
     * )
     * @Assert\Image()
     */
    private $file;
    
    /**
     * @var string
     *
     * @ORM\Column(name="original_name", type="string", length=255)
     */
    private $originalName;

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
     * Set file
     *
     * @param UploadedFile $file
     *
     * @return Attachment
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        $this->originalName = $file->getClientOriginalName();
        
        return $this;
    }

    /**
     * Get file
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Attachment
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }
    
    /**
     * Set person
     *
     * @param \AdFinemSimpleFormBundle\Entity\Person $person
     *
     * @return Attachment
     */
    public function setPerson(\AdFinemSimpleFormBundle\Entity\Person $person)
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
    
    /**
     * Add person
     *
     * @param \AdFinemSimpleFormBundle\Entity\Person $person
     *
     * @return Attachment
     */
    public function addPerson(\AdFinemSimpleFormBundle\Entity\Person $person)
    {
        if ($this->person === null) {
            $this->person = $person;
        }
        
        return $this;
    }
    
    /**
     * Extra actions before insert and update
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersistUpdate()
    {
        /* prepare "file" to saving to database */
        $file = $this->file;
        $this->file = file_get_contents($file->getRealPath());
    }
}
