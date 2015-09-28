<?php

namespace AdFinemSimpleFormBundle\Entity\traits;

/**
 * Attention
 * in entity PHPdoc you must add
 * @ORM\HasLifecycleCallbacks
 * 
 * Trait for Doctrine adds fields "created_at" and "updated_at"
 * and care about fill these fields
 * 
 * @author Wojciech Brüggemann <wojtek77@o2.pl>
 */
trait CreateUpdateFields
{
    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updated
     * 
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Attachment
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
     *
     * @return Attachment
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
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->updatedAt = new \DateTime('now');

        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
    }
}
