<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
	procted $_accessible = [
		'*' => true.
		'id' => false,
		'slug' => false,
	]
}
