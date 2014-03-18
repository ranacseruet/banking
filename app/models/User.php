<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * User Entity
 *
 * @Table(name="users")
 * @Entity
 */
class User
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
     * @var string $username
     *
     * @Column(name="username", type="string", length=30, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string $password
     *
     * @Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;


    /**
     * @var string $roolId
     *
     * @Column(name="rool_id", type="smallint", nullable=false)
     */
    private $roolId;

    /**
     * @var string $firstName
     *
     * @Column(name="first_name", type="string", length=50, nullable=true)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @Column(name="last_name", type="string", length=50, nullable=true)
     */
    private $lastName;


    /**
     * @var string $accounts
     *
     * @OneToMany(targetEntity="Account", mappedBy="user")
     **/
    private $accounts;


    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * @param string $accounts
     * @return $this;
     */
    public function setAccounts($accounts)
    {
        $this->accounts = $accounts;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $roolId
     * @return $this
     */
    public function setRoolId($roolId)
    {
        $this->roolId = $roolId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoolId()
    {
        return $this->roolId;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}