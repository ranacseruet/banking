<?php
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
