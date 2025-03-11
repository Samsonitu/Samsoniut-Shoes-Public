<?php 

namespace Models\UserModels;

use Core\Model;

class NewsModel extends Model {
    public function getAllNews() 
    {
        $query = "SELECT nc.newsCatName, n.title, n.newsSlug, n.excerpt, n.thumbnail, n.createAt
        FROM news as n
        JOIN news_category as nc ON nc.newsCatId = n.newsCatId
        WHERE n.status != 0 AND n.active != 0
        ORDER BY n.createAt DESC";
        return $this->SelectRow($query);
    }

    public function getNewsDetailsInfo($newsSlug)
    {
        $query = "SELECT nc.newsCatId, nc.newsCatName, n.title, n.newsSlug, n.excerpt, n.content, n.thumbnail, n.createAt
        FROM news as n
        JOIN news_category as nc ON nc.newsCatId = n.newsCatId
        WHERE n.status != 0 AND n.active != 0 AND newsSlug = ?
        ORDER BY n.createAt DESC";
        return $this->SelectRow($query, [$newsSlug]);
    }
 
    public function getNewsRelated($newsSlug, $newsCatId)
    {
        $query = "SELECT nc.newsCatName, n.title, n.newsSlug, n.excerpt, n.content, n.thumbnail, n.createAt
        FROM news as n
        JOIN news_category as nc ON nc.newsCatId = n.newsCatId
        WHERE n.status != 0 AND n.active != 0 AND newsSlug != ? AND nc.newsCatId = ?
        ORDER BY n.createAt DESC";
        return $this->SelectRow($query, [$newsSlug, $newsCatId]);
    }

    public function getNewsShortInfo()
    {
        $query = "SELECT nc.newsCatName, n.title, n.newsSlug, n.excerpt, n.thumbnail, n.createAt
        FROM news as n
        JOIN news_category as nc ON nc.newsCatId = n.newsCatId
        WHERE n.status != 0 AND n.active != 0
        ORDER BY n.createAt DESC LIMIT 2";
        return $this->SelectRow($query);
    }
}