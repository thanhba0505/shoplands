<?php

require_once 'app/Models/ConnectDatabase.php';

class ReviewImage
{
    // Lấy danh sách ảnh của bình luận theo id
    public function getImagesByReviewId($review_id)
    {
        $query = new ConnectDatabase();

        $sql = "
            SELECT
                ri.image_path AS path
            FROM
                review_images ri
            WHERE
                ri.review_id = :review_id
        ";

        $result = $query->query($sql, ['review_id' => $review_id])->fetchAll();

        return $result;
    }
}
