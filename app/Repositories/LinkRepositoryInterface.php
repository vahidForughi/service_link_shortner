<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Collection;

interface LinkRepositoryInterface
{
    public function getAllLinks(): Collection;

    public function createLink($data): Link;

    public function updateLink($id, $data);

    public function deleteLink($id);

    public function getLinkById($id);

    public function getLinkByAddress($address);

    public function getTotalLinksCount();

    public function getLinksByUserId($userId);

    public function getLinksByStatus($status);


    public function getLinksByCreatedAtRange($startDate, $endDate);

    public function getLinksByUpdatedAtRange($startDate, $endDate);

    public function getLinksBySearchQuery($searchQuery);

    public function getLinksByCategory($categoryId);

    public function getLinksByTag($tagId);

    public function getLinksByAuthor($authorId);

    public function getLinksByViewsCountRange($minViews, $maxViews);

    public function getLinksByLikesCountRange($minLikes, $maxLikes);

    public function getLinksByCommentsCountRange($minComments, $maxComments);
}
