<?php

    function createStatus($status = 1, $id = 0, $option = 'order') {
        $url = url("admin/$option/status-{$status}/{$id}");
        if($option == 'order') {
            if($status) {
                return '<a href="'.$url.'" class="btn btn-warning">Đã giao</a>';
            }
            return '<a href="'.$url.'" class="btn btn-info">Mới nhận</a>';
        }
        if($option == 'product') {
            if($status) {
                return '<a href="'.$url.'" class="btn btn-warning">Active</a>';
            }
            return '<a href="'.$url.'" class="btn btn-info">Inactive</a>';
        }
    }

    function fotmatPrice($price, $option = null) {
        return number_format($price, 0, " ",".") . ' đ';
    }

    function createBtnNewSale($created_at = 0, $sale_price) {
        $xhtml = '';
        if(strtotime($created_at) + 7*24*60*60 > time()) {
            $xhtml .= '<span class="label sale">New</span>';
        }
        if($sale_price > 0) {
            $xhtml .= '<span class="label sale">Sale</span>';
        }
        return '<div class="labels">'.$xhtml.'</div>';
    }

    function createPrice($price = 0, $sale_price = 0) {
        $xhtml = '';
        if($sale_price > 0) {
            $xhtml = '<i style="text-decoration: line-through;">'.fotmatPrice($price).'</i> ' . fotmatPrice($sale_price);
        }else {
            if($price > 0) {
                $xhtml = fotmatPrice($price);
            }else {
                $xhtml = 'Liên hệ';
            }
        }
        return '<span class="price">'.$xhtml.'</span>';
    }

?>