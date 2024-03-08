<?php 

namespace App\Entity;


class Challenge
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $selectedImage;

    public function getSelectedImage(): ?string
    {
        return $this->selectedImage;
    }

    public function setSelectedImage(?string $selectedImage): self
    {
        $this->selectedImage = $selectedImage;
    
        return $this;
    }



}