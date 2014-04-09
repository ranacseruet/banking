<?php
/**
 * Inevstment
 *
 * @Table(name="transactions")
 * @Entity
 */
class Transaction
{
    CONST DEBIT     = 'D';
    CONST CREDIT   = 'C';
    
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float $amount
     *
     * @Column(name="amount", type="float", length=25, nullable=false)
     */
    private $amount;
    
    /**
     * @var string $type debit|credit
     *
     * @Column(name="type", type="string", length=25, nullable=false)
     */
    private $type;
    
    /**
     * @var string $type debit|credit
     *
     * @Column(name="description", type="string", length=250, nullable=true)
     */
    private $description;

     /**
     * @var string $type debit|credit
     *
     * @Column(name="create_time", type="datetime")
     */
    private $createTime;
    
     /**
     * @var $account;
     *
     * @ManyToOne(targetEntity="Account", inversedBy="transactions", cascade={"persist", "remove"})
     * @JoinColumn(name="account_id", referencedColumnName="id")
     **/
    private $account;
    
    public function __construct() 
    {
        $this->createTime = new DateTime();
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
     * Set amount
     *
     * @param float $amount
     * @return Investment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
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
    
    /**
     * Get account
     *
     * @return Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
    
    /**
     * Set account
     *
     * @param Account type
     * @return Transaction
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getCreateTime() {
        return $this->createTime;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setCreateTime($createTime) {
        $this->createTime = $createTime;
        return $this;
    }
}
