<?php
/**
 * Bill
 *
 * @Table(name="WireTransfer")
 * @Entity
 */
class WireTransfer
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
     * @Column(name="name", type="string", length=50, nullable=false, unique=true)
     */
    private $name;
    
    /**
     * @var string $bankName
     *
     * @Column(name="bankName", type="string", length=50, nullable=false, unique=true)
     */
    private $bankName;
    
    /**
     * @var string $accountNo
     *
     * @Column(name="accountNo", type="string", length=25, nullable=false, unique=true)
     */
    private $accountNo;
    
    /**
     * @var string $name
     *
     * @Column(name="address", type="string", length=255, nullable=false, unique=true)
     */
    private $address;
    
    /**
     * @var float $amount
     *
     * @Column(name="amount", type="float", length=25, nullable=false)
     */
    private $amount;
    
    /**
     * @var DateTime $type
     *
     * @Column(name="createTime", type="datetime")
     */
    private $createTime;
    
    
    /**
     * @var Account
     * @ManyToOne(targetEntity="Account")
     **/
    private $fromAccount;
    
    
    public function __construct() 
    {
        $this->payers = new Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return DxUsers
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

    public function getBankName() {
        return $this->bankName;
    }

    public function getAccountNo() {
        return $this->accountNo;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCreateTime() {
        return $this->createTime;
    }

    public function setBankName($bankName) {
        $this->bankName = $bankName;
        return $this;
    }

    public function setAccountNo($accountNo) {
        $this->accountNo = $accountNo;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setCreateTime(DateTime $createTime) {
        $this->createTime = $createTime;
        return $this;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getFromAccount() {
        return $this->fromAccount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function setFromAccount(Account $fromAccount) {
        $this->fromAccount = $fromAccount;
        return $this;
    }

}
