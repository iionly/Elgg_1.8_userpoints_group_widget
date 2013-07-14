<?php

$limit = 5;

$options = array('type' => 'user',
                 'limit' => $limit,
                 'relationship' => 'member',
                 'relationship_guid' => $vars['entity']->guid,
                 'inverse_relationship' => true,
                 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
$options['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => 0,  'operand' => '>'));
$entities = elgg_get_entities_from_relationship($options);

$html = '';

?>

<div class="elgg-module elgg-module-aside">
    <div class="elgg-head">
        <h3><?php echo elgg_echo('userpoints_group_widget:top_group_members'); ?></h3>
    </div>
    <div>
        <?php
            foreach ($entities as $entity) {
                $icon = elgg_view_entity_icon($entity, 'tiny');
                $branding = (abs($entity->userpoints_points) > 1) ? elgg_echo('elggx_userpoints:lowerplural') : elgg_echo('elggx_userpoints:lowersingular');
                $info = "<a href=\"{$entity->getURL()}\">{$entity->name}</a><br><b>{$entity->userpoints_points} $branding</b>";
                $html .= elgg_view('page/components/image_block', array('image' => $icon, 'body' => $info));
            }
            echo $html;
        ?>
    </div>
</div>
