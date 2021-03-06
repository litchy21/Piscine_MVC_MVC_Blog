<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="billet")
 * @ORM\HasLifecycleCallbacks
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
	 * @var datetime $created
 	 * @ORM\Column(type="datetime")
	*/
	private $created;

	/**
	 * @var datetime $updated
 	 * @ORM\Column(type="datetime", nullable = true)
	*/
	private $updated;

	/**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new \DateTime("now");
    }

	/**
	 * @ORM\Column(type="integer")
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

	public function getId(){
		return $this->id;
	}

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