<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="#(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?#",
     *     match=true,
     *     message="Veuillez insérer un lien Youtube valide !"
     * )
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Tricks::class, inversedBy="videos")
     * @ORM\JoinColumn(name="trickId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $trickId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTrickId(): ?Tricks
    {
        return $this->trickId;
    }

    public function setTrickId(?Tricks $trickId): self
    {
        $this->trickId = $trickId;

        return $this;
    }
}
