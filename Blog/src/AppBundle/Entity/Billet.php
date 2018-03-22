<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="billet")
*/

class Billet
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	*/
	private $id;

	/**
	 * @ORM\Column(type="string")
	*/
	private $created;

	/**
	 * @ORM\Column(type="string")
	*/
	private $updated;

	/**
	 * @ORM\Column(type="integer")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
	private $user_id;

	/**
	 * @ORM\Column(type="string")
	*/
	private $title;

	/**
	 * @ORM\Column(type="string")
	*/
	private $content;

	/**
	 * @ORM\Column(type="string")
	*/
	private $tags;


	public function getCreated()
	{
		return $this->created;
	}
	public function setCreated($created)
	{
		$this->created = $created;
	}

	public function getUpdated()
	{
		return $this->updated;
	}
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}

	public function getUser_id()
	{
		return $this->user_id;
	}
	public function setUser_id($user_id)
	{
		$this->user_id = $user_id;
	}

	public function getTitle()
	{
		return $this->title;
	}
	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}

	public function getTags()
	{
		return $this->tags;
	}
	public function setTags($tags)
	{
		$this->tags = $tags;
	}
}