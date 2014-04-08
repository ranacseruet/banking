<?php
/**
 * Card Entity
 *
 * @Table(name="cards")
 * @Entity
 */
class Card
{
    const CREDIT = 'cr';
    const DEBIT  = 'dr';

    /**
     * @var integer $id
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $type
     *
     * @Column(name="type", type="string", columnDefinition="ENUM('Cr', 'Dr')")
     */
    private $type;

    /**
     * @var string $cartNo
     *
     * @Column(name="card_no", type="string", length=12, nullable=false, unique=true)
     */
    private $cartNo;

    /**
     * @var string $pinNo
     *
     * @Column(name="pin_no", type="string", length=4, nullable=true)
     */
    private $pinNo;

    /**
     * @var \DateTime $expireDate
     *
     * @ORM\Column(name="expire_date", type="date", nullable=false)
     */
    private $expireDate;


    /**
     * @var \DateTime $issueDate
     *
     * @ORM\Column(name="issue_date", type="date", nullable=false)
     */
    private $issueDate;


    /**
     * @var $account;
     *
     * @ManyToOne(targetEntity="Account", inversedBy="cards")
     * @JoinColumn(name="account_id", referencedColumnName="id")
     **/
    private $account;


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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

        /**
     * @param mixed $account
     * @return $this;
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param \DateTime $updateDate
     * @return $this;
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
     * @param string $type
     * @return $this;
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
     * @param string $pinNo
     * @return $this;
     */
    public function setPinNo($pinNo)
    {
        $this->pinNo = $pinNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPinNo()
    {
        return $this->pinNo;
    }

    /**
     * @param \DateTime $issueDate
     * @return $this;
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * @param \DateTime $expireDate
     * @return $this;
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * @param \DateTime $createDate
     * @return $this;
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
     * @param string $cartNo
     * @return $this;
     */
    public function setCartNo($cartNo)
    {
        $this->cartNo = $cartNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCartNo()
    {
        return $this->cartNo;
    }

    /**
     * Return all type / enum type
     *
     * @return array
     */
    public static function getAllType()
    {
        return array(self::CREDIT => 'Credit',
                     self::DEBIT  => 'Debit');
    }

    /**
     * Return all rules for validation
     *
     * @return array
     */
    public static function getRules()
    {
        return array('card_no'              => 'required|numeric|min:12|unique:cards',
                     'pin_no'               => 'required|digits:4|confirmed',
		             'pin_no_confirmation'  => 'required|digits:4',
                     'expire_date'          => 'required|date',
                     'issue_date'           => 'required|date'
        );
    }
}
