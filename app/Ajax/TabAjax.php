<?php

require_once './app/Ajax/Ajax.php';

class TabAjax extends Ajax
{
    public function __construct()
    {
        parent::__construct();
    }

    // Example action for handling tab content
    protected function loadTabContent()
    {
        $tab = isset($_POST['tab']) ? $_POST['tab'] : '';

        $content = $this->getTabContent($tab);

        if ($content) {
            $this->respond(['success' => true, 'content' => $content]);
        } else {
            $this->respond(['success' => false, 'message' => 'Tab not found.']);
        }
    }

    private function getTabContent($tab)
    {
        $tabs = [
            'tab1' => '<p>This is the content of Tab 1.</p>',
            'tab2' => '<p>This is the content of Tab 2.</p>',
            'tab3' => '<p>This is the content of Tab 3.</p>'
        ];

        return isset($tabs[$tab]) ? $tabs[$tab] : null;
    }
}
