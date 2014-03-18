<?php
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Account Entity
 *
 * @Table(name="accounts")
 * @Entity
 */
class Account
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
     * @var string $accountNo
     *
     * @Column(name="account_no", type="string", length=12, nullable=false, unique=true)
     */
    private $accountNo;


    /**
     * @var string $interestRate
     *
     * @Column(name="interest_rate", type="float", nullable=true)
     */
    private $interestRate;


    /**
     * @var string $isActive
     *
     * @Column(name="is_active", type="boolean", nullable=false, options={"default":0})
     */
    private $isActive;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", columnDefinition="ENUM('Saving', 'checking', 'Investment')")
     */
    private $type;


   /**
    * @var string $user
    *
    * @ManyToOne(targetEntity="User", inversedBy="accounts")
    * @JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $user;


    /**
     * @var string $cards
     *
     * @OneToMany(targetEntity="Card", mappedBy="account")
     */
    private $cards;


    /**
     * @var \DateTime $createDate
     *
     * @ORM\Column(name="create_date", type="date", nullable=false)
     */
    private $createDate;

    /**
     * @var \DateTime $modifyDate
     *
     * @ORM\Column(name="update_date", type="datetime", nullable=false)
     */
    private $updateDate;
    
     /**
     * @var ArrayCollection $transactions
     *
     * @OneToMany(targetEntity="Transaction", mappedBy="account")
     */
    private $transactions;


    public function __construct()
    {
        $this->cards = new ArrayCollection();
        $this->transactions = new ArrayCollection();
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
     * @param $accountNo
     * @return $this
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @param string $interestRate
     * @return $this
     */
    public function setInterestRate($interestRate)
    {
        $this->interestRate = $interestRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    /**
     * @param string $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function getTransactions() 
    {
        return $this->transactions;
    }

    public function setTransactions(ArrayCollection $transactions)
    {
        $this->transactions = $transactions;
        return $this;
    }
    
}
