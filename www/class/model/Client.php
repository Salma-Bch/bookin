<?php


namespace model;


use DateTime;
use utility\Format;

class Client {
    private int $clientId;
    private String $lastName;
    private String $firstName;
    private String $mail;
    private String $psd;
    private DateTime $birthDate;
    private String $profession;
    private String $sex;
    private int $age;
    private array $tags;

    /**
     * Client constructor.
     * @param int $clientId
     * @param String $lastName
     * @param String $firstName
     * @param String $mail
     * @param String $psd
     * @param DateTime $birthDate
     * @param String $profession
     * @param String $sex
     * @param array $tags
     */
    public function __construct(int $clientId, string $lastName, string $firstName, string $mail, string $psd, DateTime $birthDate,
                                string $profession, string $sex, array $tags){
        $this->clientId = $clientId;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->mail = $mail;
        $this->psd = $psd;
        $this->birthDate = $birthDate;
        $this->profession = $profession;
        $this->sex = $sex;
        $this->age = $this->ageCalculate($birthDate);
        $this->tags = $tags;
    }

    public function toArray($clientIdFirst=true){
        if($clientIdFirst) {
            return array(Format::getFormatId(8, $this->clientId),
                $this->lastName,
                $this->firstName,
                $this->mail,
                $this->psd,
                $this->birthDate->format('Y-m-d'),
                $this->profession,
                $this->sex,
                implode(",", $this->tags));
        }
        else {
            return array(
                $this->lastName,
                $this->firstName,
                $this->mail,
                $this->psd,
                $this->birthDate->format('Y-m-d'),
                $this->profession,
                $this->sex,
                implode(",", $this->tags),
                Format::getFormatId(8, $this->clientId));
        }
    }

    public function toAssocArray(){
        return array("client_id"=>Format::getFormatId(8,$this->clientId),
            "last_name"=>$this->lastName,
            "first_name"=>$this->firstName,
            "mail"=>$this->mail,
            "psd"=>$this->psd,
            "birthDate"=>$this->birthDate->format('Y-m-d'),
            "profession"=>$this->profession,
            "sex"=>$this->sex,
            "tags"=>implode(",",$this->tags));
    }

    public function getAgeRange():String{
        $age = $this->getAge();
        if($age <15)
            return "Enfants";
        else if($age<25)
            return "Adolescents";
        else if($age <65)
            return "Adultes";
        else
            return "Ainés";
    }
    /**
     * @param \DateTime
     * @return int
     */
    public function ageCalculate($birthDate): int{
        return ($birthDate->diff(new \DateTime()))->y;
    }
    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
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

    /**
     * @return \DateTime
     */
    public function getBirthDate(): \DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate(\DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return String
     */
    public function getProfession(): string
    {
        return $this->profession;
    }

    /**
     * @param String $profession
     */
    public function setProfession(string $profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return String
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param String $sex
     */
    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

}