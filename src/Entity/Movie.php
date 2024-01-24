<?php
// Fichier : Movie.php | Date: 2024-01-22 | Auteur: Patrick SUFFREN

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

// When using attributes, don't forget to add #[ORM\HasLifecycleCallbacks]
// to the class of the entity where you define the callback

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_movies_collection', 'get_movie_item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Groups(['get_movies_collection', 'get_movie_item', 'get_genre_item_movies'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    #[Groups(['get_movie_item'])]
    private ?\DateTimeImmutable $releaseDate = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\NotBlank()]
    #[Assert\Positive]
    #[Groups(['get_movies_collection', 'get_movie_item'])]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Groups(['get_movie_item'])]
    private ?string $summary = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column(length: 2083, nullable: true)]
    #[Assert\Length(max: 2083)]
    #[Assert\Url()]
    #[Groups(['get_movie_item'])]
    private ?string $poster = null;

    // Le rating est calculé sur la base des différentes critiques
    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: 1, nullable: true)]
    #[Assert\Range(
        min: 1,
        max: 5,
    )]
    private ?string $rating = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank()]
    #[Assert\Choice(['Film', 'Série'])]
    #[Groups(['get_genre_item_movies'])]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Season::class, orphanRemoval: true, cascade: ["remove"])]
    #[ORM\OrderBy(["number" => "ASC"])]
    #[Groups(['get_movies_collection', 'get_movie_item'])]
    private Collection $seasons;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'movies')]
    // REFER : https://symfony.com/doc/current/reference/constraints/Count.html
    #[Assert\Count(min:2, max:5)]
    #[Groups(['get_movies_collection', 'get_movie_item'])]
    private Collection $genres;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Casting::class, orphanRemoval: true)]
    #[ORM\OrderBy(["creditOrder" => "ASC"])]
    #[Groups(['get_movie_item'])]
    // REFER : https://www.doctrine-project.org/projects/doctrine-orm/en/2.17/reference/attributes-reference.html#attrref_orderby
    private Collection $castings;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: Review::class, orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->seasons      = new ArrayCollection();
        $this->genres       = new ArrayCollection();
        $this->castings     = new ArrayCollection();
        $this->reviews      = new ArrayCollection();
        $this->releaseDate  = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeImmutable $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function addSeason(Season $season): static
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons->add($season);
            $season->setMovie($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): static
    {
        if ($this->seasons->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getMovie() === $this) {
                $season->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addMovie($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeMovie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Casting>
     */
    public function getCastings(): Collection
    {
        return $this->castings;
    }

    public function addCasting(Casting $casting): static
    {
        if (!$this->castings->contains($casting)) {
            $this->castings->add($casting);
            $casting->setMovie($this);
        }

        return $this;
    }

    public function removeCasting(Casting $casting): static
    {
        if ($this->castings->removeElement($casting)) {
            // set the owning side to null (unless already changed)
            if ($casting->getMovie() === $this) {
                $casting->setMovie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setMovie($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getMovie() === $this) {
                $review->setMovie(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    // REFER : https://symfony.com/doc/6.4/doctrine/events.html#doctrine-lifecycle-callbacks
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
