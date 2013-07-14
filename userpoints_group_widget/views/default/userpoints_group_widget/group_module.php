<?php
/**
 * Userpoints group module
 */

$group = elgg_get_page_owner_entity();

if ($group->userpoints_group_widget_enable == "no") {
    return true;
}

$limit = 5;

elgg_push_context('widgets');
$options = array('type' => 'user',
                 'limit' => $limit,
                 'relationship' => 'member',
                 'relationship_guid' => $group->guid,
                 'inverse_relationship' => true,
                 'order_by_metadata' =>  array('name' => 'userpoints_points', 'direction' => DESC, 'as' => integer));
$options['metadata_name_value_pairs'] = array(array('name' => 'userpoints_points', 'value' => 0,  'operand' => '>'));
$entities = elgg_get_entities_from_relationship($options);

$content = '';

foreach ($entities as $entity) {
                $icon = elgg_view_entity_icon($entity, 'small');
                $branding = (abs($entity->userpoints_points) > 1) ? elgg_echo('elggx_userpoints:lowerplural') : elgg_echo('elggx_userpoints:lowersingular');
                $info = "<a href=\"{$entity->getURL()}\">{$entity->name}</a><br><b>{$entity->userpoints_points} $branding</b>";
                $content .= elgg_view('page/components/image_block', array('image' => $icon, 'body' => $info));
            }
elgg_pop_context();

echo elgg_view('groups/profile/module', array('title' => elgg_echo('userpoints_group_widget:top_group_members'),'content' => $content));
