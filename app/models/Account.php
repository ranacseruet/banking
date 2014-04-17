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
    CONST SAVING        = 'saving';
    CONST CHECKING      = 'checking';
    CONST INVESTMENT    = 'investment';
    CONST CREDIT_CARD   = 'credit_card';

    CONST APPROVED        = 1;
    CONST UNAPPROVED      = 0;


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
     * @Column(name="account_no", type="bigint", nullable=false, unique=true)
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
     * @Column(name="type", type="string", columnDefinition="ENUM('saving', 'checking', 'investment', 'credit_card')")
     */
    private $type;

   /**
    * @var string $user
    *
    * @ManyToOne(targetEntity="User", inversedBy="accounts", cascade={"persist", "remove"})
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
     * @Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;


    /**
     * @var \DateTime $modifyDate
     *
     * @Column(name="update_date", type="datetime", nullable=false)
     */
    private $updateDate;
    
     /**
     * @var ArrayCollection $transactions
     *
     * @OneToMany(targetEntity="Transaction", mappedBy="account")
     */
    private $transactions;
    
    /**
     * @var Bill $billingAccount
     *
     * @OneToOne(targetEntity="Bill", mappedBy="account")
     */
    private $billingAccount;
    
    public function __construct()
    {
        $this->cards        = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->updateDate   = new DateTime('now');
        $this->createDate   = new DateTime();
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

    /**
     * @param \DateTime $createDate
     * @return $this
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $updateDate
     * @return $this
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $cards
     * @return $this
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
        return $this;
    }

    /**
     * Return the array collection of card
     *
     * @return string
     */
    public function getCards()
    {
        return $this->cards;
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
    
    public function getBillingAccount() {
        return $this->billingAccount;
    }

    /**
     * Return all statues / enum type
     *
     * @return array
     */
    public static function getALLStatuses()
    {
        return array(self::SAVING       => 'Saving',
                     //self::INVESTMENT   => 'Investment',
                     self::CHECKING     => 'Checking');
                     //self::CREDIT_CARD  => "Credit Card");
    }

    /**
     * Return total balance
     *
     * @return double
     */
    public function getBalance()
    {
        $bal = 0;
        if ($this->transactions->count() > 0 ) {
            foreach($this->transactions as $transaction) {
                if($transaction->getType() == Transaction::CREDIT) {
                    $bal += $transaction->getAmount();
                }
                else {
                    $bal -= $transaction->getAmount();
                }
            }
        }
        return $bal;
    }

    /**
     * Return all rules for validation
     *
     * @return array
     */
    public static function getRules()
    {
        return array('account_no'    => 'required|numeric|min:12|unique:accounts',
                     'interest_rate' => 'required|numeric',
                     'type'          => 'required'
        );
    }

    /**
     * Return all rules for validation
     *
     * @return array
     */
    public static function getRulesUserApply()
    {
        return array('account_no'    => 'required|numeric|min:12|unique:accounts',
                     'type'          => 'required'
        );
    }


    /**
     * Return all rules for validation
     *
     * @return array
     */
    public static function getRulesForDeposit()
    {
        return array('account_no' => 'required',
                     'amount'     => 'required|numeric'
        );
    }
    
    public static function generateAccountNo()
    {
       $query =  Doctrine::createQueryBuilder("Account");
       $query->select('MAX(a.accountNo) AS accountNo');
       $query->from("Account", "a");
       $result = $query->getQuery()->getOneOrNullResult();
       
       if(!$result || $result["accountNo"]==0) {
           return 100000000000;
       }
       return intval($result["accountNo"])+1;
    }
}
