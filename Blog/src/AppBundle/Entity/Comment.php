<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 * @ORM\HasLifecycleCallbacks
*/

class Comment
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
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime("now");
    }

	/**
	 * @ORM\Column(type="integer")
     */
	private $user_id;

	/**
	 * @ORM\Column(type="string")
	*/
	private $comment;

	/**
	 * @ORM\Column(type="integer")
	*/
	private $billet_id;

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

	public function getBillet_id()
	{
		return $this->billet_id;
	}
	public function setBillet_id($billet_id)
	{
		$this->billet_id = $billet_id;
	}

	public function getUser_id()
	{
		return $this->user_id;
	}
	public function setUser_id($user_id)
	{
		$this->user_id = $user_id;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function setComment($comment)
	{
		$this->comment = $comment;
	}
}