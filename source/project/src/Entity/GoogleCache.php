<?php

namespace App\Entity;

use App\Repository\GoogleCacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoogleCacheRepository::class)
 */
class GoogleCache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="bigint", unique=true)
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;                 // 'Google Translate',
    /**
     * @ORM\Column(type="text")
     */
    private $description;           // 'Translate between 103 languages by typing\r\n...' ,
    /**
     * @ORM\Column(type="text")
     */
    private $descriptionHTML;       // 'Translate between 103 languages by typing<br>...',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $summary;               // 'The world is closer than ever with over 100 languages',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $installs;              // '500,000,000+',
    /**
     * @ORM\Column(type="bigint")
     */
    private $minInstalls;           // 500000000,
    /**
     * @ORM\Column(type="bigint")
     */
    private $maxInstalls;           // 898626813,
    /**
     * @ORM\Column(type="float")
     */
    private $score;                 // 4.482483,
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $scoreText;             // '4.5',
    /**
     * @ORM\Column(type="integer")
     */
    private $ratings;               // 6811669,
    /**
     * @ORM\Column(type="integer")
     */
    private $reviews;               //: 1614618,
    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $histogram;             // { '1': 370042, '2': 145558, '3': 375720, '4': 856865, '5': 5063481 },
    /**
     * @ORM\Column(type="float")
     */
    private $price;                 // 0,
    /**
     * @ORM\Column(type="boolean")
     */
    private $free;                  // true,
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $currency;              // 'USD',
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $priceText;             // 'Free',
    /**
     * @ORM\Column(type="boolean")
     */
    private $offersIAP;             // false,
    /**
     * @ORM\Column(type="string")
     */
    private $IAPRange;              // undefined,
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $size;                  // 'Varies with device',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $androidVersion;        // 'VARY',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $androidVersionText;    // 'Varies with device',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $developer;             // 'Google LLC',
    /**
     * @ORM\Column(type="string")
     */
    private $developerId;           // '5700313618786177705',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $developerEmail;        // 'translate-android-support@google.com',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $developerWebsite;      // 'http://support.google.com/translate',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $developerAddress;      // '1600 Amphitheatre Parkway, Mountain View 94043',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $privacyPolicy;         // 'http://www.google.com/policies/privacy/',
    /**
     * @ORM\Column(type="bigint")
     */
    private $developerInternalID;   // '5700313618786177705',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $genre;                 // 'Tools',
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $genreId;               // 'TOOLS',
    /**
     * @ORM\Column(type="string")
     */
    private $familyGenre;           // undefined,
    /**
     * @ORM\Column(type="string")
     */
    private $familyGenreId;         // undefined,
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;                  // 'https://lh3.googleusercontent.com/ZrNeuKthBirZN7rrXPN1JmUbaG8ICy3kZSHt-WgSnREsJzo2txzCzjIoChlevMIQEA',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $headerImage;           // 'https://lh3.googleusercontent.com/e4Sfy0cOmqpike76V6N6n-tDVbtbmt6MxbnbkKBZ_7hPHZRfsCeZhMBZK8eFDoDa1Vf-',
    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $screenshots;           // [
                                    //    'https://lh3.googleusercontent.com/dar060xShkqnJjWC2j_EazWBpLo28X4IUWCYXZgS2iXes7W99LkpnrvIak6vz88xFQ',
                                    //    'https://lh3.googleusercontent.com/VnzidUTSWK_yhpNK0uqTSfpVgow5CsZOnBdN3hIpTxODdlZg1VH1K4fEiCrdUQEZCV0',
                                    // ],
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video;                 // undefined,
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $videoImage;            // undefined,
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $contentRating;         // 'Everyone',
    /**
     * @ORM\Column(type="string")
     */
    private $contentRatingDescription;  // undefined,
    /**
     * @ORM\Column(type="boolean")
     */
    private $adSupported;               // false,
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $released;                  // undefined,
    /**
     * @ORM\Column(type="bigint")
     */
    private $updated;                   // 1576868577000,
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $version;                   // 'Varies with device',
    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $recentChanges;             // 'Improved offline translations with upgraded language downloads',
    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $comments;                  // [],
    /**
     * @ORM\Column(type="boolean")
     */
    private $editorsChoice;             // true,
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $appId;                     // 'com.google.android.apps.translate',
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;                       // 'https://play.google.com/

    /**
     * @ORM\OneToOne(targetEntity=Statistics::class, mappedBy="google_cache")
     */
    private $statistics;

    /**
     * @return mixed
     */
    public function getStatistics()
    {
        return $this->statistics;
    }

    /**
     * @param mixed $statistics
     * @return GoogleCache
     */
    public function setStatistics($statistics)
    {
        $this->statistics = $statistics;
        return $this;
    }

    public static $gkey_search = [
            'title',
            'description',
            'descriptionHTML',
            'summary',
            'installs',
            'minInstalls',
            'maxInstalls',
            'score',
            'scoreText',
            'ratings',
            'reviews',
            'histogram',
            'price',
            'free',
            'currency',
            'priceText',
            'offersIAP',
            'IAPRange',
            'size',
            'androidVersion',
            'androidVersionText',
            'developer',
            'developerId',
            'developerEmail',
            'developerWebsite',
            'developerAddress',
            'privacyPolicy',
            'developerInternalID',
            'genre',
            'genreId',
            'familyGenre',
            'familyGenreId',
            'icon',
            'headerImage',
            'screenshots',
            'video',
            'videoImage',
            'contentRating',
            'contentRatingDescription',
            'adSupported',
            'released',
            'updated',
            'version',
            'recentChanges',
            'comments',
            'editorsChoice',
            'appId',
            'url',
            'statistics',
    ];

    public function __construct(array $data) {
        // заполним поля класса из $data
        foreach ($data as $key => $value) {
            $method = 'set'.str_replace('_', '', $key);
            if(!method_exists($this, $method))
                throw new \BadMethodCallException(sprintf('Unknown property "%s" on annotation "%s".', $key, static::class));
            $this->$method($value);
        }
        // заполним отсутствующие в $data поля класса
        foreach ($this as $key => $value) {
            if($key === 'id') continue;
            if($value === null) {
                $method = 'set' . str_replace('_', '', $key);
                if(!method_exists($this, $method))
                    throw new \BadMethodCallException(sprintf('Unknown property "%s" on annotation "%s".', $key, static::class));
                $this->$method(0);
            }
        }
    }

    public function getDataProp(): array {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return GoogleCache
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return GoogleCache
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return GoogleCache
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescriptionHTML()
    {
        return $this->descriptionHTML;
    }

    /**
     * @param mixed $descriptionHTML
     * @return GoogleCache
     */
    public function setDescriptionHTML(string $descriptionHTML)
    {
        $this->descriptionHTML = $descriptionHTML;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     * @return GoogleCache
     */
    public function setSummary(string $summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstalls()
    {
        return $this->installs;
    }

    /**
     * @param mixed $installs
     * @return GoogleCache
     */
    public function setInstalls(string $installs)
    {
        $this->installs = $installs;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinInstalls()
    {
        return $this->minInstalls;
    }

    /**
     * @param mixed $minInstalls
     * @return GoogleCache
     */
    public function setMinInstalls(int $minInstalls)
    {
        $this->minInstalls = $minInstalls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaxInstalls()
    {
        return $this->maxInstalls;
    }

    /**
     * @param mixed $maxInstalls
     * @return GoogleCache
     */
    public function setMaxInstalls(int $maxInstalls)
    {
        $this->maxInstalls = $maxInstalls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return GoogleCache
     */
    public function setScore(float $score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreText()
    {
        return $this->scoreText;
    }

    /**
     * @param mixed $scoreText
     * @return GoogleCache
     */
    public function setScoreText(string $scoreText)
    {
        $this->scoreText = $scoreText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param mixed $ratings
     * @return GoogleCache
     */
    public function setRatings(int $ratings)
    {
        $this->ratings = $ratings;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     * @return GoogleCache
     */
    public function setReviews(int $reviews)
    {
        $this->reviews = $reviews;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHistogram()
    {
        return $this->histogram;
    }

    /**
     * @param mixed $histogram
     * @return GoogleCache
     */
    public function setHistogram(string $histogram)
    {
        $this->histogram = $histogram;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return GoogleCache
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFree()
    {
        return $this->free;
    }

    /**
     * @param mixed $free
     * @return GoogleCache
     */
    public function setFree(bool $free)
    {
        $this->free = $free;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return GoogleCache
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceText()
    {
        return $this->priceText;
    }

    /**
     * @param mixed $priceText
     * @return GoogleCache
     */
    public function setPriceText(string $priceText)
    {
        $this->priceText = $priceText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffersIAP()
    {
        return $this->offersIAP;
    }

    /**
     * @param mixed $offersIAP
     * @return GoogleCache
     */
    public function setOffersIAP(bool $offersIAP)
    {
        $this->offersIAP = $offersIAP;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIAPRange()
    {
        return $this->IAPRange;
    }

    /**
     * @param mixed $IAPRange
     * @return GoogleCache
     */
    public function setIAPRange(string $IAPRange)
    {
        $this->IAPRange = $IAPRange;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     * @return GoogleCache
     */
    public function setSize(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAndroidVersion()
    {
        return $this->androidVersion;
    }

    /**
     * @param mixed $androidVersion
     * @return GoogleCache
     */
    public function setAndroidVersion(string $androidVersion)
    {
        $this->androidVersion = $androidVersion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAndroidVersionText()
    {
        return $this->androidVersionText;
    }

    /**
     * @param mixed $androidVersionText
     * @return GoogleCache
     */
    public function setAndroidVersionText(string $androidVersionText)
    {
        $this->androidVersionText = $androidVersionText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @param mixed $developer
     * @return GoogleCache
     */
    public function setDeveloper(string $developer)
    {
        $this->developer = $developer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloperId()
    {
        return $this->developerId;
    }

    /**
     * @param mixed $developerId
     * @return GoogleCache
     */
    public function setDeveloperId(string $developerId)
    {
        $this->developerId = $developerId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloperEmail()
    {
        return $this->developerEmail;
    }

    /**
     * @param mixed $developerEmail
     * @return GoogleCache
     */
    public function setDeveloperEmail(string $developerEmail)
    {
        $this->developerEmail = $developerEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloperWebsite()
    {
        return $this->developerWebsite;
    }

    /**
     * @param mixed $developerWebsite
     * @return GoogleCache
     */
    public function setDeveloperWebsite(string $developerWebsite)
    {
        $this->developerWebsite = $developerWebsite;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloperAddress()
    {
        return $this->developerAddress;
    }

    /**
     * @param mixed $developerAddress
     * @return GoogleCache
     */
    public function setDeveloperAddress(string $developerAddress)
    {
        $this->developerAddress = $developerAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrivacyPolicy()
    {
        return $this->privacyPolicy;
    }

    /**
     * @param mixed $privacyPolicy
     * @return GoogleCache
     */
    public function setPrivacyPolicy(string $privacyPolicy)
    {
        $this->privacyPolicy = $privacyPolicy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeveloperInternalID()
    {
        return $this->developerInternalID;
    }

    /**
     * @param mixed $developerInternalID
     * @return GoogleCache
     */
    public function setDeveloperInternalID($developerInternalID)
    {
        $this->developerInternalID = $developerInternalID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     * @return GoogleCache
     */
    public function setGenre(string $genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * @param mixed $genreId
     * @return GoogleCache
     */
    public function setGenreId(string $genreId)
    {
        $this->genreId = $genreId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamilyGenre()
    {
        return $this->familyGenre;
    }

    /**
     * @param mixed $familyGenre
     * @return GoogleCache
     */
    public function setFamilyGenre(string $familyGenre)
    {
        $this->familyGenre = $familyGenre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFamilyGenreId()
    {
        return $this->familyGenreId;
    }

    /**
     * @param mixed $familyGenreId
     * @return GoogleCache
     */
    public function setFamilyGenreId(string $familyGenreId)
    {
        $this->familyGenreId = $familyGenreId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return GoogleCache
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderImage()
    {
        return $this->headerImage;
    }

    /**
     * @param mixed $headerImage
     * @return GoogleCache
     */
    public function setHeaderImage(string $headerImage)
    {
        $this->headerImage = $headerImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScreenshots()
    {
        return $this->screenshots;
    }

    /**
     * @param mixed $screenshots
     * @return GoogleCache
     */
    public function setScreenshots(string $screenshots)
    {
        $this->screenshots = $screenshots;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return GoogleCache
     */
    public function setVideo(string $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideoImage()
    {
        return $this->videoImage;
    }

    /**
     * @param mixed $videoImage
     * @return GoogleCache
     */
    public function setVideoImage(string $videoImage)
    {
        $this->videoImage = $videoImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentRating()
    {
        return $this->contentRating;
    }

    /**
     * @param mixed $contentRating
     * @return GoogleCache
     */
    public function setContentRating(string $contentRating)
    {
        $this->contentRating = $contentRating;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentRatingDescription()
    {
        return $this->contentRatingDescription;
    }

    /**
     * @param mixed $contentRatingDescription
     * @return GoogleCache
     */
    public function setContentRatingDescription(string $contentRatingDescription)
    {
        $this->contentRatingDescription = $contentRatingDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdSupported()
    {
        return $this->adSupported;
    }

    /**
     * @param mixed $adSupported
     * @return GoogleCache
     */
    public function setAdSupported(bool $adSupported)
    {
        $this->adSupported = $adSupported;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param mixed $released
     * @return GoogleCache
     */
    public function setReleased(string $released)
    {
        $this->released = $released;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return GoogleCache
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return GoogleCache
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecentChanges()
    {
        return $this->recentChanges;
    }

    /**
     * @param mixed $recentChanges
     * @return GoogleCache
     */
    public function setRecentChanges(string $recentChanges)
    {
        $this->recentChanges = $recentChanges;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     * @return GoogleCache
     */
    public function setComments(string $comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditorsChoice()
    {
        return $this->editorsChoice;
    }

    /**
     * @param mixed $editorsChoice
     * @return GoogleCache
     */
    public function setEditorsChoice(bool $editorsChoice)
    {
        $this->editorsChoice = $editorsChoice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     * @return GoogleCache
     */
    public function setAppId(string $appId)
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return GoogleCache
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }
}
