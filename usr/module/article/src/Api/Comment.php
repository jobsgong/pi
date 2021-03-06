<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt BSD 3-Clause License
 */

namespace Module\Article\Api;

use Module\Article\Service;
use Pi;
use Pi\Application\Api\AbstractComment;

/**
 * Comment target callback handler
 *
 * @author Zongshu Lin <lin40553024@163.com>
 */
class Comment extends AbstractComment
{
    /** @var string */
    protected $module = 'article';

    /**
     * Get target data
     *
     * @param int|int[] $item Item id(s)
     *
     * @return array
     */
    public function get($item)
    {
        $result = [];
        $items  = (array)$item;

        //$route = Pi::api('api', $this->module)->getRouteName();
        $route = 'article';

        // Get articles
        $where        = ['id' => $items];
        $columns      = ['id', 'subject', 'time_publish', 'uid'];
        $modelArticle = Pi::model('article', $this->module);
        $articles     = $modelArticle->getSearchRows($where, null, null, $columns);

        // Get article slugs
        $modelExtended = Pi::model('extended', $this->module);
        $rowset        = $modelExtended->select(['article' => $items]);
        $slugs         = [];
        foreach ($rowset as $row) {
            $slugs[$row->article] = $row->slug;
        }

        foreach ($items as $id) {
            $result[$id] = [
                'id'    => $id,
                'title' => $articles[$id]['subject'],
                'url'   => Pi::service('url')->assemble(
                    $route,
                    [
                        'module' => $this->module,
                        'id'     => $id,
                        'slug'   => $slugs[$id],
                        'time'   => $articles[$id]['time_publish'],
                    ]
                ),
                'uid'   => $articles[$id]['uid'],
                'time'  => $articles[$id]['time_publish'],
            ];
        }

        if (is_scalar($item)) {
            $result = $result[$item];
        }

        return $result;
    }
}
