<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
*/

class User implements UserInterface
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	*/
	private $id;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	*/
	private $username;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	*/
	private $name;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	*/
	private $lastname;

	/**
	 * @ORM\Column(type="date")
	 * @Assert\NotBlank()
	*/
	private $birthdate;

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
     * @Assert\Email()
	*/
	private $email;

	/**
	 * @ORM\Column(type="string", length=4096)
	 * @Assert\NotBlank()
	*/
	private $password;

	public function getId(){
		return $this->id;
	}
	public function getUsername()
	{
		return $this->username;
	}
	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}

	public function getLastname()
	{
		return $this->lastname;
	}
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function setBirthdate($birthdate)
	{
		$this->birthdate = $birthdate;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getRoles()
	{
		return ['ROLE_USER'];
	}
	public function getSalt()
	{
	}
	public function eraseCredentials()
	{
		$this->password = null;
	}
	public function serialize()
    {
        return serialize([$this->id, $this->username, $this->password]);
    }

    public function unserialize($serialized)
    {
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }
}