<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiResource(
 *      security= "is_granted('ROLE_USER')",
 *      collectionOperations={"get", "post"},
 *      itemOperations= {
 *          "put",
 *          "delete",
 *          "patch",
 *          "get"= {
 *              "controller"= NotFoundAction::class,
 *              "openapi_context"={
 *                  "summary"= "hidden",
 *              },
 *              "read"= false,
 *              "output"= false
 *          }
 *      } 
 * )
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read:Post")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read:Post")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="category")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCategory() === $this) {
                $post->setCategory(null);
            }
        }

        return $this;
    }
}
