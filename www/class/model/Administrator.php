<?php


namespace model;


use utility\Format;

class Administrator {
    private int $adminId;
    private String $lastName;
    private String $firstName;
    private String $mail;
    private String $psd;

    /**
     * Administrator constructor.
     * @param int $adminId
     * @param String $lastName
     * @param String $firstName
     * @param String $mail
     * @param String $psd
     */
    public function __construct(int $adminId, string $lastName, string $firstName, string $mail, string $psd)
    {
        $this->adminId = $adminId;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->mail = $mail;
        $this->psd = $psd;
    }

    public function toArray($administratorIdFirst=true){
        if($administratorIdFirst) {
            return array(Format::getFormatId(8, $this->administratorId),
                $this->lastName,
                $this->firstName,
                $this->mail,
                $this->psd);
        }
        else {
            return array(
                $this->lastName,
                $this->firstName,
                $this->mail,
                $this->psd,
                Format::getFormatId(8, $this->administratorId));
        }
    }

    /**
     * @return int
     */
    public function getAdminId(): int
    {
        return $this->adminId;
    }

    /**
     * @param int $adminId
     */
    public function setAdminId(int $adminId): void
    {
        $this->adminId = $adminId;
    }

    /**
     * @return String
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param String $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return String
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param String $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return String
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param String $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return String
     */
    public function getPsd(): string
    {
        return $this->psd;
    }

    /**
     * @param String $psd
     */
    public function setPsd(string $psd): void
    {
        $this->psd = $psd;
    }


}