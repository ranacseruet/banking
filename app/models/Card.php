<?php
/**
 * Card Entity
 *
 * @Table(name="cards")
 * @Entity
 */
class Card
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
     * @var string $type
     *
     * @Column(name="type", type="varchar", columnDefinition="ENUM('Cr', 'Dr')")
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
}
