<?php

namespace Trnx\Polls\model;

use PDO;
use Trnx\Polls\lib\Database;

class Poll extends Database
{
  private string $uuid;
  private string $id;
  private array $options;

  public function __construct(private string $title, $createUUID = true)
  {
    parent::__construct();
    $this->options = [];
    if ($createUUID) {
      $this->uuid = uniqid();
    }
  }

  public function save()
  {
    $query = $this->connect()->prepare("INSERT INTO polls(uuid,title) VALUES(:uuid,:title)");
    $query->execute(['uuid' => $this->uuid, 'title' => $this->title]);

    $query = $this->connect()->prepare("SELECT * FROM polls WHERE uuid = :uuid");
    $query->execute(['uuid' => $this->uuid]);

    $this->id = $query->fetchColumn();
  }

  public function insertOptions(array $options)
  {
    foreach ($options as $option) {
      $query = $this->connect()->prepare("INSERT INTO options(poll_id,title,votes) VALUES(:poll_id,:title,0)");
      $query->execute(['poll_id' => $this->id, 'title' => $option]);
    }
  }

  public static function getPolls(): array
  {
    $polls = [];
    $db = new Database;
    $query = $db->connect()->query("SELECT * FROM polls");
    while ($record = $query->fetch(PDO::FETCH_ASSOC)) {
      $poll = Poll::createFromArray($record);
      array_push($polls, $poll);
    }
    return $polls;
  }

  public static function createFromArray(array $arr): Poll
  {
    $poll = new Poll($arr['title'], false);
    $poll->setUUID($arr['uuid']);
    $poll->setId($arr['id']);

    return $poll;
  }

  public static function find($uuid): Poll
  {
    $db = new Database;
    $query = $db->connect()->prepare("SELECT * FROM polls WHERE uuid = :uuid");
    $query->execute(['uuid' => $uuid]);
    $record = $query->fetch();

    $poll = Poll::createFromArray($record);

    // consulta de opciones
    $query = $db->connect()->prepare("SELECT * FROM polls INNER JOIN options ON polls.id = options.poll_id WHERE polls.uuid = :uuid");
    $query->execute(['uuid' => $uuid]);

    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
      $poll->includeOption($r);
    }

    return $poll;
  }

  public function vote($optionID): Poll
  {
    $query = $this->connect()->prepare("UPDATE options SET votes = votes + 1 WHERE id = :id");
    $query->execute(['id' => $optionID]);

    $poll = Poll::find($this->getUUID());
    return $poll;
  }

  public function getTotalVotes()
  {
    $total  = 0;
    foreach ($this->options as $option) {
      $total = $total + $option['votes'];
    }

    return $total;
  }

  public function includeOption($arr)
  {
    array_push($this->options, $arr);
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getUUID()
  {
    return $this->uuid;
  }

  public function setUUID($val)
  {
    $this->uuid = $val;
  }

  public function setId($val)
  {
    $this->id = $val;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getOptions()
  {
    return $this->options;
  }
}
