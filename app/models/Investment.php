<?php
/**
 * Inevstment
 *
 * @Table(name="investments")
 * @Entity
 */
class Investment
{
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=25, nullable=false, unique=true)
     */
    private $name;
    
    /**
     * @var string $type fixed|open
     *
     * @Column(name="type", type="string", length=25, nullable=false)
     */
    private $type;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ManyToMany(targetEntity="Account", inversedBy="payees")
     * @JoinTable(name="account_payee")
     **/
    //private $accounts;
    
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
     * @return Investment
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
     * Set type
     *
     * @param string type
     * @return Investment
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    public function getAccounts() 
    {
        
    }

}
