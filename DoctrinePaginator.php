<?php

namespace DoctrineMongoODMModule\Tools\Paginator\Adapter;

use Doctrine\ODM\MongoDB\Query\Builder;
use Zend\Paginator\Adapter\AdapterInterface;

class DoctrinePaginator implements AdapterInterface{

    /**
     * @var \Doctrine\MongoDB\Query\Builder
     */
    protected $queryBuilder;

    /**
     * internal result's count cache
     * @var int
     */
    protected $count;

    /**
     * @param \Doctrine\ODM\MongoDB\Query\Builder $qb
     */
    public function __construct(Builder $queryBuilder = null){
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @param \Doctrine\ODM\MongoDB\Query\Builder|null $qb
     * @return DoctrineMongoODMModule\Paginator\Adapter\DoctrinePaginator
     */
    public function setQueryBuilder(Builder $queryBuilder){
        $this->queryBuilder = $queryBuilder;
        return $this;
    }
    
    /**
     * Returns an collection of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
        return $this->queryBuilder->skip($offset)->limit($itemCountPerPage)->getQuery()->getIterator();
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        if(is_null($this->count)){
			$this->count = $this->queryBuilder->getQuery()->count();
		}
        return $this->count;
    }
}
