<?php
/**
 * Elgg News plugin
 * @package elgg-news
 */

namespace Elgg\News;

use Elgg\Database\Seeds\Seed;

/**
 * Add news seed
 *
 * @access private
 */
class Seeder extends Seed {

    /**
     * {@inheritdoc}
     */
    public function seed() {

        $count_news = function () {
            return elgg_get_entities([
                'types' => 'object',
                'subtypes' => 'news',
                'metadata_names' => '__faker',
                'count' => true,
            ]);
        };

        while ($count_news() < $this->limit) {
            $metadata = [
                'address' => $this->faker()->url,
            ];

            $attributes = [
                'subtype' => 'news',
            ];

            $new = $this->createObject($attributes, $metadata);

            if (!$new) {
                continue;
            }

            $this->createComments($new);
            $this->createLikes($new);

            elgg_create_river_item([
                'view' => 'river/object/news/create',
                'action_type' => 'create',
                'subject_guid' => $new->owner_guid,
                'object_guid' => $new->guid,
                'target_guid' => $new->container_guid,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unseed() {

        $news = elgg_get_entities([
            'types' => 'object',
            'subtypes' => 'news',
            'metadata_names' => '__faker',
            'limit' => 0,
            'batch' => true,
        ]);

        /* @var $news \ElggBatch */

        $news->setIncrementOffset(false);

        foreach ($news as $n) {
            if ($n->delete()) {
                $this->log("Deleted news $n->guid");
            } else {
                $this->log("Failed to delete news $n->guid");
            }
        }
    }

	/**
	 * {@inheritDoc}
	 */
	public static function getType() : string {
		return 'news';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getCountOptions() : array {
		return [
			'type' => 'object',
			'subtype' => 'news',
		];
	}

}
