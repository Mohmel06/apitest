<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use App\Controller\PostCountController;
use App\Controller\PostPublishController;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *    normalizationContext={
 *          "groups"={"read:collection"}
 *    },
 *    denormalizationContext={"groups"={"write:Post"}},
 *    paginationItemsPerPage= 2,
 *    paginationMaximumItemsPerPage = 2,
 *    paginationClientItemsPerPage = true,
 *    collectionOperations={
 *          "get", 
 *          "post",
 *          "count"= {
 *              "method"= "GET",
 *              "path"= "/posts/count",
 *              "controller"=" PostCountController::class",
 *              "read"= false,
 *              "pagination_enabled"= false,
 *              "filter"={},
 *          }
 *    },
 *    itemOperations={
 *          "put",
 *          "delete",
 *          "get"={
 *              "normalizationContext"={
 *                  "groups"={"read:collection", "read:item", "read:Post"},
 *                  "openapi_definition_name"= "Detail"
 *              }
 *           },
 *           "publish"={
 *              "method" = "POST",
 *              "patch" = "/posts/{id}/publish",
 *              "controller" = "PostPublishController::class",
 *              "openapi_context"= {
 *                  "summary"= "Permet de publier un article",
 *                  "requestBody"= {
 *                      "content"= {
 *                          "application/jsonld"= {
 *                              "schema"= {}                              
 *                          }
 *                      }
 *                  }
 *              }
 *           }
 *    }
 * ),
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial"})
 * @ApiFilter(DateFilter::class, properties={"createdAt"})
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

    /**
     * @ORM\Column(type="boolean", options={"default": "0"})
     * @Groups({"read:collection"})
     */
    private $online = false;

    public function  __construct () {
        //  $this->CreatedAt = new \DateTime(); fonction créé pour persister la date de mise à jour
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

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }
}
