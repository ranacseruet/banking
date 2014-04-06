<?php
/**
 * Inevstment
 *
 * @Table(name="transactions")
 * @Entity
 */
class Transaction
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
     * @var $account;
     *
     * @ManyToOne(targetEntity="Account", inversedBy="transactions")
     * @JoinColumn(name="account_id", referencedColumnName="id")
     **/
    private $account;
    
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
}
