<?php

class Tab
{
    public function testAjax()
    {
        // Danh sách nội dung tab
        $tabs = [
            'tab1' => '<p>This is the content of Tab 1.</p>',
            'tab2' => '<p>This is the content of Tab 2.</p>',
            'tab3' => '<p>This is the content of Tab 3.</p>'
        ];

        // Lấy giá trị tab từ request
        $tab = $_POST['tab'] ?? null;

        // Trả về nội dung tương ứng
        if (isset($tabs[$tab])) {
            return $tabs[$tab];
        }

        // Nếu tab không tồn tại, trả về thông báo lỗi
        return '<p>Tab content not found.</p>';
    }
}
