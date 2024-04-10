<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $menu->id . '</td>
                    <td>' . $char . $menu->name . '</td>
                    <td>' . self::active($menu->active) . '</td>
                    <td>' . $menu->updated_at . '</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/menus/edit/' . $menu->id . '"><i class="fas fa-edit"></i> Edit</a>

                        <a class="btn btn-danger" href="#" onclick="removeRow(' . $menu->id . ',  \'/admin/menus/delete\')"><i class="fas fa-trash" style="padding-right: 4px"></i>Delete</a>
                    </td>
                </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '--');

            }
        }

        return $html;
    }

    public static function active($active): string
    {
        return $active == 0 ? '<span class="btn btn-danger">No</span>' : '<span class="btn btn-success">Yes</span>';
    }

    // sử dụng đêj quy để load danh mục sản phẩm 
    public static function menus($menus, $parent_id = 0): string
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                // cấp 1
                $html .= '
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name) . '">
                            ' . $menu->name . '
                        </a>';

                unset($menu[$key])
                ;

                // kiểm tra nếu isChild là con thì sẽ reder ra
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>
                ';
            }
        }

        return $html;
    }

    // viết hàm kiểm tra xem nó có phải cấp 2 hay không
    public static function isChild($menus, $id): bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }

        return false;
    }
}