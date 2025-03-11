<?php

namespace Models\AdminModels;

use Core\Model;

class NewsModel extends Model
{
    /* BEGIN NEWS CATEGORY */
        public function getAllNewsCategory()
        {
            $query = "SELECT * FROM news_category";
            return $this->SelectRow($query);
        }

        public function countNewsCatInTrash()
        {
            $query = "SELECT COUNT(*) as total FROM news_category WHERE active = 0";
            return $this->SelectRow($query);
        }

        public function checkExistsNewsCategory($newsCatName, $description)
        {
            $query = "SELECT newsCatId 
                FROM news_category 
                WHERE LOWER(TRIM(newsCatName)) = LOWER(TRIM(?)) AND LOWER(TRIM(description)) = LOWER(TRIM(?)) LIMIT 1";
            return $this->SelectRow($query, [$newsCatName, $description]);
        }

        public function createNewsCategory($userId, $newsCatName, $description)
        {
            $query = "INSERT INTO `news_category`(`userId`, `newsCatName`, `newsCatSlug`, `description`) 
                VALUES (?, ?, ?, ?) ";
            return $this->InsertRow($query, [$userId, $newsCatName, convertToSlug($newsCatName) , $description]);
        }

        public function updateNewsCategory($userId, $newsCatId, $newsCatName, $description)
        {
            $query = "UPDATE `news_category` 
                SET `userId` = ?, `newsCatName`= ?, `newsCatSlug`= ?, `description`= ?, `lastUpdated` = CURRENT_TIMESTAMP() 
                WHERE `newsCatId` = ?";
            return $this->UpdateRow($query, [$userId, $newsCatName, convertToSlug($newsCatName), $description, $newsCatId]);
        }

        public function checkHasTempDeleteNewCat($newsCatId) 
        {
            $query = "SELECT newsId
                FROM news 
                WHERE newsCatId = ? LIMIT 1";
            return $this->SelectRow($query, [$newsCatId]);
        }

        public function tempDeleteNewsCategory($userId, $newsCatId) 
        {
            $query = "UPDATE `news_category` 
                SET `userId` = ?, `active` = 0, `lastUpdated` = CURRENT_TIMESTAMP() 
                WHERE newsCatId = ?";
            return $this->UpdateRow($query, [$userId, $newsCatId]);
        }

        public function getAllNewsCatInTrash() 
        {
            $query = "SELECT * FROM news_category WHERE active = 0";
            return $this->SelectRow($query);
        }

        public function deleteNewsCategory($newsCatId)
        {
            $query = "DELETE FROM `news_category` WHERE `newsCatId` = ?";
            return $this->DeleteRow($query, [$newsCatId]);
        }

        public function restoreNewsCatInTrash($userId, $newsCatId)
        {
            $query = "UPDATE `news_category` 
                SET active = 1, userId = ?, lastUpdated = CURRENT_TIMESTAMP() 
                WHERE newsCatId = ?";
            return $this->UpdateRow($query, [$userId, $newsCatId]);
        }

        public function changeStatusNewsCategory($userId, $newsCatId)
        {
            $query = "UPDATE `news_category` 
                SET `userId` = ?, status = 1 - status, lastUpdated = CURRENT_TIMESTAMP() 
                WHERE newsCatId = ?";
            return $this->UpdateRow($query, [$userId, $newsCatId]);
        }
    /* END NEWS CATEGORY */

    /* BEGIN NEWS */
        public function getAllNews()
        {
            $query = "SELECT * FROM news";
            return $this->SelectRow($query);
        }

        public function getNewsDetailsInfo($newsId)
        {
            $query = "SELECT n.*, nc.newsCatName
                FROM news as n
                JOIN news_category as nc ON nc.newsCatId = n.newsCatId
                WHERE n.newsId = ? 
                LIMIT 1
            ";
            return $this->SelectRow($query, [$newsId]);
        }

        public function getNewsCatNameAndId()
        {
            $query = "SELECT newsCatId, newsCatName FROM news_category";
            return $this->SelectRow($query);    
        }

        public function checkExistsNews($title, $excerpt, $thumbnail)
        {
            $query = "SELECT newsId FROM news WHERE title = ? AND excerpt = ? AND thumbnail = ? LIMIT 1";
            return $this->SelectRow($query, [$title, $excerpt, $thumbnail]);
        }

        public function createNews($userId, $newsCatId, $title, $excerpt, $content, $thumbnail)
        {
            $query = "INSERT INTO `news`(`userId`, `newsCatId`, `title`, `newsSlug`, `excerpt`, `content`, `thumbnail`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            return $this->InsertRow($query, [$userId, $newsCatId, $title, convertToSlug($title), $excerpt, $content, $thumbnail]);
        }   

        public function updateNews($userId, $newsId, $newsCatId, $title, $excerpt, $content, $thumbnail)
        {
            $thumbnail =  $thumbnail === NULL ? 'thumbnail' : $thumbnail;
            $query = "UPDATE `news` 
                SET `userId` = ?, `newsCatId` = ?, `title` = ?, `newsSlug` = ?, `excerpt` = ?, `content` = ?, 
                `thumbnail` = `$thumbnail`, `lastUpdated` = CURRENT_TIMESTAMP()   
                WHERE `newsId` = ?";
            return $this->UpdateRow($query, [$userId, $newsCatId, $title, convertToSlug($title), $excerpt, $content, $newsId]);
        } 

        public function countNewsInTrash() 
        {
            $query = "SELECT COUNT(*) as total FROM news WHERE active = 0";
            return $this->SelectRow($query);    
        }

        public function getAllNewsInTrash()
        {
            $query = "SELECT * FROM news WHERE active = 0";
            return $this->SelectRow($query);
        }

        public function restoreNewsInTrash($userId, $newsId) 
        {
            $query = "UPDATE news 
                SET userId = ?, active = 1, lastUpdated = CURRENT_TIMESTAMP() 
                WHERE newsId = ?";
            return $this->UpdateRow($query, [$userId, $newsId]);
        }

        public function deleteNews($newsId)
        {
            $query = "DELETE FROM `news` WHERE newsId = ?";
            return $this->DeleteRow($query, [$newsId]);
        }

        public function tempDeleteNews($userId, $newsId) 
        {
            $query = "UPDATE `news` 
                SET `userId` = ?, `active` = 0, `lastUpdated` = CURRENT_TIMESTAMP() 
                WHERE newsId = ?";
            return $this->UpdateRow($query, [$userId, $newsId]);
        }

        public function changeStatusNews($userId, $newsId)
        {
            $query = "UPDATE `news` 
                SET `userId` = ?, status = 1 - status, lastUpdated = CURRENT_TIMESTAMP() 
                WHERE newsId = ?";
            return $this->UpdateRow($query, [$userId, $newsId]);
        }
    /* END NEWS */
}