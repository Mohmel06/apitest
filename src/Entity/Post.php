<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *    normalizationContext={"groups"={"read:collection"}},
 *    denormalizationContext={"groups"={"write:Post"}},
 *    itemOperations={
 *          "put",
 *          "delete",
 *          "get"={
 *              "normalizationContext"={"groups"={"read:collection", "read:item", "read:Post"}}
 *           }
 *    }
 * )
 */

class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:collection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:collection", "write:Post"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:collection", "write:Post"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:item", "write:Post"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:item"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @Groups({"read:item", "write:Post"})
     */
    private $category;

    public function  __construct () {
        //  $this->CreatedAt = new \DateTime();
         $this->updateAt = new \DateTime();
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}