<?php
namespace Aws\Api\Parser;

use Aws\Api\StructureShape;
use Aws\Api\Service;
use GuzzleHttp\Message\ResponseInterface;

/**
 * @internal Implements REST-XML parsing (e.g., S3, CloudFront, etc...)
 */
class RestXmlParser extends AbstractRestParser
{
    /** @var JsonParser */
    private $parser;

    /**
     * @param Service   $api    Service description
     * @param XmlParser $parser XML body parser
     */
    public function __construct(Service $api, XmlParser $parser = null)
    {
        parent::__construct($api);
        $this->parser = $parser ?: new XmlParser();
    }

    protected function payload(
        ResponseInterface $response,
        StructureShape $member,
        array &$result
    ) {
        $result += $this->parser->parse($member, $response->xml());
    }
}