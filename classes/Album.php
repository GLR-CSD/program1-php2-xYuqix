<?php

declare(strict_types=1);
class Album
{
    private ?int $id;
    private string $naam;
    private string $artiesten;
    private string $release_datum;
    private string $url;
    private string $afbeelding;
    private string $prijs;
public function __construct(?int $id, string $naam, string $artiesten, string $release_datum, string $url, string $afbeelding, string $prijs)
{
    $this->id = $id;
    $this->naam = $naam;
    $this->artiesten = $artiesten;
    $this->release_datum = $release_datum;
    $this->url = $url;
    $this->afbeelding = $afbeelding;
    $this->prijs = $prijs;
}

public static function getAll(PDO $db): array
{
    $stmt = $db->query("SELECT * FROM album");

    $albums = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $album = new Album(
            $row['id'],
            $row['naam'],
            $row['artiesten'],
            $row['release_datum'],
            $row['url'],
            $row['afbeelding'],
            $row['prijs']
        );
        $albums[] = $album;
    }
    return $albums;
}

public function save(PDO $db): void
{
    $stmt = $db->prepare("INSERT INTO album (naam, artiesten, release_datum, url, afbeelding, prijs) VALUES (:naam, :artiesten, :release_datum, :url, :afbeelding, :prijs)");
    $stmt->bindParam(':naam', $this->naam);
    $stmt->bindParam(':artiesten', $this->artiesten);
    $stmt->bindParam(':release_datum', $this->release_datum);
    $stmt->bindParam(':url', $this->url);
    $stmt->bindParam(':afbeelding', $this->afbeelding);
    $stmt->bindParam(':prijs', $this->prijs);
    $stmt->execute();
}

    public function update(PDO $db): void
    {
        // Voorbereiden van de query
        $stmt = $db->prepare("UPDATE album SET naam = :naam, artiesten = :artiesten, release_datum = :release_datum, url = :url, afbeelding = :afbeelding, prijs = :prijs WHERE id = :id");
        $stmt->bindParam(':naam', $this->naam);
        $stmt->bindParam(':artiesten', $this->artiesten);
        $stmt->bindParam(':release_datum', $this->release_datum);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':afbeelding', $this->afbeelding);
        $stmt->bindParam(':prijs', $this->prijs);
        $stmt->execute();
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

public function getAfbeelding(): string
    {
        return $this->afbeelding;
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
        $this->artiesten = $artiesten;
    }

public function setRelease_datum(string $release_datum): void
    {
        $this->release_datum = $release_datum;
    }

public function setUrl(string $url): void
    {
        $this->url = $url;
    }

public function setAfbeelding(string $afbeelding): void
    {
        $this->afbeelding = $afbeelding;
    }

public function setPrijs(string $prijs): void
    {
        $this->prijs = $prijs;
    }
}