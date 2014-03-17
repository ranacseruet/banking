<?php

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
}