<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @param $phoneNumbers array<int, string>
     */
    #[Assert\Count(min: 1, minMessage: 'Must have at least one phone number.')]
    #[Assert\Unique(message: 'Same phone number entered several times.')]
    #[Assert\All([
        new Assert\NotBlank(message: 'Phone number not entered.'),
        new Assert\Length(min: 7, max: 20),
        new Assert\Regex('/^(?!\s)\+?(?:[ ]?[0-9])+(?!\s)$/', message: 'Phone number is not valid.'),
    ])]
    private array $phoneNumbers;

    public function __construct()
    {
        $this->phoneNumbers = ['', '', ''];
    }

    public function getPhoneNumbers(): array
    {
        return $this->phoneNumbers;
    }

    /**
     * @param array<int, string> $phoneNumbers
     */
    public function setPhoneNumbers(array $phoneNumbers): static
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }
}
