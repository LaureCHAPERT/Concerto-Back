<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_events_list", "get_events_item", "get_regions_item", "get_search_item", "get_genres_item", "get_events_home"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"get_events_list", "get_events_item", "get_search_item", "get_genres_item", "get_events_home", "get_regions_item"})
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get_events_list", "get_events_item", "get_regions_item", "get_search_item", "get_genres_item", "get_events_home"})
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"get_events_list", "get_events_item", "get_genres_item", "get_search_item", "get_regions_item", "get_events_home"})
     * @Assert\NotBlank
     * @Assert\Range(min="today", minMessage = "Il faut rentrer une date future !")
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Groups({"get_events_list", "get_events_item", "get_regions_item", "get_search_item", "get_genres_item", "get_events_home"})
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"get_events_list", "get_events_item", "get_regions_item", "get_search_item", "get_genres_item", "get_events_home"})
     * @Assert\NotBlank
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"get_events_list", "get_events_item", "get_regions_item", "get_genres_item", "get_events_home"})
     * @Assert\NotBlank
     */
    private $linkTicketing;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"get_events_list", "get_events_item", "get_search_item", "get_events_home", "get_regions_item", "get_genres_item"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="events")
     * @Groups({"get_events_list", "get_events_item", "get_search_item"})
     * @Assert\NotBlank
     */
    private $genres;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_events_list", "get_events_item", "get_search_item"})
     * @Assert\NotBlank
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Groups({"get_events_list", "get_events_item", "get_genres_item", "get_search_item", "get_regions_item", "get_events_home"})
     */
    private $hour;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->setCreatedAt(new \DateTimeImmutable());
    }

    public function __toString()
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLinkTicketing(): ?string
    {
        return $this->linkTicketing;
    }

    public function setLinkTicketing(string $linkTicketing): self
    {
        $this->linkTicketing = $linkTicketing;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }
    
}
