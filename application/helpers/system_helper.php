<?php

use Ramsey\Uuid\Uuid;

function rmdirFull($dirPath)
{
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        reset($objects);
        rmdir($dirPath);
    }
}

function uuid()
{
    $uuid = Uuid::uuid4();
    return $uuid->toString();
}

function input($name, $options = [])
{
    $ci = &get_instance();
    $value = $ci->input->get($name, true);
    if ($value == null) {
        $value = $ci->input->post($name, true);
    }

    if (isset($options['type']) && $options['type'] == 'number') {
        if ($value == null) $value = 0;
    }
    return $value;
}

function currentUrl()
{
    return base64_encode(current_url() . '/?' . $_SERVER['QUERY_STRING']);
}

function getItemTags()
{
    return ['armor', 'weapon', 'offHand', 'resource', 'food', 'potion', 'recipe', 'quest', 'chest', 'jewel', 'other'];
}

function getItemTypes()
{
    return [
        'armor' => ['head', 'body', 'feet', 'arm'],
        'weapon' => ['axe', 'bow', 'wand', 'sword', 'pickaxe', 'sickle', 'hammer'],
        'offHand' => ['shield'],
        'resource' => ['wood', 'stone', 'hide', 'ore', 'fiber'],
        'food' => ['Meat', 'Fish', 'Fruit', 'Vegetable'],
        'potion' => ['hp', 'mp'],
        'recipe' => ['armor', 'axe', 'bow', 'shield', 'sword', 'wand', 'potion', 'food'],
        'quest' => [],
        'chest' => [],
        'jewel' => ['blue', 'red', 'green', 'purple'],
        'other' => []
    ];
}

function getItemSpecsField()
{
    return [
        'armor' => [
            [
                'type' => 'number',
                'name' => 'speed',
            ],
            [
                'type' => 'number',
                'name' => 'armor',
            ],
            [
                'type' => 'number',
                'name' => 'hp',
            ],
            [
                'type' => 'number',
                'name' => 'mp',
            ],
            [
                'type' => 'number',
                'name' => 'hpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'mpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'ccResistance',
            ],
            [
                'type' => 'number',
                'name' => 'magicalResistance',
            ],
            [
                'type' => 'number',
                'name' => 'critical',
            ],
        ],
        'weapon' => [
            [
                'type' => 'number',
                'name' => 'hp',
            ],
            [
                'type' => 'number',
                'name' => 'damage',
            ],
            [
                'type' => 'number',
                'name' => 'hpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'attackSpeed',
            ],
            [
                'type' => 'number',
                'name' => 'critical',
            ],
            [
                'type' => 'number',
                'name' => 'range',
            ],
        ],
        'offHand' => [
            [
                'type' => 'number',
                'name' => 'armor',
            ]
        ],
        'resource' => [],
        'food' => [
            [
                'type' => 'number',
                'name' => 'hp',
            ],
            [
                'type' => 'number',
                'name' => 'mp',
            ],
            [
                'type' => 'number',
                'name' => 'hpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'mpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'countDown',
            ],
        ],
        'potion' => [
            [
                'type' => 'number',
                'name' => 'hp',
            ],
            [
                'type' => 'number',
                'name' => 'mp',
            ],
            [
                'type' => 'number',
                'name' => 'hpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'mpRegen',
            ],
            [
                'type' => 'number',
                'name' => 'countDown',
            ],
        ],
        'recipe' => [],
        'quest' => [],
        'chest' => [],
        'jewel' => [
            [
                'type' => 'number',
                'name' => 'critical',
            ],
            [
                'type' => 'number',
                'name' => 'hpBonus',
            ],
            [
                'type' => 'number',
                'name' => 'mpBonus',
            ],
            [
                'type' => 'number',
                'name' => 'damageBonus',
            ],
        ],
        'other' => []
    ];
}

function getItemCategories()
{
    return [
        'armor' => ['ranged', 'melee', 'magic'],
        'weapon' => [],
        'offHand' => [],
        'resource' => [],
        'food' => [],
        'potion' => [],
        'recipe' => [],
        'quest' => [],
        'chest' => []
    ];
}
