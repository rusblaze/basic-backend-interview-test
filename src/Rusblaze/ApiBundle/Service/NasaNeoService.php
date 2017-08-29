<?php
namespace Rusblaze\ApiBundle\Service;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Rusblaze\ApiBundle\Dto\NeoListPage;
use Rusblaze\CoreDomain\Neo\Neo;
class NasaNeoService
{
    const DATA_FORMAT = 'Y-m-d';

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * NasaNeoService constructor.
     */
    public function __construct(Serializer $serializer, string $baseUrl, string $apiKey)
    {
        $this->httpClient = new Client([
            'base_uri' => $baseUrl
        ]);

        $this->apiKey = $apiKey;
        $this->serializer = $serializer;
    }

    /**
     * @param \DateTime   $startDate
     * @param \DateTime   $endDate
     * @param bool        $detailed
     * @param string|null $url
     *
     * @return Neo[]
     */
    public function loadNeos(\DateTime $startDate, \DateTime $endDate, bool $detailed = true, string $url = null)
    {
        $data = $this->loadData($startDate, $endDate, $detailed, $url);
        $neos = [];
        foreach ($data->getNeo() as $date => $daylyNeos) {
            $discoverDate = \DateTime::createFromFormat(self::DATA_FORMAT, $date);
            foreach ($daylyNeos as $neoDto) {
                /**
                 * @var \Rusblaze\ApiBundle\Dto\Neo $neoDto
                 * @var \Rusblaze\ApiBundle\Dto\CloseApproachData $closeApproach
                 */
                $closeApproach = $neoDto->getLastCloseApproachData();
                $closestVelicity = $closeApproach->getRelativeVelocity();
                $neo = new Neo(
                    $discoverDate,
                    $neoDto->getNeoReferenceId(),
                    $neoDto->getName(),
                    $closestVelicity->getKilometersPerHour(),
                    $neoDto->isPotentiallyHazardousAsteroid()
                );
                $neos[$neoDto->getNeoReferenceId()] = $neo;
            }
        }
        return $neos;
    }

    /**
     * @param \DateTime   $startDate
     * @param \DateTime   $endDate
     * @param bool        $detailed
     * @param string|null $url
     *
     * @return NeoListPage
     */
    private function loadData(\DateTime $startDate, \DateTime $endDate, $detailed = true, string $url = null)
    {
        if (!is_null($url)) {
            $data = $this->httpClient->get($url)->getBody()->getContents();
        } else {
            $data = $this->httpClient->get('feed', [
                'query' => [
                    'start_date' => $startDate->format(self::DATA_FORMAT),
                    'end_date' => $endDate->format(self::DATA_FORMAT),
                    'detailed' => $detailed,
                    'api_key' => $this->apiKey,
                ],
            ])->getBody()->getContents();
        }

        return $this->serializer->deserialize($data, NeoListPage::class, 'json');
    }
}