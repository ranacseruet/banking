<?php
/**
 * Account Entity
 *
 * @Table(name="payees")
 * @Entity
 */
class Payee 
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
     * @var User
     * @ManyToOne(targetEntity="User", inversedBy="payees")
     **/
    private $user;
    
    /**
     * @var Bill
     * @ManyToOne(targetEntity="Bill", inversedBy="payers")
     **/
    private $bill;
    
    /**
     * @var string $type debit|credit
     *
     * @Column(name="accountNo", type="string", length=20, nullable=false)
     */
    private $accountNo;
    
    /**
     * @var string $type debit|credit
     *
     * @Column(name="createTime", type="datetime")
     */
    private $createTime;
    
    public function __construct() 
    {
        $this->createTime = new DateTime();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getBill() {
        return $this->bill;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setBill(Bill $bill) {
        $this->bill = $bill;
        return $this;
    }

    public function getCreateTime() {
        return $this->createTime;
    }
    
    public function getAccountNo() {
        return $this->accountNo;
    }

    public function setAccountNo($accountNo) {
        $this->accountNo = $accountNo;
        return $this;
    }
    
}
