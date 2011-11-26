<?php

$geo = new getGeoInfo();
//$geo->find(array('location' => array('$nearSphere' => array((float) $lng,(float) $lat))));
$geo->find(array(
  'location' => array(
    '$nearSphere' => array(
      (float) $lng,
      (float) $lat,
     ),
  ),
));


class getGeoInfo
{
    private $mongo;
    private $collection;

    public function __construct()
    {
        $this->mongo = new Mongo('mongodb://127.0.0.1:27017');
        $this->collection = $this->mongo->selectDB('miniblog')->selectCollection('places');
    }

    public function find($query = array(), $limit = null)
    {
        $cursor = $this->collection->find($query);

        // JSON形式で返す
        echo '[';
        $isFirst = true;
        $i = 1;
        while ($cursor->hasNext()) {
            if (!is_null($limit) && $limit < $i) break;
            $item = $cursor->getNext();
            $exportItem = array(
                                'location' => $item['location'],
                                'category' => $item['category'],
                                );
            echo ($isFirst) ? '' : ', ';
            echo json_encode($exportItem);
            if ($isFirst) $isFirst = false;

            ++$i;
        }
        echo ']';
    }
}