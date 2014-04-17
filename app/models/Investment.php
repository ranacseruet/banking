<?php
/**
 * Account Entity
 *
 * @Table(name="investments")
 * @Entity
 */
class Investment 
{
    CONST SIX_MONTH  = 'SIX_MONTH';
    CONST ONE_YEAR   = 'ONE_YEAR';
    
    CONST FIXED = "FIXED";
    CONST VARIABLE = "VARIABLE";
    
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
     * @ManyToOne(targetEntity="User", inversedBy="investments")
     **/
    private $user;
    
    /**
     * @var int $termLength In months
     *
     * @Column(name="term_length", type="integer", nullable=false)")
     */
    private $termLength;
    
    /**
     * @var string $termType
     *
     * @Column(name="term_type", type="string", nullable=false, columnDefinition="ENUM('FIXED', 'VARIABLE')")
     */
    private $termType;
    
    /**
     * @var string $isActive
     *
     * @Column(name="is_active", type="boolean", nullable=false, options={"default":1})
     */
    private $isActive;
    
    /**
     * @var DateTime $createTime
     *
     * @Column(name="create_time", type="datetime")
     */
    private $createTime;
    
    /**
     * @var float $interestRate In Days
     *
     * @Column(name="interest_rate", type="float", nullable=false)")
     */
    private $interestRate;
    
    
    /**
     * @var float $amount In Days
     *
     * @Column(name="amount", type="float", nullable=false)")
     */
    private $amount;    
    
    
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

    public function getTermLength() {
        return $this->termLength;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setTermLength($termLength) {
        $this->termLength = $termLength;
        return $this;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
    }
    
    public function getTermType() {
        return $this->termType;
    }

    public function getInterestRate() {
        return $this->interestRate;
    }

    public function setTermType($termType) {
        $this->termType = $termType;
        return $this;
    }

    public function setInterestRate($interestRate) {
        $this->interestRate = $interestRate;
        return $this;
    }
    
    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function getInterestTotal($amount = 0)
    {
        if($amount == 0) {
            $amount = $this->amount;
        }
        return (((($this->interestRate)/12)*$this->termLength)/100)*$amount;
    }
    
    public function isMatured()
    {
        if(isset($this->isMatured)) {
            return $this->isMatured;
        }
        $now = new DateTime();
//        /echo $this->getMaturityDate()->getTimestamp()." : ".$now->getTimestamp();
        if($this->getMaturityDate()->getTimestamp() > $now->getTimestamp()) {
            return false;
        }
        return true;
    }
    
    public function getMaturityDate()
    {
        return $this->createTime->add(new DateInterval('P'.$this->termLength.'M'));
    }
}
