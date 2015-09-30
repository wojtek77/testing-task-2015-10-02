<?php

namespace AdFinemSimpleFormBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Person
 *
 * @ORM\Table(options={"collate"="utf8_polish_ci"})
 * @ORM\Entity
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 * @UniqueEntity("email")
 */
class Person
{
    use traits\CreateUpdateFields;
    
    /**
     * @ORM\OneToMany(targetEntity="Attachment", mappedBy="person", cascade={"persist"})
     * 
     * @Assert\Valid
     * @Assert\Count(
     *      min = "1",
     *      max = "5",
     *      minMessage = "You must specify at least one attachment",
     *      maxMessage = "You cannot specify more than {{ limit }} attachments"
     * )
     */
    private $attachments;

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
     * @ORM\Column(name="name", type="string", length=10)
     * 
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     * 
     * @Assert\NotBlank()
     * @Assert\Expression(
     *     "this.isValidSurname()",
     *     message="If the name is began from 'A' the surname cannot be began from 'A'"
     * )
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * 
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkHost = true
     * )
     */
    private $email;
    
    public function __construct()
    {
        $this->attachments = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Person
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
     * Set surname
     *
     * @param string $surname
     *
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Person
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
     * Remove attachment
     *
     * @param \AdFinemSimpleFormBundle\Entity\Attachment $attachment
     */
    public function removeAttachment(\AdFinemSimpleFormBundle\Entity\Attachment $attachment)
    {
        $this->attachments->removeElement($attachment);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
    
    /**
     * Add attachment
     *
     * @param \AdFinemSimpleFormBundle\Entity\Attachment $attachment
     *
     * @return Person
     */
    public function addAttachment(\AdFinemSimpleFormBundle\Entity\Attachment $attachment)
    {
        $attachment->addPerson($this);
        
        $this->attachments[] = $attachment;

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
        /* remove NULL */
        if ($this->name === null) {
            $this->name = '';
        }
    }
    
    /**
     * A validate relation between fields "name" and "surname"
     * used by field "surname"
     * 
     * @return bool
     */
    public function isValidSurname()
    {
        return !isset($this->name{0})
                || $this->name{0} !== 'A'
                || $this->surname{0} !== 'A';
    }
}
