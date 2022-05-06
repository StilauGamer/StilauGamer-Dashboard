<?php
# Checking for errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getCurrentPage() {
    $currentPage = ucfirst(basename($_SERVER["PHP_SELF"], ".php"));
    return $currentPage;
}

function setCurrentPage($user_id, $page) {
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    $stmt = $conn->prepare("UPDATE users SET last_page=:last_page WHERE user_id=:user_id");
    $stmt->bindParam(":last_page", $page);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}


function getThemeColor($themeid, $colorName, $type) {
    # IF STATEMENTS
    # QUERY ETTER COLOR THEME ETTER ID
    # SJEKKER ROWS
    # FETCHER COLORSA
    # RETURNER FARGEN
    include $_SERVER['DOCUMENT_ROOT']."/mysql.php";
    if (!$type == "rgb") {
        if ($stmt = $conn->prepare("SELECT * FROM themes WHERE theme_id=:theme_id")) {
            $stmt->bindParam(":theme_id", $themeid);
            $stmt->execute();
            $result = $stmt->fetch();
            switch ($colorName) {
                case "background-color":
                    return $result["background-color"];
                    break;
                case "main-color":
                    return $result["main-color"];
                    break;
                case "box-color":
                    return $result["box-color"];
                    break;
                case "text-color":
                    return $result["text-color"];
                    break;
                default:
                    return "#FFFFFF";
                    break;
            }
        }
    }
    if ($stmt = $conn->prepare("SELECT * FROM themes WHERE theme_id=:theme_id")) {
        $stmt->bindParam(":theme_id", $themeid);
        $stmt->execute();
        $result = $stmt->fetch();
        switch ($colorName) {
            case "background-color":
                return $result["background-color"];
                break;
            case "main-color":
                return $result["main-color"];
                break;
            case "box-color":
                return $result["box-color"];
                break;
            case "text-color":
                return $result["text-color"];
                break;
            default:
                return "#FFFFFF";
                break;
        }
    }
}
?>