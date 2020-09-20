<?php

$data = [
    'string' => 'title one',
    'int' => 123,
    'float' => 7.0123,
    'bool' => false,
    'undefined' => undefined,
    'null' => null,
    'undefined2' => 'undefined',
];
$je = json_encode($data);
$jd = json_decode($je, true);
var_dump($je, $jd);
exit;


$subject = "[ { title: 'В РЕБРО', appId: 'com.loyaltyplant.partner.vrebro', }, { title: 'В РЕБРО 2', appId: 'rebro2.com.loyaltyplant.partner.vrebro', } ]";
$len = mb_strlen($subject);
$text = handlingQuotes($subject, $len);

$len2 = mb_strlen($text);
$arr = handlingComma($text, $len2);
$json = json_encode($arr['php_arr']);
$t = json_decode($arr['php_arr'], true);
$json2 = json_decode($json, true);
var_dump($json, $json2, $text);
exit;

// Обработка запятых
function handlingComma(string $haystack, $n) {
    $i = 0;
    $offset = 0;
    $arr = [];
    while ($i < $n) {
        $start = mb_strpos($haystack, '{', $offset);
        if($start == false)
            break;
        $end = mb_strpos($haystack, '}', $start);
        if($end == false)
            break;
        array_push($arr, mb_substr($haystack, $start + 1, $end - $start - 1));
        $i = $offset = $end;
    }

    // работа с запятой в конце строки
    $php_arr = [];
    for ($i = 0; $i < (int)count($arr); $i++) {
        $arr[$i] = trim($arr[$i]);
        $end = mb_strpos($arr[$i], ',', -1);
        if($end == false)
            continue;
        $arr[$i] = '{'.mb_substr($arr[$i], 0, $end - 1).'"}';
        array_push($php_arr, json_decode($arr[$i], true));
    }

    return ['str_arr' => $arr, 'php_arr' => $php_arr];
}

// обработка кавычек
function handlingQuotes(string $haystack, $n) {
    $text = str_replace("'","\"", $haystack);
    $key = [ 'title', 'appId' ];

    $offset = 0;
    for($i = 0; $i < (int)count($key); $i++) {
        $text = str_replace($key[$i], '"'.$key[$i].'"', $text);
    }
    return $text;
}
//---


$data = [
    'url' => 'url addr',
    'appId' => 'application Id',
    'title' => 'title hahaha',
];

$unit = new Unit($data);

$unit->setScore(999.5678);
var_dump($unit);
exit;


class Unit
{
    private $url;
    private $appId;
    private $summary;
    private $title;
    private $developer;
    private $developerId;
    private $icon;
    private $score;
    private $scoreText;
    private $priceText;
    private $free;

    public function __construct(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.str_replace('_', '', $key);
            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException(sprintf('Unknown property "%s" on annotation "%s".', $key, static::class));
            }
            $this->$method($value);
        }
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }/**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }/**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }/**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }/**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }/**
     * @param mixed $summary
     */
    public function setSummary($summary): void
    {
        $this->summary = $summary;
    }/**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }/**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }/**
     * @return mixed
     */
    public function getDeveloper()
    {
        return $this->developer;
    }/**
     * @param mixed $developer
     */
    public function setDeveloper($developer): void
    {
        $this->developer = $developer;
    }/**
     * @return mixed
     */
    public function getDeveloperId()
    {
        return $this->developerId;
    }/**
     * @param mixed $developerId
     */
    public function setDeveloperId($developerId): void
    {
        $this->developerId = $developerId;
    }/**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }/**
     * @param mixed $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }/**
     * @return mixed
     */
    public function getScore(): int
    {
        return $this->score;
    }/**
     * @param mixed $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }/**
     * @return mixed
     */
    public function getScoreText()
    {
        return $this->scoreText;
    }/**
     * @param mixed $scoreText
     */
    public function setScoreText($scoreText): void
    {
        $this->scoreText = $scoreText;
    }/**
     * @return mixed
     */
    public function getPriceText()
    {
        return $this->priceText;
    }/**
     * @param mixed $priceText
     */
    public function setPriceText($priceText): void
    {
        $this->priceText = $priceText;
    }/**
     * @return mixed
     */
    public function getFree()
    {
        return $this->free;
    }/**
     * @param mixed $free
     */
    public function setFree($free): void
    {
        $this->free = $free;
    }          // true
}



