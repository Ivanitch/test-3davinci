<?php

declare(strict_types=1);

class CustomXMLReader
{
    /**
     * @param string $file
     * @return string
     * @throws Exception
     */
    public function referenceFirstElement(string $file): string
    {
        $xmlFile = __DIR__ . DIRECTORY_SEPARATOR . $file;

        if (!file_exists($xmlFile))
            throw new Exception('File is not found!');

        $xmlFile = mb_convert_encoding($xmlFile, 'utf-8');
        $xml = new SimpleXMLElement($xmlFile, 0, true);
        $data = $xml->xpath("//File[@FileType='IMG']");
        $data = json_decode(json_encode($data), true);

        return $data[0]["@attributes"]["Reference"];
    }
}
