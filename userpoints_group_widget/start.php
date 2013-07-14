<?php

elgg_register_event_handler('init','system','userpoints_group_widget_init');

function userpoints_group_widget_init() {

    // uncommenting the following line would list the top users in the sidebar of groups
    //elgg_extend_view('groups/sidebar/members', 'userpoints_group_widget/sidebar');

    // Add group option
    add_group_tool_option('userpoints_group_widget', elgg_echo('userpoints_group_widget:enable_userpoints_group_widget'), true);
    elgg_extend_view('groups/tool_latest', 'userpoints_group_widget/group_module');

    if (elgg_is_active_plugin('widget_manager')) {
        //add groups widget
        elgg_register_widget_type('userpoints_group_widget', elgg_echo("userpoints_group_widget:top_group_members"), elgg_echo('userpoints_group_widget:top_group_members'), "groups");
    }
}