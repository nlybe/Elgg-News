<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

namespace Elgg\News\Upgrades;

use Elgg\Upgrade\AsynchronousUpgrade;
use Elgg\Upgrade\Result;
use ElggObject;

/**
 * Migrate 'object', 'amapnews' to 'object', 'news'
 *
 * @since 3.0
 */
class MigrateNews extends AsynchronousUpgrade {

    /**
     * {@inheritDoc}
     */
    public function getVersion(): int {
        if (!isset($this->_version)) {
			$this->_version = date('Ymd') . rand(10, 99);
		}
		
		return $this->_version;
        // return 2017110700;
    }

    /**
     * {@inheritDoc}
     */
    public function shouldBeSkipped(): bool {
        return empty($this->countItems());
    }

    /**
     * {@inheritDoc}
     */
    public function countItems(): int {
        return elgg_get_entities([
            'type' => 'object',
            'subtype' => 'amapnews',
            'count' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function needsIncrementOffset(): bool {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function run(Result $result, $offset): Result {

        /* @var \ElggBatch $entities */
        $entities = elgg_get_entities([
            'type' => 'object',
            'subtype' => 'amapnews',
            'offset' => $offset,
            'limit' => 25,
            'batch' => true,
            'batch_inc_offset' => $this->needsIncrementOffset(),
        ]);

        /* @var $e \ElggObject */
        foreach ($entities as $e) {
            if ($this->migrate($e)) {
                $result->addSuccesses();
            } else {
                $result->addError("Error migrating news: {$e->guid}");
                $result->addFailures();
            }
        }
    }

    /**
     * Migrate one amapnews to a news
     *
     * @param ElggObject amapnews to migrate
     *
     * @return bool
     */
    protected function migrate(ElggObject $e) {

        $dbprefix = elgg_get_config('dbprefix');
        $query = "UPDATE {$dbprefix}entities
			SET subtype = 'news'
			WHERE guid = {$e->guid}
		";

        if (!elgg()->db->updateData($query)) {
            return false;
        }

        return true;
    }

}
