<?php

class Album
{
    private int $id;
    private string $naam;
    private string $artiesten;
    private string $release_datum;
    private string $url;
    private string $afbeeldingen;
    private string $prijs;

    public function __construct(int $id, string $naam, string $artiesten, string $release_datum, string $url, string $afbeeldingen, string $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->artiesten = $artiesten;
        $this->release_datum = $release_datum;
        $this->url = $url;
        $this->afbeeldingen = $afbeeldingen;
        $this->prijs = $prijs;
    }

    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("Select * from album");

        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album(
                $row['id'],
                $row['naam'],
                $row['artiesten'],
                $row['release_datum'],
                $row['url'],
                $row['afbeeldingen'],
                $row['prijs']
            );
            $albums[] = $album;
        }
        return $albums;
    }

    public function save(PDO $db): void
    {
        $stmt = $db->prepare("INSERT INTO album (naam, artiesten, release_datum, url, afbeeldingen, prijs) VALUES (:naam, :artiesten, :release_datum, :url, :afbeeldingen, :prijs)");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':release_datum', $this->release_datum);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':afbeeldingen', $this->afbeeldingen);
        $stmt->bindParam(':prijs', $this->prijs);
    }

    public function update(PDO $db): void
    {
        $stmt = $db->prepare("UPDATE album SET naam = :naam, artiesten = :artiesten, release_datum = :release_datum, url = :url, afbeeldingen = :afbeeldingen, prijs = :prijs WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':release_datum', $this->release_datum);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':afbeeldingen', $this->afbeeldingen);
        $stmt->bindParam(':prijs', $this->prijs);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getArtiesten(): string
    {
        return $this->artiesten;
    }

    public function getRelease_datum(): string
    {
        return $this->release_datum;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAfbeeldingen(): string
    {
        return $this->afbeeldingen;
    }

    public function getPrijs(): string
    {
        return $this->prijs;
    }


    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    public function setArtiesten(string $artiesten): void
    {
        $this->naam = $artiesten;
    }

    public function setRelease_datum(string $release_datum): void
    {
        $this->naam = $release_datum;
    }

    public function setUrl(string $url): void
    {
        $this->naam = $url;
    }

    public function setAfbeeldingen(string $afbeeldingen): void
    {
        $this->naam = $afbeeldingen;
    }

    public function setPrijs(string $prijs): void
    {
        $this->naam = $prijs;
    }


}