<?php

namespace App\Repositories;

use App\Models\Link;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LinksCacheRepository implements LinkRepositoryInterface
{
    const CACHE_KEY_PREFIX = 'links:';
    const CACHE_EXPIRE_TIME = 3600;

    public function getAllLinks(): Collection
    {
        return Link::all();
    }

    public function createLink($data): Link
    {
        $link = Link::create($data);

        $this->cacheLink($link->id, $link->toArray());

        return $link;
    }

    public function updateLink($id, $data)
    {
        $link = Link::findOrFail($id);

        $link->update($data);

        $this->cacheLink($link->id, $link->toArray());

        return $link;
    }

    public function deleteLink($id)
    {
        Link::destroy($id);

        Cache::forget(self::CACHE_KEY_PREFIX . $id);
    }

    public function getLinkById($id)
    {
        $linkData = Cache::remember(self::CACHE_KEY_PREFIX . $id, 3600, fn () =>
            Link::findOrFail($id)->toArray()
        );

        return new Link($linkData);
    }

    public function getLinkByAddress($address)
    {
        $linkData = Cache::remember(self::CACHE_KEY_PREFIX . $address, 3600, fn () =>
            Link::where('address', $address)->firstOrFail()->toArray()
        );

        return new Link($linkData);
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

    private function cacheLink(string $id, array $linkData)
    {
        Cache::put(self::CACHE_KEY_PREFIX . $id, $linkData, self::CACHE_EXPIRE_TIME);
    }
}
