<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LinksSQLRepository implements LinkRepositoryInterface
{
    public function getAllLinks(): Collection
    {
        return Link::all();
    }

    public function createLink($data): Link
    {
        return Link::create($data);
    }

    public function updateLink($id, $data)
    {
        $link = Link::findOrFail($id);
        $link->update($data);
        return $link;
    }

    public function deleteLink($id)
    {
        return Link::destroy($id);
    }

    public function getLinkById($id)
    {
        return Link::findOrFail($id);
    }

    public function getLinkByAddress($address)
    {
        return Link::where('address', $address)->firstOrFail();
    }

    public function getTotalLinksCount()
    {
        return Link::count();
    }

    public function getLinksByUserId($userId)
    {
        return Link::where('user_id', $userId)->get();
    }

    public function getLinksByStatus($status)
    {
        return Link::where('status', $status)->get();
    }

    public function getLinksByCreatedAtRange($startDate, $endDate)
    {
        return Link::whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public function getLinksByUpdatedAtRange($startDate, $endDate)
    {
        return Link::whereBetween('updated_at', [$startDate, $endDate])->get();
    }

    public function getLinksBySearchQuery($searchQuery)
    {
        return Link::where('title', 'LIKE', "%{$searchQuery}%")
            ->orWhere('description', 'LIKE', "%{$searchQuery}%")
            ->get();
    }

    public function getLinksByCategory($categoryId)
    {
        return Link::where('category_id', $categoryId)->get();
    }

    public function getLinksByTag($tagId)
    {
        return Link::whereHas('tags', function ($query) use ($tagId) {
            $query->where('tags.id', $tagId);
        })->get();
    }

    public function getLinksByAuthor($authorId)
    {
        return Link::where('author_id', $authorId)->get();
    }

    public function getLinksByViewsCountRange($minViews, $maxViews)
    {
        return Link::whereBetween('views_count', [$minViews, $maxViews])->get();
    }

    public function getLinksByLikesCountRange($minLikes, $maxLikes)
    {
        return Link::whereBetween('likes_count', [$minLikes, $maxLikes])->get();
    }

    public function getLinksByCommentsCountRange($minComments, $maxComments)
    {
        return Link::whereBetween('comments_count', [$minComments, $maxComments])->get();
    }
}
