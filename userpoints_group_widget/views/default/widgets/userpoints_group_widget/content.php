<?php
/**
 * Groups profile page Userpoints widget for Widget Manager plugin
 *
 */

// get widget settings
$count = sanitise_int($vars["entity"]->userpoints_group_widget_count, false);
if(empty($count)){
        $count = 5;
}

$prev_context = elgg_get_context();
elgg_set_context('groups');

$options = array('type' => 'user',
                 'limit' => $limit,
                 'relationship' => 'member',
                 'relationship_guid' => elgg_get_page_owner_guid(),
                 'inverse_relationship' => true,
                 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
$options['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => 0,  'operand' => '>'));
$entities = elgg_get_entities_from_relationship($options);

elgg_set_context($prev_context);

$content = '';

foreach ($entities as $entity) {
                $icon = elgg_view_entity_icon($entity, 'small');
                $branding = (abs($entity->userpoints_points) > 1) ? elgg_echo('elggx_userpoints:lowerplural') : elgg_echo('elggx_userpoints:lowersingular');
                $info = "<a href=\"{$entity->getURL()}\">{$entity->name}</a><br><b>{$entity->userpoints_points} $branding</b>";
                $content .= elgg_view('page/components/image_block', array('image' => $icon, 'body' => $info));
            }

echo $content;
