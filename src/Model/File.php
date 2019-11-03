<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class File
 *
 * @package App\Model
 */
class File
{
    /**
     * @var integer
     * @Serializer\SerializedName("id")
     * @Serializer\Type(name="string")
     * @Serializer\Groups({"Default"})
     * @Serializer\Expose
     */
    protected $id;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type(name="string")
     * @Serializer\Expose
     */
    protected $name;

    /**
     * @var string
     * @Serializer\SerializedName("mimeType")
     * @Serializer\Type(name="string")
     */
    protected $mimeType;

    /**
     * @var string
     * @Serializer\SerializedName("downloadLink")
     * @Serializer\Type(name="string")
     */
    protected $downloadLink;

    /**
     * @var string
     * @Serializer\SerializedName("size")
     * @Serializer\Type(name="string")
     */
    protected $size;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param  string $id
     * @return File
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * 
     * @return File
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $string
     * 
     * @return self
     */
    public function setMimeType(string $string): self
    {
        $this->mimeType = strtolower($string);

        return $this;
    }

    /**
     * @return string
     */
    public function getDownloadLink(): string
    {
        return $this->downloadLink;
    }

    /**
     * @param string $downloadLink
     * 
     * @return File
     */
    public function setDownloadLink(?string $downloadLink): self
    {
        $this->downloadLink = $downloadLink;

        return $this;
    }

    /**
     * @return string
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * @param string $size
     * 
     * @return File
     */
    public function setSize(?string $size):self
    {
        $this->size = $size;

        return $this;
    }
}
