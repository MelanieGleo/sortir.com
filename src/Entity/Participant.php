<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 * @UniqueEntity(fields={"nom"}, message="There is already an account with this nom")
 //todo ajout email a unique entity

 */
class Participant implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToMany(targetEntity=Sortie::class, inversedBy="participants")
     */
    private $sorties;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="participOrga")
     */
    private $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="participants")
     */
    private $site;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private ?string $pseudo;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private ?string $motDePasse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $emplacementPhoto;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
        $this->organisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSortie(sortie $sortie): self
    {
        if (!$this->sorties->contains($sortie)) {
            $this->sorties[] = $sortie;
        }

        return $this;

    }

    public function removeSortie(sortie $sortie): self
    {
        $this->sorties->removeElement($sortie);

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getOrganisateur(): Collection
    {
        return $this->organisateur;
    }

    public function addOrganisateur(Sortie $organisateur): self
    {
        if (!$this->organisateur->contains($organisateur)) {
            $this->organisateur[] = $organisateur;
            $organisateur->setParticipOrga($this);
        }

        return $this;
    }

    public function removeOrganisateur(Sortie $organisateur): self
    {
        if ($this->organisateur->removeElement($organisateur)) {
            // set the owning side to null (unless already changed)
            if ($organisateur->getParticipOrga() === $this) {
                $organisateur->setParticipOrga(null);
            }
        }

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    public function getRoles(): array
    {
        $user = $this->getAdministrateur();
        if($user){
            $roles[] = 'ROLE_ADMIN';
        } else {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }


    /**
     * @return string
     * @override
     * besoins pour userInterface
     */
    public function getPassword(): string
    {
        return $this->motDePasse;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @return string
     * @override
     * besoins pour userInterface
     */
    public function getUsername(): string
    {
       return $this->nom;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEmplacementPhoto(): ?string
    {
        return $this->emplacementPhoto;
    }

    public function setEmplacementPhoto(?string $emplacementPhoto): self
    {
        $this->emplacementPhoto = $emplacementPhoto;

        return $this;
    }



}

