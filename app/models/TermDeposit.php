<?php
/**
 * Account Entity
 *
 * @Table(name="TermDeposit")
 * @Entity
 */
class TermDeposit 
{
    CONST SIX_MONTH  = 'SIX_MONTH';
    CONST ONE_YEAR   = 'ONE_YEAR';
    
    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var Bill
     * @ManyToOne(targetEntity="Account", inversedBy="termDeposits")
     **/
    private $account;
    
    /**
     * @var int $termLength In Days
     *
     * @Column(name="term_length", type="string", nullable=false, columnDefinition="ENUM('SIX_MONTH', 'ONE_YEAR')")
     */
    private $termLength;
    
    /**
     * @var string $isActive
     *
     * @Column(name="is_active", type="boolean", nullable=false, options={"default":1})
     */
    private $isActive;
    
    /**
     * @var DateTime $createTime
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

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
    
    public function getCreateTime() {
        return $this->createTime;
    }
    
    public function getAccount() {
        return $this->account;
    }

    public function getTermLength() {
        return $this->termLength;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setAccount(Bill $account) {
        $this->account = $account;
        return $this;
    }

    public function setTermLength($termLength) {
        $this->termLength = $termLength;
        return $this;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }
}
