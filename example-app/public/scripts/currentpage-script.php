<?php
function getCurrentPage() {
    $currentPage = basename($_SERVER["PHP_SELF"], ".php");
    $currentPage = preg_replace('/(?<!\ )[A-Z]/', ' $0', $currentPage);
    $currentPage = ucfirst($currentPage);
    return $currentPage;
}
