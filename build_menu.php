<?php
function buildMenu($menuItems, $parentId = null) {
    $html = '';

    $filteredItems = array_filter($menuItems, function ($item) use ($parentId) {
        return $item['parent_id'] == $parentId;
    });

    if (!empty($filteredItems)) {
        $html .= '<ul>';
        foreach ($filteredItems as $item) {
            $html .= '<li>';

            $link = !empty($item['page_link']) ? $item['page_link'] : '#';
            $html .= '<a href="' . htmlspecialchars($link) . '">' . htmlspecialchars($item['menu_name']) . '</a>';

            $html .= buildMenu($menuItems, $item['menu_id']);

            $html .= '</li>';
        }
        $html .= '</ul>';
    }

    return $html;
}
?>
